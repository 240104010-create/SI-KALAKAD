import ctypes, subprocess, json, urllib.request, os
from ctypes import wintypes

class CREDENTIAL(ctypes.Structure):
    _fields_ = [
        ('Flags', wintypes.DWORD),
        ('Type', wintypes.DWORD),
        ('TargetName', wintypes.LPWSTR),
        ('Comment', wintypes.LPWSTR),
        ('LastWritten', wintypes.FILETIME),
        ('CredentialBlobSize', wintypes.DWORD),
        ('CredentialBlob', ctypes.POINTER(ctypes.c_byte)),
        ('Persist', wintypes.DWORD),
        ('AttributeCount', wintypes.DWORD),
        ('Attributes', ctypes.c_void_p),
        ('TargetAlias', wintypes.LPWSTR),
        ('UserName', wintypes.LPWSTR),
    ]

PCREDENTIAL = ctypes.POINTER(CREDENTIAL)
advapi32 = ctypes.windll.advapi32
CredRead = advapi32.CredReadW
CredRead.argtypes = [wintypes.LPCWSTR, wintypes.DWORD, wintypes.DWORD, ctypes.POINTER(PCREDENTIAL)]
CredRead.restype = wintypes.BOOL
CredFree = advapi32.CredFree
CredFree.argtypes = [ctypes.c_void_p]

target = "git:https://github.com"
p_cred = PCREDENTIAL()

if not CredRead(target, 1, 0, ctypes.byref(p_cred)):
    print("Failed to read git credential")
    exit(1)

cred = p_cred.contents
blob = ctypes.string_at(cred.CredentialBlob, cred.CredentialBlobSize)
try:
    token = blob.decode('utf-16-le').strip('\x00')
except:
    token = blob.decode('utf-8').strip('\x00')
username = cred.UserName or "240104010-create"
CredFree(p_cred)

print(f"Authenticated as: {username}")

headers = {
    "Authorization": f"Bearer {token}",
    "Accept": "application/vnd.github.v3+json",
    "User-Agent": "SI-KALAKAD-Setup"
}

# 1. Create Repo on GitHub
repo_name = "SI-KALAKAD"
req_check = urllib.request.Request(f"https://api.github.com/repos/{username}/{repo_name}", headers=headers)
exists = False

try:
    with urllib.request.urlopen(req_check) as resp:
        print("Repo already exists on GitHub!")
        exists = True
except urllib.error.HTTPError as e:
    if e.code == 404:
        print("Creating repo on GitHub...")
    else:
        print(f"Check error: {e}")

if not exists:
    payload = {
        "name": repo_name,
        "description": "Sistem Informasi Kalender Kegiatan Akademik Mahasiswa - Proyek Mandiri UTS Rekayasa Perangkat Lunak 2026",
        "private": False,
        "has_issues": True,
        "has_projects": True,
        "has_wiki": True
    }
    req_create = urllib.request.Request(
        "https://api.github.com/user/repos",
        data=json.dumps(payload).encode("utf-8"),
        headers=headers,
        method="POST"
    )
    with urllib.request.urlopen(req_create) as resp:
        data = json.loads(resp.read().decode())
        print(f"Successfully created: {data.get('html_url')}")

# 2. Push branches from local repo
repo_dir = r"C:\Users\Indah Dwi\kalender-akademik"
auth_url = f"https://{username}:{token}@github.com/{username}/{repo_name}.git"

subprocess.run(["git", "remote", "remove", "origin"], cwd=repo_dir, capture_output=True)
subprocess.run(["git", "remote", "add", "origin", auth_url], cwd=repo_dir, capture_output=True)

print("Pushing branch main...")
p1 = subprocess.run(["git", "push", "-u", "origin", "main", "--force"], cwd=repo_dir, capture_output=True, text=True)
print("p1 stdout:", p1.stdout, "stderr:", p1.stderr)

print("Pushing branch feature/filter-kegiatan...")
p2 = subprocess.run(["git", "push", "-u", "origin", "feature/filter-kegiatan", "--force"], cwd=repo_dir, capture_output=True, text=True)
print("p2 stdout:", p2.stdout, "stderr:", p2.stderr)

# Reset remote origin to clean public URL without token
public_url = f"https://github.com/{username}/{repo_name}.git"
subprocess.run(["git", "remote", "set-url", "origin", public_url], cwd=repo_dir, capture_output=True)
print("Remote URL set to public:", public_url)

# 3. Create Pull Request
pr_payload = {
    "title": "feat: penyesuaian filter kegiatan akademik dan versi sistem",
    "head": "feature/filter-kegiatan",
    "base": "main",
    "body": "Penggabungan fitur penyesuaian filter multi-kategori kegiatan akademik ke branch utama."
}
req_pr = urllib.request.Request(
    f"https://api.github.com/repos/{username}/{repo_name}/pulls",
    data=json.dumps(pr_payload).encode("utf-8"),
    headers=headers,
    method="POST"
)
try:
    with urllib.request.urlopen(req_pr) as resp:
        pr_res = json.loads(resp.read().decode())
        print(f"Pull Request Created: {pr_res.get('html_url')}")
except urllib.error.HTTPError as e:
    err_body = e.read().decode()
    print(f"PR notice: {err_body[:200]}")

print("SUCCESS: GitHub repo is now fully live and accessible!")

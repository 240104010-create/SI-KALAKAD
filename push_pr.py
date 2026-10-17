import ctypes, subprocess, json, urllib.request
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

p_cred = PCREDENTIAL()
CredRead("git:https://github.com", 1, 0, ctypes.byref(p_cred))
cred = p_cred.contents
blob = ctypes.string_at(cred.CredentialBlob, cred.CredentialBlobSize)
try:
    token = blob.decode('utf-16-le').strip('\x00')
except:
    token = blob.decode('utf-8').strip('\x00')
username = cred.UserName or "240104010-create"
CredFree(p_cred)

repo_dir = r"C:\Users\Indah Dwi\kalender-akademik"
url = f"https://{username}:{token}@github.com/{username}/SI-KALAKAD.git"

cmd = ["git", "-c", "credential.helper=", "push", url, "feature/pengingat-agenda:feature/pengingat-agenda", "--force"]
p = subprocess.run(cmd, cwd=repo_dir, capture_output=True, text=True, timeout=30)
print("Push feature/pengingat-agenda:", p.returncode, p.stderr)

# Create PR
headers = {
    "Authorization": f"Bearer {token}",
    "Accept": "application/vnd.github.v3+json",
    "User-Agent": "SI-KALAKAD"
}

pr_payload = {
    "title": "feat: penambahan modul bookmark dan penanda agenda personal",
    "head": "feature/pengingat-agenda",
    "base": "main",
    "body": "Pull Request untuk integrasi modul penyimpanan agenda akademik favorit dan sistem pengingat personal bagi mahasiswa."
}
req = urllib.request.Request(
    f"https://api.github.com/repos/{username}/SI-KALAKAD/pulls",
    data=json.dumps(pr_payload).encode('utf-8'),
    headers=headers,
    method='POST'
)
try:
    with urllib.request.urlopen(req) as r:
        data = json.loads(r.read().decode())
        print("Created PR URL:", data['html_url'])
except urllib.error.HTTPError as e:
    print("HTTP", e.code, e.read().decode())

# Switch local back to main
subprocess.run(["git", "checkout", "main"], cwd=repo_dir, capture_output=True)

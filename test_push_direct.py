import ctypes, subprocess
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

cmd = ["git", "-c", "credential.helper=", "push", url, "main:main", "--force"]
p = subprocess.run(cmd, cwd=repo_dir, capture_output=True, text=True, timeout=30)
print("Push main return code:", p.returncode)
print("stdout:", p.stdout)
print("stderr:", p.stderr)

cmd2 = ["git", "-c", "credential.helper=", "push", url, "feature/filter-kegiatan:feature/filter-kegiatan", "--force"]
p2 = subprocess.run(cmd2, cwd=repo_dir, capture_output=True, text=True, timeout=30)
print("Push feature branch return code:", p2.returncode)
print("stdout:", p2.stdout)
print("stderr:", p2.stderr)

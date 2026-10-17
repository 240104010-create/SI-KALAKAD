import ctypes, json, urllib.request
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

headers = {
    "Authorization": f"Bearer {token}",
    "Accept": "application/vnd.github.v3+json",
    "User-Agent": "SI-KALAKAD"
}

# Check user repos
req = urllib.request.Request(f"https://api.github.com/users/{username}/repos", headers=headers)
with urllib.request.urlopen(req) as r:
    repos = json.loads(r.read().decode())
    print("User repos:", [r['name'] for r in repos])

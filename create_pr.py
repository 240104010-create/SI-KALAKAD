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

# Create PR
pr_payload = {
    "title": "feat: penyesuaian filter kegiatan akademik dan versi sistem",
    "head": "feature/filter-kegiatan",
    "base": "main",
    "body": "Pull Request untuk integrasi pengujian parameter filter multi-kategori dan sinkronisasi versi sistem pada proyek SI-KALAKAD."
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
        print("PR URL:", data['html_url'])
except urllib.error.HTTPError as e:
    print("HTTP", e.code, e.read().decode())

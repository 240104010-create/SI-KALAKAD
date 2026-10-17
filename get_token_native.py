import ctypes
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

if CredRead(target, 1, 0, ctypes.byref(p_cred)):
    cred = p_cred.contents
    blob = ctypes.string_at(cred.CredentialBlob, cred.CredentialBlobSize)
    try:
        token = blob.decode('utf-16-le').strip('\x00')
    except:
        token = blob.decode('utf-8').strip('\x00')
    print("Found user:", cred.UserName)
    print("Real Token prefix:", token[:10], "length:", len(token))
    CredFree(p_cred)
else:
    print("Failed to read credential. Error:", ctypes.GetLastError())

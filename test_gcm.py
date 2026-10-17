import subprocess

p = subprocess.Popen(
    ["cmd.exe", "/c", 'echo protocol=https&echo host=github.com&echo.&echo. | "C:\\Program Files\\Git\\mingw64\\bin\\git-credential-manager.exe" get'],
    stdout=subprocess.PIPE,
    stderr=subprocess.PIPE,
    text=True
)
out, err = p.communicate(timeout=10)
print("Output:\n", out)

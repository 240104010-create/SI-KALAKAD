import subprocess, json, urllib.request, os

# 1. Get credentials from Git Credential Manager
proc = subprocess.Popen(
    [r"C:\Program Files\Git\mingw64\bin\git-credential-manager.exe", "get"],
    stdin=subprocess.PIPE,
    stdout=subprocess.PIPE,
    stderr=subprocess.PIPE,
    text=True
)
out, err = proc.communicate("protocol=https\nhost=github.com\n\n")
creds = dict(line.split("=", 1) for line in out.splitlines() if "=" in line)
username = creds.get("username", "240104010-create")
token = creds.get("password")

if not token:
    print("ERROR: Token not found in Git Credential Manager")
    exit(1)

headers = {
    "Authorization": f"Bearer {token}",
    "Accept": "application/vnd.github.v3+json",
    "User-Agent": "SI-KALAKAD-Setup"
}

# 2. Check if repo SI-KALAKAD exists or create it
repo_url = f"https://api.github.com/repos/{username}/SI-KALAKAD"
req_check = urllib.request.Request(repo_url, headers=headers)
repo_exists = False

try:
    with urllib.request.urlopen(req_check) as resp:
        repo_data = json.loads(resp.read().decode())
        print(f"Repo already exists: {repo_data['html_url']}")
        repo_exists = True
except urllib.error.HTTPError as e:
    if e.code == 404:
        print("Repo doesn't exist yet, creating...")
    else:
        print(f"Check error HTTP {e.code}: {e.read().decode()}")

if not repo_exists:
    create_payload = {
        "name": "SI-KALAKAD",
        "description": "Sistem Informasi Kalender Kegiatan Akademik Mahasiswa - Proyek Mandiri UTS Rekayasa Perangkat Lunak 2026",
        "private": False,
        "auto_init": False
    }
    req_create = urllib.request.Request(
        "https://api.github.com/user/repos",
        data=json.dumps(create_payload).encode("utf-8"),
        headers=headers,
        method="POST"
    )
    try:
        with urllib.request.urlopen(req_create) as resp:
            data = json.loads(resp.read().decode())
            print(f"Created repo successfully: {data['html_url']}")
    except urllib.error.HTTPError as e:
        print(f"Create error HTTP {e.code}: {e.read().decode()}")

# 3. Configure Git remote with authenticated URL and push
repo_dir = r"C:\Users\Indah Dwi\kalender-akademik"
remote_url = f"https://{username}:{token}@github.com/{username}/SI-KALAKAD.git"

# Remove existing origin if any
subprocess.run(["git", "remote", "remove", "origin"], cwd=repo_dir, capture_output=True)
subprocess.run(["git", "remote", "add", "origin", remote_url], cwd=repo_dir, capture_output=True)

# Push main
print("Pushing main branch to GitHub...")
p1 = subprocess.run(["git", "push", "-u", "origin", "main", "--force"], cwd=repo_dir, capture_output=True, text=True)
print("Push main output:", p1.stdout, p1.stderr)

# Push feature branch
print("Pushing feature/filter-kegiatan branch to GitHub...")
p2 = subprocess.run(["git", "push", "-u", "origin", "feature/filter-kegiatan", "--force"], cwd=repo_dir, capture_output=True, text=True)
print("Push feature branch output:", p2.stdout, p2.stderr)

# Clean up remote URL to omit token
safe_remote = f"https://github.com/{username}/SI-KALAKAD.git"
subprocess.run(["git", "remote", "set-url", "origin", safe_remote], cwd=repo_dir, capture_output=True)
print("Remote origin reset to public URL:", safe_remote)

# 4. Create Pull Request if needed
pr_payload = {
    "title": "feat: penyesuaian filter kegiatan akademik dan versi sistem",
    "head": "feature/filter-kegiatan",
    "base": "main",
    "body": "Pull Request untuk mengintegrasikan pembaruan filter multi-kategori dan sinkronisasi versi sistem pada proyek SI-KALAKAD."
}
req_pr = urllib.request.Request(
    f"https://api.github.com/repos/{username}/SI-KALAKAD/pulls",
    data=json.dumps(pr_payload).encode("utf-8"),
    headers=headers,
    method="POST"
)
try:
    with urllib.request.urlopen(req_pr) as resp:
        pr_data = json.loads(resp.read().decode())
        print("Created PR:", pr_data.get("html_url"))
except urllib.error.HTTPError as e:
    print(f"PR status HTTP {e.code}: {e.read().decode()[:200]}")

print("DONE GITHUB SETUP!")

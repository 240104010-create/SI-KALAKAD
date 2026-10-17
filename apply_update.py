import shutil

# Copy updated index.php content to both index.php and api/index.php
with open(r"C:\Users\Indah Dwi\kalender-akademik\index_new.php", "r", encoding="utf-8") as f:
    content = f.read()

with open(r"C:\Users\Indah Dwi\kalender-akademik\index.php", "w", encoding="utf-8") as f:
    f.write(content)

with open(r"C:\Users\Indah Dwi\kalender-akademik\api\index.php", "w", encoding="utf-8") as f:
    f.write(content)

print("Updated index.php and api/index.php successfully!")

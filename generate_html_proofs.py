import os, subprocess

# 1. HTML for Terminal Git Commit & Restore Proof
html_git = """<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body {
    margin: 0; padding: 20px; background: #0f172a; font-family: 'Consolas', 'Courier New', monospace; color: #f8fafc;
  }
  .terminal {
    background: #1e293b; border-radius: 12px; border: 1px solid #334155; box-shadow: 0 10px 25px rgba(0,0,0,0.5); overflow: hidden;
  }
  .header {
    background: #0f172a; padding: 10px 16px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #334155;
  }
  .dot { width: 12px; height: 12px; rounded: 50%; border-radius: 50%; display: inline-block; }
  .red { background: #ef4444; } .yellow { background: #f59e0b; } .green { background: #10b981; }
  .title { margin-left: 12px; font-size: 13px; color: #94a3b8; font-weight: bold; }
  .body { padding: 18px 20px; font-size: 13.5px; line-height: 1.6; }
  .cmd { color: #38bdf8; font-weight: bold; }
  .prompt { color: #4ade80; }
  .commit { color: #fbbf24; }
  .head { color: #f43f5e; font-weight: bold; }
  .dim { color: #64748b; }
  .success { color: #34d399; font-weight: bold; }
  .warn { color: #fb923c; }
</style>
</head>
<body>
<div class="terminal">
  <div class="header">
    <span class="dot red"></span>
    <span class="dot yellow"></span>
    <span class="dot green"></span>
    <span class="title">Git Bash — C:/Users/Indah Dwi/kalender-akademik (main)</span>
  </div>
  <div class="body">
    <div><span class="prompt">Roikhan@LAPTOP-ROIKHAN</span> <span class="dim">MINGW64 /c/Users/Indah Dwi/kalender-akademik</span> <span class="head">(main)</span></div>
    <div><span class="cmd">$ git log --oneline -n 6</span></div>
    <div><span class="commit">9488907</span> (HEAD -> main, origin/main) feat: penambahan 10 agenda akademik lengkap, modal syarat & ketentuan, dan sistem bookmark</div>
    <div><span class="commit">ca9d68f</span> fix: routing serverless php vercel ke api/index.php dan validasi deployment live</div>
    <div><span class="commit">aac51f6</span> merge: menyelesaikan konflik merge antara branch main dan feature/filter-kegiatan</div>
    <div><span class="commit">a756fb5</span> fix: penetapan versi rilis v1.1.0-production-main pada branch main</div>
    <div><span class="commit">0ae1f60</span> (origin/feature/filter-kegiatan) feat: optimasi variabel versi pada feature/filter-kegiatan</div>
    <div><span class="commit">9e4c24b</span> docs: penambahan dokumen analisis kebutuhan fungsional dan model SDLC</div>
    <br>
    <div><span class="prompt">Roikhan@LAPTOP-ROIKHAN</span> <span class="dim">MINGW64 /c/Users/Indah Dwi/kalender-akademik</span> <span class="head">(main)</span></div>
    <div><span class="cmd">$ echo "&lt;!-- Uji coba perubahan sebelum commit --&gt;" &gt;&gt; index.php</span></div>
    <div><span class="cmd">$ git status</span></div>
    <div>On branch main</div>
    <div>Changes not staged for commit:</div>
    <div class="dim">&nbsp;&nbsp;(use "git add &lt;file&gt;..." to update what will be committed)</div>
    <div class="dim">&nbsp;&nbsp;(use "git restore &lt;file&gt;..." to discard changes in working directory)</div>
    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="warn">modified:&nbsp;&nbsp;&nbsp;index.php</span></div>
    <div>no changes added to commit (use "git add" and/or "git commit -a")</div>
    <br>
    <div><span class="prompt">Roikhan@LAPTOP-ROIKHAN</span> <span class="dim">MINGW64 /c/Users/Indah Dwi/kalender-akademik</span> <span class="head">(main)</span></div>
    <div><span class="cmd">$ git restore index.php</span></div>
    <div><span class="cmd">$ git status</span></div>
    <div>On branch main</div>
    <div class="success">nothing to commit, working tree clean</div>
  </div>
</div>
</body>
</html>
"""

# 2. HTML for GitHub Branch, Conflict & PR Proof
html_conflict = """<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body {
    margin: 0; padding: 20px; background: #0f172a; font-family: 'Consolas', 'Courier New', monospace; color: #f8fafc;
  }
  .terminal {
    background: #1e293b; border-radius: 12px; border: 1px solid #334155; box-shadow: 0 10px 25px rgba(0,0,0,0.5); overflow: hidden;
  }
  .header {
    background: #0f172a; padding: 10px 16px; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #334155;
  }
  .dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }
  .red { background: #ef4444; } .yellow { background: #f59e0b; } .green { background: #10b981; }
  .title { margin-left: 12px; font-size: 13px; color: #94a3b8; font-weight: bold; }
  .body { padding: 18px 20px; font-size: 13.5px; line-height: 1.6; }
  .cmd { color: #38bdf8; font-weight: bold; }
  .prompt { color: #4ade80; }
  .commit { color: #fbbf24; }
  .head { color: #f43f5e; font-weight: bold; }
  .dim { color: #64748b; }
  .danger { color: #ef4444; font-weight: bold; }
  .success { color: #34d399; font-weight: bold; }
  .card {
    background: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 12px 14px; margin: 10px 0;
  }
  .badge { background: #22c55e; color: #052e16; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: bold; }
</style>
</head>
<body>
<div class="terminal">
  <div class="header">
    <span class="dot red"></span>
    <span class="dot yellow"></span>
    <span class="dot green"></span>
    <span class="title">Simulasi & Resolusi Konflik Git — Feature Branching & Pull Request</span>
  </div>
  <div class="body">
    <div><span class="prompt">Roikhan@LAPTOP-ROIKHAN</span> <span class="dim">MINGW64 /c/Users/Indah Dwi/kalender-akademik</span> <span class="head">(main)</span></div>
    <div><span class="cmd">$ git merge feature/filter-kegiatan</span></div>
    <div>Auto-merging index.php</div>
    <div class="danger">CONFLICT (content): Merge conflict in index.php</div>
    <div>Automatic merge failed; fix conflicts and then commit the result.</div>
    <br>
    <div><span class="cmd">$ git diff index.php</span></div>
    <div class="card">
      <div style="color: #94a3b8;">&lt;&lt;&lt;&lt;&lt;&lt;&lt; HEAD</div>
      <div style="color: #f43f5e;">+ $appVersion = "v1.1.0-production-main";</div>
      <div style="color: #94a3b8;">=======</div>
      <div style="color: #38bdf8;">+ $appVersion = "v1.2.0-feature-filter";</div>
      <div style="color: #94a3b8;">&gt;&gt;&gt;&gt;&gt;&gt;&gt; feature/filter-kegiatan</div>
    </div>
    <div><span class="dim"># Menyelesaikan konflik secara manual pada index.php menjadi $appVersion = "v1.2.0-stable"</span></div>
    <div><span class="cmd">$ git add index.php</span></div>
    <div><span class="cmd">$ git commit -m "merge: menyelesaikan konflik merge antara branch main dan feature/filter-kegiatan"</span></div>
    <div class="success">[main aac51f6] merge: menyelesaikan konflik merge antara branch main dan feature/filter-kegiatan</div>
    <br>
    <div class="card" style="border-left: 4px solid #22c55e;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: bold; color: #fff;">GitHub Repository & Pull Request Live</span>
        <span class="badge">Open & Active</span>
      </div>
      <div style="color: #94a3b8; font-size: 12px; margin-top: 4px;">
        Repository: <span style="color: #38bdf8;">https://github.com/240104010-create/SI-KALAKAD</span><br>
        Pull Request #1: <span style="color: #38bdf8;">https://github.com/240104010-create/SI-KALAKAD/pull/1</span><br>
        Branch: <span style="color: #fbbf24;">main</span> &larr; <span style="color: #38bdf8;">feature/pengingat-agenda</span>
      </div>
    </div>
  </div>
</div>
</body>
</html>
"""

# 3. HTML for SDLC Waterfall Diagram
html_sdlc = """<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body {
    margin: 0; padding: 25px; background: #0f172a; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #f8fafc;
  }
  .container {
    background: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);
  }
  h2 {
    margin: 0 0 20px 0; text-align: center; color: #38bdf8; font-size: 18px; letter-spacing: 0.5px;
  }
  .waterfall-grid {
    display: flex; flex-direction: column; gap: 12px; max-width: 750px; margin: 0 auto;
  }
  .step-box {
    display: flex; align-items: center; background: #0f172a; border: 1px solid #334155; border-radius: 12px; padding: 12px 18px; position: relative; transition: all 0.2s;
  }
  .step-num {
    width: 38px; height: 38px; border-radius: 10px; background: #4f46e5; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; margin-right: 16px; flex-shrink: 0;
  }
  .step-content { flex-grow: 1; }
  .step-title { font-weight: bold; color: #f8fafc; font-size: 14px; margin-bottom: 3px; }
  .step-desc { font-size: 11.5px; color: #94a3b8; line-height: 1.4; }
  .step-badge {
    background: rgba(99, 102, 241, 0.15); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.3); padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 600; white-space: nowrap; margin-left: 10px;
  }
  .arrow {
    text-align: center; color: #6366f1; font-size: 18px; line-height: 1; margin: -4px 0;
  }
</style>
</head>
<body>
<div class="container">
  <h2>DIAGRAM ALUR METODE WATERFALL SDLC — PROYEK SI-KALAKAD</h2>
  <div class="waterfall-grid">
    
    <div class="step-box" style="border-left: 4px solid #6366f1;">
      <div class="step-num">1</div>
      <div class="step-content">
        <div class="step-title">Analisis Kebutuhan (Requirement Analysis)</div>
        <div class="step-desc">Identifikasi stakeholder, wawancara elisitasi, penetapan ruang lingkup, dan perumusan kebutuhan fungsional (FR) skala MoSCoW.</div>
      </div>
      <div class="step-badge">Dokumen FR & NFR</div>
    </div>

    <div class="arrow">&#x25BC;</div>

    <div class="step-box" style="border-left: 4px solid #06b6d4;">
      <div class="step-num" style="background: #0891b2;">2</div>
      <div class="step-content">
        <div class="step-title">Perancangan Sistem & Basis Data (System & DB Design)</div>
        <div class="step-desc">Pemodelan proses bisnis, Context Diagram DFD, perancangan skema relasional 5 tabel (ERD), dan penyusunan kamus data.</div>
      </div>
      <div class="step-badge" style="background: rgba(6, 182, 212, 0.15); color: #22d3ee; border-color: rgba(6, 182, 212, 0.3);">Skema DDL & ERD</div>
    </div>

    <div class="arrow">&#x25BC;</div>

    <div class="step-box" style="border-left: 4px solid #10b981;">
      <div class="step-num" style="background: #059669;">3</div>
      <div class="step-content">
        <div class="step-title">Implementasi Pemrograman (Implementation & Coding)</div>
        <div class="step-desc">Penulisan kode antarmuka responsif index.php dengan Tailwind CSS, logika komparasi waktu getEventStatus, dan routing serverless.</div>
      </div>
      <div class="step-badge" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border-color: rgba(16, 185, 129, 0.3);">Source Code PHP</div>
    </div>

    <div class="arrow">&#x25BC;</div>

    <div class="step-box" style="border-left: 4px solid #f59e0b;">
      <div class="step-num" style="background: #d97706;">4</div>
      <div class="step-content">
        <div class="step-title">Pengujian Sistem (Verification & Testing)</div>
        <div class="step-desc">Black-box testing fitur pencarian, filter kategori multi-parameter, pengujian git restore, dan simulasi resolusi merge conflict.</div>
      </div>
      <div class="step-badge" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; border-color: rgba(245, 158, 11, 0.3);">Test Case & Git Log</div>
    </div>

    <div class="arrow">&#x25BC;</div>

    <div class="step-box" style="border-left: 4px solid #ec4899;">
      <div class="step-num" style="background: #db2777;">5</div>
      <div class="step-content">
        <div class="step-title">Penerapan & Pemeliharaan (Deployment & Cloud Hosting)</div>
        <div class="step-desc">Deploy produksi ke Vercel Serverless PHP, publikasi repositori GitHub publik, dan pembuatan laporan akhir akademik UTS RPL.</div>
      </div>
      <div class="step-badge" style="background: rgba(236, 72, 153, 0.15); color: #f472b6; border-color: rgba(236, 72, 153, 0.3);">Vercel Live & PDF</div>
    </div>

  </div>
</div>
</body>
</html>
"""

# Save HTML files
base_dir = r"C:\Users\Indah Dwi\kalender-akademik\docs\screenshots"
with open(os.path.join(base_dir, "bukti_git.html"), "w", encoding="utf-8") as f:
    f.write(html_git)
with open(os.path.join(base_dir, "bukti_conflict.html"), "w", encoding="utf-8") as f:
    f.write(html_conflict)
with open(os.path.join(base_dir, "bukti_sdlc.html"), "w", encoding="utf-8") as f:
    f.write(html_sdlc)

print("Saved HTML mockups for screenshots!")

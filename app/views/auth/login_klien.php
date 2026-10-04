<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Masuk — Subhan Aziz &amp; Partners</title>
  <link rel="icon" type="image/jpeg" href="<?= BASEURL ?>/assets/images/logo.jpeg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root { --ink:#1c1a17; --paper:#faf7f1; --accent:#7a2634; --line:#ddd4c2; }
    body {
      font-family: 'Inter', sans-serif; min-height: 100vh;
      display: flex; align-items: center; justify-content: center; padding: 1.5rem;
      background:
        linear-gradient(rgba(250,247,241,.85), rgba(250,247,241,.92)),
        url('https://images.unsplash.com/photo-1658958327132-a80f8a9409fb?auto=format&fit=crop&w=1600&q=80') center/cover fixed;
      color: var(--ink);
    }
    .auth-card { width: 100%; max-width: 400px; background: var(--paper); border: 1px solid var(--line); padding: 2.6rem 2.4rem; box-shadow: 0 20px 60px rgba(28,26,23,.18); }
    .auth-logo { display: block; height: 52px; width: 52px; object-fit: contain; margin: 0 auto .8rem; }
    .auth-brand { font-family: 'Cinzel', serif; font-weight: 700; font-size: 1.15rem; text-align: center; margin-bottom: .3rem; letter-spacing: .03em; text-transform: uppercase; }
    .auth-brand span { color: inherit; }
    .auth-subtitle { text-align: center; font-size: .82rem; color: #8a8378; margin-bottom: 2.2rem; letter-spacing: .04em; text-transform: uppercase; }
    .form-label { font-size: .78rem; letter-spacing: .06em; text-transform: uppercase; color: #8a8378; margin-bottom: .3rem; }
    .form-control {
      border: none; border-bottom: 1px solid var(--line); border-radius: 0; padding: .55rem 0;
      background: transparent; font-size: .95rem; color: var(--ink);
    }
    .form-control:focus { box-shadow: none; border-bottom-color: var(--accent); background: transparent; }
    .btn-masuk {
      background: transparent; border: 1px solid var(--ink); color: var(--ink); border-radius: 0;
      padding: .75rem; width: 100%; font-size: .92rem; letter-spacing: .03em; transition: all .2s; margin-top: .5rem;
    }
    .btn-masuk:hover { background: var(--ink); color: var(--paper); }
    .auth-footer { text-align: center; padding-top: 1.6rem; font-size: .85rem; color: #8a8378; }
    .auth-footer a { color: var(--accent); text-decoration: none; border-bottom: 1px solid transparent; }
    .auth-footer a:hover { border-bottom-color: var(--accent); }
    .input-group-text { border: none; border-bottom: 1px solid var(--line); background: transparent; cursor: pointer; padding-bottom: .55rem; }
  </style>
</head>
<body>
<div class="auth-card">
  <img src="<?= BASEURL ?>/assets/images/logo.jpeg" alt="Subhan Aziz & Partners" class="auth-logo">
  <div class="auth-brand">Subhan Aziz <span>&amp; Partners</span></div>
  <div class="auth-subtitle">Masuk ke akun klien</div>

  <?php if (!empty($flash)): ?>
    <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : ($flash['type'] === 'success' ? 'success' : 'info') ?> rounded-0 py-2 px-3 mb-3" style="font-size:.85rem;">
      <?= htmlspecialchars($flash['message']) ?>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/auth/prosesKlien">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <div class="input-group">
        <input type="password" name="password" class="form-control" id="passwordInput" required>
        <span class="input-group-text" onclick="togglePassword()"><i class="bi bi-eye" id="eyeIcon"></i></span>
      </div>
    </div>
    <button type="submit" class="btn-masuk">Masuk</button>
  </form>

  <div class="auth-footer">
    Belum punya akun? <a href="<?= BASEURL ?>/auth/register">Daftar sekarang</a><br>
    <!-- <a href="<?= BASEURL ?>/auth/staf" style="color:#8a8378;">Staf firma? Login backend</a> -->
  </div>
</div>
<script>
  function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') { input.type = 'text'; icon.className = 'bi bi-eye-slash'; }
    else { input.type = 'password'; icon.className = 'bi bi-eye'; }
  }
</script>
</body>
</html>

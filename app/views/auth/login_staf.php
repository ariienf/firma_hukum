<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Staf — Subhan Aziz &amp; Partners</title>
  <link rel="icon" type="image/jpeg" href="<?= BASEURL ?>/assets/images/logo.jpeg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root { --ink:#1c1a17; --paper:#faf7f1; --accent:#7a2634; --line:#ddd4c2; }
    body {
      font-family: 'Inter', sans-serif; min-height: 100vh;
      display: flex; align-items: center; justify-content: center; padding: 1.5rem;
      background:
        linear-gradient(rgba(8,21,33,.85), rgba(8,21,33,.92)),
        url('https://images.unsplash.com/photo-1568092806323-8ec13dfa9b92?auto=format&fit=crop&w=1600&q=80') center/cover fixed;
      color: var(--paper);
    }
    .auth-card { width: 100%; max-width: 380px; background: var(--ink); border: 1px solid rgba(250,247,241,.2); padding: 2.6rem 2.4rem; box-shadow: 0 20px 60px rgba(0,0,0,.4); }
    .auth-logo { display: block; height: 48px; width: 48px; object-fit: contain; margin: 0 auto .7rem; }
    .auth-brand { font-family: 'Cinzel', serif; font-weight: 700; font-size: 1.05rem; text-align: center; margin-bottom: .3rem; letter-spacing: .03em; text-transform: uppercase; }
    .auth-brand span { color: inherit; }
    .auth-subtitle { text-align: center; font-size: .8rem; color: rgba(250,247,241,.5); margin-bottom: 2.2rem; letter-spacing: .06em; text-transform: uppercase; }
    .form-label { font-size: .76rem; letter-spacing: .06em; text-transform: uppercase; color: rgba(250,247,241,.5); margin-bottom: .3rem; }
    .form-control {
      border: none; border-bottom: 1px solid rgba(250,247,241,.25); border-radius: 0; padding: .55rem 0;
      background: transparent; font-size: .95rem; color: var(--paper);
    }
    .form-control:focus { box-shadow: none; border-bottom-color: var(--paper); background: transparent; color: var(--paper); }
    .btn-masuk {
      background: transparent; border: 1px solid var(--paper); color: var(--paper); border-radius: 0;
      padding: .75rem; width: 100%; font-size: .92rem; letter-spacing: .03em; transition: all .2s; margin-top: .5rem;
    }
    .btn-masuk:hover { background: var(--paper); color: var(--ink); }
    .auth-footer { text-align: center; padding-top: 1.6rem; font-size: .85rem; }
    .auth-footer a { color: rgba(250,247,241,.6); text-decoration: none; border-bottom: 1px solid transparent; }
    .auth-footer a:hover { border-bottom-color: rgba(250,247,241,.6); }
  </style>
</head>
<body>
<div class="auth-card">
  <img src="<?= BASEURL ?>/assets/images/logo.jpeg" alt="Subhan Aziz & Partners" class="auth-logo">
  <div class="auth-brand">Subhan Aziz <span>&amp; Partners</span></div>
  <div class="auth-subtitle">Login Staf (Backend)</div>

  <?php if (!empty($flash)): ?>
    <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : ($flash['type'] === 'success' ? 'success' : 'info') ?> rounded-0 py-2 px-3 mb-3" style="font-size:.85rem;">
      <?= htmlspecialchars($flash['message']) ?>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/auth/prosesStaf">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn-masuk">Masuk</button>
  </form>

  <!-- <div class="auth-footer">
    <a href="<?= BASEURL ?>/auth">Kembali ke login klien</a>
  </div> -->
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= isset($judul) ? $judul . ' — Subhan Aziz & Partners' : 'Subhan Aziz & Partners' ?></title>
  <link rel="icon" type="image/jpeg" href="<?= BASEURL ?>/assets/images/logo.jpeg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/style.css') ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a href="<?= BASEURL ?>" class="brand-logo me-4">
      <img src="<?= BASEURL ?>/assets/images/logo.jpeg" alt="Subhan Aziz & Partners" class="brand-logo-img">
      Subhan Aziz <span>&amp; Partners</span>
    </a>
    <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <i class="bi bi-list fs-4"></i>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto gap-1 mt-2 mt-lg-0">
        <li class="nav-item"><a href="<?= BASEURL ?>" class="nav-link nav-link-custom">Beranda</a></li>
        <li class="nav-item"><a href="<?= BASEURL ?>/home/layanan" class="nav-link nav-link-custom">Perkara</a></li>
        <li class="nav-item"><a href="<?= BASEURL ?>/home/tentang" class="nav-link nav-link-custom">Tentang</a></li>
        <li class="nav-item"><a href="<?= BASEURL ?>/home/kontak" class="nav-link nav-link-custom">Kontak</a></li>
      </ul>

      <?php if (isset($_SESSION['klien'])): ?>
      <div class="dropdown mt-2 mt-lg-0">
        <button class="btn-nav-login dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
          <span class="avatar-circle"><?= strtoupper(substr($_SESSION['klien']['nama'], 0, 1)) ?></span>
          <span style="font-size:0.85rem;"><?= htmlspecialchars($_SESSION['klien']['nama']) ?></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="<?= BASEURL ?>/klien">Dashboard</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL ?>/klien/tagihan">Tagihan Saya</a></li>
          <li><a class="dropdown-item" href="<?= BASEURL ?>/klien/pengajuan">Ajukan Perkara</a></li>
          <li><hr class="dropdown-divider my-1"></li>
          <li><a class="dropdown-item text-danger" href="<?= BASEURL ?>/auth/logout">Keluar</a></li>
        </ul>
      </div>
      <?php elseif (isset($_SESSION['staf'])): ?>
      <div class="dropdown mt-2 mt-lg-0">
        <button class="btn-nav-login dropdown-toggle" data-bs-toggle="dropdown">
          <?= htmlspecialchars($_SESSION['staf']['nama']) ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><span class="dropdown-item-text text-muted" style="font-size:0.75rem;"><?= htmlspecialchars($_SESSION['staf']['role']) ?></span></li>
          <li><hr class="dropdown-divider my-1"></li>
          <li><a class="dropdown-item text-danger" href="<?= BASEURL ?>/auth/logout">Keluar</a></li>
        </ul>
      </div>
      <?php else: ?>
      <div class="d-flex align-items-center gap-3 mt-2 mt-lg-0">
        <a href="<?= BASEURL ?>/auth" class="btn-nav-login">Masuk</a>
        <a href="<?= BASEURL ?>/auth/register" class="btn-nav-daftar">Daftar</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</nav>

<?php $flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); ?>
<?php if (!empty($flash)): ?>
<div class="flash-global">
  <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : ($flash['type'] === 'success' ? 'success' : 'info') ?> alert-dismissible fade show rounded-0 py-2 px-3" style="font-size:0.85rem;">
    <?= htmlspecialchars($flash['message']) ?>
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
  </div>
</div>
<?php endif; ?>

<main>

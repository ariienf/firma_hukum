<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= isset($judul) ? $judul . ' — Backend SAP' : 'Backend SAP' ?></title>
  <link rel="icon" type="image/jpeg" href="<?= BASEURL ?>/assets/images/logo.jpeg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/admin.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/admin.css') ?>">
</head>
<body class="admin-body">
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <img src="<?= BASEURL ?>/assets/images/logo.jpeg" alt="Subhan Aziz & Partners">
      <div class="admin-brand-text">
        Subhan Aziz <span>&amp; Partners</span>
      </div>
    </div>
    <nav class="admin-nav">
      <?php
        $role = $_SESSION['staf']['role'] ?? '';

        // Path saat ini relatif terhadap BASEURL, mis. "paralegal/verifikasi" -> controller "paralegal", method "verifikasi"
        $basePath  = parse_url(BASEURL, PHP_URL_PATH) ?? '';
        $reqPath   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
        $relPath   = trim(substr($reqPath, strlen($basePath)), '/');
        $segments  = $relPath === '' ? [] : explode('/', $relPath);
        // matchKey gabungan controller+method, supaya "paralegal/pengajuan" tidak ketuker
        // dengan "managing_partner/pengajuan" (dua controller beda, nama method sama).
        $matchKey  = ($segments[0] ?? '') . '/' . ($segments[1] ?? '');

        // href (null = pembatas/label saja), ikon, label, daftar matchKey yang membuat menu ini aktif
        $menu = [];
        switch ($role) {
            case 'paralegal':
                $menu = [
                    ['/paralegal', 'bi-speedometer2', 'Dashboard', ['paralegal/']],
                    ['/paralegal/pengajuan', 'bi-file-earmark-check', 'Verifikasi Pengajuan', ['paralegal/pengajuan', 'paralegal/verifikasi', 'paralegal/prosesVerifikasi']],
                    ['/paralegal/pembayaran', 'bi-cash-stack', 'Verifikasi Pembayaran', ['paralegal/pembayaran', 'paralegal/verifikasiBayar', 'paralegal/prosesVerifikasiBayar']],
                ];
                break;
            case 'managing_partner':
                $menu = [
                    ['/managing_partner', 'bi-speedometer2', 'Dashboard', ['managing_partner/']],
                    ['/managing_partner/pengajuan', 'bi-clipboard-check', 'Review Pengajuan', ['managing_partner/pengajuan', 'managing_partner/review', 'managing_partner/prosesReview']],
                    ['/managing_partner/riwayat', 'bi-clock-history', 'Riwayat Kasus', ['managing_partner/riwayat']],
                ];
                break;
            case 'lawyer':
                $menu = [
                    ['/lawyer', 'bi-speedometer2', 'Dashboard', ['lawyer/']],
                    ['/lawyer/kasus', 'bi-briefcase', 'Kasus Saya', ['lawyer/kasus', 'lawyer/tangani', 'lawyer/mulai', 'lawyer/selesaikan']],
                ];
                break;
            case 'administrator':
                $menu = [
                    ['/administrator', 'bi-speedometer2', 'Dashboard', ['administrator/']],
                    ['/administrator/layanan', 'bi-briefcase', 'Kelola Layanan', ['administrator/layanan', 'administrator/tambahLayanan', 'administrator/editLayanan', 'administrator/hapusLayanan']],
                    ['/administrator/klien', 'bi-people', 'Kelola Klien', ['administrator/klien', 'administrator/tambahKlien', 'administrator/editKlien', 'administrator/hapusKlien']],
                    ['/administrator/pengajuan', 'bi-folder2-open', 'Kelola Pengajuan', ['administrator/pengajuan', 'administrator/tambahPengajuan', 'administrator/editPengajuan', 'administrator/hapusPengajuan']],
                    [null, null, 'Aksi Staf Lain', []],
                    ['/paralegal/pengajuan', 'bi-file-earmark-check', 'Verifikasi Pengajuan', ['paralegal/pengajuan', 'paralegal/verifikasi', 'paralegal/prosesVerifikasi']],
                    ['/paralegal/pembayaran', 'bi-cash-stack', 'Verifikasi Pembayaran', ['paralegal/pembayaran', 'paralegal/verifikasiBayar', 'paralegal/prosesVerifikasiBayar']],
                    ['/managing_partner/pengajuan', 'bi-clipboard-check', 'Review Pengajuan', ['managing_partner/pengajuan', 'managing_partner/review', 'managing_partner/prosesReview']],
                    ['/managing_partner/riwayat', 'bi-clock-history', 'Riwayat Kasus', ['managing_partner/riwayat']],
                    ['/lawyer/kasus', 'bi-briefcase', 'Kasus Saya', ['lawyer/kasus', 'lawyer/tangani', 'lawyer/mulai', 'lawyer/selesaikan']],
                ];
                break;
        }
        foreach ($menu as $item):
          [$path, $icon, $label, $match] = $item;
          if ($path === null): ?>
            <div class="admin-nav-divider"><?= htmlspecialchars($label) ?></div>
          <?php continue; endif;
          $active = in_array($matchKey, $match, true);
      ?>
        <a href="<?= BASEURL . $path ?>" class="admin-nav-link<?= $active ? ' active' : '' ?>">
          <i class="bi <?= $icon ?>"></i> <?= $label ?>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="admin-user">
      <div class="admin-user-name"><?= htmlspecialchars($_SESSION['staf']['nama'] ?? '') ?></div>
      <div class="admin-user-role"><?= htmlspecialchars(str_replace('_', ' ', $role)) ?></div>
      <a href="<?= BASEURL ?>/auth/logout" class="admin-logout"><i class="bi bi-box-arrow-right me-1"></i>Keluar</a>
    </div>
  </aside>

  <div class="admin-content">
    <header class="admin-topbar">
      <h1><?= isset($judul) ? htmlspecialchars($judul) : '' ?></h1>
    </header>

    <?php $flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); ?>
    <?php if (!empty($flash)): ?>
    <div class="flash-global">
      <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : ($flash['type'] === 'success' ? 'success' : 'info') ?> alert-dismissible fade show shadow-sm rounded-3 py-2 px-3" style="font-size:0.85rem;">
        <?= htmlspecialchars($flash['message']) ?>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
      </div>
    </div>
    <?php endif; ?>

    <main class="admin-main">

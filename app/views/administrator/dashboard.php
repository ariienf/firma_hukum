<div class="page-wrap">
  <span class="section-label">Dashboard Administrator</span>
  <h2 class="section-title mb-4">Ringkasan Sistem</h2>

  <div class="row g-3 mb-5">
    <?php
    $label = [
      'baru' => 'Baru', 'verifikasi' => 'Terverifikasi', 'diteruskan' => 'Diteruskan',
      'ditangani' => 'Ditangani', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak',
    ];
    foreach ($label as $key => $teks):
    ?>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-box">
          <div class="num"><?= $ringkasan[$key] ?? 0 ?></div>
          <div class="label"><?= $teks ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <p style="color:var(--ink-soft);">
    Total <strong><?= $jumlahLayanan ?></strong> layanan dan <strong><?= $jumlahKlien ?></strong> klien terdaftar.
  </p>
  <div class="d-flex gap-3 flex-wrap">
    <a href="<?= BASEURL ?>/administrator/layanan" class="btn-brand">Kelola Layanan</a>
    <a href="<?= BASEURL ?>/administrator/klien" class="btn-brand-outline">Kelola Klien</a>
    <a href="<?= BASEURL ?>/administrator/pengajuan" class="btn-brand-outline">Kelola Pengajuan</a>
  </div>
</div>

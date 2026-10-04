<div class="page-wrap">
  <span class="section-label">Dashboard Paralegal</span>
  <h2 class="section-title mb-4">Ringkasan</h2>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num"><?= $baru ?></div><div class="label">Pengajuan Baru</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num"><?= $menungguBayar ?></div><div class="label">Tagihan Menunggu</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num"><?= $verifikasi['sesuai'] ?? 0 ?></div><div class="label">Terverifikasi Sesuai</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-box"><div class="num"><?= $verifikasi['tidak_sesuai'] ?? 0 ?></div><div class="label">Ditolak Verifikasi</div></div>
    </div>
  </div>

  <div class="d-flex gap-3 flex-wrap">
    <a href="<?= BASEURL ?>/paralegal/pengajuan" class="btn-brand">Verifikasi Pengajuan</a>
    <a href="<?= BASEURL ?>/paralegal/pembayaran" class="btn-brand-outline">Verifikasi Pembayaran</a>
  </div>
</div>

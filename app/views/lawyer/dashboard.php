<div class="page-wrap">
  <span class="section-label">Dashboard Lawyer</span>
  <h2 class="section-title mb-4">Ringkasan</h2>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $count['ditugaskan'] ?? 0 ?></div><div class="label">Belum Ditangani</div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $count['diproses'] ?? 0 ?></div><div class="label">Sedang Berjalan</div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $count['selesai'] ?? 0 ?></div><div class="label">Selesai</div></div>
    </div>
  </div>

  <a href="<?= BASEURL ?>/lawyer/kasus" class="btn-brand">Kasus Saya</a>
</div>

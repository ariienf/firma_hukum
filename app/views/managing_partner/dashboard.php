<div class="page-wrap">
  <span class="section-label">Dashboard Managing Partner</span>
  <h2 class="section-title mb-4">Ringkasan</h2>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $menunggu ?></div><div class="label">Menunggu Review</div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $review['dapat_ditangani'] ?? 0 ?></div><div class="label">Diteruskan ke Lawyer</div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="stat-box"><div class="num"><?= $review['ditolak'] ?? 0 ?></div><div class="label">Ditolak Review</div></div>
    </div>
  </div>

  <a href="<?= BASEURL ?>/managing_partner/pengajuan" class="btn-brand">Review Pengajuan</a>
</div>

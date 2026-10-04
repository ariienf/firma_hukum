<div class="page-wrap" style="max-width:640px;">
  <span class="section-label">Verifikasi Pembayaran</span>
  <h2 class="section-title mb-4"><?= htmlspecialchars($t['no_tiket']) ?></h2>

  <div class="data-card">
    <dl>
      <dt>Klien</dt><dd><?= htmlspecialchars($t['nama_klien']) ?></dd>
      <dt>Jenis</dt><dd><?= htmlspecialchars(ucfirst($t['jenis_pembayaran'])) ?></dd>
      <dt>Jumlah</dt><dd>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></dd>
      <dt>Metode Bayar</dt><dd><?= htmlspecialchars($t['metode_bayar'] ?: '-') ?></dd>
      <dt>Tanggal Bayar</dt><dd><?= htmlspecialchars($t['tanggal_bayar']) ?></dd>
    </dl>
  </div>

  <?php
    $ekstensi = strtolower(pathinfo($t['bukti_bayar'], PATHINFO_EXTENSION));
    $urlBukti = BASEURL . '/uploads/' . $t['bukti_bayar'];
  ?>
  <div class="data-card">
    <div style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);margin-bottom:.8rem;">Bukti Pembayaran</div>
    <?php if (in_array($ekstensi, ['jpg', 'jpeg', 'png'], true)): ?>
      <a href="<?= $urlBukti ?>" target="_blank"><img src="<?= $urlBukti ?>" alt="Bukti pembayaran" style="max-width:100%;border:1px solid var(--line);"></a>
    <?php else: ?>
      <a href="<?= $urlBukti ?>" target="_blank" class="btn-brand-outline">Lihat Berkas PDF &rarr;</a>
    <?php endif; ?>
  </div>

  <form method="post" action="<?= BASEURL ?>/paralegal/prosesVerifikasiBayar/<?= $t['id_pembayaran'] ?>">
    <button type="submit" name="status_bayar" value="lunas" class="btn-brand">Setujui (Lunas)</button>
    <button type="submit" name="status_bayar" value="ditolak" class="btn-brand-outline ms-3" style="color:var(--accent);border-bottom-color:var(--accent);">Tolak</button>
    <a href="<?= BASEURL ?>/paralegal" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

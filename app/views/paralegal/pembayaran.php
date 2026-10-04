<div class="page-wrap">
  <span class="section-label">Paralegal</span>
  <h2 class="section-title mb-4">Tagihan Menunggu Verifikasi</h2>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Klien</th><th>Jenis</th><th>Jumlah</th><th></th></tr>
    <?php if (empty($tagihan)): ?>
      <tr><td colspan="5" class="empty-note">Tidak ada tagihan yang menunggu verifikasi.</td></tr>
    <?php else: foreach ($tagihan as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['no_tiket']) ?></td>
        <td><?= htmlspecialchars($t['nama_klien']) ?></td>
        <td><?= htmlspecialchars(ucfirst($t['jenis_pembayaran'])) ?></td>
        <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
        <td><a href="<?= BASEURL ?>/paralegal/verifikasiBayar/<?= $t['id_pembayaran'] ?>" class="btn-brand-outline">Periksa &rarr;</a></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

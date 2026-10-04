<div class="page-wrap">
  <span class="section-label">Paralegal</span>
  <h2 class="section-title mb-4">Pengajuan Menunggu Verifikasi</h2>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Klien</th><th>Layanan</th><th>Tanggal</th><th></th></tr>
    <?php if (empty($pengajuan)): ?>
      <tr><td colspan="5" class="empty-note">Tidak ada pengajuan baru saat ini.</td></tr>
    <?php else: foreach ($pengajuan as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['no_tiket']) ?></td>
        <td><?= htmlspecialchars($p['nama_klien']) ?></td>
        <td><?= htmlspecialchars($p['nama_layanan']) ?></td>
        <td><?= htmlspecialchars($p['tanggal_pengajuan']) ?></td>
        <td><a href="<?= BASEURL ?>/paralegal/verifikasi/<?= $p['id_pengajuan'] ?>" class="btn-brand-outline">Verifikasi &rarr;</a></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

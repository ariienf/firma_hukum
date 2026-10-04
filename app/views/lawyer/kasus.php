<div class="page-wrap">
  <span class="section-label">Lawyer</span>
  <h2 class="section-title mb-4">Kasus yang Ditugaskan</h2>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Klien</th><th>Layanan</th><th>Status</th><th></th></tr>
    <?php if (empty($penugasan)): ?>
      <tr><td colspan="5" class="empty-note">Belum ada kasus yang ditugaskan kepada Anda.</td></tr>
    <?php else: foreach ($penugasan as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['no_tiket']) ?></td>
        <td><?= htmlspecialchars($t['nama_klien']) ?></td>
        <td><?= htmlspecialchars($t['nama_layanan']) ?></td>
        <td><span class="badge-status st-<?= htmlspecialchars($t['status_penugasan']) ?>"><?= htmlspecialchars($t['status_penugasan']) ?></span></td>
        <td><a href="<?= BASEURL ?>/lawyer/tangani/<?= $t['id_penugasan'] ?>" class="btn-brand-outline">Buka &rarr;</a></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

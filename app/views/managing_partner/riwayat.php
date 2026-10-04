<div class="page-wrap">
  <span class="section-label">Managing Partner</span>
  <h2 class="section-title mb-4">Riwayat Kasus</h2>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Klien</th><th>Dokumen</th><th>Status</th><th>Lawyer</th></tr>
    <?php if (empty($penugasan)): ?>
      <tr><td colspan="5" class="empty-note">Belum ada kasus yang diteruskan ke lawyer.</td></tr>
    <?php else: foreach ($penugasan as $pg): ?>
      <tr>
        <td><?= htmlspecialchars($pg['no_tiket']) ?></td>
        <td><?= htmlspecialchars($pg['nama_klien']) ?></td>
        <td>
          <?php if (empty($pg['dokumen'])): ?>
            <span style="color:var(--muted);">Belum ada dokumen</span>
          <?php else: foreach ($pg['dokumen'] as $d): ?>
            <div class="mb-1"><a href="<?= BASEURL ?>/uploads/<?= htmlspecialchars($d['file_path']) ?>" target="_blank"><?= htmlspecialchars($d['nama_dokumen']) ?></a></div>
          <?php endforeach; endif; ?>
        </td>
        <td><span class="badge-status st-<?= htmlspecialchars($pg['status_penugasan']) ?>"><?= htmlspecialchars($pg['status_penugasan']) ?></span></td>
        <td><?= htmlspecialchars($pg['nama_lawyer']) ?></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

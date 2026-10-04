<div class="page-wrap">
  <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4" style="border-bottom:1px solid var(--line);padding-bottom:1.2rem;">
    <div>
      <span class="section-label">Dashboard Klien</span>
      <h2 class="section-title mb-0">Pengajuan Saya</h2>
    </div>
    <div class="d-flex gap-3">
      <a class="btn-brand-outline" href="<?= BASEURL ?>/klien/tagihan">Tagihan Saya</a>
      <a class="btn-brand" href="<?= BASEURL ?>/klien/pengajuan">+ Ajukan Konsultasi Perkara Baru</a>
    </div>
  </div>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Layanan</th><th>Tanggal</th><th>Status</th><th></th></tr>
    <?php if (empty($pengajuan)): ?>
      <tr><td colspan="5" class="text-center py-4" style="color:var(--muted);">Belum ada pengajuan.</td></tr>
    <?php else: foreach ($pengajuan as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['no_tiket']) ?></td>
        <td><?= htmlspecialchars($p['nama_layanan']) ?></td>
        <td><?= htmlspecialchars($p['tanggal_pengajuan']) ?></td>
        <td><span class="badge-status st-<?= htmlspecialchars($p['status']) ?>"><?= htmlspecialchars($p['status']) ?></span></td>
        <td><a href="<?= BASEURL ?>/klien/dokumen/<?= $p['id_pengajuan'] ?>" class="btn-brand-outline">Dokumen &rarr;</a></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

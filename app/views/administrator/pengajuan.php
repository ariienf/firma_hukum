<div class="page-wrap">
  <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4" style="border-bottom:1px solid var(--line);padding-bottom:1.2rem;">
    <div>
      <span class="section-label">Administrator</span>
      <h2 class="section-title mb-0">Kelola Pengajuan</h2>
    </div>
    <a class="btn-brand" href="<?= BASEURL ?>/administrator/tambahPengajuan">+ Tambah Pengajuan</a>
  </div>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Klien</th><th>Layanan</th><th>Tanggal</th><th>Status</th><th></th></tr>
    <?php if (empty($pengajuan)): ?>
      <tr><td colspan="6" class="empty-note">Belum ada pengajuan.</td></tr>
    <?php else: foreach ($pengajuan as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['no_tiket']) ?></td>
        <td><?= htmlspecialchars($p['nama_klien']) ?></td>
        <td><?= htmlspecialchars($p['nama_layanan']) ?></td>
        <td><?= htmlspecialchars($p['tanggal_pengajuan']) ?></td>
        <td><span class="badge-status st-<?= htmlspecialchars($p['status']) ?>"><?= htmlspecialchars($p['status']) ?></span></td>
        <td class="d-flex gap-3">
          <a href="<?= BASEURL ?>/administrator/editPengajuan/<?= $p['id_pengajuan'] ?>" class="btn-brand-outline">Edit</a>
          <form method="post" action="<?= BASEURL ?>/administrator/hapusPengajuan/<?= $p['id_pengajuan'] ?>" onsubmit="return confirm('Hapus pengajuan ini?');">
            <button type="submit" class="btn-brand-outline" style="color:var(--accent);border-color:var(--accent);background:none;cursor:pointer;">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

<div class="page-wrap">
  <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4" style="border-bottom:1px solid var(--line);padding-bottom:1.2rem;">
    <div>
      <span class="section-label">Administrator</span>
      <h2 class="section-title mb-0">Kelola Layanan</h2>
    </div>
    <a class="btn-brand" href="<?= BASEURL ?>/administrator/tambahLayanan">+ Tambah Layanan</a>
  </div>
  <table class="tbl-brand">
    <tr><th>Nama Layanan</th><th>Deskripsi</th><th>Tarif</th><th></th></tr>
    <?php if (empty($layanan)): ?>
      <tr><td colspan="4" class="empty-note">Belum ada layanan.</td></tr>
    <?php else: foreach ($layanan as $l): ?>
      <tr>
        <td><?= htmlspecialchars($l['nama_layanan']) ?></td>
        <td><?= htmlspecialchars($l['deskripsi']) ?></td>
        <td>Rp <?= number_format($l['tarif'], 0, ',', '.') ?></td>
        <td class="d-flex gap-3">
          <a href="<?= BASEURL ?>/administrator/editLayanan/<?= $l['id_layanan'] ?>" class="btn-brand-outline">Edit</a>
          <form method="post" action="<?= BASEURL ?>/administrator/hapusLayanan/<?= $l['id_layanan'] ?>" onsubmit="return confirm('Hapus layanan ini?');">
            <button type="submit" class="btn-brand-outline" style="color:var(--accent);border-color:var(--accent);background:none;cursor:pointer;">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

<div class="page-wrap">
  <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4" style="border-bottom:1px solid var(--line);padding-bottom:1.2rem;">
    <div>
      <span class="section-label">Administrator</span>
      <h2 class="section-title mb-0">Kelola Klien</h2>
    </div>
    <a class="btn-brand" href="<?= BASEURL ?>/administrator/tambahKlien">+ Tambah Klien</a>
  </div>
  <table class="tbl-brand">
    <tr><th>Nama</th><th>Email</th><th>No. Telepon</th><th>Terdaftar</th><th></th></tr>
    <?php if (empty($klien)): ?>
      <tr><td colspan="5" class="empty-note">Belum ada klien terdaftar.</td></tr>
    <?php else: foreach ($klien as $k): ?>
      <tr>
        <td><?= htmlspecialchars($k['nama_klien']) ?></td>
        <td><?= htmlspecialchars($k['email']) ?></td>
        <td><?= htmlspecialchars($k['no_telp'] ?: '-') ?></td>
        <td><?= htmlspecialchars($k['created_at']) ?></td>
        <td class="d-flex gap-3">
          <a href="<?= BASEURL ?>/administrator/editKlien/<?= $k['id_klien'] ?>" class="btn-brand-outline">Edit</a>
          <form method="post" action="<?= BASEURL ?>/administrator/hapusKlien/<?= $k['id_klien'] ?>" onsubmit="return confirm('Hapus klien ini?');">
            <button type="submit" class="btn-brand-outline" style="color:var(--accent);border-color:var(--accent);background:none;cursor:pointer;">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

<div class="page-wrap" style="max-width:560px;">
  <span class="section-label">Administrator</span>
  <h2 class="section-title mb-4"><?= $k ? 'Edit Klien' : 'Tambah Klien' ?></h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger rounded-3 py-2 px-3 mb-3" style="font-size:.85rem;"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/administrator/<?= $k ? 'editKlien/' . $k['id_klien'] : 'tambahKlien' ?>">
    <div class="mb-3">
      <label class="form-label d-block">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($k['nama_klien'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label d-block">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($k['email'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label d-block">No. Telepon</label>
      <input type="text" name="no_telp" class="form-control" value="<?= htmlspecialchars($k['no_telp'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label class="form-label d-block">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($k['alamat'] ?? '') ?></textarea>
    </div>
    <div class="mb-4">
      <label class="form-label d-block">Password <?= $k ? '(kosongkan bila tidak diganti)' : '' ?></label>
      <input type="password" name="password" class="form-control" <?= $k ? '' : 'required' ?>>
    </div>
    <button type="submit" class="btn-brand">Simpan</button>
    <a href="<?= BASEURL ?>/administrator/klien" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

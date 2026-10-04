<div class="page-wrap" style="max-width:560px;">
  <span class="section-label">Administrator</span>
  <h2 class="section-title mb-4"><?= $l ? 'Edit Layanan' : 'Tambah Layanan' ?></h2>

  <form method="post" action="<?= BASEURL ?>/administrator/<?= $l ? 'editLayanan/' . $l['id_layanan'] : 'tambahLayanan' ?>">
    <div class="mb-3">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Nama Layanan</label>
      <input type="text" name="nama_layanan" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" value="<?= htmlspecialchars($l['nama_layanan'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="3"><?= htmlspecialchars($l['deskripsi'] ?? '') ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Persyaratan Dokumen <span style="text-transform:none;letter-spacing:0;">(satu dokumen per baris)</span></label>
      <textarea name="persyaratan" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="5" placeholder="Fotokopi KTP pemohon&#10;Surat kuasa (jika diwakilkan)&#10;..."><?= htmlspecialchars($l['persyaratan'] ?? '') ?></textarea>
    </div>
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Tarif (Rp)</label>
      <input type="number" name="tarif" min="0" step="1000" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" value="<?= htmlspecialchars($l['tarif'] ?? '0') ?>" required>
    </div>
    <button type="submit" class="btn-brand">Simpan</button>
    <a href="<?= BASEURL ?>/administrator/layanan" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

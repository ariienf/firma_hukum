<div class="page-wrap" style="max-width:560px;">
  <span class="section-label">Administrator</span>
  <h2 class="section-title mb-4"><?= $p ? 'Edit Pengajuan' : 'Tambah Pengajuan' ?></h2>

  <?php if ($p): ?><p style="color:var(--muted);margin-top:-1rem;">No. Tiket: <strong><?= htmlspecialchars($p['no_tiket']) ?></strong> &mdash; Klien: <strong><?= htmlspecialchars($p['nama_klien']) ?></strong></p><?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/administrator/<?= $p ? 'editPengajuan/' . $p['id_pengajuan'] : 'tambahPengajuan' ?>">
    <?php if (!$p): ?>
      <div class="mb-3">
        <label class="form-label d-block">Klien</label>
        <select name="id_klien" class="form-select" required>
          <?php foreach ($klien as $k): ?>
            <option value="<?= $k['id_klien'] ?>"><?= htmlspecialchars($k['nama_klien']) ?> (<?= htmlspecialchars($k['email']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label d-block">Jenis Layanan</label>
      <select name="id_layanan" class="form-select" required>
        <?php foreach ($layanan as $l): ?>
          <option value="<?= $l['id_layanan'] ?>" <?= ($p && (int) $p['id_layanan'] === (int) $l['id_layanan']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($l['nama_layanan']) ?> (Rp <?= number_format($l['tarif'], 0, ',', '.') ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label d-block">Ringkasan Kasus</label>
      <textarea name="ringkasan_kasus" class="form-control" rows="4" required><?= htmlspecialchars($p['ringkasan_kasus'] ?? '') ?></textarea>
    </div>

    <?php if ($p): ?>
      <div class="mb-4">
        <label class="form-label d-block">Status</label>
        <select name="status" class="form-select">
          <?php foreach (['baru', 'verifikasi', 'diteruskan', 'ditangani', 'selesai', 'ditolak'] as $st): ?>
            <option value="<?= $st ?>" <?= $p['status'] === $st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
          <?php endforeach; ?>
        </select>
        <div class="form-text" style="font-size:.78rem;color:var(--muted);">Mengubah status di sini tidak membuat catatan verifikasi/review otomatis — murni koreksi data.</div>
      </div>
    <?php endif; ?>

    <button type="submit" class="btn-brand">Simpan</button>
    <a href="<?= BASEURL ?>/administrator/pengajuan" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

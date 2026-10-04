<div class="page-wrap" style="max-width:640px;">
  <span class="section-label">Verifikasi Pengajuan</span>
  <h2 class="section-title mb-4"><?= htmlspecialchars($p['no_tiket']) ?></h2>

  <div class="data-card">
    <dl>
      <dt>Klien</dt><dd><?= htmlspecialchars($p['nama_klien']) ?> (<?= htmlspecialchars($p['email']) ?>)</dd>
      <dt>No. Telepon</dt><dd><?= htmlspecialchars($p['no_telp'] ?: '-') ?></dd>
      <dt>Layanan</dt><dd><?= htmlspecialchars($p['nama_layanan']) ?> (Rp <?= number_format($p['tarif'], 0, ',', '.') ?>)</dd>
      <dt>Tanggal</dt><dd><?= htmlspecialchars($p['tanggal_pengajuan']) ?></dd>
      <dt>Ringkasan Kasus</dt><dd><?= nl2br(htmlspecialchars($p['ringkasan_kasus'])) ?></dd>
    </dl>
  </div>

  <div class="data-card">
    <div style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);margin-bottom:.8rem;">Dokumen Terlampir</div>
    <?php if (empty($dokumen)): ?>
      <p style="color:var(--ink-soft);margin:0;">Klien belum melampirkan dokumen.</p>
    <?php else: foreach ($dokumen as $d): ?>
      <div class="mb-2"><a href="<?= BASEURL ?>/uploads/<?= htmlspecialchars($d['file_path']) ?>" target="_blank"><?= htmlspecialchars($d['nama_dokumen']) ?></a></div>
    <?php endforeach; endif; ?>
  </div>

  <form method="post" action="<?= BASEURL ?>/paralegal/prosesVerifikasi/<?= $p['id_pengajuan'] ?>">
    <label class="form-label d-block mb-2" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Hasil Verifikasi</label>
    <div class="mb-3 d-flex gap-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="hasil_verifikasi" value="sesuai" id="sesuai" required>
        <label class="form-check-label" for="sesuai">Sesuai &mdash; teruskan ke Managing Partner</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="hasil_verifikasi" value="tidak_sesuai" id="tidak_sesuai">
        <label class="form-check-label" for="tidak_sesuai">Tidak Sesuai &mdash; tolak pengajuan</label>
      </div>
    </div>
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Catatan</label>
      <textarea name="catatan" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="3"></textarea>
    </div>
    <button type="submit" class="btn-brand">Simpan Verifikasi</button>
    <a href="<?= BASEURL ?>/paralegal" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

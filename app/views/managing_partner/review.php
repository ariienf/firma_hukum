<div class="page-wrap" style="max-width:640px;">
  <span class="section-label">Review Pengajuan</span>
  <h2 class="section-title mb-4"><?= htmlspecialchars($p['no_tiket']) ?></h2>

  <div class="data-card">
    <dl>
      <dt>Klien</dt><dd><?= htmlspecialchars($p['nama_klien']) ?> (<?= htmlspecialchars($p['email']) ?>)</dd>
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

  <?php if (!empty($catatanParalegal) && !empty($catatanParalegal['catatan'])): ?>
    <div class="data-card">
      <div style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--accent);margin-bottom:.8rem;">Catatan dari Paralegal</div>
      <p style="color:var(--ink-soft);margin:0 0 .5rem;"><?= nl2br(htmlspecialchars($catatanParalegal['catatan'])) ?></p>
      <p style="color:var(--muted);font-size:.8rem;margin:0;">
        Hasil verifikasi: <strong><?= htmlspecialchars(str_replace('_', ' ', $catatanParalegal['hasil_verifikasi'])) ?></strong>
        &middot; <?= htmlspecialchars($catatanParalegal['tanggal_verifikasi']) ?>
      </p>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/managing_partner/prosesReview/<?= $p['id_pengajuan'] ?>">
    <label class="form-label d-block mb-2" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Hasil Review</label>
    <div class="mb-3 d-flex gap-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="hasil_review" value="dapat_ditangani" id="dapat" onclick="toggleTugas(true)" required>
        <label class="form-check-label" for="dapat">Dapat Ditangani &mdash; tunjuk lawyer</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="hasil_review" value="ditolak" id="tolak" onclick="toggleTugas(false)">
        <label class="form-check-label" for="tolak">Ditolak</label>
      </div>
    </div>

    <div id="blok-tugas" style="display:none;">
      <div class="row g-3 mb-3">
        <div class="col-md-7">
          <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Tunjuk Lawyer</label>
          <select name="kode_lawyer" class="form-select">
            <?php foreach ($lawyer as $lw): ?>
              <option value="<?= htmlspecialchars($lw['kode']) ?>"><?= htmlspecialchars($lw['nama']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-5">
          <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Biaya Penanganan (Rp)</label>
          <input type="number" name="biaya_penanganan" min="0" step="1000" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;">
        </div>
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Catatan</label>
      <textarea name="catatan" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="3"></textarea>
    </div>
    <button type="submit" class="btn-brand">Simpan Review</button>
    <a href="<?= BASEURL ?>/managing_partner" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>
<script>
  function toggleTugas(show) {
    document.getElementById('blok-tugas').style.display = show ? 'block' : 'none';
  }
</script>

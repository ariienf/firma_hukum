<div class="page-wrap" style="max-width:640px;">
  <span class="section-label">Tangani Kasus</span>
  <h2 class="section-title mb-4"><?= htmlspecialchars($t['no_tiket']) ?></h2>

  <div class="data-card">
    <dl>
      <dt>Klien</dt><dd><?= htmlspecialchars($t['nama_klien']) ?></dd>
      <dt>Layanan</dt><dd><?= htmlspecialchars($t['nama_layanan']) ?></dd>
      <dt>Ringkasan Kasus</dt><dd><?= nl2br(htmlspecialchars($t['ringkasan_kasus'])) ?></dd>
      <dt>Biaya Penanganan</dt><dd>Rp <?= number_format($t['biaya_penanganan'], 0, ',', '.') ?></dd>
      <dt>Status Penugasan</dt><dd><span class="badge-status"><?= htmlspecialchars($t['status_penugasan']) ?></span></dd>
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

  <?php if (!empty($catatanMp) && !empty($catatanMp['catatan'])): ?>
    <div class="data-card">
      <div style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--accent);margin-bottom:.8rem;">Catatan dari Managing Partner</div>
      <p style="color:var(--ink-soft);margin:0 0 .5rem;"><?= nl2br(htmlspecialchars($catatanMp['catatan'])) ?></p>
      <p style="color:var(--muted);font-size:.8rem;margin:0;"><?= htmlspecialchars($catatanMp['tanggal_review']) ?></p>
    </div>
  <?php endif; ?>

  <?php if (empty($penanganan)): ?>
    <form method="post" action="<?= BASEURL ?>/lawyer/mulai/<?= $t['id_penugasan'] ?>">
      <p style="color:var(--ink-soft);">Kasus ini belum mulai ditangani.</p>
      <button type="submit" class="btn-brand">Mulai Penanganan</button>
    </form>

  <?php elseif ($penanganan['status_penanganan'] === 'berjalan'): ?>
    <form method="post" action="<?= BASEURL ?>/lawyer/selesaikan/<?= $t['id_penugasan'] ?>">
      <p style="color:var(--ink-soft);">Penanganan dimulai sejak <?= htmlspecialchars($penanganan['tanggal_mulai']) ?>.</p>
      <div class="mb-4">
        <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Hasil Penanganan</label>
        <textarea name="hasil_penanganan" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn-brand">Selesaikan Penanganan</button>
    </form>

  <?php else: ?>
    <div class="data-card">
      <p class="mb-2"><strong>Kasus telah selesai</strong> pada <?= htmlspecialchars($penanganan['tanggal_selesai']) ?>.</p>
      <p style="color:var(--ink-soft);margin:0;"><?= nl2br(htmlspecialchars($penanganan['hasil_penanganan'])) ?></p>
    </div>
  <?php endif; ?>

  <a href="<?= BASEURL ?>/lawyer" class="btn-brand-outline mt-3 d-inline-block">&larr; Kembali</a>
</div>

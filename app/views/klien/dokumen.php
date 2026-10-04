<div class="page-wrap" style="max-width:640px;">
  <span class="section-label">Dokumen Pendukung</span>
  <h2 class="section-title mb-2"><?= htmlspecialchars($p['no_tiket']) ?></h2>

  <?php if (!empty($lawyerNama)): ?>
    <p style="color:var(--ink-soft);font-size:.9rem;margin-bottom:1.5rem;">
      Ditangani oleh: <strong style="color:var(--ink);"><?= htmlspecialchars($lawyerNama) ?></strong>
    </p>
  <?php else: ?>
    <div class="mb-4"></div>
  <?php endif; ?>

  <?php $syarat = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', trim($p['persyaratan'] ?? '')))); ?>
  <?php if (!empty($syarat)): ?>
    <div class="mb-4" style="background:var(--paper-deep);border:1px solid var(--line);padding:1rem 1.2rem;">
      <div style="font-size:.74rem;letter-spacing:.05em;text-transform:uppercase;color:var(--accent);margin-bottom:.5rem;">
        Persyaratan Dokumen &mdash; <?= htmlspecialchars($p['nama_layanan']) ?>
      </div>
      <ul style="margin:0;padding-left:1.1rem;font-size:.86rem;color:var(--ink-soft);">
        <?php foreach ($syarat as $s): ?><li><?= htmlspecialchars($s) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ((!empty($catatanParalegal) && !empty($catatanParalegal['catatan'])) || (!empty($catatanLawyer) && !empty($catatanLawyer['hasil_penanganan']))): ?>
    <div class="mb-4" style="background:#fff;border:1px solid var(--line);padding:1rem 1.2rem;">
      <div style="font-size:.74rem;letter-spacing:.05em;text-transform:uppercase;color:var(--accent);margin-bottom:.7rem;">Catatan &amp; Perkembangan Kasus</div>

      <?php if (!empty($catatanParalegal) && !empty($catatanParalegal['catatan'])): ?>
        <div class="mb-3">
          <div style="font-size:.8rem;font-weight:600;color:var(--ink);">Dari Paralegal &mdash; <?= htmlspecialchars($catatanParalegal['tanggal_verifikasi']) ?></div>
          <p style="color:var(--ink-soft);font-size:.9rem;margin:.2rem 0 0;"><?= nl2br(htmlspecialchars($catatanParalegal['catatan'])) ?></p>
        </div>
      <?php endif; ?>

      <?php if (!empty($catatanLawyer) && !empty($catatanLawyer['hasil_penanganan'])): ?>
        <div>
          <div style="font-size:.8rem;font-weight:600;color:var(--ink);">
            Dari Lawyer<?= !empty($lawyerNama) ? ', ' . htmlspecialchars($lawyerNama) : '' ?> &mdash; <?= htmlspecialchars($catatanLawyer['tanggal_selesai']) ?>
          </div>
          <p style="color:var(--ink-soft);font-size:.9rem;margin:.2rem 0 0;"><?= nl2br(htmlspecialchars($catatanLawyer['hasil_penanganan'])) ?></p>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <table class="tbl-brand mb-4">
    <tr><th>Nama Berkas</th><th>Tanggal Unggah</th><th></th></tr>
    <?php if (empty($dokumen)): ?>
      <tr><td colspan="3" class="empty-note">Belum ada dokumen diunggah.</td></tr>
    <?php else: foreach ($dokumen as $d): ?>
      <tr>
        <td><?= htmlspecialchars($d['nama_dokumen']) ?></td>
        <td><?= htmlspecialchars($d['tanggal_upload']) ?></td>
        <td><a href="<?= BASEURL ?>/uploads/<?= htmlspecialchars($d['file_path']) ?>" target="_blank" class="btn-brand-outline">Lihat &rarr;</a></td>
      </tr>
    <?php endforeach; endif; ?>
  </table>

  <form method="post" action="<?= BASEURL ?>/klien/dokumen/<?= $p['id_pengajuan'] ?>" enctype="multipart/form-data">
    <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Tambah Dokumen</label>
    <input type="file" name="dokumen[]" class="form-control" accept=".jpg,.jpeg,.png,.pdf" multiple>
    <div class="form-text mb-3" style="font-size:.78rem;color:var(--muted);">Boleh lebih dari satu file. Format JPG/PNG/PDF, maksimal 2MB per file.</div>
    <button type="submit" class="btn-brand">Unggah</button>
    <a href="<?= BASEURL ?>/klien" class="btn-brand-outline ms-3">Kembali</a>
  </form>
</div>

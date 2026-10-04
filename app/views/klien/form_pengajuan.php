<div class="page-wrap" style="max-width:560px;">
  <span class="section-label">Pengajuan Baru</span>
  <h2 class="section-title mb-2">Ajukan Konsultasi Perkara</h2>
  <p style="color:var(--ink-soft);margin-bottom:2rem;">Isi detail di bawah, tim kami akan segera memverifikasi pengajuan Anda.</p>
  <form method="post" action="<?= BASEURL ?>/klien/pengajuan" enctype="multipart/form-data">
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Jenis Layanan</label>
      <select name="id_layanan" id="pilihLayanan" class="form-select" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;" required>
        <?php foreach ($layanan as $l): ?>
          <option value="<?= $l['id_layanan'] ?>"><?= htmlspecialchars($l['nama_layanan']) ?> (Rp <?= number_format($l['tarif'], 0, ',', '.') ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-4" style="background:var(--paper-deep);border:1px solid var(--line);padding:1rem 1.2rem;">
      <div style="font-size:.74rem;letter-spacing:.05em;text-transform:uppercase;color:var(--accent);margin-bottom:.5rem;">Persyaratan Dokumen</div>
      <ul id="daftarPersyaratan" style="margin:0;padding-left:1.1rem;font-size:.86rem;color:var(--ink-soft);"></ul>
    </div>
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Ringkasan Kasus</label>
      <textarea name="ringkasan_kasus" class="form-control" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;background:transparent;" rows="5" required></textarea>
    </div>
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Dokumen Pendukung <span class="text-muted" style="text-transform:none;letter-spacing:0;">(opsional)</span></label>
      <input type="file" name="dokumen[]" class="form-control" accept=".pdf" multiple>
      <div class="form-text" style="font-size:.78rem;color:var(--muted);">Boleh lebih dari satu file. Format PDF, maksimal 2MB per file.</div>
    </div>
    <button type="submit" class="btn-brand">Kirim Pengajuan</button>
  </form>
</div>
<script>
  const persyaratanMap = <?php
    $persyaratanMap = [];
    foreach ($layanan as $l) {
        $persyaratanMap[$l['id_layanan']] = array_values(array_filter(array_map('trim',
            preg_split('/\r\n|\r|\n/', trim($l['persyaratan'] ?? '')))));
    }
    echo json_encode($persyaratanMap);
  ?>;

  function tampilkanPersyaratan(id) {
    const list = document.getElementById('daftarPersyaratan');
    list.innerHTML = '';
    (persyaratanMap[id] || []).forEach(function (teks) {
      const li = document.createElement('li');
      li.textContent = teks;
      list.appendChild(li);
    });
  }

  const pilihLayanan = document.getElementById('pilihLayanan');
  pilihLayanan.addEventListener('change', function () { tampilkanPersyaratan(this.value); });
  tampilkanPersyaratan(pilihLayanan.value);
</script>


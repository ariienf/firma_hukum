<style>
  .lay-row { display: flex; align-items: baseline; gap: 1.5rem; padding: 1.6rem 0; border-bottom: 1px solid var(--line); }
  .lay-row:first-of-type { border-top: 1px solid var(--line); }
  .lay-row .lnum { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; color: var(--accent); width: 44px; flex-shrink: 0; }
  .lay-row .lbody { flex: 1; }
  .lay-row h3 { font-size: 1.2rem; margin-bottom: .3rem; }
  .lay-row p { color: var(--ink-soft); font-size: .92rem; margin: 0; max-width: 560px; }
  .lay-row .lprice { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; color: var(--ink); white-space: nowrap; }
  .lay-row .syarat-label { font-size: .74rem; letter-spacing: .05em; text-transform: uppercase; color: var(--accent); margin: .8rem 0 .4rem; }
  .lay-row ul.syarat { list-style: none; padding: 0; margin: 0; }
  .lay-row ul.syarat li { font-size: .86rem; color: var(--ink-soft); padding-left: 1rem; position: relative; margin-bottom: .3rem; }
  .lay-row ul.syarat li::before { content: '\2013'; position: absolute; left: 0; color: var(--accent); }

  .lawyer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 2rem; }
  .lawyer-card { text-align: center; }
  .lawyer-avatar {
    width: 96px; height: 96px; margin: 0 auto .9rem; border-radius: 50%;
    background: var(--paper-deep); border: 1px solid var(--line);
    display: flex; align-items: center; justify-content: center; font-size: 2.6rem;
  }
  .lawyer-card h4 { font-size: 1.02rem; margin-bottom: .2rem; }
  .lawyer-card .peran { font-size: .74rem; letter-spacing: .05em; text-transform: uppercase; color: var(--accent); margin-bottom: .7rem; }
  .lawyer-card ul { list-style: none; padding: 0; margin: 0; text-align: left; }
  .lawyer-card li {
    font-size: .85rem; color: var(--ink-soft); line-height: 1.6; margin-bottom: .55rem;
    padding-left: 1rem; position: relative;
  }
  .lawyer-card li::before { content: '\2013'; position: absolute; left: 0; color: var(--accent); }
</style>

<section class="page-wrap" style="max-width:820px;">
  <span class="eyebrow">Layanan Perkara Kami</span>
  <h1 class="section-title mb-2" style="font-size:2rem;">Bidang hukum yang kami tangani</h1>
  <p style="color:var(--ink-soft);max-width:560px;margin-bottom:2rem;">Pilih bidang hukum yang sesuai dengan kebutuhan Anda. Setiap pengajuan akan diverifikasi paralegal kami sebelum ditindaklanjuti.</p>

  <?php if (empty($layanan)): ?>
    <p style="color:var(--ink-soft);">Belum ada data layanan.</p>
  <?php else: foreach ($layanan as $i => $l): ?>
    <div class="lay-row">
      <div class="lnum"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></div>
      <div class="lbody">
        <h3><?= htmlspecialchars($l['nama_layanan']) ?></h3>
        <p><?= htmlspecialchars($l['deskripsi']) ?></p>
        <?php $syarat = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', trim($l['persyaratan'] ?? '')))); ?>
        <?php if (!empty($syarat)): ?>
          <div class="syarat-label">Persyaratan Dokumen</div>
          <ul class="syarat">
            <?php foreach ($syarat as $s): ?><li><?= htmlspecialchars($s) ?></li><?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <div class="lprice">Rp <?= number_format($l['tarif'], 0, ',', '.') ?></div>
    </div>
  <?php endforeach; endif; ?>
</section>

<!-- TIM LAWYER -->
<section class="page-wrap" style="max-width:820px;border-top:1px solid var(--line);">
  <span class="eyebrow">Tim Kami</span>
  <h2 class="section-title mb-2" style="font-size:1.7rem;">Lawyer yang menangani kasus Anda</h2>
  <p style="color:var(--ink-soft);max-width:560px;margin-bottom:2.2rem;">Setiap kasus yang diteruskan managing partner akan ditugaskan ke salah satu lawyer berpengalaman berikut.</p>

  <div class="lawyer-grid">
    <div class="lawyer-card">
      <div class="lawyer-avatar">👨&zwj;⚖️</div>
      <h4>Achmad Tadzudin, S.H.</h4>
      <div class="peran">Corporate Lawyer &amp; Litigasi</div>
      <ul>
        <li>6 tahun pengalaman mendampingi perusahaan dalam penyusunan kontrak dan kepatuhan regulasi.</li>
        <li>Menangani proses merger &amp; akuisisi serta mitigasi risiko hukum korporasi.</li>
        <li>Berpengalaman menangani negosiasi, mediasi, hingga litigasi sengketa bisnis di pengadilan.</li>
      </ul>
    </div>
    <div class="lawyer-card">
      <div class="lawyer-avatar">👨&zwj;⚖️</div>
      <h4>Ade Akbar Mubarok, S.H.I.</h4>
      <div class="peran">HAKI &amp; Branding Legal</div>
      <ul>
        <li>5 tahun pengalaman menangani pendaftaran merek dan hak kekayaan intelektual.</li>
        <li>Menangani pendaftaran merek ke DJKI hingga monitoring sengketa HAKI.</li>
        <li>Membantu legalitas branding dan perlindungan identitas usaha klien.</li>
      </ul>
    </div>
  </div>

  <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand mt-5 d-inline-block">Ajukan Konsultasi Perkara</a>
</section>

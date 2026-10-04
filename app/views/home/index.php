<style>
  .hero-editorial { padding: 6rem 0 5rem; border-bottom: 1px solid var(--line); }
  .hero-editorial h1 { font-size: clamp(2.2rem, 5vw, 3.6rem); line-height: 1.15; margin-bottom: 1.4rem; }
  .hero-editorial .lede { font-size: 1.05rem; color: var(--ink-soft); max-width: 480px; margin-bottom: 2rem; }
  .stat-row { display: flex; gap: 2rem; margin-top: 2.2rem; padding-top: 1.2rem; border-top: 1px solid var(--line); }
  .stat-row .num { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 600; }
  .stat-row .label { font-size: .72rem; color: var(--muted); letter-spacing: .04em; text-transform: uppercase; }

  .hero-photo { position: relative; height: 100%; min-height: 340px; }
  .hero-photo img { width: 100%; height: 100%; object-fit: cover; filter: grayscale(.55) contrast(1.05) brightness(.95); border: 1px solid var(--line); }
  .hero-photo .cap {
    position: absolute; left: 0; bottom: 0; background: var(--ink); color: var(--paper);
    font-size: .72rem; letter-spacing: .06em; text-transform: uppercase; padding: .6rem 1rem;
  }
  .testi-bg { position: relative; background-size: cover; background-position: center; }
  .testi-bg::before { content: ''; position: absolute; background: rgba(0, 0, 0, 0.86); }
  .testi-bg > .pull-quote { position: relative; z-index: 1; }

  .step-line { display: flex; flex-wrap: wrap; gap: 2.5rem; }
  .step-item { flex: 1; min-width: 200px; }
  .step-item .snum { font-family: 'Cormorant Garamond', serif; font-size: 2.2rem; color: var(--line); display: block; margin-bottom: .4rem; }
  .step-item h4 { font-size: 1rem; margin-bottom: .4rem; }
  .step-item p { font-size: .87rem; color: var(--ink-soft); margin: 0; }

  .pull-quote { text-align: center; max-width: 680px; margin: 0 auto; }
  .pull-quote p { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1.7rem; line-height: 1.5; color: var(--ink); margin-bottom: 1.2rem; }
  .pull-quote .who { font-size: .82rem; letter-spacing: .06em; text-transform: uppercase; color: var(--muted); }

  .faq-row { border-bottom: 1px solid var(--line); }
  .faq-row:first-of-type { border-top: 1px solid var(--line); }
  .faq-row summary { list-style: none; cursor: pointer; padding: 1.2rem 0; font-size: 1.02rem; font-weight: 500; display: flex; justify-content: space-between; align-items: center; }
  .faq-row summary::-webkit-details-marker { display: none; }
  .faq-row summary::after { content: '+'; color: var(--accent); font-size: 1.2rem; }
  .faq-row[open] summary::after { content: '\2212'; }
  .faq-row .faq-body { padding: 0 0 1.3rem; color: var(--ink-soft); font-size: .92rem; max-width: 600px; }
</style>

<!-- HERO -->
<section class="hero-editorial">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="eyebrow">Firma Hukum &mdash; Sejak 10+ Tahun</span>
        <h1>Konsultasi hukum yang tenang, jelas, dan dapat dipercaya.</h1>
        <p class="lede">Subhan Aziz &amp; Partners mendampingi klien menyelesaikan perkara pidana, perdata,
           hingga litigasi &mdash; ditangani langsung oleh paralegal, lawyer, dan managing partner kami.</p>
        <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand">Ajukan Perkara</a>
        <a href="<?= BASEURL ?>/home/layanan" class="btn-brand-outline ms-4">Lihat layanan &rarr;</a>
        <div class="stat-row" style="max-width:360px;">
          <div><div class="num">500+</div><div class="label">Klien</div></div>
          <div><div class="num">10+</div><div class="label">Tahun</div></div>
          <div><div class="num">24/7</div><div class="label">Online</div></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-photo">
          <img src="https://images.unsplash.com/photo-1593115057322-e94b77572f20?auto=format&fit=crop&w=900&q=80" alt="Palu hakim">
          <div class="cap">Perkara &amp; Litigasi Hukum</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CARA MENGAJUKAN -->
<section class="page-wrap">
  <span class="section-label">Proses</span>
  <h2 class="section-title mb-5">Cara mengajukan konsultasi perkara</h2>
  <div class="step-line">
    <div class="step-item"><span class="snum">01</span><h4>Daftar Akun</h4><p>Buat akun klien secara gratis hanya dengan email dan data diri singkat.</p></div>
    <div class="step-item"><span class="snum">02</span><h4>Masuk &amp; Pilih Layanan</h4><p>Login, lalu pilih jenis layanan hukum yang Anda butuhkan.</p></div>
    <div class="step-item"><span class="snum">03</span><h4>Kirim Pengajuan</h4><p>Isi ringkasan kasus Anda dan kirimkan pengajuan konsultasi perkara.</p></div>
    <div class="step-item"><span class="snum">04</span><h4>Diproses Tim Kami</h4><p>Paralegal memverifikasi, lalu managing partner &amp; lawyer menindaklanjuti.</p></div>
  </div>
  <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand mt-5 d-inline-block">Mulai Sekarang</a>
</section>

<!-- TESTIMONI -->
<section class="testi-bg" style="color:var(--paper);padding:6rem 0;background-image:url('https://images.unsplash.com/photo-1589391886645-d51941baf7fb?auto=format&fit=crop&w=1600&q=80');">
  <div class="container">
    <div class="pull-quote">
      <p style="color:var(--paper);">&ldquo;Prosesnya jelas, tim paralegalnya cepat merespon sejak hari pertama. Pendampingan litigasinya profesional dan saya selalu tahu perkembangan kasus lewat dashboard.&rdquo;</p>
      <div class="who" style="color:rgba(250,247,241,.6);">Klien Pendampingan Litigasi, Jakarta</div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="page-wrap" style="max-width:760px;">
  <span class="section-label">FAQ</span>
  <h2 class="section-title mb-4">Pertanyaan yang sering diajukan</h2>
  <details class="faq-row">
    <summary>Apakah saya harus mendaftar sebelum mengajukan konsultasi?</summary>
    <div class="faq-body">Ya. Pendaftaran akun klien diperlukan agar setiap pengajuan tercatat, dapat diverifikasi, dan status kasusnya dapat Anda pantau melalui dashboard.</div>
  </details>
  <details class="faq-row">
    <summary>Berapa lama proses verifikasi pengajuan?</summary>
    <div class="faq-body">Setelah pengajuan dikirim, tim paralegal akan memverifikasi kelengkapan kasus sebelum diteruskan ke managing partner untuk ditindaklanjuti.</div>
  </details>
  <details class="faq-row">
    <summary>Apakah data dan kasus saya dijaga kerahasiaannya?</summary>
    <div class="faq-body">Ya, seluruh data klien dan dokumen kasus disimpan aman dan hanya dapat diakses oleh staf yang berwenang menangani kasus Anda.</div>
  </details>
</section>

<!-- CTA -->
<section class="page-wrap text-center" style="max-width:600px;">
  <h2 class="section-title mb-3">Siap menyelesaikan masalah hukum Anda?</h2>
  <p style="color:var(--ink-soft);margin-bottom:2rem;">Daftar sekarang dan ajukan konsultasi perkara pertama Anda bersama tim Subhan Aziz &amp; Partners.</p>
  <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand">Ajukan Konsultasi Perkara Sekarang</a>
</section>

<style>
  .about-photo { width: 100%; height: 260px; object-fit: cover; filter: grayscale(.5) contrast(1.05); border: 1px solid var(--line); margin-bottom: 1.6rem; }
  .feat-row { display: flex; gap: 1rem; padding: 1.4rem 0; border-bottom: 1px solid var(--line); }
  .feat-row:first-child { border-top: 1px solid var(--line); }
  .feat-row .fnum { font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; color: var(--accent); width: 40px; flex-shrink: 0; }
  .feat-row h4 { font-size: 1.05rem; margin-bottom: .2rem; }
  .feat-row p { color: var(--ink-soft); font-size: .9rem; margin: 0; }
</style>

<section class="page-wrap">
  <span class="eyebrow">Tentang Kami</span>
  <h1 class="section-title mb-4" style="font-size:2rem;">Kenapa klien memilih kami</h1>

  <div class="row">
    <div class="col-lg-4">
      <img class="about-photo" src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=700&q=80" alt="Rak buku hukum">
      <p style="color:var(--ink-soft);">Firma Hukum Subhan Aziz &amp; Partners melayani konsultasi dan penanganan
         perkara hukum secara profesional sejak lebih dari 10 tahun. Setiap pengajuan diverifikasi paralegal,
         ditinjau managing partner, lalu ditangani lawyer yang ditunjuk hingga selesai.</p>
    </div>
    <div class="col-lg-7 offset-lg-1">
      <div class="feat-row">
        <div class="fnum">01</div>
        <div><h4>Kerahasiaan Terjamin</h4><p>Setiap data dan dokumen kasus dijaga sesuai kode etik profesi hukum.</p></div>
      </div>
      <div class="feat-row">
        <div class="fnum">02</div>
        <div><h4>Respon Cepat</h4><p>Pengajuan diverifikasi paralegal dan ditindaklanjuti tanpa menunggu lama.</p></div>
      </div>
      <div class="feat-row">
        <div class="fnum">03</div>
        <div><h4>Tim Berpengalaman</h4><p>Ditangani paralegal, lawyer, dan managing partner dengan pengalaman puluhan kasus.</p></div>
      </div>
      <div class="feat-row">
        <div class="fnum">04</div>
        <div><h4>Proses Transparan</h4><p>Pantau status pengajuan Anda kapan saja lewat dashboard klien.</p></div>
      </div>
    </div>
  </div>

  <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand mt-5 d-inline-block">Ajukan Konsultasi Perkara</a>
</section>

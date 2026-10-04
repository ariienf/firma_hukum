<style>
  .kontak-row { display: flex; gap: 1.2rem; padding: 1.4rem 0; border-bottom: 1px solid var(--line); }
  .kontak-row:first-of-type { border-top: 1px solid var(--line); }
  .kontak-row .knum { font-family: 'Cormorant Garamond', serif; font-size: 1.2rem; color: var(--accent); width: 40px; flex-shrink: 0; }
  .kontak-row h4 { font-size: 1rem; margin-bottom: .2rem; }
  .kontak-row p { color: var(--ink-soft); font-size: .92rem; margin: 0; }
</style>

<section class="page-wrap" style="max-width:700px;">
  <span class="eyebrow">Kontak Kami</span>
  <h1 class="section-title mb-2" style="font-size:2rem;">Hubungi Subhan Aziz &amp; Partners</h1>
  <p style="color:var(--ink-soft);max-width:520px;margin-bottom:2rem;">Ada pertanyaan sebelum mengajukan konsultasi? Hubungi kami lewat salah satu kontak berikut.</p>

  <div class="kontak-row">
    <div class="knum">01</div>
    <div><h4>Alamat</h4><p>Jl. Contoh Raya No. 17, Jakarta</p></div>
  </div>
  <div class="kontak-row">
    <div class="knum">02</div>
    <div><h4>Telepon</h4><p>(021) 555-0117</p></div>
  </div>
  <div class="kontak-row">
    <div class="knum">03</div>
    <div><h4>Email</h4><p>info@subhanazizpartners.co.id</p></div>
  </div>
  <div class="kontak-row">
    <div class="knum">04</div>
    <div><h4>Jam Operasional</h4><p>Senin&ndash;Jumat, 08.00&ndash;17.00</p></div>
  </div>

  <a href="<?= BASEURL ?>/home/ajukan" class="btn-brand mt-5 d-inline-block">Ajukan Konsultasi Perkara</a>
</section>

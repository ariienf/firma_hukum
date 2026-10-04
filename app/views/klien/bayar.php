<div class="page-wrap" style="max-width:560px;">
  <span class="section-label">Pembayaran</span>
  <h2 class="section-title mb-4">Bayar Tagihan &mdash; <?= htmlspecialchars($t['no_tiket']) ?></h2>

  <div class="data-card">
    <dl>
      <dt>Jenis</dt><dd><?= htmlspecialchars(ucfirst($t['jenis_pembayaran'])) ?></dd>
      <dt>Jumlah</dt><dd>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></dd>
    </dl>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger rounded-0 py-2 px-3 mb-3" style="font-size:.85rem;"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" action="<?= BASEURL ?>/klien/bayar/<?= $t['id_pembayaran'] ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Metode Bayar</label>
      <select name="metode_bayar" class="form-select" style="border:none;border-bottom:1px solid var(--line);border-radius:0;padding:.55rem 0;" required>
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="QRIS">QRIS</option>
        <option value="Tunai">Tunai (bayar langsung ke kantor)</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="form-label d-block" style="font-size:.78rem;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Bukti Pembayaran</label>
      <input type="file" name="bukti_bayar" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
      <div class="form-text" style="font-size:.78rem;color:var(--muted);">Format JPG/PNG/PDF, maksimal 2MB.</div>
    </div>
    <button type="submit" class="btn-brand">Kirim Bukti Pembayaran</button>
    <a href="<?= BASEURL ?>/klien" class="btn-brand-outline ms-3">Batal</a>
  </form>
</div>

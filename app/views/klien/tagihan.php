<div class="page-wrap">
  <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4" style="border-bottom:1px solid var(--line);padding-bottom:1.2rem;">
    <div>
      <span class="section-label">Tagihan</span>
      <h2 class="section-title mb-0">Pembayaran Saya</h2>
    </div>
    <a class="btn-brand-outline" href="<?= BASEURL ?>/klien">&larr; Dashboard Pengajuan</a>
  </div>
  <table class="tbl-brand">
    <tr><th>No. Tiket</th><th>Jenis</th><th>Jumlah</th><th>Status</th><th></th></tr>
    <?php if (empty($tagihan)): ?>
      <tr><td colspan="5" class="empty-note">Belum ada tagihan.</td></tr>
    <?php else: foreach ($tagihan as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['no_tiket']) ?></td>
        <td><?= htmlspecialchars(ucfirst($t['jenis_pembayaran'])) ?></td>
        <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
        <td><span class="badge-status st-<?= htmlspecialchars($t['status_bayar']) ?>"><?= htmlspecialchars(str_replace('_', ' ', $t['status_bayar'])) ?></span></td>
        <td>
          <?php if (in_array($t['status_bayar'], ['belum_bayar', 'ditolak'], true)): ?>
            <a href="<?= BASEURL ?>/klien/bayar/<?= $t['id_pembayaran'] ?>" class="btn-brand-outline">Bayar &rarr;</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; endif; ?>
  </table>
</div>

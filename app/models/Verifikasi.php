<?php
// ================= Model Verifikasi (oleh Paralegal) =================
require_once __DIR__ . '/Pengajuan.php';
require_once __DIR__ . '/Pembayaran.php';

class Verifikasi
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Simpan hasil verifikasi paralegal dan perbarui status pengajuan
    public function simpan($data)
    {
        $this->db->query(
                'INSERT INTO verifikasi (id_pengajuan, kode_paralegal, hasil_verifikasi, catatan)
                 VALUES (:id_pengajuan, :kode_paralegal, :hasil, :catatan)')
            ->bind(':id_pengajuan',   $data['id_pengajuan'])
            ->bind(':kode_paralegal', $data['kode_paralegal'])
            ->bind(':hasil',          $data['hasil_verifikasi'])
            ->bind(':catatan',        $data['catatan']);
        $this->db->execute();

        if ($data['hasil_verifikasi'] === 'sesuai') {
            (new Pengajuan())->updateStatus($data['id_pengajuan'], 'verifikasi');
            $pengajuan = (new Pengajuan())->find($data['id_pengajuan']);
            (new Pembayaran())->buat($data['id_pengajuan'], 'konsultasi', $pengajuan['tarif']);
        } else {
            (new Pengajuan())->updateStatus($data['id_pengajuan'], 'ditolak');
        }
    }

    // Rekap jumlah verifikasi yang sudah diproses, dikelompokkan per hasil
    public function hitungByHasil()
    {
        $rows = $this->db->query('SELECT hasil_verifikasi, COUNT(*) AS jumlah FROM verifikasi GROUP BY hasil_verifikasi')->resultSet();
        $hasil = ['sesuai' => 0, 'tidak_sesuai' => 0];
        foreach ($rows as $r) {
            $hasil[$r['hasil_verifikasi']] = (int) $r['jumlah'];
        }
        return $hasil;
    }

    // Catatan verifikasi paralegal untuk satu pengajuan (dipakai MP & klien)
    public function findByPengajuan($id_pengajuan)
    {
        return $this->db->query('SELECT * FROM verifikasi WHERE id_pengajuan = :id ORDER BY tanggal_verifikasi DESC')
            ->bind(':id', $id_pengajuan)
            ->single();
    }
}

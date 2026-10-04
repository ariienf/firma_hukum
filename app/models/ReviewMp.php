<?php
// ================= Model ReviewMp (oleh Managing Partner) =================
require_once __DIR__ . '/Pengajuan.php';
require_once __DIR__ . '/Pembayaran.php';

class ReviewMp
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Simpan hasil review MP. Jika dapat_ditangani, sekaligus buat penugasan ke lawyer.
    public function simpan($data)
    {
        $this->db->query(
                'INSERT INTO review_mp (id_pengajuan, kode_mp, hasil_review, catatan)
                 VALUES (:id_pengajuan, :kode_mp, :hasil, :catatan)')
            ->bind(':id_pengajuan', $data['id_pengajuan'])
            ->bind(':kode_mp',      $data['kode_mp'])
            ->bind(':hasil',        $data['hasil_review'])
            ->bind(':catatan',      $data['catatan']);
        $this->db->execute();

        if ($data['hasil_review'] === 'dapat_ditangani') {
            $this->db->query(
                    'INSERT INTO penugasan (id_pengajuan, kode_mp, kode_lawyer, biaya_penanganan, status_penugasan)
                     VALUES (:id_pengajuan, :kode_mp, :kode_lawyer, :biaya, "ditugaskan")')
                ->bind(':id_pengajuan', $data['id_pengajuan'])
                ->bind(':kode_mp',      $data['kode_mp'])
                ->bind(':kode_lawyer',  $data['kode_lawyer'])
                ->bind(':biaya',        $data['biaya_penanganan']);
            $this->db->execute();

            (new Pengajuan())->updateStatus($data['id_pengajuan'], 'diteruskan');
            (new Pembayaran())->buat($data['id_pengajuan'], 'penanganan', $data['biaya_penanganan']);
        } else {
            (new Pengajuan())->updateStatus($data['id_pengajuan'], 'ditolak');
        }
    }

    // Rekap jumlah review yang sudah diproses, dikelompokkan per hasil
    public function hitungByHasil()
    {
        $rows = $this->db->query('SELECT hasil_review, COUNT(*) AS jumlah FROM review_mp GROUP BY hasil_review')->resultSet();
        $hasil = ['dapat_ditangani' => 0, 'ditolak' => 0];
        foreach ($rows as $r) {
            $hasil[$r['hasil_review']] = (int) $r['jumlah'];
        }
        return $hasil;
    }

    // Catatan review Managing Partner untuk satu pengajuan (dipakai lawyer)
    public function findByPengajuan($id_pengajuan)
    {
        return $this->db->query('SELECT * FROM review_mp WHERE id_pengajuan = :id ORDER BY tanggal_review DESC')
            ->bind(':id', $id_pengajuan)
            ->single();
    }
}

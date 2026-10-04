<?php
// ================= Model Penugasan (MP -> Lawyer) =================

class Penugasan
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Daftar penugasan milik seorang lawyer, lengkap dengan data pengajuan/klien/layanan
    public function getByLawyer($kode_lawyer)
    {
        return $this->db->query(
                'SELECT pg.*, p.no_tiket, p.ringkasan_kasus, p.status AS status_pengajuan,
                        l.nama_layanan, k.nama_klien
                 FROM penugasan pg
                 JOIN pengajuan p ON pg.id_pengajuan = p.id_pengajuan
                 JOIN layanan l   ON p.id_layanan = l.id_layanan
                 JOIN klien k     ON p.id_klien = k.id_klien
                 WHERE pg.kode_lawyer = :kode
                 ORDER BY pg.tanggal_penugasan ASC')
            ->bind(':kode', $kode_lawyer)
            ->resultSet();
    }

    public function find($id_penugasan)
    {
        return $this->db->query(
                'SELECT pg.*, p.no_tiket, p.ringkasan_kasus, p.status AS status_pengajuan,
                        l.nama_layanan, k.nama_klien
                 FROM penugasan pg
                 JOIN pengajuan p ON pg.id_pengajuan = p.id_pengajuan
                 JOIN layanan l   ON p.id_layanan = l.id_layanan
                 JOIN klien k     ON p.id_klien = k.id_klien
                 WHERE pg.id_penugasan = :id')
            ->bind(':id', $id_penugasan)
            ->single();
    }

    // Penugasan (terbaru) untuk satu pengajuan, dipakai tampilan klien untuk tahu lawyer yang menangani
    public function findByPengajuan($id_pengajuan)
    {
        return $this->db->query(
                'SELECT * FROM penugasan WHERE id_pengajuan = :id ORDER BY tanggal_penugasan DESC')
            ->bind(':id', $id_pengajuan)
            ->single();
    }

    public function updateStatus($id_penugasan, $status)
    {
        $this->db->query('UPDATE penugasan SET status_penugasan = :status WHERE id_penugasan = :id')
            ->bind(':status', $status)
            ->bind(':id', $id_penugasan);
        return $this->db->execute();
    }

    // Semua kasus yang sudah diteruskan ke lawyer manapun (riwayat kasus milik Managing Partner)
    public function all()
    {
        return $this->db->query(
                'SELECT pg.*, p.no_tiket, p.ringkasan_kasus, p.status AS status_pengajuan,
                        l.nama_layanan, k.nama_klien
                 FROM penugasan pg
                 JOIN pengajuan p ON pg.id_pengajuan = p.id_pengajuan
                 JOIN layanan l   ON p.id_layanan = l.id_layanan
                 JOIN klien k     ON p.id_klien = k.id_klien
                 ORDER BY pg.tanggal_penugasan DESC')
            ->resultSet();
    }

    // Rekap jumlah kasus milik seorang lawyer, dikelompokkan per status_penugasan
    public function countByLawyer($kode_lawyer)
    {
        $rows = $this->db->query(
                'SELECT status_penugasan, COUNT(*) AS jumlah FROM penugasan WHERE kode_lawyer = :kode GROUP BY status_penugasan')
            ->bind(':kode', $kode_lawyer)
            ->resultSet();
        $hasil = ['ditugaskan' => 0, 'diproses' => 0, 'selesai' => 0];
        foreach ($rows as $r) {
            $hasil[$r['status_penugasan']] = (int) $r['jumlah'];
        }
        return $hasil;
    }
}

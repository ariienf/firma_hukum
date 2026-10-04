<?php
// ================= Model PenangananKasus (oleh Lawyer) =================
require_once __DIR__ . '/Pengajuan.php';
require_once __DIR__ . '/Penugasan.php';

class PenangananKasus
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByPenugasan($id_penugasan)
    {
        return $this->db->query('SELECT * FROM penanganan_kasus WHERE id_penugasan = :id')
            ->bind(':id', $id_penugasan)
            ->single();
    }

    // Hasil penanganan lawyer untuk satu pengajuan (dipakai klien), lewat penugasan terkait
    public function findByPengajuan($id_pengajuan)
    {
        return $this->db->query(
                'SELECT pk.* FROM penanganan_kasus pk
                 JOIN penugasan pg ON pk.id_penugasan = pg.id_penugasan
                 WHERE pg.id_pengajuan = :id')
            ->bind(':id', $id_pengajuan)
            ->single();
    }

    // Lawyer mulai menangani kasus
    public function mulai($id_penugasan, $id_pengajuan)
    {
        $this->db->query(
                'INSERT INTO penanganan_kasus (id_penugasan, status_penanganan, tanggal_mulai)
                 VALUES (:id_penugasan, "berjalan", CURDATE())')
            ->bind(':id_penugasan', $id_penugasan);
        $this->db->execute();

        (new Penugasan())->updateStatus($id_penugasan, 'diproses');
        (new Pengajuan())->updateStatus($id_pengajuan, 'ditangani');
    }

    // Lawyer menyelesaikan penanganan kasus
    public function selesaikan($id_penugasan, $id_pengajuan, $hasil_penanganan)
    {
        $this->db->query(
                'UPDATE penanganan_kasus
                 SET hasil_penanganan = :hasil, status_penanganan = "selesai", tanggal_selesai = CURDATE()
                 WHERE id_penugasan = :id_penugasan')
            ->bind(':hasil',        $hasil_penanganan)
            ->bind(':id_penugasan', $id_penugasan);
        $this->db->execute();

        (new Penugasan())->updateStatus($id_penugasan, 'selesai');
        (new Pengajuan())->updateStatus($id_pengajuan, 'selesai');
    }
}

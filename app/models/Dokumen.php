<?php
// ================= Model Dokumen (berkas pendukung pengajuan) =================

class Dokumen
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByPengajuan($id_pengajuan)
    {
        return $this->db->query(
                'SELECT * FROM dokumen WHERE id_pengajuan = :id ORDER BY tanggal_upload ASC')
            ->bind(':id', $id_pengajuan)
            ->resultSet();
    }

    public function simpan($id_pengajuan, $nama_dokumen, $file_path)
    {
        $this->db->query(
                'INSERT INTO dokumen (id_pengajuan, nama_dokumen, file_path) VALUES (:id, :nama, :path)')
            ->bind(':id',   $id_pengajuan)
            ->bind(':nama', $nama_dokumen)
            ->bind(':path', $file_path);
        return $this->db->execute();
    }
}

<?php
// ================= Model Layanan (CRUD administrator) =================

class Layanan
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        return $this->db->query('SELECT * FROM layanan ORDER BY nama_layanan ASC')->resultSet();
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM layanan WHERE id_layanan = :id')
            ->bind(':id', $id)
            ->single();
    }

    public function create($data)
    {
        $this->db->query(
                'INSERT INTO layanan (nama_layanan, deskripsi, persyaratan, tarif)
                 VALUES (:nama, :deskripsi, :persyaratan, :tarif)')
            ->bind(':nama',        $data['nama_layanan'])
            ->bind(':deskripsi',   $data['deskripsi'])
            ->bind(':persyaratan', $data['persyaratan'])
            ->bind(':tarif',       $data['tarif']);
        return $this->db->execute();
    }

    public function update($id, $data)
    {
        $this->db->query(
                'UPDATE layanan SET nama_layanan = :nama, deskripsi = :deskripsi,
                        persyaratan = :persyaratan, tarif = :tarif
                 WHERE id_layanan = :id')
            ->bind(':nama',        $data['nama_layanan'])
            ->bind(':deskripsi',   $data['deskripsi'])
            ->bind(':persyaratan', $data['persyaratan'])
            ->bind(':tarif',       $data['tarif'])
            ->bind(':id',          $id);
        return $this->db->execute();
    }

    // Kembalikan true bila berhasil, atau pesan error (string) bila gagal (mis. masih dipakai pengajuan)
    public function delete($id)
    {
        try {
            $this->db->query('DELETE FROM layanan WHERE id_layanan = :id')->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            return 'Layanan tidak dapat dihapus karena masih memiliki riwayat pengajuan.';
        }
    }
}

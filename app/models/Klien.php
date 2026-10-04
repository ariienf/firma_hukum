<?php
// ================= Model Klien =================

class Klien
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByEmail($email)
    {
        return $this->db->query('SELECT * FROM klien WHERE email = :email')
                        ->bind(':email', $email)
                        ->single();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO klien (nama_klien, email, password, no_telp, alamat)
                          VALUES (:nama, :email, :password, :no_telp, :alamat)')
                 ->bind(':nama',     $data['nama'])
                 ->bind(':email',    $data['email'])
                 ->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT))
                 ->bind(':no_telp',  $data['no_telp'])
                 ->bind(':alamat',   $data['alamat']);
        return $this->db->execute();
    }

    // ---- CRUD untuk administrator ----

    public function all()
    {
        return $this->db->query('SELECT * FROM klien ORDER BY nama_klien ASC')->resultSet();
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM klien WHERE id_klien = :id')
            ->bind(':id', $id)
            ->single();
    }

    public function update($id, $data)
    {
        $this->db->query(
                'UPDATE klien SET nama_klien = :nama, email = :email, no_telp = :no_telp, alamat = :alamat
                 WHERE id_klien = :id')
            ->bind(':nama',    $data['nama'])
            ->bind(':email',   $data['email'])
            ->bind(':no_telp', $data['no_telp'])
            ->bind(':alamat',  $data['alamat'])
            ->bind(':id',      $id);
        return $this->db->execute();
    }

    public function resetPassword($id, $passwordPlain)
    {
        $this->db->query('UPDATE klien SET password = :password WHERE id_klien = :id')
            ->bind(':password', password_hash($passwordPlain, PASSWORD_DEFAULT))
            ->bind(':id', $id);
        return $this->db->execute();
    }

    // Kembalikan true bila berhasil, atau pesan error (string) bila gagal (mis. masih punya pengajuan)
    public function delete($id)
    {
        try {
            $this->db->query('DELETE FROM klien WHERE id_klien = :id')->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            return 'Klien tidak dapat dihapus karena masih memiliki riwayat pengajuan.';
        }
    }
}

<?php
// ================= Model Pengajuan (contoh modul transaksi) =================

class Pengajuan
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByKlien($id_klien)
    {
        return $this->db->query(
                'SELECT p.*, l.nama_layanan
                 FROM pengajuan p
                 JOIN layanan l ON p.id_layanan = l.id_layanan
                 WHERE p.id_klien = :id
                 ORDER BY p.tanggal_pengajuan DESC')
            ->bind(':id', $id_klien)
            ->resultSet();
    }

    public function simpan($data)
    {
        $no_tiket = 'SAP-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
        $this->db->query(
                'INSERT INTO pengajuan (no_tiket, id_klien, id_layanan, ringkasan_kasus, status)
                 VALUES (:tiket, :klien, :layanan, :ringkasan, "baru")')
            ->bind(':tiket',     $no_tiket)
            ->bind(':klien',     $data['id_klien'])
            ->bind(':layanan',   $data['id_layanan'])
            ->bind(':ringkasan', $data['ringkasan_kasus']);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    // Daftar pengajuan dengan status tertentu (dipakai paralegal & managing partner)
    public function getByStatus($status)
    {
        return $this->db->query(
                'SELECT p.*, l.nama_layanan, k.nama_klien
                 FROM pengajuan p
                 JOIN layanan l ON p.id_layanan = l.id_layanan
                 JOIN klien k ON p.id_klien = k.id_klien
                 WHERE p.status = :status
                 ORDER BY p.tanggal_pengajuan ASC')
            ->bind(':status', $status)
            ->resultSet();
    }

    // Detail satu pengajuan lengkap dengan data klien & layanan
    public function find($id)
    {
        return $this->db->query(
                'SELECT p.*, l.nama_layanan, l.tarif, l.persyaratan, k.nama_klien, k.email, k.no_telp
                 FROM pengajuan p
                 JOIN layanan l ON p.id_layanan = l.id_layanan
                 JOIN klien k ON p.id_klien = k.id_klien
                 WHERE p.id_pengajuan = :id')
            ->bind(':id', $id)
            ->single();
    }

    public function updateStatus($id, $status)
    {
        $this->db->query('UPDATE pengajuan SET status = :status WHERE id_pengajuan = :id')
            ->bind(':status', $status)
            ->bind(':id', $id);
        return $this->db->execute();
    }

    // Hitung jumlah pengajuan per status (dipakai ringkasan administrator)
    public function countByStatus()
    {
        $rows = $this->db->query('SELECT status, COUNT(*) AS jumlah FROM pengajuan GROUP BY status')->resultSet();
        $hasil = [];
        foreach ($rows as $r) {
            $hasil[$r['status']] = (int) $r['jumlah'];
        }
        return $hasil;
    }

    // ---- CRUD untuk administrator (koreksi data langsung, semua status) ----

    public function all()
    {
        return $this->db->query(
                'SELECT p.*, l.nama_layanan, k.nama_klien
                 FROM pengajuan p
                 JOIN layanan l ON p.id_layanan = l.id_layanan
                 JOIN klien k ON p.id_klien = k.id_klien
                 ORDER BY p.tanggal_pengajuan DESC')
            ->resultSet();
    }

    public function update($id, $data)
    {
        $this->db->query(
                'UPDATE pengajuan SET id_layanan = :layanan, ringkasan_kasus = :ringkasan, status = :status
                 WHERE id_pengajuan = :id')
            ->bind(':layanan',   $data['id_layanan'])
            ->bind(':ringkasan', $data['ringkasan_kasus'])
            ->bind(':status',    $data['status'])
            ->bind(':id',        $id);
        return $this->db->execute();
    }

    // Kembalikan true bila berhasil, atau pesan error (string) bila gagal (mis. sudah punya riwayat verifikasi/pembayaran)
    public function delete($id)
    {
        try {
            $this->db->query('DELETE FROM pengajuan WHERE id_pengajuan = :id')->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            return 'Pengajuan tidak dapat dihapus karena sudah memiliki riwayat verifikasi/review/pembayaran.';
        }
    }
}

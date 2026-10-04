<?php
// ================= Model Pembayaran =================
// jenis_pembayaran: 'konsultasi' (dibuat otomatis saat paralegal verifikasi 'sesuai')
//                   'penanganan' (dibuat otomatis saat MP menugaskan lawyer)
// status_bayar: belum_bayar -> menunggu_verifikasi -> lunas | ditolak

class Pembayaran
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Buat tagihan baru (dipanggil otomatis dari Verifikasi/ReviewMp)
    public function buat($id_pengajuan, $jenis, $jumlah)
    {
        $this->db->query(
                'INSERT INTO pembayaran (id_pengajuan, jenis_pembayaran, jumlah, status_bayar)
                 VALUES (:id_pengajuan, :jenis, :jumlah, "belum_bayar")')
            ->bind(':id_pengajuan', $id_pengajuan)
            ->bind(':jenis',        $jenis)
            ->bind(':jumlah',       $jumlah);
        return $this->db->execute();
    }

    // Semua tagihan milik klien (join ke pengajuan untuk no_tiket & kepemilikan)
    public function getByKlien($id_klien)
    {
        return $this->db->query(
                'SELECT b.*, p.no_tiket, p.id_klien
                 FROM pembayaran b
                 JOIN pengajuan p ON b.id_pengajuan = p.id_pengajuan
                 WHERE p.id_klien = :id_klien
                 ORDER BY b.tanggal_bayar DESC')
            ->bind(':id_klien', $id_klien)
            ->resultSet();
    }

    // Detail satu tagihan, lengkap dengan kepemilikan klien (untuk validasi akses)
    public function find($id_pembayaran)
    {
        return $this->db->query(
                'SELECT b.*, p.no_tiket, p.id_klien, k.nama_klien
                 FROM pembayaran b
                 JOIN pengajuan p ON b.id_pengajuan = p.id_pengajuan
                 JOIN klien k     ON p.id_klien = k.id_klien
                 WHERE b.id_pembayaran = :id')
            ->bind(':id', $id_pembayaran)
            ->single();
    }

    // Klien mengunggah bukti bayar
    public function simpanBukti($id_pembayaran, $metode_bayar, $bukti_bayar)
    {
        $this->db->query(
                'UPDATE pembayaran
                 SET metode_bayar = :metode, bukti_bayar = :bukti,
                     status_bayar = "menunggu_verifikasi", tanggal_bayar = NOW()
                 WHERE id_pembayaran = :id')
            ->bind(':metode', $metode_bayar)
            ->bind(':bukti',  $bukti_bayar)
            ->bind(':id',     $id_pembayaran);
        return $this->db->execute();
    }

    // Daftar tagihan yang menunggu diverifikasi paralegal
    public function getMenungguVerifikasi()
    {
        return $this->db->query(
                'SELECT b.*, p.no_tiket, k.nama_klien
                 FROM pembayaran b
                 JOIN pengajuan p ON b.id_pengajuan = p.id_pengajuan
                 JOIN klien k     ON p.id_klien = k.id_klien
                 WHERE b.status_bayar = "menunggu_verifikasi"
                 ORDER BY b.tanggal_bayar ASC')
            ->resultSet();
    }

    // Paralegal menyetujui/menolak bukti bayar
    public function verifikasi($id_pembayaran, $status_bayar, $kode_paralegal)
    {
        $this->db->query(
                'UPDATE pembayaran SET status_bayar = :status, kode_paralegal = :kode WHERE id_pembayaran = :id')
            ->bind(':status', $status_bayar)
            ->bind(':kode',   $kode_paralegal)
            ->bind(':id',     $id_pembayaran);
        return $this->db->execute();
    }

    // Rekap jumlah tagihan dikelompokkan per status_bayar
    public function countByStatus()
    {
        $rows = $this->db->query('SELECT status_bayar, COUNT(*) AS jumlah FROM pembayaran GROUP BY status_bayar')->resultSet();
        $hasil = [];
        foreach ($rows as $r) {
            $hasil[$r['status_bayar']] = (int) $r['jumlah'];
        }
        return $hasil;
    }
}

<?php
// ================= Model Staf (dari konfigurasi, BUKAN DB) =================
// Inilah jembatan ke "database aktor backend di dalam coding".

class Staf
{
    private $daftar;

    public function __construct()
    {
        // Memuat array staf dari app/config/staff.php
        $this->daftar = require '../app/config/staff.php';
    }

    // Cek username & password. Return data staf bila cocok, atau false.
    public function autentikasi($username, $password)
    {
        if (!isset($this->daftar[$username])) {
            return false;
        }
        $staf = $this->daftar[$username];
        if (password_verify($password, $staf['password'])) {
            unset($staf['password']);          // jangan simpan hash di session
            $staf['username'] = $username;
            return $staf;                      // berisi kode, nama, role, username
        }
        return false;
    }

    // Daftar staf dengan role tertentu, tanpa hash password (dipakai dropdown penugasan lawyer)
    public function getByRole($role)
    {
        $hasil = [];
        foreach ($this->daftar as $username => $staf) {
            if ($staf['role'] === $role) {
                unset($staf['password']);
                $staf['username'] = $username;
                $hasil[] = $staf;
            }
        }
        return $hasil;
    }

    // Cari satu staf berdasarkan kode (mis. 'LW01'), tanpa hash password
    public function findByKode($kode)
    {
        foreach ($this->daftar as $username => $staf) {
            if ($staf['kode'] === $kode) {
                unset($staf['password']);
                $staf['username'] = $username;
                return $staf;
            }
        }
        return null;
    }
}

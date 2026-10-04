<?php
// ================= Base Controller =================

class Controller
{
    // Memuat model: $this->model('Klien')
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Menampilkan view: $this->view('klien/dashboard', $data)
    public function view($view, $data = [])
    {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    // --------- Helper autentikasi / hak akses ---------

    // Pastikan sudah login sebagai klien, jika tidak -> ke halaman login
    protected function requireKlien()
    {
        if (!isset($_SESSION['klien'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    // Pastikan sudah login sebagai staf dengan role tertentu
    // contoh: $this->requireStaf('paralegal')
    // Administrator selalu lolos (superuser) apapun role yang diminta.
    protected function requireStaf($role = null)
    {
        if (!isset($_SESSION['staf'])) {
            header('Location: ' . BASEURL . '/auth/staf');
            exit;
        }
        if ($role !== null && $_SESSION['staf']['role'] !== $role && $_SESSION['staf']['role'] !== 'administrator') {
            die('Akses ditolak: role tidak sesuai.');
        }
    }
}

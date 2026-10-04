<?php
// ================= HomeController (landing page publik) =================

class HomeController extends Controller
{
    // Beranda: bisa diakses siapa saja (belum login)
    public function index()
    {
        $db      = new Database();
        $layanan = $db->query('SELECT * FROM layanan')->resultSet();

        $this->view('templates/header', ['judul' => 'Subhan Aziz & Partners — Konsultasi Hukum']);
        $this->view('home/index', ['layanan' => $layanan]);
        $this->view('templates/footer');
    }

    // Gerbang "Ajukan Konsultasi": klien yang sudah login -> langsung ke form,
    // tamu -> diarahkan daftar dulu.
    public function ajukan()
    {
        if (isset($_SESSION['klien'])) {
            header('Location: ' . BASEURL . '/klien/pengajuan');
            exit;
        }
        $_SESSION['flash'] = ['type' => 'info', 'message' => 'Silakan daftar terlebih dahulu untuk mengajukan konsultasi.'];
        header('Location: ' . BASEURL . '/auth/register');
        exit;
    }

    // Halaman tersendiri: daftar lengkap layanan
    public function layanan()
    {
        $db      = new Database();
        $layanan = $db->query('SELECT * FROM layanan')->resultSet();

        $this->view('templates/header', ['judul' => 'Layanan Kami']);
        $this->view('home/layanan', ['layanan' => $layanan]);
        $this->view('templates/footer');
    }

    // Halaman tersendiri: profil firma
    public function tentang()
    {
        $this->view('templates/header', ['judul' => 'Tentang Kami']);
        $this->view('home/tentang');
        $this->view('templates/footer');
    }

    // Halaman tersendiri: informasi kontak
    public function kontak()
    {
        $this->view('templates/header', ['judul' => 'Kontak Kami']);
        $this->view('home/kontak');
        $this->view('templates/footer');
    }
}

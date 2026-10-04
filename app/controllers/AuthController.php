<?php
// ================= AuthController =================
// Menangani login klien (DB), login staf (config), registrasi, logout.

class AuthController extends Controller
{
    // Halaman login klien
    public function index()
    {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        $this->view('auth/login_klien', ['flash' => $flash]);
    }

    // Proses login klien -> cek ke tabel klien
    public function prosesKlien()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/auth'); exit; }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $klien    = $this->model('Klien')->findByEmail($email);

        if ($klien && password_verify($password, $klien['password'])) {
            $_SESSION['klien'] = [
                'id_klien' => $klien['id_klien'],
                'nama'     => $klien['nama_klien'],
            ];
            header('Location: ' . BASEURL . '/klien');
            exit;
        }
        $this->view('auth/login_klien', ['flash' => ['type' => 'error', 'message' => 'Email atau password salah.']]);
    }

    // Registrasi klien baru
    public function register()
    {
        $flash = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama'     => trim($_POST['nama']),
                'email'    => trim($_POST['email']),
                'password' => $_POST['password'],
                'no_telp'  => trim($_POST['no_telp']),
                'alamat'   => trim($_POST['alamat']),
            ];
            $klienModel = $this->model('Klien');
            if ($klienModel->findByEmail($data['email'])) {
                $flash = ['type' => 'error', 'message' => 'Email sudah terdaftar. Silakan masuk atau gunakan email lain.'];
            } elseif ($klienModel->register($data)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Registrasi berhasil. Silakan masuk untuk melanjutkan.'];
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
        if ($flash === null) {
            $flash = $_SESSION['flash'] ?? null;
            unset($_SESSION['flash']);
        }
        $this->view('auth/register', ['flash' => $flash]);
    }

    // Halaman login staf (backend)
    public function staf()
    {
        $this->view('auth/login_staf', ['flash' => null]);
    }

    // Proses login staf -> cek ke config (hardcoded)
    public function prosesStaf()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/auth/staf'); exit; }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $staf     = $this->model('Staf')->autentikasi($username, $password);

        if ($staf) {
            $_SESSION['staf'] = $staf;                 // kode, nama, role, username
            // arahkan ke dashboard sesuai role
            header('Location: ' . BASEURL . '/' . $staf['role']);
            exit;
        }
        $this->view('auth/login_staf', ['flash' => ['type' => 'error', 'message' => 'Username atau password salah.']]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}

<?php
// ================= KlienController (front-end klien) =================

class KlienController extends Controller
{
    public function __construct()
    {
        $this->requireKlien();   // wajib login sebagai klien
    }

    // Dashboard: daftar pengajuan milik klien
    public function index()
    {
        $id_klien  = $_SESSION['klien']['id_klien'];
        $pengajuan = $this->model('Pengajuan')->getByKlien($id_klien);

        $this->view('templates/header', ['judul' => 'Dashboard Klien']);
        $this->view('klien/dashboard', ['pengajuan' => $pengajuan]);
        $this->view('templates/footer');
    }

    // Halaman tersendiri: daftar tagihan/pembayaran milik klien
    public function tagihan()
    {
        $id_klien = $_SESSION['klien']['id_klien'];
        $tagihan  = $this->model('Pembayaran')->getByKlien($id_klien);

        $this->view('templates/header', ['judul' => 'Tagihan Saya']);
        $this->view('klien/tagihan', ['tagihan' => $tagihan]);
        $this->view('templates/footer');
    }

    // Form pengajuan baru + proses simpan
    public function pengajuan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_klien'        => $_SESSION['klien']['id_klien'],
                'id_layanan'      => (int) $_POST['id_layanan'],
                'ringkasan_kasus' => trim($_POST['ringkasan_kasus']),
            ];
            $id_pengajuan = $this->model('Pengajuan')->simpan($data);
            $gagal = $this->simpanDokumenUpload($id_pengajuan, $_FILES['dokumen'] ?? []);

            $_SESSION['flash'] = $gagal > 0
                ? ['type' => 'info', 'message' => "Pengajuan terkirim. $gagal file dokumen tidak dapat diunggah (format/ukuran tidak sesuai)."]
                : ['type' => 'success', 'message' => 'Pengajuan berhasil dikirim.'];
            header('Location: ' . BASEURL . '/klien');
            exit;
        }

        // ambil daftar layanan untuk dropdown
        $db = new Database();
        $layanan = $db->query('SELECT * FROM layanan')->resultSet();

        $this->view('templates/header', ['judul' => 'Ajukan Konsultasi']);
        $this->view('klien/form_pengajuan', ['layanan' => $layanan]);
        $this->view('templates/footer');
    }

    // Lihat & lampirkan dokumen pendukung untuk satu pengajuan
    public function dokumen($id_pengajuan)
    {
        $p = $this->model('Pengajuan')->find($id_pengajuan);
        if (!$p || (int) $p['id_klien'] !== (int) $_SESSION['klien']['id_klien']) {
            header('Location: ' . BASEURL . '/klien');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gagal = $this->simpanDokumenUpload($id_pengajuan, $_FILES['dokumen'] ?? []);
            $_SESSION['flash'] = $gagal > 0
                ? ['type' => 'info', 'message' => "$gagal file tidak dapat diunggah (format/ukuran tidak sesuai)."]
                : ['type' => 'success', 'message' => 'Dokumen berhasil diunggah.'];
            header('Location: ' . BASEURL . '/klien/dokumen/' . $id_pengajuan);
            exit;
        }

        $dokumen          = $this->model('Dokumen')->getByPengajuan($id_pengajuan);
        $catatanParalegal = $this->model('Verifikasi')->findByPengajuan($id_pengajuan);
        $catatanLawyer    = $this->model('PenangananKasus')->findByPengajuan($id_pengajuan);

        // Nama lawyer yang menangani, kalau kasus sudah ditugaskan/ditangani
        $lawyerNama = null;
        $penugasan  = $this->model('Penugasan')->findByPengajuan($id_pengajuan);
        if ($penugasan) {
            $staf = $this->model('Staf')->findByKode($penugasan['kode_lawyer']);
            $lawyerNama = $staf['nama'] ?? null;
        }

        $this->view('templates/header', ['judul' => 'Dokumen Pengajuan']);
        $this->view('klien/dokumen', [
            'p'                => $p,
            'dokumen'          => $dokumen,
            'catatanParalegal' => $catatanParalegal,
            'catatanLawyer'    => $catatanLawyer,
            'lawyerNama'       => $lawyerNama,
        ]);
        $this->view('templates/footer');
    }

    // Validasi & simpan beberapa file dokumen sekaligus (input name="dokumen[]").
    // Return jumlah file yang GAGAL diunggah (0 bila semua sukses / tidak ada file).
    private function simpanDokumenUpload($id_pengajuan, $files)
    {
        if (empty($files) || empty($files['name'][0])) {
            return 0;
        }

        $izinkan = ['jpg', 'jpeg', 'png', 'pdf'];
        $gagal   = 0;

        foreach ($files['name'] as $i => $namaAsli) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }
            $ekstensi = strtolower(pathinfo($namaAsli, PATHINFO_EXTENSION));
            if (!in_array($ekstensi, $izinkan, true) || $files['size'][$i] > 2 * 1024 * 1024) {
                $gagal++;
                continue;
            }

            $namaFile = 'dok_' . $id_pengajuan . '_' . time() . '_' . $i . '_' . strtoupper(substr(uniqid(), -5)) . '.' . $ekstensi;
            if (move_uploaded_file($files['tmp_name'][$i], UPLOAD_PATH . $namaFile)) {
                $this->model('Dokumen')->simpan($id_pengajuan, $namaAsli, $namaFile);
            } else {
                $gagal++;
            }
        }

        return $gagal;
    }

    // Bayar tagihan: upload bukti transfer
    public function bayar($id_pembayaran)
    {
        $pembayaranModel = $this->model('Pembayaran');
        $tagihan = $pembayaranModel->find($id_pembayaran);

        // wajib milik klien yang sedang login
        if (!$tagihan || $tagihan['id_klien'] !== $_SESSION['klien']['id_klien']) {
            header('Location: ' . BASEURL . '/klien/tagihan');
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->prosesUploadBukti($id_pembayaran, $tagihan);
            if ($error === null) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Bukti pembayaran terkirim, menunggu verifikasi paralegal.'];
                header('Location: ' . BASEURL . '/klien/tagihan');
                exit;
            }
        }

        $this->view('templates/header', ['judul' => 'Bayar Tagihan']);
        $this->view('klien/bayar', ['t' => $tagihan, 'error' => $error]);
        $this->view('templates/footer');
    }

    // Validasi & simpan file bukti bayar. Return null bila sukses, atau pesan error.
    private function prosesUploadBukti($id_pembayaran, $tagihan)
    {
        if (empty($_FILES['bukti_bayar']) || $_FILES['bukti_bayar']['error'] !== UPLOAD_ERR_OK) {
            return 'Silakan pilih file bukti pembayaran.';
        }

        $file     = $_FILES['bukti_bayar'];
        $izinkan  = ['jpg', 'jpeg', 'png', 'pdf'];
        $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ekstensi, $izinkan, true)) {
            return 'Format file harus JPG, PNG, atau PDF.';
        }
        if ($file['size'] > 2 * 1024 * 1024) {
            return 'Ukuran file maksimal 2MB.';
        }

        $namaFile = 'bayar_' . $id_pembayaran . '_' . time() . '.' . $ekstensi;
        if (!move_uploaded_file($file['tmp_name'], UPLOAD_PATH . $namaFile)) {
            return 'Gagal menyimpan file. Silakan coba lagi.';
        }

        $metode = trim($_POST['metode_bayar'] ?? '');
        $this->model('Pembayaran')->simpanBukti($id_pembayaran, $metode, $namaFile);
        return null;
    }
}

<?php
// ================= ParalegalController (backend) =================
// Verifikasi pengajuan klien yang berstatus 'baru' + verifikasi bukti pembayaran.

class ParalegalController extends Controller
{
    public function __construct()
    {
        $this->requireStaf('paralegal');
    }

    // Dashboard: ringkasan saja, bukan daftar kerja
    public function index()
    {
        $countPengajuan = $this->model('Pengajuan')->countByStatus();
        $countBayar     = $this->model('Pembayaran')->countByStatus();
        $countVerif     = $this->model('Verifikasi')->hitungByHasil();

        $this->view('templates/staf_header', ['judul' => 'Dashboard Paralegal']);
        $this->view('paralegal/dashboard', [
            'baru'          => $countPengajuan['baru'] ?? 0,
            'menungguBayar' => $countBayar['menunggu_verifikasi'] ?? 0,
            'verifikasi'    => $countVerif,
        ]);
        $this->view('templates/staf_footer');
    }

    // Daftar pengajuan yang menunggu verifikasi
    public function pengajuan()
    {
        $pengajuan = $this->model('Pengajuan')->getByStatus('baru');
        $this->view('templates/staf_header', ['judul' => 'Verifikasi Pengajuan']);
        $this->view('paralegal/pengajuan', ['pengajuan' => $pengajuan]);
        $this->view('templates/staf_footer');
    }

    public function verifikasi($id)
    {
        $data = $this->model('Pengajuan')->find($id);
        if (!$data || $data['status'] !== 'baru') {
            header('Location: ' . BASEURL . '/paralegal/pengajuan');
            exit;
        }
        $dokumen = $this->model('Dokumen')->getByPengajuan($id);
        $this->view('templates/staf_header', ['judul' => 'Verifikasi Pengajuan']);
        $this->view('paralegal/verifikasi', ['p' => $data, 'dokumen' => $dokumen]);
        $this->view('templates/staf_footer');
    }

    public function prosesVerifikasi($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/paralegal/pengajuan'); exit; }

        $this->model('Verifikasi')->simpan([
            'id_pengajuan'     => $id,
            'kode_paralegal'   => $_SESSION['staf']['kode'],
            'hasil_verifikasi' => $_POST['hasil_verifikasi'],
            'catatan'          => trim($_POST['catatan'] ?? ''),
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Verifikasi pengajuan berhasil disimpan.'];
        header('Location: ' . BASEURL . '/paralegal/pengajuan');
        exit;
    }

    // Daftar tagihan yang menunggu verifikasi bukti bayar
    public function pembayaran()
    {
        $tagihan = $this->model('Pembayaran')->getMenungguVerifikasi();
        $this->view('templates/staf_header', ['judul' => 'Verifikasi Pembayaran']);
        $this->view('paralegal/pembayaran', ['tagihan' => $tagihan]);
        $this->view('templates/staf_footer');
    }

    public function verifikasiBayar($id_pembayaran)
    {
        $tagihan = $this->model('Pembayaran')->find($id_pembayaran);
        if (!$tagihan || $tagihan['status_bayar'] !== 'menunggu_verifikasi') {
            header('Location: ' . BASEURL . '/paralegal/pembayaran');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Verifikasi Pembayaran']);
        $this->view('paralegal/verifikasi_bayar', ['t' => $tagihan]);
        $this->view('templates/staf_footer');
    }

    public function prosesVerifikasiBayar($id_pembayaran)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/paralegal/pembayaran'); exit; }

        $status = $_POST['status_bayar'] === 'lunas' ? 'lunas' : 'ditolak';
        $this->model('Pembayaran')->verifikasi($id_pembayaran, $status, $_SESSION['staf']['kode']);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Verifikasi pembayaran berhasil disimpan.'];
        header('Location: ' . BASEURL . '/paralegal/pembayaran');
        exit;
    }
}

<?php
// ================= LawyerController (backend) =================
// Menangani kasus yang ditugaskan oleh Managing Partner.

class LawyerController extends Controller
{
    public function __construct()
    {
        $this->requireStaf('lawyer');
    }

    // Dashboard: ringkasan saja, bukan daftar kerja
    public function index()
    {
        $count = $this->model('Penugasan')->countByLawyer($_SESSION['staf']['kode']);
        $this->view('templates/staf_header', ['judul' => 'Dashboard Lawyer']);
        $this->view('lawyer/dashboard', ['count' => $count]);
        $this->view('templates/staf_footer');
    }

    // Daftar kasus yang ditugaskan ke lawyer ini
    public function kasus()
    {
        $penugasan = $this->model('Penugasan')->getByLawyer($_SESSION['staf']['kode']);
        $this->view('templates/staf_header', ['judul' => 'Kasus Saya']);
        $this->view('lawyer/kasus', ['penugasan' => $penugasan]);
        $this->view('templates/staf_footer');
    }

    public function tangani($id_penugasan)
    {
        $tugas = $this->model('Penugasan')->find($id_penugasan);
        if (!$tugas || $tugas['kode_lawyer'] !== $_SESSION['staf']['kode']) {
            header('Location: ' . BASEURL . '/lawyer/kasus');
            exit;
        }
        $penanganan   = $this->model('PenangananKasus')->findByPenugasan($id_penugasan);
        $dokumen      = $this->model('Dokumen')->getByPengajuan($tugas['id_pengajuan']);
        $catatanMp    = $this->model('ReviewMp')->findByPengajuan($tugas['id_pengajuan']);
        $this->view('templates/staf_header', ['judul' => 'Tangani Kasus']);
        $this->view('lawyer/tangani', [
            't'           => $tugas,
            'penanganan'  => $penanganan,
            'dokumen'     => $dokumen,
            'catatanMp'   => $catatanMp,
        ]);
        $this->view('templates/staf_footer');
    }

    public function mulai($id_penugasan)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/lawyer/kasus'); exit; }

        $tugas = $this->model('Penugasan')->find($id_penugasan);
        if ($tugas && $tugas['kode_lawyer'] === $_SESSION['staf']['kode']) {
            $this->model('PenangananKasus')->mulai($id_penugasan, $tugas['id_pengajuan']);
        }
        header('Location: ' . BASEURL . '/lawyer/tangani/' . $id_penugasan);
        exit;
    }

    public function selesaikan($id_penugasan)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/lawyer/kasus'); exit; }

        $tugas = $this->model('Penugasan')->find($id_penugasan);
        if ($tugas && $tugas['kode_lawyer'] === $_SESSION['staf']['kode']) {
            $this->model('PenangananKasus')->selesaikan($id_penugasan, $tugas['id_pengajuan'], trim($_POST['hasil_penanganan'] ?? ''));
        }
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Penanganan kasus telah diselesaikan.'];
        header('Location: ' . BASEURL . '/lawyer/kasus');
        exit;
    }
}

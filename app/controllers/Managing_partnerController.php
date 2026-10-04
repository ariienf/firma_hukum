<?php
// ================= Managing_partnerController (backend) =================
// Review pengajuan yang sudah diverifikasi paralegal (status 'verifikasi'),
// tentukan biaya penanganan & tunjuk lawyer.

class Managing_partnerController extends Controller
{
    public function __construct()
    {
        $this->requireStaf('managing_partner');
    }

    // Dashboard: ringkasan saja, bukan daftar kerja
    public function index()
    {
        $countPengajuan = $this->model('Pengajuan')->countByStatus();
        $countReview    = $this->model('ReviewMp')->hitungByHasil();

        $this->view('templates/staf_header', ['judul' => 'Dashboard Managing Partner']);
        $this->view('managing_partner/dashboard', [
            'menunggu' => $countPengajuan['verifikasi'] ?? 0,
            'review'   => $countReview,
        ]);
        $this->view('templates/staf_footer');
    }

    // Daftar pengajuan yang menunggu review
    public function pengajuan()
    {
        $pengajuan = $this->model('Pengajuan')->getByStatus('verifikasi');
        $this->view('templates/staf_header', ['judul' => 'Review Pengajuan']);
        $this->view('managing_partner/pengajuan', ['pengajuan' => $pengajuan]);
        $this->view('templates/staf_footer');
    }

    public function review($id)
    {
        $data = $this->model('Pengajuan')->find($id);
        if (!$data || $data['status'] !== 'verifikasi') {
            header('Location: ' . BASEURL . '/managing_partner/pengajuan');
            exit;
        }
        $lawyer          = $this->model('Staf')->getByRole('lawyer');
        $dokumen         = $this->model('Dokumen')->getByPengajuan($id);
        $catatanParalegal = $this->model('Verifikasi')->findByPengajuan($id);
        $this->view('templates/staf_header', ['judul' => 'Review Pengajuan']);
        $this->view('managing_partner/review', [
            'p'                => $data,
            'lawyer'           => $lawyer,
            'dokumen'          => $dokumen,
            'catatanParalegal' => $catatanParalegal,
        ]);
        $this->view('templates/staf_footer');
    }

    public function prosesReview($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/managing_partner/pengajuan'); exit; }

        $this->model('ReviewMp')->simpan([
            'id_pengajuan'     => $id,
            'kode_mp'          => $_SESSION['staf']['kode'],
            'hasil_review'     => $_POST['hasil_review'],
            'catatan'          => trim($_POST['catatan'] ?? ''),
            'kode_lawyer'      => $_POST['kode_lawyer'] ?? null,
            'biaya_penanganan' => $_POST['biaya_penanganan'] ?? 0,
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Review pengajuan berhasil disimpan.'];
        header('Location: ' . BASEURL . '/managing_partner/pengajuan');
        exit;
    }

    // Riwayat semua kasus yang sudah diteruskan ke lawyer manapun
    public function riwayat()
    {
        $penugasan = $this->model('Penugasan')->all();

        $stafModel    = $this->model('Staf');
        $dokumenModel = $this->model('Dokumen');
        foreach ($penugasan as &$row) {
            $lawyer = $stafModel->findByKode($row['kode_lawyer']);
            $row['nama_lawyer'] = $lawyer['nama'] ?? $row['kode_lawyer'];
            $row['dokumen']     = $dokumenModel->getByPengajuan($row['id_pengajuan']);
        }
        unset($row);

        $this->view('templates/staf_header', ['judul' => 'Riwayat Kasus']);
        $this->view('managing_partner/riwayat', ['penugasan' => $penugasan]);
        $this->view('templates/staf_footer');
    }
}

<?php
// ================= AdministratorController (backend) =================
// Ringkasan sistem + kelola data layanan.

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->requireStaf('administrator');
    }

    public function index()
    {
        $ringkasan     = $this->model('Pengajuan')->countByStatus();
        $jumlahLayanan = count($this->model('Layanan')->all());
        $jumlahKlien   = count($this->model('Klien')->all());
        $this->view('templates/staf_header', ['judul' => 'Dashboard Administrator']);
        $this->view('administrator/dashboard', [
            'ringkasan'     => $ringkasan,
            'jumlahLayanan' => $jumlahLayanan,
            'jumlahKlien'   => $jumlahKlien,
        ]);
        $this->view('templates/staf_footer');
    }

    public function layanan()
    {
        $layanan = $this->model('Layanan')->all();
        $this->view('templates/staf_header', ['judul' => 'Kelola Layanan']);
        $this->view('administrator/layanan', ['layanan' => $layanan]);
        $this->view('templates/staf_footer');
    }

    public function tambahLayanan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('Layanan')->create([
                'nama_layanan' => trim($_POST['nama_layanan']),
                'deskripsi'    => trim($_POST['deskripsi']),
                'persyaratan'  => trim($_POST['persyaratan'] ?? ''),
                'tarif'        => $_POST['tarif'],
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Layanan baru berhasil ditambahkan.'];
            header('Location: ' . BASEURL . '/administrator/layanan');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Tambah Layanan']);
        $this->view('administrator/layanan_form', ['l' => null]);
        $this->view('templates/staf_footer');
    }

    public function editLayanan($id)
    {
        $layananModel = $this->model('Layanan');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $layananModel->update($id, [
                'nama_layanan' => trim($_POST['nama_layanan']),
                'deskripsi'    => trim($_POST['deskripsi']),
                'persyaratan'  => trim($_POST['persyaratan'] ?? ''),
                'tarif'        => $_POST['tarif'],
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Layanan berhasil diperbarui.'];
            header('Location: ' . BASEURL . '/administrator/layanan');
            exit;
        }
        $data = $layananModel->find($id);
        if (!$data) {
            header('Location: ' . BASEURL . '/administrator/layanan');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Edit Layanan']);
        $this->view('administrator/layanan_form', ['l' => $data]);
        $this->view('templates/staf_footer');
    }

    public function hapusLayanan($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/administrator/layanan'); exit; }

        $hasil = $this->model('Layanan')->delete($id);
        $_SESSION['flash'] = is_string($hasil)
            ? ['type' => 'error', 'message' => $hasil]
            : ['type' => 'success', 'message' => 'Layanan berhasil dihapus.'];
        header('Location: ' . BASEURL . '/administrator/layanan');
        exit;
    }

    // ---- Kelola Klien ----

    public function klien()
    {
        $klien = $this->model('Klien')->all();
        $this->view('templates/staf_header', ['judul' => 'Kelola Klien']);
        $this->view('administrator/klien', ['klien' => $klien]);
        $this->view('templates/staf_footer');
    }

    public function tambahKlien()
    {
        $error = null;
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
                $error = 'Email sudah dipakai klien lain.';
            } else {
                $klienModel->register($data);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Klien baru berhasil ditambahkan.'];
                header('Location: ' . BASEURL . '/administrator/klien');
                exit;
            }
        }
        $this->view('templates/staf_header', ['judul' => 'Tambah Klien']);
        $this->view('administrator/klien_form', ['k' => null, 'error' => $error]);
        $this->view('templates/staf_footer');
    }

    public function editKlien($id)
    {
        $klienModel = $this->model('Klien');
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $existing = $klienModel->findByEmail($email);
            if ($existing && (int) $existing['id_klien'] !== (int) $id) {
                $error = 'Email sudah dipakai klien lain.';
            } else {
                $klienModel->update($id, [
                    'nama'     => trim($_POST['nama']),
                    'email'    => $email,
                    'no_telp'  => trim($_POST['no_telp']),
                    'alamat'   => trim($_POST['alamat']),
                ]);
                if (!empty($_POST['password'])) {
                    $klienModel->resetPassword($id, $_POST['password']);
                }
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data klien berhasil diperbarui.'];
                header('Location: ' . BASEURL . '/administrator/klien');
                exit;
            }
        }
        $data = $klienModel->find($id);
        if (!$data) {
            header('Location: ' . BASEURL . '/administrator/klien');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Edit Klien']);
        $this->view('administrator/klien_form', ['k' => $data, 'error' => $error]);
        $this->view('templates/staf_footer');
    }

    public function hapusKlien($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/administrator/klien'); exit; }

        $hasil = $this->model('Klien')->delete($id);
        $_SESSION['flash'] = is_string($hasil)
            ? ['type' => 'error', 'message' => $hasil]
            : ['type' => 'success', 'message' => 'Klien berhasil dihapus.'];
        header('Location: ' . BASEURL . '/administrator/klien');
        exit;
    }

    // ---- Kelola Pengajuan (koreksi data langsung) ----

    public function pengajuan()
    {
        $pengajuan = $this->model('Pengajuan')->all();
        $this->view('templates/staf_header', ['judul' => 'Kelola Pengajuan']);
        $this->view('administrator/pengajuan', ['pengajuan' => $pengajuan]);
        $this->view('templates/staf_footer');
    }

    public function tambahPengajuan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('Pengajuan')->simpan([
                'id_klien'        => (int) $_POST['id_klien'],
                'id_layanan'      => (int) $_POST['id_layanan'],
                'ringkasan_kasus' => trim($_POST['ringkasan_kasus']),
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Pengajuan baru berhasil ditambahkan.'];
            header('Location: ' . BASEURL . '/administrator/pengajuan');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Tambah Pengajuan']);
        $this->view('administrator/pengajuan_form', [
            'p'       => null,
            'klien'   => $this->model('Klien')->all(),
            'layanan' => $this->model('Layanan')->all(),
        ]);
        $this->view('templates/staf_footer');
    }

    public function editPengajuan($id)
    {
        $pengajuanModel = $this->model('Pengajuan');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pengajuanModel->update($id, [
                'id_layanan'      => (int) $_POST['id_layanan'],
                'ringkasan_kasus' => trim($_POST['ringkasan_kasus']),
                'status'          => $_POST['status'],
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Pengajuan berhasil diperbarui.'];
            header('Location: ' . BASEURL . '/administrator/pengajuan');
            exit;
        }
        $data = $pengajuanModel->find($id);
        if (!$data) {
            header('Location: ' . BASEURL . '/administrator/pengajuan');
            exit;
        }
        $this->view('templates/staf_header', ['judul' => 'Edit Pengajuan']);
        $this->view('administrator/pengajuan_form', [
            'p'       => $data,
            'klien'   => null,
            'layanan' => $this->model('Layanan')->all(),
        ]);
        $this->view('templates/staf_footer');
    }

    public function hapusPengajuan($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ' . BASEURL . '/administrator/pengajuan'); exit; }

        $hasil = $this->model('Pengajuan')->delete($id);
        $_SESSION['flash'] = is_string($hasil)
            ? ['type' => 'error', 'message' => $hasil]
            : ['type' => 'success', 'message' => 'Pengajuan berhasil dihapus.'];
        header('Location: ' . BASEURL . '/administrator/pengajuan');
        exit;
    }
}

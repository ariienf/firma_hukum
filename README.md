# Sistem Layanan Konsultasi Hukum — Subhan Aziz & Partners
PHP Native (MVC) + MySQL. Kerangka awal (skeleton) yang sudah berjalan: routing, koneksi database, dan **login ganda** — klien dari database, staf (paralegal / managing partner / lawyer / administrator) dari konfigurasi di kode.

## Struktur folder
```
subhan-aziz-partners/
├── public/                 <- document root (arahkan browser/URL ke sini)
│   ├── index.php           front controller (satu-satunya pintu masuk)
│   ├── .htaccess           URL routing
│   ├── uploads/            file dokumen & bukti bayar
│   └── assets/css/style.css
├── app/
│   ├── config/
│   │   ├── config.php      BASEURL & konstanta
│   │   ├── database.php    kredensial DB
│   │   └── staff.php       DATA STAF (hardcoded, hash bcrypt)
│   ├── core/
│   │   ├── App.php         router
│   │   ├── Controller.php  base controller + helper hak akses
│   │   └── Database.php    PDO + prepared statement
│   ├── controllers/        AuthController, KlienController, ...
│   ├── models/             Klien, Staf, Pengajuan, ...
│   └── views/              header/footer, auth, klien, ...
└── database.sql            skrip pembuatan 9 tabel
```

## Cara menjalankan (XAMPP/Laragon)
1. Salin folder ini ke `htdocs` (XAMPP) atau `www` (Laragon).
2. Buat database dan tabel: import `database.sql` lewat phpMyAdmin.
3. Sesuaikan `app/config/database.php` (user/pass MySQL) dan `app/config/config.php` (BASEURL).
4. Buka: `http://localhost/subhan-aziz-partners/public`

## Akun uji
- **Klien**: daftar sendiri lewat menu Registrasi.
- **Staf** (password semua: `sap12345`):
  - Administrator → username `admin`
  - Paralegal → `paralegal1` (kode PL01)
  - Managing Partner → `mp1` (kode MP01)
  - Lawyer → `lawyer1` (kode LW01)

## Konsep front-end vs back-end (sesuai rancangan)
- Klien = pengguna front-end; datanya di tabel `klien`.
- Staf = pengguna back-end; **datanya di `app/config/staff.php`, bukan di DB**.
- Hasil kerja staf tetap ditulis ke DB (verifikasi, review_mp, penugasan, pembayaran),
  dengan kolom `kode_paralegal` / `kode_mp` / `kode_lawyer` diisi dari staf yang login
  (`$_SESSION['staf']['kode']`).

## Urutan pembangunan yang disarankan
1. (SUDAH ADA) Routing, DB, login klien + staf, contoh modul pengajuan klien.
2. Modul dokumen: upload ke `public/uploads/`, simpan path ke tabel `dokumen`.
3. Modul paralegal: lihat pengajuan `status='baru'`, isi `verifikasi`, ubah status.
4. Modul managing partner: `review_mp`, tentukan `biaya_penanganan`, buat `penugasan`.
5. Modul lawyer: lihat `penugasan`, isi `penanganan_kasus`, kirim hasil.
6. Modul pembayaran: klien bayar + upload bukti; paralegal verifikasi (`status_bayar`).
7. Modul administrator: kelola `layanan`.

Tiap modul mengikuti pola yang sama: Controller (extends Controller) → Model (pakai Database) → View.

## Catatan keamanan (poin plus untuk sidang)
- Password klien & staf disimpan sebagai **hash** (`password_hash` / `password_verify`).
- Semua query memakai **prepared statement** (PDO) → aman dari SQL injection.
- Output ke HTML dibungkus `htmlspecialchars()` → aman dari XSS.
- Validasi upload (tipe & ukuran file) ditambahkan saat membangun modul dokumen.
"# firma_hukum" 

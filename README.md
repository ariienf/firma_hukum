# ⚖️ Sistem Layanan Konsultasi Hukum

### Subhan Aziz & Partners

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Native">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Architecture-MVC-success?style=for-the-badge" alt="MVC">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
</p>

## 📌 Tentang Sistem

**Sistem Layanan Konsultasi Hukum** merupakan aplikasi berbasis web yang dirancang untuk membantu proses pelayanan konsultasi dan penanganan perkara hukum pada **Subhan Aziz & Partners**.

Aplikasi ini dibangun menggunakan **PHP Native dengan arsitektur MVC (Model-View-Controller)** dan database **MySQL**.

Sistem dirancang dengan pemisahan akses antara **Klien** sebagai pengguna front-end dan **Staf** sebagai pengguna back-end. Staf terdiri dari beberapa peran, yaitu **Administrator, Paralegal, Managing Partner, dan Lawyer**.

Tujuan utama sistem adalah menyediakan alur pelayanan hukum yang lebih terstruktur, mulai dari pengajuan konsultasi oleh klien, proses verifikasi, review, penugasan perkara, penanganan kasus, hingga proses pembayaran.

---

## 🎯 Tujuan Pengembangan

Sistem ini dikembangkan untuk:

* Mempermudah klien mengajukan layanan konsultasi hukum.
* Menyediakan akses informasi layanan hukum secara terstruktur.
* Membantu staf dalam mengelola pengajuan klien.
* Mempermudah proses verifikasi pengajuan.
* Membantu Managing Partner melakukan review dan menentukan biaya penanganan.
* Membantu Lawyer dalam mengelola penanganan perkara.
* Mempermudah proses pembayaran layanan.
* Menyediakan pengelolaan data layanan secara terintegrasi.

---

## ✨ Fitur Sistem

### 👤 Klien

Klien dapat:

* Melakukan registrasi akun.
* Melakukan login.
* Mengajukan layanan/konsultasi hukum.
* Melihat status pengajuan.
* Mengunggah dokumen pendukung.
* Melihat proses penanganan perkara.
* Melakukan pembayaran.
* Mengunggah bukti pembayaran.
* Melihat status pembayaran.

### 👨‍💼 Administrator

Administrator bertugas mengelola:

* Data layanan hukum.
* Informasi layanan yang tersedia.
* Data pendukung sistem.
* Pengelolaan administrasi aplikasi.

### 👨‍⚖️ Paralegal

Paralegal dapat:

* Melihat pengajuan klien.
* Melakukan verifikasi pengajuan.
* Mengubah status pengajuan.
* Melakukan verifikasi pembayaran.
* Memantau proses pengajuan klien.

### 👔 Managing Partner

Managing Partner dapat:

* Melakukan review pengajuan.
* Menentukan biaya penanganan.
* Menentukan penugasan perkara.
* Menentukan Lawyer yang menangani perkara.

### ⚖️ Lawyer

Lawyer dapat:

* Melihat perkara yang ditugaskan.
* Melakukan proses penanganan kasus.
* Mengisi informasi penanganan perkara.
* Mengirimkan hasil penanganan kasus.

---

## 🔄 Alur Layanan

```text
                    KLIEN
                      │
                      ▼
              Registrasi / Login
                      │
                      ▼
             Pengajuan Konsultasi
                      │
                      ▼
              Upload Dokumen
                      │
                      ▼
             Verifikasi Paralegal
                      │
                      ▼
             Review Managing Partner
                      │
                      ▼
             Penentuan Biaya & Penugasan
                      │
                      ▼
                  Lawyer
                      │
                      ▼
              Penanganan Perkara
                      │
                      ▼
                  Pembayaran
                      │
                      ▼
           Upload Bukti Pembayaran
                      │
                      ▼
           Verifikasi Pembayaran
                      │
                      ▼
              Proses Selesai
```

---

## 👥 Role & Hak Akses

| Role                 | Fungsi                                                                                  |
| -------------------- | --------------------------------------------------------------------------------------- |
| **Klien**            | Registrasi, login, pengajuan konsultasi, upload dokumen, pembayaran, dan melihat status |
| **Paralegal**        | Verifikasi pengajuan dan pembayaran                                                     |
| **Managing Partner** | Review pengajuan, menentukan biaya dan penugasan                                        |
| **Lawyer**           | Menangani perkara yang ditugaskan                                                       |
| **Administrator**    | Mengelola layanan dan administrasi sistem                                               |

---

## 🛠️ Teknologi

| Teknologi           | Penggunaan                 |
| ------------------- | -------------------------- |
| **PHP Native**      | Bahasa pemrograman utama   |
| **MySQL**           | Database                   |
| **HTML5**           | Struktur halaman           |
| **CSS3**            | Tampilan website           |
| **JavaScript**      | Interaksi halaman          |
| **MVC**             | Arsitektur aplikasi        |
| **PDO**             | Koneksi dan query database |
| **Apache**          | Web server                 |
| **XAMPP / Laragon** | Local development          |
| **Git & GitHub**    | Version control            |

---

## 🏛️ Arsitektur MVC

Project menggunakan konsep **MVC (Model-View-Controller)** yang dibangun menggunakan PHP Native.

```text
                    Browser
                       │
                       ▼
                public/index.php
                       │
                       ▼
                    Router
                       │
                       ▼
                  Controller
                 /           \
                ▼             ▼
             Model           View
                │             │
                ▼             ▼
             MySQL          Browser
```

### Model

Model bertanggung jawab terhadap pengelolaan data dan komunikasi dengan database.

### View

View digunakan untuk menampilkan halaman antarmuka kepada pengguna.

### Controller

Controller menangani proses bisnis dan menghubungkan Model dengan View.

---

## 📁 Struktur Folder

Struktur utama project:

```text
firma_hukum/
│
├── app/
│   ├── config/
│   │   ├── config.php
│   │   ├── database.php
│   │   └── staff.php
│   │
│   ├── core/
│   │   ├── App.php
│   │   ├── Controller.php
│   │   └── Database.php
│   │
│   ├── controllers/
│   │
│   ├── models/
│   │
│   └── views/
│
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── assets/
│   └── uploads/
│
├── sap_konsultasi.sql
├── index.php
└── README.md
```

Struktur tersebut memisahkan komponen aplikasi berdasarkan tanggung jawabnya sehingga pengembangan modul dapat dilakukan secara lebih terorganisir.

---

## 💾 Database

Database menggunakan **MySQL** dengan file:

```text
sap_konsultasi.sql
```

Database digunakan untuk menyimpan data yang berkaitan dengan:

* Klien
* Staf
* Pengajuan
* Dokumen
* Verifikasi
* Review
* Penugasan
* Penanganan perkara
* Pembayaran
* Layanan

---

## 🔐 Sistem Login

Sistem memiliki dua kelompok pengguna:

### Front-End

```text
Klien
   │
   ├── Registrasi
   └── Login
```

Data klien disimpan pada database.

### Back-End

```text
Staf
 │
 ├── Administrator
 ├── Paralegal
 ├── Managing Partner
 └── Lawyer
```

Data akun staf dikonfigurasi melalui sistem aplikasi.

---

## 🔒 Keamanan

Beberapa mekanisme keamanan yang diterapkan dalam sistem:

* Password menggunakan `password_hash()`.
* Verifikasi password menggunakan `password_verify()`.
* Query database menggunakan **PDO Prepared Statement**.
* Output HTML menggunakan `htmlspecialchars()`.
* Sistem menggunakan session untuk autentikasi pengguna.
* Dokumen diunggah melalui direktori `public/uploads/`.

Penggunaan prepared statement membantu mengurangi risiko SQL Injection, sedangkan escaping output membantu mengurangi risiko XSS.

---

## ⚙️ Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat memiliki:

* PHP 8.x atau versi yang sesuai.
* MySQL / MariaDB.
* Apache Web Server.
* XAMPP atau Laragon.
* Web Browser.
* Git *(opsional)*.

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/ariienf/firma_hukum.git
```

Masuk ke folder project:

```bash
cd firma_hukum
```

### 2. Letakkan Project

Jika menggunakan **XAMPP**, letakkan project pada:

```text
C:/xampp/htdocs/
```

Jika menggunakan **Laragon**:

```text
C:/laragon/www/
```

### 3. Buat Database

Buka:

```text
phpMyAdmin
```

Buat database baru.

Contoh:

```text
sap_konsultasi
```

### 4. Import Database

Import file:

```text
sap_konsultasi.sql
```

ke database yang telah dibuat.

### 5. Konfigurasi Database

Buka:

```text
app/config/database.php
```

Kemudian sesuaikan konfigurasi MySQL:

```php
'host'     => 'localhost',
'database' => 'sap_konsultasi',
'username' => 'root',
'password' => ''
```

Sesuaikan username dan password dengan konfigurasi MySQL pada komputer Anda.

### 6. Konfigurasi BASEURL

Sesuaikan konfigurasi pada:

```text
app/config/config.php
```

Contoh:

```php
define('BASEURL', 'http://localhost/firma_hukum/public');
```

### 7. Jalankan Aplikasi

Buka browser:

```text
http://localhost/firma_hukum/public
```

---

## 🔑 Akun Pengujian

Untuk pengujian staf, tersedia beberapa akun bawaan.

| Role             | Username     | Kode   |
| ---------------- | ------------ | ------ |
| Administrator    | `admin`      | -      |
| Paralegal        | `paralegal1` | `PL01` |
| Managing Partner | `mp1`        | `MP01` |
| Lawyer           | `lawyer1`    | `LW01` |

**Password akun pengujian:**

```text
sap12345
```

> Untuk penggunaan production, akun dan password bawaan sebaiknya segera diganti.

---

## 📂 Upload Dokumen

Dokumen pendukung dan bukti pembayaran menggunakan direktori:

```text
public/uploads/
```

Alur penyimpanan:

```text
User
 │
 ▼
Upload File
 │
 ▼
Validasi File
 │
 ▼
public/uploads/
 │
 ▼
Path File disimpan
 │
 ▼
Database
```

---

## 📋 Status Pengembangan

| Modul                   | Status          |
| ----------------------- | --------------- |
| Routing                 | ✅ Selesai       |
| Koneksi Database        | ✅ Selesai       |
| Login Klien             | ✅ Selesai       |
| Login Staf              | ✅ Selesai       |
| Registrasi Klien        | ✅ Selesai       |
| Pengajuan Klien         | ✅ Dasar         |
| Modul Dokumen           | 🔄 Pengembangan |
| Verifikasi Paralegal    | 🔄 Pengembangan |
| Review Managing Partner | 🔄 Pengembangan |
| Penugasan Lawyer        | 🔄 Pengembangan |
| Penanganan Perkara      | 🔄 Pengembangan |
| Pembayaran              | 🔄 Pengembangan |
| Administrasi Layanan    | 🔄 Pengembangan |

Status di atas mengikuti kondisi repository yang saat ini dijelaskan sebagai **kerangka awal/skeleton**, dengan routing, database, autentikasi, dan contoh modul pengajuan yang sudah berjalan.

---

## 📸 Screenshot

Tambahkan screenshot aplikasi pada bagian ini agar repository lebih menarik sebagai portofolio.

Contoh:

```markdown
## 📸 Tampilan Sistem

### Halaman Beranda

![Homepage](public/assets/img/home.png)

### Halaman Login

![Login](public/assets/img/login.png)

### Dashboard Klien

![Dashboard Klien](public/assets/img/dashboard-klien.png)

### Pengajuan Konsultasi

![Pengajuan](public/assets/img/pengajuan.png)

### Dashboard Staf

![Dashboard Staf](public/assets/img/dashboard-staf.png)
```

> Sesuaikan nama file screenshot dengan file yang benar-benar terdapat di repository.

---

## 🔮 Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan pada versi berikutnya:

* Dashboard statistik.
* Notifikasi status pengajuan.
* Notifikasi pembayaran.
* Sistem komunikasi antara klien dan lawyer.
* Riwayat konsultasi klien.
* Pengelolaan dokumen perkara yang lebih lengkap.
* Export laporan ke PDF.
* Export data ke Excel.
* Sistem penjadwalan konsultasi.
* Integrasi notifikasi WhatsApp.
* Peningkatan UI/UX.

---

## 🎓 Tujuan Project

Project ini dikembangkan sebagai implementasi **Sistem Informasi Layanan Konsultasi Hukum berbasis web** dengan menerapkan konsep:

* PHP Native
* MVC Architecture
* Object-Oriented Programming
* MySQL Database
* Role-Based Access
* Authentication & Authorization
* CRUD
* File Upload
* Prepared Statement

---

## 👨‍💻 Developer

**Arie Nur Fauzi**

GitHub:

[github.com/ariienf](https://github.com/ariienf)

Repository:

[firma_hukum](https://github.com/ariienf/firma_hukum)

---

## 📜 Lisensi

Project ini dibuat untuk keperluan **pembelajaran, pengembangan sistem informasi, dan portofolio**.

© 2026 Arie Nur Fauzi

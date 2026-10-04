-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2026 at 04:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sap_konsultasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `nama_dokumen` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_upload` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `id_pengajuan`, `nama_dokumen`, `file_path`, `tanggal_upload`) VALUES
(5, 12, 'kampus merdeka.jpeg', 'dok_12_1783742252_0_955EF.jpeg', '2026-07-11 10:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int NOT NULL,
  `nama_klien` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `nama_klien`, `email`, `password`, `no_telp`, `alamat`, `created_at`) VALUES
(6, 'Andrew Nasution', 'andrew@gmail.com', '$2y$10$y0snv/dZIngFqp49J.VNdeGtCvAdM/0Y9sh5svi..vwPNS8.bF7Xm', '081580809090', 'Medan', '2026-07-06 06:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int NOT NULL,
  `nama_layanan` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `persyaratan` text COLLATE utf8mb4_general_ci,
  `tarif` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `persyaratan`, `tarif`) VALUES
(6, 'Corporate Lawyer', 'Kami membantu perusahaan dalam penyusunan kontrak, legal audit, kepatuhan regulasi, merger & akuisisi, serta perlindungan hukum jangka panjang untuk memastikan bisnis berjalan aman dan berkelanjutan.', 'Fotokopi KTP/identitas direktur atau perwakilan perusahaan\nAkta pendirian perusahaan & perubahannya (jika ada)\nNPWP perusahaan\nDraf kontrak/perjanjian yang akan direview (jika ada)\nSurat kuasa (jika diwakilkan)', '5000000.00'),
(7, 'Pendaftaran HAKI', 'Layanan mencakup pengecekan merek, pendaftaran ke DJKI, monitoring, hingga penanganan sengketa hak kekayaan intelektual agar brand Anda aman secara hukum.', 'Fotokopi KTP pemohon\nNPWP (jika atas nama badan usaha)\nContoh/etiket merek atau logo yang akan didaftarkan\nKelas barang/jasa yang akan didaftarkan\nSurat kuasa (jika diwakilkan)', '1500000.00'),
(8, 'Company Branding Legal', 'Kami membantu legalitas brand, perlindungan identitas usaha, penyusunan legal document brand, serta strategi perlindungan reputasi bisnis di pasar.', 'Fotokopi KTP pemohon/direktur\nDokumen identitas usaha (nama usaha, logo, tagline)\nAkta pendirian perusahaan atau surat izin usaha\nDraf dokumen legal brand yang sudah ada (jika ada)\nSurat kuasa (jika diwakilkan)', '2000000.00'),
(9, 'Litigasi & Mediasi', 'Penanganan perkara perdata, negosiasi, mediasi, hingga litigasi di pengadilan dengan pendekatan strategis untuk hasil terbaik bagi klien.', 'Fotokopi KTP pemohon\nSurat kuasa khusus\nSalinan gugatan/surat panggilan atau dokumen sengketa terkait\nBukti-bukti pendukung perkara\nKronologi permasalahan secara tertulis', '5000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `kode_paralegal` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_pembayaran` enum('konsultasi','penanganan') COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` decimal(12,2) NOT NULL DEFAULT '0.00',
  `metode_bayar` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT CURRENT_TIMESTAMP,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_bayar` enum('belum_bayar','menunggu_verifikasi','lunas','ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'belum_bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pengajuan`, `kode_paralegal`, `jenis_pembayaran`, `jumlah`, `metode_bayar`, `tanggal_bayar`, `bukti_bayar`, `status_bayar`) VALUES
(9, 12, NULL, 'konsultasi', '5000000.00', NULL, '2026-07-11 11:06:45', NULL, 'belum_bayar'),
(10, 12, 'PL01', 'penanganan', '2000000.00', 'Transfer Bank', '2026-07-11 11:08:53', 'bayar_10_1783742933.jpg', 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan_kasus`
--

CREATE TABLE `penanganan_kasus` (
  `id_penanganan` int NOT NULL,
  `id_penugasan` int NOT NULL,
  `hasil_penanganan` text COLLATE utf8mb4_general_ci,
  `status_penanganan` enum('berjalan','selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'berjalan',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int NOT NULL,
  `no_tiket` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_klien` int NOT NULL,
  `id_layanan` int NOT NULL,
  `tanggal_pengajuan` datetime DEFAULT CURRENT_TIMESTAMP,
  `ringkasan_kasus` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('baru','verifikasi','diteruskan','ditangani','selesai','ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `no_tiket`, `id_klien`, `id_layanan`, `tanggal_pengajuan`, `ringkasan_kasus`, `status`) VALUES
(12, 'SAP-20260711-8A5F7', 6, 6, '2026-07-11 10:57:32', 'Kasus Pembunuhan', 'diteruskan');

-- --------------------------------------------------------

--
-- Table structure for table `penugasan`
--

CREATE TABLE `penugasan` (
  `id_penugasan` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `kode_mp` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_lawyer` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_penugasan` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_penugasan` enum('ditugaskan','diproses','selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ditugaskan',
  `biaya_penanganan` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penugasan`
--

INSERT INTO `penugasan` (`id_penugasan`, `id_pengajuan`, `kode_mp`, `kode_lawyer`, `tanggal_penugasan`, `status_penugasan`, `biaya_penanganan`) VALUES
(6, 12, 'MP01', 'LW01', '2026-07-11 11:07:52', 'ditugaskan', '2000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `review_mp`
--

CREATE TABLE `review_mp` (
  `id_review` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `kode_mp` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `hasil_review` enum('dapat_ditangani','ditolak') COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `tanggal_review` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_mp`
--

INSERT INTO `review_mp` (`id_review`, `id_pengajuan`, `kode_mp`, `hasil_review`, `catatan`, `tanggal_review`) VALUES
(7, 12, 'MP01', 'dapat_ditangani', 'Proses', '2026-07-11 11:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `kode_paralegal` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `hasil_verifikasi` enum('sesuai','tidak_sesuai') COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `tanggal_verifikasi` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `id_pengajuan`, `kode_paralegal`, `hasil_verifikasi`, `catatan`, `tanggal_verifikasi`) VALUES
(10, 12, 'PL01', 'sesuai', 'Diproses', '2026-07-11 11:06:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `fk_dokumen_pengajuan` (`id_pengajuan`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_pengajuan` (`id_pengajuan`);

--
-- Indexes for table `penanganan_kasus`
--
ALTER TABLE `penanganan_kasus`
  ADD PRIMARY KEY (`id_penanganan`),
  ADD KEY `fk_penanganan_penugasan` (`id_penugasan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD UNIQUE KEY `no_tiket` (`no_tiket`),
  ADD KEY `fk_pengajuan_klien` (`id_klien`),
  ADD KEY `fk_pengajuan_layanan` (`id_layanan`);

--
-- Indexes for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id_penugasan`),
  ADD KEY `fk_penugasan_pengajuan` (`id_pengajuan`);

--
-- Indexes for table `review_mp`
--
ALTER TABLE `review_mp`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_review_pengajuan` (`id_pengajuan`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `fk_verifikasi_pengajuan` (`id_pengajuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penanganan_kasus`
--
ALTER TABLE `penanganan_kasus`
  MODIFY `id_penanganan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id_penugasan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review_mp`
--
ALTER TABLE `review_mp`
  MODIFY `id_review` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `fk_dokumen_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`);

--
-- Constraints for table `penanganan_kasus`
--
ALTER TABLE `penanganan_kasus`
  ADD CONSTRAINT `fk_penanganan_penugasan` FOREIGN KEY (`id_penugasan`) REFERENCES `penugasan` (`id_penugasan`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_klien` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`),
  ADD CONSTRAINT `fk_pengajuan_layanan` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`);

--
-- Constraints for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD CONSTRAINT `fk_penugasan_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`);

--
-- Constraints for table `review_mp`
--
ALTER TABLE `review_mp`
  ADD CONSTRAINT `fk_review_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`);

--
-- Constraints for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD CONSTRAINT `fk_verifikasi_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

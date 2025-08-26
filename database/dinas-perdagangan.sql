/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `pengunjung`;
CREATE TABLE `pengunjung` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_visited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengunjung_ip_address_unique` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `struktur_organisasi_parent_id_foreign` (`parent_id`),
  CONSTRAINT `struktur_organisasi_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `struktur_organisasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `balai`;
CREATE TABLE `balai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `alur`;
CREATE TABLE `alur` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `uu_terkait` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `ppids`;
CREATE TABLE `ppids` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `agendas`;
CREATE TABLE `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `acara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `berita_views`;
CREATE TABLE `berita_views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_id` bigint unsigned NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `berita_views_berita_id_foreign` (`berita_id`),
  CONSTRAINT `berita_views_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kategori_galeris`;
CREATE TABLE `kategori_galeris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `galeris`;
CREATE TABLE `galeris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_galeri_id` bigint unsigned NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeris_kategori_galeri_id_foreign` (`kategori_galeri_id`),
  CONSTRAINT `galeris_kategori_galeri_id_foreign` FOREIGN KEY (`kategori_galeri_id`) REFERENCES `kategori_galeris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pasars`;
CREATE TABLE `pasars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `daftar_barang`;
CREATE TABLE `daftar_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `detail_pasars`;
CREATE TABLE `detail_pasars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pasar_id` bigint unsigned NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pasars_pasar_id_foreign` (`pasar_id`),
  CONSTRAINT `detail_pasars_pasar_id_foreign` FOREIGN KEY (`pasar_id`) REFERENCES `pasars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `dokumen_pasars`;
CREATE TABLE `dokumen_pasars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pasar_id` bigint unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumen_pasars_pasar_id_foreign` (`pasar_id`),
  CONSTRAINT `dokumen_pasars_pasar_id_foreign` FOREIGN KEY (`pasar_id`) REFERENCES `pasars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `daftar_harga`;
CREATE TABLE `daftar_harga` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pasar_id` bigint unsigned NOT NULL,
  `barang_id` bigint unsigned NOT NULL,
  `harga` int NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `daftar_harga_pasar_id_foreign` (`pasar_id`),
  KEY `daftar_harga_barang_id_foreign` (`barang_id`),
  CONSTRAINT `daftar_harga_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `daftar_barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `daftar_harga_pasar_id_foreign` FOREIGN KEY (`pasar_id`) REFERENCES `pasars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `formulirs`;
CREATE TABLE `formulirs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Test', 'admin@example.com', '2025-06-13 14:57:45', '$2y$12$GqUhbFTjuRU/k6n7jeOGMOJO0DP3Bc1Bmsw7xgBEKxcIkL3Cb5n5m', 'cJYiE0TdpL', '2025-06-13 14:57:45', '2025-06-13 14:57:45');

INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `nip`, `foto`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'FAJAR PURWOTO, SH. MM', 'KEPALA DINAS PERDAGANGAN', '196401151992011001', '', NULL, '2025-05-28 05:15:32', '2025-05-28 05:15:32');
INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `nip`, `foto`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'BEKTI SADONO, SH', 'SEKERTARIS', '196506231992031002', '', 1, '2025-05-28 05:17:29', '2025-05-28 05:17:29');
INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `nip`, `foto`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'EKO HANGGONO, SH', 'Kepala Sub Bag. Umum dan Kepegawaian', '196303301985111002', '', 2, '2025-05-28 05:18:48', '2025-05-28 05:18:48');
INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `nip`, `foto`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 'LILIS WAHYUNINGSIH, SIP', 'Kepala Sub Bagagian Keuangan', '196705031988032020', '', 2, '2025-05-28 05:20:11', '2025-05-28 05:20:11'),
(5, 'SUNARNO, S.Sos', 'Kepala Sub Bag. Perencanaan dan Evaluasi', '196501111988031012', '', 2, '2025-05-28 05:24:57', '2025-05-28 05:24:57'),
(6, 'BAHTIAR EFENDI, S.Sos', 'Kepala Bidang Pengembangan Perdagangan dan Stabilitas Harga', '19601103 198903 1 012', '', 4, '2025-05-28 05:27:37', '2025-05-28 05:27:37'),
(7, 'MOCH AGUS RG, ST. MT', 'Kepala Bidang Bina Usaha', '19720222 199603 1001', '', 4, '2025-05-28 05:28:52', '2025-05-28 05:28:52'),
(8, 'DODY KRISTYANTO, SE. MM', 'Kepala Bidang Penataan dan Penetapan', '19690912 199503 1 002', '', 4, '2025-05-28 05:29:35', '2025-05-28 05:29:35'),
(10, 'NUR KHOLIS. ST, MT', 'Kepala Bidang Pengembangan Prasarana dan Sarana Perdagangan', '19631214 199003 1004', '', 4, '2025-05-28 05:30:29', '2025-05-28 05:30:29'),
(11, 'Drs. AJI WAHYU AGUNG P', 'Seksi Ekspor dan Impor', '19640308 199203 1006', '', 6, '2025-05-28 05:47:53', '2025-05-28 05:47:53'),
(12, 'I NYOMAN WITA, SH', 'Seksi Stabilitas Harga', '19611210 199009 1 001', '', 6, '2025-05-28 05:48:37', '2025-05-28 05:48:37'),
(13, 'SUPRIYO BURHAM, S.Sos', 'Seksi Pengendalian Usaha', '19610817 198703 1 022', '', 6, '2025-05-28 05:49:22', '2025-05-28 05:49:22'),
(14, 'ANDRIANA E P., SH, MM', 'Seksi Pembinaan dan Pengembangan Usaha', '19620827 199103 2003', '', 7, '2025-05-28 05:51:54', '2025-05-28 05:51:54'),
(15, 'WAHYU WIJIARSIH, SE', 'Seksi Pendapatan', '19611028 198903 2002', '', 7, '2025-05-28 05:53:09', '2025-05-28 05:53:09'),
(16, 'YOYOK PATRIOTOMO, SH', 'Seksi Pembinaan Pedagang Kreatif Lapangan', '19610420 198503 1014', '', 7, '2025-05-28 05:54:07', '2025-05-28 05:54:07'),
(17, 'Drs. OKTAVIAΤΜΟΝΟ', 'Seksi Pemetaan dan Penataan', '19721229 1992031007', '', 8, '2025-05-28 05:56:23', '2025-05-28 05:56:23'),
(18, 'F. TOTOK K. SH', 'Seksi Pengawasan Sarana Perdagangan', '19591019 198703 1 005', '', 8, '2025-05-28 05:56:55', '2025-05-28 05:56:55'),
(19, 'Drs. SUSILO DANARDONO', 'Seksi Penetapan', '19610504 198503 1015', '', 8, '2025-05-28 05:57:37', '2025-05-28 05:57:37'),
(22, 'UGHARI FAJAR D, SH', 'Seksi Kebersihan Lingkungan', '19671023 196303 1001', '', 10, '2025-05-28 06:00:13', '2025-05-28 06:00:13'),
(23, 'TJETJEP WAHYU P, SH', 'Seksi Pelayanan Air Kelistrikan', '19710904 199210 1001', '', 10, '2025-05-28 06:01:01', '2025-05-28 06:01:01'),
(24, 'PRAYITNA, SE, MT', 'Seksi Bangunan', '19650223 200701 1 003', '', 10, '2025-05-28 06:03:34', '2025-05-28 06:03:34'),
(26, 'SRI SAMDONO, SH', 'Kepala UPTD Pasar Wilayah. Johar', '19601012 199301 1014', '', 17, '2025-05-28 06:27:46', '2025-05-28 06:27:46'),
(27, 'SUDIRO, SH', 'Kepala Sub Bag TU UPTO Pasar Wilayah Johar', '19601012 199301 1014', '', 26, '2025-05-28 06:28:34', '2025-05-28 06:28:34'),
(28, 'SURANTO, SH', 'Kepala UPTD Pasar Wilayah Karimata', '19620609 199203 1003', '', 17, '2025-05-28 06:30:06', '2025-05-28 06:30:06'),
(29, 'NYAMINIK, SE', 'Kepala Sub Bag TU UPTO Pasar Wilayah Karimata', '19660217 198603 2009', '', 28, '2025-05-28 06:30:49', '2025-05-28 06:30:49'),
(30, 'MOH IQBAL, SH', 'Kepala UPTD Pasar Wilayah Bulu', '19600521 199807 1001', '', 17, '2025-05-28 06:31:40', '2025-05-28 06:31:40'),
(31, 'Dra. LILIEK NUR FAHMI', 'Kepala Sub Bag TU UPTD Pasar Wilayah Bulu', '19660101 199301.2003', '', 30, '2025-05-28 06:32:39', '2025-05-28 06:32:39'),
(32, 'SUNARDI, SH', 'Kepala UPTD Pasar Wilayah Karangayu', '19591006 197909 1003', '', 17, '2025-05-28 06:34:36', '2025-05-28 06:34:36'),
(33, 'WAGINO', 'Kepala Sub Bag TU UPTD Pasar Wilayah Karangayu', '19591006 197909 1003', '', 32, '2025-05-28 06:35:17', '2025-05-28 06:35:17'),
(34, 'NGASIMAN, SH', 'Kepala UPTD Pasar Wilayah Jatingaleh', '19530106 198901 1 001', '', 17, '2025-05-28 06:36:08', '2025-05-28 06:36:08'),
(35, 'SUYATIN, SH', 'Kepala Sub Bag TU UPTD Pasar Wilayah Jatingaleh', '19620906 198803 1010', '', 34, '2025-05-28 06:36:42', '2025-05-28 06:36:42'),
(36, 'SUHARTOKO, SE', 'Kepala UPTD Pasar Wilayah Pedurungan', '19601007 198709 1001', '', 17, '2025-05-28 06:37:58', '2025-05-28 06:37:58'),
(37, 'ARIF BUDI SETIAWAN', 'Kepala Sub Bag TU UPTD Pasar Wilayah Pedurungan', '19640513 1989011002', '', 36, '2025-05-28 06:38:32', '2025-05-28 06:38:32'),
(38, 'M. SYAMSUDDIN, S.Sos, MM', 'Kepala UPTD Metrologi Legal', '19600704 198103 1009', '', 17, '2025-05-28 06:39:25', '2025-05-28 06:39:25'),
(39, 'HAPSORO RADEN BAGUS', 'Kepala Sub Bag TU UPTD Metrologi Legal', '19610223 198503 1003', '', 38, '2025-05-28 06:40:06', '2025-05-28 06:40:06');

INSERT INTO `balai` (`id`, `kategori`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Balai Pengembangan Kemasan dan Industri Kreatif', 'Jl. Ki Mangunsarkoro No.10, Karangkidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50136', 'Merupakan UPT Disperindag Provinsi Jawa Tengah, berdiri berdasarkan Peraturan Gubernur Jawa Tengah Nomor  107 Tahun 2016 tanggal 27 Desember 2016 bernama Balai Pengembangan Kemasan dan Industri Kreatif (BPKIK). Selanjutnya berdasarkan Peraturan Gubernur Jawa Tengah Nomor 33 Tahun 2018 tanggal 1 Maret 2018 berubah menjadi Balai Industri Kreatif Digital dan Kemasan (BIKDK).', '2025-06-13 15:05:04', '2025-06-16 09:09:24');
INSERT INTO `balai` (`id`, `kategori`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'Balai Pengujian dan Sertifikasi Mutu Barang', 'Jl. Brigjen Sudiarto No.327, Pedurungan Kidul, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50192', 'Balai Pengujian dan Sertifikasi Mutu Barang (BPSMB) Semarang adalah lembaga milik Dinas Perindustrian dan Perdagangan Provinsi Jawa Tengah yang bertugas melakukan kalibrasi dan pengujian mutu barang. BPSMB Semarang memiliki 10 orang personil kalibrasi dan menyelenggarakan berbagai jasa pengujian mutu barang untuk mendukung industri di Jawa Tengah.', '2025-06-16 09:09:58', '2025-06-16 09:09:58');

INSERT INTO `berita` (`id`, `judul`, `slug`, `foto`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'PENGAWASAN ALAT UKUR TAKAR TIMBANG DI PASAR GAYAMSARI OLEH UPTD METROLOGI LEGAL SEMARANG', 'apa ini', 'komoditas_pasar/hxdDEYbIFrfHJ4eVyKoQWOlvIiDwuWPZ6vkiJr1r.jpg', 'Rabu, (21/2) Demi terciptanya tertib ukur dikota Semarang, UPTD Metrologi Legal Kota Semarang melakukan kegiatan Pengawasan UTTP (alat ukur takar timbang dan perlengkapannya) di Pasar Gayamsari Semarang.\r\n\r\nKegiatan pengawasan kemetrologian ini dilakukan untuk memberikan jaminan kepastian hukum kebenaran pengukuran dan tertib ukur, dengan cara memastikan UTTP yang dipergunakan dalam perdagangan/transaksi jual beli dan atau serah terima barang telah dilakukan tera atau tera ulang oleh UPTD Metrologi, serta petugas memberikan himbauan dan edukasi kepada pedagang untuk selalu tertib melakukan tera dan tera ulang UTTP nya demi menjagatertib ukur sehingga tercipta kepercayaan dan kepuasan kepada pelanggan', '2025-05-28 03:32:20', '2025-06-16 08:26:25');
INSERT INTO `berita` (`id`, `judul`, `slug`, `foto`, `isi`, `created_at`, `updated_at`) VALUES
(2, 'Superindo sediakan 1.200 paket diskon sembako \\\"Friday Mubarak\\\" Aprindo', 'berita terkini', 'berita/UwNYgJSOXDja3gXOgMcGJEsyIIzEzeOysQHuYtLh.png', 'Superindo Sediakan 1.200 Paket Sembako Diskon Lewat Program “Friday Mubarak” Selama Ramadhan\r\n\r\nSemarang – Dalam rangka mendukung peningkatan daya beli masyarakat selama bulan suci Ramadhan 1446 H, Superindo turut ambil bagian dalam program nasional \\\"Friday Mubarak\\\" yang digagas oleh Asosiasi Pengusaha Ritel Indonesia (Aprindo) bersama Kementerian Koordinator Bidang Perekonomian. Program ini menghadirkan paket sembako dengan potongan harga hingga 30 persen.\r\n\r\nNational Head Retail Operation Superindo, Joko Susanto, mengungkapkan bahwa pihaknya menyediakan sekitar 1.200 paket sembako dengan harga terjangkau. Program ini dilaksanakan serentak di 12 gerai Superindo yang tersebar di 10 kota besar, seperti Semarang, Surabaya, Malang, Jakarta, Bandung, dan Lampung.\r\n\r\n\\\"Paket sembako yang biasanya dijual seharga Rp125.000, dalam program ini ditawarkan hanya Rp100.000. Setiap hari Jumat selama Ramadhan, kami siapkan 100 paket di setiap gerai,\\\" jelas Joko saat menghadiri peluncuran program di Semarang, Jumat.\r\n\r\nProgram “Friday Mubarak” resmi diluncurkan secara hybrid oleh Menteri Koordinator Bidang Perekonomian, Airlangga Hartarto, dan Ketua Umum Aprindo, Roy Nicholas Mandey, di Jakarta. Di berbagai daerah, peluncuran serupa juga dilakukan oleh ritel anggota Aprindo, termasuk Superindo.\r\n\r\nJoko menambahkan bahwa program ini akan berlangsung lima kali selama Ramadhan, tepatnya setiap hari Jumat. Diharapkan, inisiatif ini dapat meringankan beban masyarakat dalam memenuhi kebutuhan pokok di tengah lonjakan harga sejumlah bahan pangan.\r\n\r\nKepala Dinas Ketahanan Pangan Provinsi Jawa Tengah, Dyah Lukisari, memberikan apresiasinya terhadap langkah Aprindo dan Superindo tersebut. Menurutnya, kehadiran program ini sangat membantu masyarakat untuk mendapatkan bahan pokok dengan harga terjangkau, terutama di tengah meningkatnya harga beberapa komoditas seperti beras, bawang putih, dan minyak goreng.\r\n\r\nSenada, Kepala Dinas Ketahanan Pangan Kota Semarang Endang Sarwiningsih Setyawulan dan Plt. Kepala Dinas Perdagangan Kota Semarang Bambang Pramusinto turut menyambut baik pelaksanaan program ini yang dinilai mendukung ketahanan pangan masyarakat selama bulan puasa.', '2025-05-28 09:07:09', '2025-05-28 09:07:18');
INSERT INTO `berita` (`id`, `judul`, `slug`, `foto`, `isi`, `created_at`, `updated_at`) VALUES
(3, '270 pelaku UMKM meriahkan Pasar Rakyat Dugderan Semarang', 'umkm', 'berita/BSbxk6BS6DgiCowod4ubzTkDkK4ak1qEbjje1SJK.png', 'Semarang – Sebanyak 270 pelaku usaha mikro, kecil, dan menengah (UMKM) turut serta memeriahkan gelaran Pasar Rakyat Dugderan 2025, yang digelar sebagai bagian dari tradisi tahunan menyambut bulan suci Ramadhan di Kota Semarang, Jawa Tengah.\r\n\r\nPelaksana tugas (Plt) Kepala Dinas Perdagangan Kota Semarang, Bambang Pramusinto, menjelaskan bahwa acara berlangsung selama 10 hari, mulai 17 hingga 26 Februari 2025, dengan melibatkan pelaku UMKM dari berbagai paguyuban seperti Paguyuban Pedagang dan Jasa (PPJ), Perhimpunan Pedagang dan Jasa (PPJP), serta Badan Pengelola Masjid Agung Semarang.\r\n\r\n“Jumlah UMKM yang berpartisipasi tahun ini meningkat dibanding tahun-tahun sebelumnya. Awalnya hanya 87 pelaku, lalu naik menjadi 225, dan sekarang sudah mencapai sekitar 270 UMKM,” ujar Bambang, Senin (17/2).\r\n\r\nPasar rakyat yang berlokasi di kawasan Aloon-Aloon Masjid Agung Semarang ini juga menghadirkan berbagai wahana permainan anak, seperti Tong Setan, Bianglala, Kincir Air, dan Kora-Kora. Bambang memastikan seluruh wahana tersebut telah diperiksa dan dinyatakan aman untuk pengunjung.\r\n\r\n“Kami menambahkan wahana permainan anak karena banyak masyarakat yang mengusulkan hal itu pada penyelenggaraan sebelumnya,” jelasnya.\r\n\r\nTak hanya itu, sejumlah area photobooth dengan latar menarik juga disiapkan untuk pengunjung yang ingin mengabadikan momen bersama keluarga di area pasar tiban ini.\r\n\r\nSementara itu, Sekretaris Komisi B DPRD Kota Semarang, Syahrul Qirom, mengapresiasi penyelenggaraan Pasar Rakyat Dugderan yang dianggap sebagai warisan budaya penting masyarakat Semarang.\r\n\r\n“Setelah sempat vakum selama tiga tahun akibat pandemi, Pasar Dugderan kembali hadir sejak 2023. Tahun lalu sempat sepi karena tidak ada wahana permainan, tapi tahun ini jauh lebih meriah,” kata Syahrul.\r\n\r\nIa menegaskan bahwa DPRD akan terus mendukung upaya pemerintah dalam melestarikan tradisi lokal, terutama kegiatan yang menjadi ikon jelang Ramadhan di Kota Semarang.\r\n\r\n“Ini bukan hanya acara pemerintah, tetapi milik kita semua. Mari kita lestarikan dan ramaikan karena ini bagian dari budaya Semarang yang harus terus dijaga,” ujarnya.', '2025-05-28 09:10:46', '2025-05-28 09:10:46');
INSERT INTO `berita` (`id`, `judul`, `slug`, `foto`, `isi`, `created_at`, `updated_at`) VALUES
(4, 'Dinas Perdagangan Kota Semarang Gelar Pasar Murah Jelang Idul Adha', 'Dinas Perdagangan Kota Semarang Gelar Pasar Murah Jelang Idul Adha', 'komoditas_pasar/Q3jcEmQD2HSjPiDfzxnmAi07ICIZDvg6zeEgOoyI.jpg', 'Semarang, 16 Juni 2025 — Dalam rangka menyambut Hari Raya Idul Adha 1446 H, Dinas Perdagangan Kota Semarang menggelar kegiatan Pasar Murah di beberapa titik strategis kota. Kegiatan ini bertujuan untuk membantu masyarakat memperoleh kebutuhan pokok dengan harga terjangkau, serta menekan inflasi menjelang hari besar keagamaan.\r\n\r\nKepala Dinas Perdagangan Kota Semarang, Ibu Ratna Widyastuti, menyampaikan bahwa kegiatan pasar murah ini dilaksanakan mulai tanggal 15 hingga 20 Juni 2025 di 10 kecamatan, bekerja sama dengan distributor, Bulog, dan pelaku UMKM lokal.\r\n\r\n“Kami ingin memastikan masyarakat bisa memenuhi kebutuhan pokok menjelang Idul Adha, tanpa terbebani lonjakan harga,” ujarnya saat ditemui di lokasi Pasar Murah Kecamatan Banyumanik.\r\n\r\nAdapun komoditas yang dijual dalam kegiatan ini meliputi:\r\n\r\nBeras medium dan premium\r\n\r\nMinyak goreng\r\n\r\nGula pasir\r\n\r\nDaging beku\r\n\r\nTelur ayam ras\r\n\r\nSayuran dan kebutuhan dapur lainnya\r\n\r\nSelain menjual kebutuhan pokok, kegiatan ini juga menghadirkan stan UMKM unggulan Kota Semarang yang menjual produk olahan makanan, kerajinan tangan, dan sembako kemasan.\r\n\r\nKegiatan ini mendapatkan sambutan hangat dari masyarakat. Salah satu warga, Ibu Siti Rohmah, mengatakan bahwa harga yang ditawarkan di pasar murah lebih murah dibandingkan di pasar tradisional.\r\n\r\nDinas Perdagangan Kota Semarang berharap kegiatan ini dapat terus dilakukan secara berkala, terutama menjelang momen penting seperti Lebaran, Natal, dan Tahun Baru.', '2025-06-16 10:14:45', '2025-06-16 10:17:16');

INSERT INTO `kategori_galeris` (`id`, `nama`, `foto`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Disperdag', 'thumbnail_galeri/LQb1aA3kfMf7DdMH0opciY2EQNFSIw4Fdiz2OsWa.jpg', '2025-05-28', '2025-05-28 08:59:21', '2025-05-28 08:59:21');
INSERT INTO `kategori_galeris` (`id`, `nama`, `foto`, `tanggal`, `created_at`, `updated_at`) VALUES
(3, 'Pasar Tradisional', 'thumbnail_galeri/W9e4w9lfyxZwDfdGY1WDMvhJk4VGOyGMw9ljw46P.jpg', '2025-06-01', '2025-06-01 14:35:26', '2025-06-01 14:35:26');

INSERT INTO `galeris` (`id`, `kategori_galeri_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'galeri/MKjfY1iF48YaBblvjjmpBkio1GiNsQaXGR5rLZ71.jpg', '2025-05-28 09:01:07', '2025-05-28 09:01:07');
INSERT INTO `galeris` (`id`, `kategori_galeri_id`, `foto`, `created_at`, `updated_at`) VALUES
(2, 1, 'galeri/O88Q3odjmYHsvfmKMq4ExRemU8FHJwDjBgy5cji5.jpg', '2025-06-01 07:10:17', '2025-06-01 07:10:17');
INSERT INTO `galeris` (`id`, `kategori_galeri_id`, `foto`, `created_at`, `updated_at`) VALUES
(3, 3, 'galeri/lutsnlDC6R1cIZKQx21LoWG7tDLvVQkkLRPQNKvn.jpg', '2025-06-01 14:35:55', '2025-06-01 14:35:55');
INSERT INTO `galeris` (`id`, `kategori_galeri_id`, `foto`, `created_at`, `updated_at`) VALUES
(4, 3, 'galeri/GgkQdmZLd02ZO47dp3qXcYReGew44Rxv1p7YITHy.png', '2025-06-01 14:36:09', '2025-06-01 14:36:09'),
(5, 3, 'galeri/NjRfQafJ0CVmbrJev0w4vZXgquBdQeJuX2BylKSW.png', '2025-06-01 14:36:23', '2025-06-01 14:36:23'),
(6, 3, 'galeri/kthCVGLdgafDNAFavsNbfLpvB5EvSNGavzOqSM9i.png', '2025-06-01 14:36:42', '2025-06-01 14:36:42'),
(7, 3, 'galeri/QN2cgRCSmBs45V3WyAttaqL5ftkvtGosrx3DGIp1.png', '2025-06-01 14:36:59', '2025-06-01 14:36:59'),
(8, 3, 'galeri/YpbfNX52OwxoazN07N6qn2NigDFD5nGp9qQQ4j7U.png', '2025-06-01 14:37:11', '2025-06-01 14:37:11'),
(9, 3, 'galeri/g26m64AcCmcqOixxxtH8VXXT1IAKO9AzngrjF1Mk.jpg', '2025-06-01 14:37:29', '2025-06-01 14:37:29'),
(10, 3, 'galeri/g1uppPPGN3LuwP2zkMDasfECfvUAr6dPtTnAGLoK.jpg', '2025-06-01 14:38:45', '2025-06-01 14:38:45');

INSERT INTO `alur` (`id`, `kategori`, `gambar`, `keterangan`, `uu_terkait`, `created_at`, `updated_at`) VALUES
(1, 'Alur Pengajuan keberatan', 'Alur/Ghp5q9TxF3xTmKFEIJvWBFpO84C2ukSQDiBeG0h3.jpg', 'ALASAN PENGAJUAN KEBERATAN :\r\n\r\nBerdasarkan pasal 35 dalam UU No.14 Tahun 2008 tentang Keterbukaan Informasi Publik (KIP), alasan yang dapat digunakan pemohon informasi untuk mengajukan keberatan :  \r\n\r\n1. Penolakan atas permintaan informasi berdasarkan Alasan pengecualian sebagaimana dimaksud dalam Pasal 17 UU No. 14 Tahun 2008 tentang KIP. \r\n2. Tidak disediakannya informasi berkala sebagaimana dimaksud dalam Pasal 9 UU No.14 Tahun 2008 tentang KIP.\r\n3. Tidak ditanggapinya permintaan informasi \r\npermintaan informasi ditanggapi tidak sebagaimana yang diminta.\r\n4. Tidak dipenuhinya permintaan informasi. \r\n5. Pengenaan biaya yang tidak wajar.\r\n6. Penyampaian informasi yang melebihi waktu yang diatur dalam Undang-Undang.', 'Berdasarkan Pasal 35 dan pasal 36 Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik menyatakan :\r\n\r\nPasal 35\r\n\r\nSetiap Pemohon Informasi Publik dapat mengajukan keberatan secara tertulis kepada atasan Pejabat Pengelola Informasi dan Dokumentasi berdasarkan alasan berikut:\r\n1. penolakan atas permintaan informasi berdasarkan alasan pengecualian sebagaimana dimaksud dalam Pasal 17.\r\na. tidak disediakannya informasi berkala sebagaimana dimaksud dalam Pasal 9.\r\nb. tidak ditanggapinya permintaan informasi.\r\nc. permintaan informasi ditanggapi tidak sebagaimana yang diminta.\r\nd. tidak dipenuhinya permintaan informasi.\r\ne. pengenaan biaya yang tidak wajar dan/atau penyampaian informasi yang melebihi waktu yang diatur dalam Undang-Undang ini.\r\n\r\n2. Alasan sebagaimana dimaksud pada ayat (1) huruf b sampai dengan huruf g dapat diselesaikan secara musyawarah oleh kedua belah pihak.\r\n\r\nPasal 36\r\n\r\n1. Keberatan diajukan oleh Pemohon Informasi Publik dalam jangka waktu paling lambat 30 (tiga puluh) hari kerja setelah ditemukannya alasan sebagaimana dimaksud dalam Pasal 35 ayat (1).', '2025-05-28 03:02:39', '2025-06-16 08:38:33');
INSERT INTO `alur` (`id`, `kategori`, `gambar`, `keterangan`, `uu_terkait`, `created_at`, `updated_at`) VALUES
(2, 'Alur Penyelesaian Sengketa', 'Alur/SiKhzRiZ77e6I8jYts71gm6zmDZzaXhdYTt2nRRt.jpg', NULL, 'UU No. 14 Tahun 2008 Pasal 37\r\n\r\n1. Upaya Penyelesaian Sengketa Informasi diajukan masyarakat Kepada Komisi Informasi Pusat dan/atau Komisi Informasi Provinsi dan/atau Komisi Informasi Kabupaten/Kota Sesuai dengan kewenangannya apabila tanggapan atasan Pejabat Pengelola Informasi dan Dokumentasi dalam Proses keberatan tidak memuaskan Pemohon Informasi Publik.\r\n\r\n2. Upaya Penyelesaian Sengketa Informasi Publik diajukan dalam waktu paling lambat 14 (empat belas) hari kerja setelah diterimanya tanggapan tertulis dari atasan pejabat sebagaimana dimaksud dalam Pasal 36 ayat (2).', '2025-06-01 14:01:33', '2025-06-16 08:43:54');

INSERT INTO `pasars` (`id`, `nama`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'PASAR BOOM LAMA', 'Jl. Boom Lama, Kuningan, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50176', 'foto_pasar/QGPcN5fFFIc2euunEmOLzRaJBxahnza1s0qKAzRu.png', '2025-05-28 09:16:54', '2025-05-28 09:16:54');
INSERT INTO `pasars` (`id`, `nama`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'PASAR BULU', 'Jl. Mgr Sugiyopranoto, Barusari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50245', 'foto_pasar/X9nL8RsIF2g1FESfBf4PD69Nvq4yAwjR6wJiEkiK.png', '2025-05-28 09:17:56', '2025-05-28 09:17:56');
INSERT INTO `pasars` (`id`, `nama`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(3, 'PASAR KARANGAYU', 'Jl. Jenderal Sudirman, Karangayu, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50149', 'foto_pasar/RTEU8tgB29ii2A08AKTsh2lQLTVDyiqE28hn4i0u.jpg', '2025-05-28 09:19:55', '2025-05-28 09:19:55');
INSERT INTO `pasars` (`id`, `nama`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'PASAR JOHAR', 'Pasar Johar, Jl. K.H. Agus Salim, Kauman, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50188', 'foto_pasar/88kiOv190Oc1Nf0fGZ1t4OTxeSwwn5uQJQh9Js0x.png', '2025-05-28 09:53:49', '2025-05-28 09:53:49'),
(5, 'PASAR PETERONGAN', 'Jl. MT. Haryono No.936, Peterongan, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50242', 'foto_pasar/UUdihCxfEqesAD45xX9DZrGSINm4isHGrZeeEvSu.jpg', '2025-05-28 09:54:59', '2025-05-28 09:54:59'),
(6, 'PASAR WONODRI', 'Jl. Wonodri Baru Raya, Wonodri, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50242', 'foto_pasar/d9l1GGXXYVwhbCyUyPANrjEXIZv0p6YV6yj82ZFC.jpg', '2025-05-28 09:56:41', '2025-05-28 09:56:41'),
(7, 'PASAR GANG BARU', 'Gg. Baru No.129, Kranggan, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50137', 'foto_pasar/9Pk0FaF1YWS37odX6wpxIT4Zk6dKlFFQeklz9kKk.jpg', '2025-05-28 10:00:05', '2025-05-28 10:00:05'),
(8, 'PASAR SAMPANGAN', 'Jl. Menoreh Raya No.33, Sampangan, Kec. Gajahmungkur, Kota Semarang, Jawa Tengah 50232', 'foto_pasar/AbgOzVbll0FGW33n4VYSTR43OaPGJ1XQczGpSt9w.png', '2025-05-28 10:01:49', '2025-05-28 10:01:49'),
(9, 'PASAR MANGKANG', 'Jl.Pasar Mangkang,kel, Wonosari, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50244', 'foto_pasar/slsYKyOp5aKmvQqpminUUyGm7n0prbpaQtaTf496.jpg', '2025-05-28 10:03:44', '2025-05-28 10:03:44'),
(10, 'PASAR RANDUSARI', 'Jl. Kyai Saleh, Randusari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50244', 'foto_pasar/ViZVS8T73rVnJMdXyxIEWvb5r3DiSl6fzdmbKfs6.jpg', '2025-05-28 10:06:04', '2025-05-28 10:06:04'),
(11, 'PASAR BANGETAYU', 'Jl. Banget Ayu Raya No.1, Bangetayu Kulon, Kec. Genuk, Kota Semarang, Jawa Tengah 50115', 'foto_pasar/X4MzPrmILvUXAsiJ7ZkXQbAq9kFdfLjCSFg73zFr.jpg', '2025-05-28 10:07:40', '2025-05-28 10:07:40'),
(12, 'PASAR GAYAMSARI', 'Jl. Majapahit No.Kel, Gayamsari, Kec. Gayamsari, Kota Semarang, Jawa Tengah 50248', 'foto_pasar/OI8F0rgBgxikkC92OmVoBwyB1nQQyk2J9xiHgu64.png', '2025-05-28 10:11:27', '2025-05-28 10:11:27'),
(13, 'PASAR GENUK', 'Jl. Kaligawe Raya No.168, Genuksari, Kec. Genuk, Kota Semarang, Jawa Tengah 50118', 'foto_pasar/M5i1LccgxY13cqZeKH8vukdYqHEWPS4kEED2JFiQ.jpg', '2025-06-01 07:44:40', '2025-06-01 07:44:40'),
(14, 'PASAR MRICAN', 'Jl. Tentara Pelajar No.99, Lamper Kidul, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50256', 'foto_pasar/gtwP2Tt7Q2d23CIZGfYff4MBlrW6xx4YCfuhogsd.png', '2025-06-01 07:54:17', '2025-06-01 07:56:14'),
(15, 'PASAR RPU KEDUNG MUNDU', 'Jalan Jl. Kedungmundu, Sendangguwo, Tembalang, Semarang City, Central Java 50273', 'foto_pasar/m4pz3iVWfkNFvn3RUpGf47snFhoQLBYe7Bbu5iqp.png', '2025-06-01 07:59:20', '2025-06-01 07:59:20'),
(16, 'PASAR RPU METESEH', 'Jl. Tunggu Raya, Meteseh, Kec. Tembalang, Kota Semarang, Jawa Tengah 50271', 'foto_pasar/Aw3ItL1n8H70STKO1oljxvzOTq440gKuVfuUMseU.png', '2025-06-01 08:02:08', '2025-06-01 08:02:08'),
(17, 'PASAR RPU PENGGARON', 'Penggaron Kidul, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50194', 'foto_pasar/Zcm77Cpd4LJtb2NT6iSSLkfgjqVmu55vrf6YhmVU.jpg', '2025-06-01 08:06:48', '2025-06-01 08:06:48'),
(18, 'PASAR SATRIO WIBOWO', 'Tlogosari Kulon, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50196', 'foto_pasar/Vhtm4E5MMefugoFcJDBv2mHyhffgJWFW6abKOimC.png', '2025-06-01 11:46:13', '2025-06-01 11:46:13'),
(19, 'PASAR SURYOKUSUMO', 'JL SIDOMULYO No.1, Muktiharjo Kidul, Pedurungan, Semarang City, Central Java 50197', 'foto_pasar/jEkEmEfO6CDHODoiN5r7MXiQbE17mmM7umYZTYFC.jpg', '2025-06-01 11:53:05', '2025-06-01 11:53:05'),
(20, 'PASAR MIJEN', 'Ngadirgo, Kec. Mijen, Kota Semarang, Jawa Tengah', 'foto_pasar/bhUTnZgfwk6djHSPVWHB4VoafEp322IFfVKO21Qd.png', '2025-06-01 11:57:24', '2025-06-01 11:57:24'),
(21, 'PASAR DARGO', 'Kebonagung, Kec. Semarang Tim., Kota Semarang, Jawa Tengah 50123', 'foto_pasar/guC1Y1MPUQuWojG3AMPa4gYK8dueGdw1hi4RhBpE.jpg', '2025-06-01 12:03:20', '2025-06-01 12:03:20'),
(22, 'PASAR JRAKAH', 'Purwoyoso, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50184', 'foto_pasar/dRf5J9Mv009M49aRMJ5idjkRQfkfoPVqXwzugH3F.png', '2025-06-01 12:06:11', '2025-06-01 12:06:11'),
(23, 'PASAR LANGGAR INDAH', '2C7J+QVH, Karangturi, Kec. Semarang Tim., Kota Semarang, Jawa Tengah 50124', 'foto_pasar/IQsQUJJ2XqFV1NlKafopFYm3is1ppJvp2vhQ5cz0.jpg', '2025-06-01 12:08:32', '2025-06-01 12:08:32'),
(24, 'PASAR REJOMULYO', 'Rejomulyo, Kec. Semarang Tim., Kota Semarang, Jawa Tengah', 'foto_pasar/Ouwdc211tZgPHM6oXAvRtWVdU2oPG9cphC0MuRAd.jpg', '2025-06-01 12:10:25', '2025-06-01 12:10:25'),
(25, 'PASAR GUNUNGPATI', 'W966+5FR, Gunungpati, Kec. Gn. Pati, Kota Semarang, Jawa Tengah 50229', 'foto_pasar/MXEyFVof8in6JPnnIWYbkr3jvn1lmE9q96RL0XhH.png', '2025-06-01 12:14:45', '2025-06-01 12:14:45'),
(26, 'PASAR MANYARAN', 'Kedung Klepu, Karanglor, Kec. Manyaran, Kabupaten Wonogiri, Jawa Tengah 57662', 'foto_pasar/6jsTOWUuBl2NByhLZxzXgrDPfbVgTtgMh1BcW208.png', '2025-06-01 12:17:19', '2025-06-01 12:17:19'),
(27, 'PASAR NGALIAN', 'Jalan Ngaliyan, Ngaliyan, Semarang, Kota Semarang, Jawa Tengah 50181', 'foto_pasar/wDYQiaHAmWz2UaotQbx90rVfDvSeZncxBtidLkEH.png', '2025-06-01 12:20:04', '2025-06-01 12:20:04'),
(28, 'PASAR PURWOGONDO', 'Jl. Peres No.68, Purwosari, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50172', 'foto_pasar/YIyxM6WI2QioY6uFKxaIthdoVXinpOmlGUtDtDN4.png', '2025-06-01 12:24:12', '2025-06-01 12:24:12'),
(29, 'UPTD PASAR WILAYAH KARIMATA', '2C8P+2XC, Jl. Purwosari Raya, Rejosari, Kec. Semarang Tim., Kota Semarang, Jawa Tengah 50125', 'foto_pasar/r7aVlRmhTQ53NQFubamM6bu62icEOta0iWjRlxya.png', '2025-06-01 12:31:37', '2025-06-01 12:31:37'),
(30, 'PASAR PURWOYOSO', '2928+VHJ, Jl. Gatot Subroto, Purwoyoso, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50184', 'foto_pasar/YynjtsuzQUP4yhlrvWXogt1SYJUVXAlQBKqDkqEu.png', '2025-06-01 12:34:06', '2025-06-01 12:34:06');

INSERT INTO `daftar_barang` (`id`, `nama`, `satuan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Cabai', 'Kg', 'komoditas_pasar/5gdtXyj00aeUf9S0fLNbLdhwiEz6ilR7hkhGdzE5.jpg', '2025-05-31 12:45:14', '2025-06-01 07:03:20');
INSERT INTO `daftar_barang` (`id`, `nama`, `satuan`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Beras Premium', 'Kg', 'komoditas_pasar/hQ5xuURPNmDgyuL0oKWBtyiBVL4KsAYaKjzCKgh9.jpg', '2025-06-01 07:04:38', '2025-06-01 07:06:32');
INSERT INTO `daftar_barang` (`id`, `nama`, `satuan`, `foto`, `created_at`, `updated_at`) VALUES
(3, 'Cabai Merah Keriting', 'Kg', 'komoditas_pasar/r8agVvQkIV9DwiTt3KD3RRRdg0zSSM9UEVQc9oLp.jpg', '2025-06-01 07:06:52', '2025-06-01 14:24:11');
INSERT INTO `daftar_barang` (`id`, `nama`, `satuan`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'Beras Medium', 'Kg', 'komoditas_pasar/xrYLUbWnYVDmSf7UdlsOkl2OZ9ZZEEN7YlZjxPkZ.jpg', '2025-06-01 14:24:33', '2025-06-01 14:24:33'),
(5, 'Bawang Merah', 'Kg', 'komoditas_pasar/IhWmxi3KvcVtLzxDmf6OQbFnVbNw6fCOm2MRSsXj.jpg', '2025-06-01 14:24:56', '2025-06-01 14:24:56'),
(6, 'Bawang Putih', 'Kg', 'komoditas_pasar/6MfDsAlhc65ESO7GYnh2vNaag8gd023uqfr86s3r.jpg', '2025-06-01 14:25:11', '2025-06-01 14:25:11'),
(7, 'Cabai Merah Besar', 'Kg', 'komoditas_pasar/PzftbBEea6QYSdb2po56s9J2NBVmxqy0CPltGVmP.png', '2025-06-01 14:25:37', '2025-06-01 14:25:37'),
(8, 'Biji Kedelai', 'Kg', 'komoditas_pasar/SWGd9l5ZOmyurzT0x3GhwCZXGuBrbjWX0mpIja7s.jpg', '2025-06-01 14:25:56', '2025-06-01 14:25:56'),
(9, 'Minyak Kemasan', 'Liter', 'komoditas_pasar/61wf7jvtvV6YTIt6e6gNuXIq5Aro6tZKWQChVBPo.jpg', '2025-06-01 14:26:15', '2025-06-01 14:26:15'),
(10, 'Minyak Curah', 'Liter', 'komoditas_pasar/xwx4WRjpLGRWKbHNzfPm4cEGBhcBUpHuz8sIO6h6.jpg', '2025-06-01 14:26:36', '2025-06-01 14:26:36'),
(11, 'Minyak Kita', 'Liter', 'komoditas_pasar/TEb7zbVMuPJBLD6SwAGsfV6iSBl2WH99yEpasYxF.jpg', '2025-06-01 14:27:10', '2025-06-01 14:27:10'),
(12, 'Daging Sapi', 'Kg', 'komoditas_pasar/htJZjlfeSOot7HqKA84VEwilYGcc7uWON7zaTax2.jpg', '2025-06-01 14:27:28', '2025-06-01 14:27:28'),
(13, 'Daging Ayam Negeri', 'Kg', 'komoditas_pasar/eTHWNsruEwxMkKq3x5CS4CkCbOwKxGA4wO0JBwoC.jpg', '2025-06-01 14:27:50', '2025-06-01 14:27:50'),
(14, 'Telur Ayam Ras', 'Kg', 'komoditas_pasar/DGwm8cNF0M3uymaaHG1LPr0YzpENY9tDe0YUdgo2.jpg', '2025-06-01 14:28:08', '2025-06-01 14:28:08'),
(15, 'Gula Pasir', 'Kg', 'komoditas_pasar/9OTubqmwFSosPsrzyof2xXcP4ltXtf6iXGLE5zLk.jpg', '2025-06-01 14:28:22', '2025-06-01 14:28:22'),
(16, 'Garam', 'Kg', 'komoditas_pasar/kM2bL1rvOTmvgEI7ml8paS0Y2dN170if3bf6hzfb.jpg', '2025-06-01 14:28:36', '2025-06-01 14:28:36');

INSERT INTO `detail_pasars` (`id`, `pasar_id`, `kategori`, `keterangan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fasilitas', 'Jumlah Petak', '1. Kios  :    34 petak  \r\n2. Los  :  210 petak      \r\n3. Pancaan :    -', '2025-05-28 09:23:01', '2025-05-28 09:23:01');
INSERT INTO `detail_pasars` (`id`, `pasar_id`, `kategori`, `keterangan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 1, 'Fasilitas', 'Listrik', '1. Kios  :  \r\na. watt : -\r\nb. Kondisi : baik \r\n2. Los  :   \r\na. watt : - \r\nb. Kondisi : cukup baik', '2025-05-28 09:25:36', '2025-06-16 08:48:15');
INSERT INTO `detail_pasars` (`id`, `pasar_id`, `kategori`, `keterangan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(3, 1, 'Fasilitas', 'Lain-lain', '1. APAR (Alat Pemadam Api Ringan)\r\na. Jumlah APAR : 6 buah\r\nb. Ukuran : ada 4 ukuran\r\n- 6 kg : 5 buah\r\n- 3 kg : 1 buah\r\n- 4 kg : - buah\r\n- 5 kg : - buah\r\n\r\nc. Lokasi Penempatan : ada 4 lantai\r\n- Lantai 1 : 6 buah\r\n- Lantai 2 : - buah\r\n- Lantai 3 : - buah\r\n- Lantai 4 : - buah\r\n\r\n2. Hidran\r\na. Jumlah Hidran : - buah\r\nb. Lokasi : -\r\nc. Kondisi Hidran : Baik\r\nd. Sumber Air : -\r\n\r\n3. Sound System\r\na. Lantai Basement : - buah (Kondisi: -)\r\nb. Lantai 1 : - buah (Kondisi: -)\r\nc. Lantai 2: - buah (Kondisi: -)\r\nd. Lantai 3: - buah (Kondisi: -)\r\n\r\n4. CCTV\r\na. Basement : - buah (Kondisi: -)\r\nb. Lantai 1 : - buah (Kondisi: -)\r\nc. Lantai 2 : - buah (Kondisi: -)\r\nd. Lantai 3: - buah (Kondisi: -)\r\n\r\n5. IPAL (Instalasi Pengolahan Air Limbah)\r\na. Ukuran: -\r\nb. Kondisi: -\r\n\r\n6. Mesin Pompa Air\r\na. Mesin Pompa Air PAM: 1 unit (Kondisi: Baik)\r\nb. Mesin Pompa Pembuangan Air: - unit (Kondisi: -)\r\nc. Mesin Pompa Air untuk Hidran: - unit (Kondisi: -)\r\n\r\n7. Pos Tera Ulang\r\na. Jumlah: -\r\nb. Kondisi: -\r\n\r\n8. Pos Keamanan\r\na. Jumlah: -\r\nb. Kondisi: -\r\n\r\n9. Eskalator\r\na. Lantai 1 ke Lantai 2: - unit\r\nb. Lantai 2 ke Lantai 3: - unit\r\n\r\n10. Lift Barang\r\na. Jumlah: -\r\nb. Kondisi: -\r\nc. Daya Tampung: -', '2025-05-28 09:27:10', '2025-06-16 09:02:53');
INSERT INTO `detail_pasars` (`id`, `pasar_id`, `kategori`, `keterangan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 1, 'Tentang', 'Profile', '1. Nama  Pasar    :  BOOM LAMA\r\n\r\n2. Golongan Pasar   :  LINGKUNGAN   \r\n\r\n3. Cabang Dinas    :  UPTD PASAR WILAYAH BULU   \r\n\r\n4. Alamat     :  Jl. Bom Lama  \r\n\r\n5. Status Kepemilikan   :  Tanah Milik Pemerintah Kota Semarang\r\n\r\n6. Tahun Pembangunan   :  1977  \r\n\r\n7. Tahun Operasional   :   1978  \r\n\r\n8. Luas  lahan    :    814 m²\r\n\r\na. Luas Bangunan   :  - m² \r\n\r\nb. Luas lahan yang tdk dipergunakan :     -  m²\r\n\r\n9. Keterangan Rencana Kota ( KRK ) : -', '2025-05-28 09:28:30', '2025-06-16 08:57:52'),
(5, 1, 'SDM', 'Jumlah SDM', '1. Struktur Personel Pasar\r\na. Kepala Pasar : 1 orang\r\n\r\nb. Petugas Administrasi : - orang\r\n\r\nc. Petugas Pemungut Retribusi : 1 orang\r\n\r\nd. Petugas Keamanan dan Ketertiban : - orang\r\n\r\ne. Petugas Kebersihan : 1 orang\r\n\r\n2. Tenaga Outsourcing\r\na. Petugas Kebersihan (Outsourcing) : - orang\r\n\r\n- Pengelola : -\r\n\r\n- Ketua : -\r\n\r\nb. Petugas Keamanan Pasar (Outsourcing) : - orang\r\n\r\n- Pengelola: -\r\n\r\n- Ketua: -', '2025-05-28 09:30:35', '2025-06-16 09:05:48');

INSERT INTO `dokumen_pasars` (`id`, `pasar_id`, `judul`, `deskripsi`, `berkas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Denah Pasar', 'Denah Pasar Boom Lama terbaru', 'dokumen-pasar/WrXRGcMLh3SFqyXBYTu4fqJ3gJp3Gx0fs2261ysR.pdf', '2025-05-28 09:32:56', '2025-05-28 09:32:56');
INSERT INTO `dokumen_pasars` (`id`, `pasar_id`, `judul`, `deskripsi`, `berkas`, `created_at`, `updated_at`) VALUES
(2, 1, 'APBP 2024', 'Anggaran pendapatan dan  belanja pasar boom lama tahun 2024 final', 'dokumen-pasar/UCgS99fQYnmRowJOZg9vSJopiNVMCBK8rDP9h3SO.pdf', '2025-05-28 09:34:40', '2025-05-28 09:34:40');

INSERT INTO `daftar_harga` (`id`, `pasar_id`, `barang_id`, `harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 32540, '2025-06-01', '2025-06-01 07:02:21', '2025-06-01 07:02:21');
INSERT INTO `daftar_harga` (`id`, `pasar_id`, `barang_id`, `harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 33000, '2025-06-01', '2025-06-01 07:02:36', '2025-06-01 07:02:36');
INSERT INTO `daftar_harga` (`id`, `pasar_id`, `barang_id`, `harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(3, 5, 1, 32000, '2025-06-01', '2025-06-01 07:02:53', '2025-06-01 07:02:53');
INSERT INTO `daftar_harga` (`id`, `pasar_id`, `barang_id`, `harga`, `tanggal`, `created_at`, `updated_at`) VALUES
(4, 11, 1, 31000, '2025-06-01', '2025-06-01 07:03:49', '2025-06-01 07:03:49'),
(5, 1, 2, 16000, '2025-06-01', '2025-06-01 07:05:04', '2025-06-01 07:05:04'),
(6, 3, 2, 15500, '2025-06-01', '2025-06-01 07:05:20', '2025-06-01 07:05:20'),
(7, 10, 2, 16500, '2025-06-01', '2025-06-01 07:05:39', '2025-06-01 07:05:39'),
(8, 1, 3, 13000, '2025-06-01', '2025-06-01 07:07:37', '2025-06-01 07:07:37'),
(9, 1, 4, 13000, '2025-06-01', '2025-06-01 14:28:59', '2025-06-01 14:28:59'),
(10, 1, 5, 37500, '2025-06-01', '2025-06-01 14:29:26', '2025-06-01 14:29:26'),
(11, 1, 6, 37500, '2025-06-01', '2025-06-01 14:29:44', '2025-06-01 14:29:44'),
(12, 1, 8, 10750, '2025-06-01', '2025-06-01 14:30:04', '2025-06-01 14:30:04'),
(13, 1, 7, 42000, '2025-06-01', '2025-06-01 14:30:36', '2025-06-01 14:30:36'),
(14, 1, 12, 130000, '2025-06-01', '2025-06-01 14:30:51', '2025-06-01 14:30:51'),
(15, 1, 13, 34000, '2025-06-01', '2025-06-01 14:31:06', '2025-06-01 14:31:06'),
(16, 1, 14, 26500, '2025-06-01', '2025-06-01 14:31:50', '2025-06-01 14:31:50'),
(17, 1, 15, 17500, '2025-06-01', '2025-06-01 14:32:22', '2025-06-01 14:32:22'),
(18, 1, 9, 20500, '2025-06-01', '2025-06-01 14:32:37', '2025-06-01 14:32:37'),
(19, 1, 10, 19000, '2025-06-01', '2025-06-01 14:32:51', '2025-06-01 14:32:51'),
(20, 1, 11, 16500, '2025-06-01', '2025-06-01 14:33:20', '2025-06-01 14:33:20'),
(21, 1, 16, 9500, '2025-06-01', '2025-06-01 14:33:33', '2025-06-01 14:33:33');

INSERT INTO `sliders` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'slider/7nX06zm2UgemdYm4td0hPpawPwpjMgDX58cv1bqM.jpg', '2025-05-28 04:53:05', '2025-05-28 04:53:05');
INSERT INTO `sliders` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'slider/znDu7c6oOptr6hSlCPfHVtDMPDzygvxWsPRw8Wyp.png', '2025-05-28 05:04:48', '2025-05-28 05:04:48');
INSERT INTO `sliders` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(3, 'slider/XMfgbAEC6fpTdKGP7fMjJCOHA9PJkhM9P5BsfnOr.png', '2025-05-28 05:05:03', '2025-05-28 05:05:03');
INSERT INTO `sliders` (`id`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'slider/6BbVRLemMFMy6i0rkqvZqIOsqG1eYsmZKbebRkGD.png', '2025-05-28 05:05:16', '2025-05-28 05:05:16'),
(5, 'slider/HpSTCpMdy2opzusEpnjmoeWiHwOl0gr7voyIu5OF.jpg', '2025-05-28 05:06:55', '2025-05-28 05:06:55'),
(6, 'slider/pit0YWyr7jzTkm7V58yUnnhsvfeU8qUUbE4KPhwp.jpg', '2025-05-28 05:07:06', '2025-05-28 05:07:06'),
(7, 'slider/FwFmTsXyJYsDnxL3X7Yp0utGEnE5bXBoaaqeSCES.jpg', '2025-06-01 07:09:02', '2025-06-01 07:09:02');

INSERT INTO `formulirs` (`id`, `kategori`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Formulir Permohonan', 'https://panelharga.badanpangan.go.id/beranda', '2025-05-31 12:55:21', '2025-05-31 12:55:21');
INSERT INTO `formulirs` (`id`, `kategori`, `url`, `created_at`, `updated_at`) VALUES
(2, 'Formulir Pengajuan Keberatan', 'https://semarangkota.go.id/', '2025-06-16 08:45:59', '2025-06-16 08:45:59');
INSERT INTO `formulirs` (`id`, `kategori`, `url`, `created_at`, `updated_at`) VALUES
(3, 'Formulir Permintaan Informasi Publik', 'https://semarangkota.go.id/', '2025-06-16 08:46:06', '2025-06-16 08:46:06');
INSERT INTO `formulirs` (`id`, `kategori`, `url`, `created_at`, `updated_at`) VALUES
(4, 'Formulir Pengaduan', 'https://semarangkota.go.id/', '2025-06-16 08:46:13', '2025-06-16 08:46:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
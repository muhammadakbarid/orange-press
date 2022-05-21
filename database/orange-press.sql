-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 03:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orange-press`
--

-- --------------------------------------------------------

--
-- Table structure for table `distribusi`
--

CREATE TABLE `distribusi` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tujuan_distribusi` text NOT NULL,
  `tanggal_distribusi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distribusi`
--

INSERT INTO `distribusi` (`id`, `id_produk`, `jumlah`, `tujuan_distribusi`, `tanggal_distribusi`) VALUES
(1, 13, 10, 'Perpustakaan Cimahi', '2022-05-17'),
(2, 13, 10, 'Perpustakaan Cimahi', '2022-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `file_attach`
--

CREATE TABLE `file_attach` (
  `id_file` int(11) NOT NULL,
  `id_riwayat` int(11) NOT NULL,
  `nama_file` varchar(256) NOT NULL,
  `url_file` varchar(256) NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_attach`
--

INSERT INTO `file_attach` (`id_file`, `id_riwayat`, `nama_file`, `url_file`, `create_on`) VALUES
(13, 78, 'Dummy_PDF1.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF1.docx', '2022-05-20 20:50:07'),
(14, 81, 'Dummy_PDF3.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF3.docx', '2022-05-20 22:13:10'),
(15, 85, 'Dummy_PDF4.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF4.docx', '2022-05-20 22:20:33'),
(16, 89, 'Dummy_PDF5.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF5.docx', '2022-05-20 22:37:10'),
(17, 92, 'Dummy_PDF17.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF17.pdf', '2022-05-20 22:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_menu`
--

CREATE TABLE `frontend_menu` (
  `id_menu` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frontend_menu`
--

INSERT INTO `frontend_menu` (`id_menu`, `label`, `link`, `id`, `sort`) VALUES
(1, 'Home', 'frontend/index', 'Home', 0),
(2, 'Features', 'frontend/features', 'Features', 1),
(3, 'About', 'frontend/about', 'about', 2),
(4, 'Sign in', 'login', 'signin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(33, 'editor', 'Editor'),
(34, 'penulis', 'Penulis'),
(35, 'proofreader', 'Proofreader'),
(36, 'editor sunting', 'Editor Sunting'),
(37, 'desainer', 'Desainer');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 40),
(1, 8),
(1, 89),
(1, 91),
(4, 91),
(1, 93),
(1, 94),
(1, 43),
(1, 44),
(1, 115),
(1, 42),
(1, 117),
(2, 117),
(5, 117),
(6, 117),
(7, 117),
(8, 117),
(9, 117),
(10, 117),
(11, 117),
(12, 117),
(13, 117),
(14, 117),
(15, 117),
(16, 117),
(17, 117),
(18, 117),
(19, 117),
(20, 117),
(21, 117),
(22, 117),
(23, 117),
(24, 117),
(25, 117),
(26, 117),
(27, 117),
(28, 117),
(29, 117),
(1, 125),
(2, 125),
(7, 125),
(8, 125),
(17, 125),
(18, 125),
(24, 125),
(26, 125),
(28, 125),
(29, 125),
(1, 127),
(2, 127),
(1, 114),
(1, 115),
(1, 92),
(1, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(1, 117),
(34, 116),
(33, 118),
(1, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(1, 119),
(1, 120),
(36, 121),
(1, 122),
(1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kti`
--

CREATE TABLE `jenis_kti` (
  `id_kti` int(11) NOT NULL,
  `nama_kti` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kti`
--

INSERT INTO `jenis_kti` (`id_kti`, `nama_kti`) VALUES
(9, 'Artikel'),
(10, 'Makalah'),
(11, 'Skripsi'),
(12, 'Tesis'),
(13, 'Paper'),
(14, 'Disertasi');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 99,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 18, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 16, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 13, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 10, 2, 92, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 11, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 12, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 17, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(92, 7, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(107, 14, 2, 40, 'fas fa-cog', 'Setting', 'setting', 'setting', 1),
(109, 15, 2, 40, 'fas fa-align-justify', 'Frontend Menu', 'frontend_menu', 'Frontend Menu', 1),
(114, 8, 2, 92, 'fas fa-edit', 'Status Sunting', 'Status_sunting', 'Status_sunting', 1),
(115, 9, 2, 92, 'fas fa-book', 'Jenis KTI', 'Jenis_kti', 'Jenis_kti', 1),
(116, 2, 2, 1, 'fas fa-check-square', 'Submission', 'Submission', '#', 1),
(117, 3, 2, 1, 'fas fa-check-double', 'List Submission', 'Submission/list', '#', 1),
(118, 4, 2, 1, 'fas fa-check-circle', 'List Submission', 'Submission/list_editor', '#', 1),
(119, 6, 2, 1, 'fas fa-clipboard-list', 'Log Riwayat', 'Riwayat/log', '#', 1),
(120, 5, 2, 1, 'fas fa-book', 'Riwayat Sunting', 'Riwayat/riwayat_sunting', '#', 1),
(121, 1, 2, 1, 'fas fa-check-circle', 'Submission List', 'Submission/list_editors', '#', 1),
(122, 1, 2, 1, 'fas fa-boxes', 'Distribusi', 'Distribusi', '#', 1),
(123, 1, 2, 92, 'fas fa-dollar-sign', 'Paket', 'Paket', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`, `keterangan`) VALUES
(1, 'Penerbitan', 1000000, ''),
(2, 'Penerbitan dan HC', 1450000, ''),
(3, 'Penerbitan dan Cetak 30 A4', 2350000, ''),
(4, 'Penerbitan dan Cetak 30 A5', 1750000, ''),
(5, 'Penerbitan dan Cetak 30 B5', 1900000, ''),
(6, 'Penerbitan, HC dan Cetak 30 A4', 2800000, ''),
(7, 'Penerbitan, HC dan Cetak 30 A5', 2200000, ''),
(8, 'Penerbitan, HC dan Cetak 30 B5', 2350000, ''),
(9, 'Penerbitan dan Cetak 50 A4', 3250000, ''),
(10, 'Penerbitan dan Cetak 50 A5', 2250000, ''),
(11, 'Penerbitan dan Cetak 50 B5', 2500000, ''),
(12, 'Penerbitan, HC dan Cetak 50 A4', 3700000, ''),
(13, 'Penerbitan, HC dan Cetak 50 A5', 2700000, ''),
(14, 'Penerbitan, HC dan Cetak 50 B5', 2950000, '');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kti` int(11) DEFAULT NULL,
  `judul` varchar(256) NOT NULL,
  `edisi` varchar(256) NOT NULL,
  `tgl_submit` date NOT NULL,
  `no_isbn` varchar(50) DEFAULT NULL,
  `file_hakcipta` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kti`, `judul`, `edisi`, `tgl_submit`, `no_isbn`, `file_hakcipta`) VALUES
(30, 14, 'Pengantar Akuntansi', '1', '2022-05-20', NULL, NULL),
(31, 11, 'Sikopet', '2', '2022-05-20', NULL, NULL),
(32, 11, 'Sarijadi', '213', '2022-05-20', NULL, NULL),
(33, 13, 'Penelitian Kecamatan Sukasari', '1', '2022-05-20', NULL, NULL),
(34, 12, 'Coba submit 2', '1', '2022-05-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_plotting` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status_kerjaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_produk`, `id_user`, `tgl_plotting`, `tgl_selesai`, `keterangan`, `status_kerjaan`) VALUES
(78, 30, 51, NULL, NULL, 'Penulis melakukan submit', 11),
(79, 30, 56, '2022-05-20', NULL, '', 10),
(80, 30, 56, NULL, NULL, 'coba', 1),
(81, 31, 51, NULL, NULL, 'Penulis melakukan submit', 11),
(84, 31, 56, '2022-05-20', NULL, NULL, 10),
(85, 32, 51, NULL, NULL, 'Penulis melakukan submit', 11),
(86, 32, 56, '2022-05-20', NULL, NULL, 10),
(87, 32, 56, NULL, '2022-05-20', 'ada typo', 2),
(88, 31, 56, NULL, NULL, 'ada typo dikit', 1),
(89, 33, 51, NULL, NULL, 'Penulis melakukan submit', 11),
(90, 33, 56, '2022-05-20', NULL, NULL, 10),
(91, 33, 56, NULL, NULL, 'diterima', 1),
(92, 34, 51, NULL, NULL, 'Penulis melakukan submit', 11);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `kode`, `nama`, `nilai`) VALUES
(1, 'LogoOrangePress_backgorund.jpg', 'Orange Press', 'www.orange-press.com');

-- --------------------------------------------------------

--
-- Table structure for table `status_sunting`
--

CREATE TABLE `status_sunting` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_sunting`
--

INSERT INTO `status_sunting` (`id_status`, `nama_status`) VALUES
(1, 'Acceptance Submission'),
(2, 'Rejected'),
(3, 'Paid'),
(4, 'Correction'),
(5, 'Approved'),
(6, 'Approved PR'),
(7, 'Layout Processed'),
(8, 'ISBN Processed'),
(9, 'Completed'),
(10, 'Lead Editor Plotted'),
(11, 'Submitted'),
(12, 'Editor Plotted'),
(13, 'Correction PR'),
(14, 'Proses Mencetak'),
(15, 'Selesai Mencetak'),
(16, 'Approve Cetak');

-- --------------------------------------------------------

--
-- Table structure for table `tim_penulis`
--

CREATE TABLE `tim_penulis` (
  `id` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `penulis_ke` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tim_penulis`
--

INSERT INTO `tim_penulis` (`id`, `id_penulis`, `id_produk`, `penulis_ke`, `status`) VALUES
(23, 51, 30, 1, NULL),
(24, 51, 31, 1, NULL),
(25, 51, 32, 1, NULL),
(26, 51, 33, 1, NULL),
(27, 57, 33, 2, NULL),
(28, 51, 34, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(254) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `no_ktp` varchar(16) NOT NULL COMMENT '16 digit',
  `nip` varchar(20) NOT NULL,
  `no_npwp` varchar(15) NOT NULL COMMENT '15 digit',
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL COMMENT '- Laki-Laki\r\n- Perempuan',
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `profesi` varchar(50) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat_instansi` text NOT NULL,
  `email_instansi` varchar(100) NOT NULL,
  `no_telp_instansi` varchar(15) NOT NULL,
  `sc_form_penulis` varchar(256) NOT NULL,
  `sc_ktp` varchar(256) NOT NULL,
  `sc_cv` varchar(256) NOT NULL,
  `sc_npwp` varchar(256) NOT NULL,
  `sc_foto` varchar(256) NOT NULL,
  `bidang_kompetensi` varchar(100) NOT NULL,
  `create_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `active`, `image`, `no_ktp`, `nip`, `no_npwp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `profesi`, `nama_instansi`, `alamat_instansi`, `email_instansi`, `no_telp_instansi`, `sc_form_penulis`, `sc_ktp`, `sc_cv`, `sc_npwp`, `sc_foto`, `bidang_kompetensi`, `create_on`) VALUES
(1, 'admin@muhakbar.com', 'Akbar', 'Admin', '$2y$08$xW6CqiKByp3QEXUKdkHIhu.N6gMFQz3KYh5CsbwgcMc39dxYP7TXi', 1, 'akbr_pp_2.jpg', '', '', '', 'Laki-Laki', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(51, 'penulis1@gmail.com', 'penulis', '1', '$2y$08$t3AEH6.JmraK9cdTPdc7luHfXG36CXkeD1/KzS0HxglMJXDceGDM.', 1, 'ezgif_com-gif-maker.jpg', '123', '123', '123', 'Perempuan', 'asdasd', '1999-11-25', 'asdasdasd', '123213', 'asdasd', 'asdasd', 'asdasd', 'ins@gmail.com', '123213', 'vlcsnap-2022-01-23-12h20m45s850.png', 'vlcsnap-2021-12-21-23h25m07s5171.png', 'Picture1.png', 'Pengumuman_Pembayaran_UTS.pdf', 'Pelaksanaan_KBM_Luring_Semester_Genap_2021-2022.pdf', 'Akuntansi', '2022-05-02 08:55:32'),
(56, 'editor1@gmail.com', 'editor', '1', '$2y$08$b8T715OYXnOr/weBYWE.rOOKO1WJ28DJshEmH5v7rQ7jEtpZbFlDW', 1, 'ezgif_com-gif-maker1.jpg', '123', '123', '123', 'Laki-Laki', 'PURWOREJO', '2022-01-01', 'asdasdasd', '1233', 'asdasd', '', '', '', '', '20210918_071215jpg-20210918101648.jpg', '', '', '', '', 'Informatika', '2022-05-11 13:18:10'),
(57, 'penulis2@gmail.com', 'Penulis', '2', '$2y$08$Slhw7Ac/pceQlshCw9JW..g92SbFWtt/5PYdjHr0HOHoR8j6wdc5K', 1, 'default.jpg', '1234567891123456', '123', '123456789112345', 'Perempuan', 'PURWOREJO', '1999-02-23', 'Jalan Sarijadi Blok 02 No 118 Rt 06/02', '+6289646817762', 'Sekretariat', 'Poltekpos', 'Jalan sariasih', 'asep@poltekpos.ac.id', '123456789112345', 'dummy.jpg', 'dummy1.jpg', 'dummy2.jpg', 'dummy3.jpg', 'dummy4.jpg', 'Bahasa Inggris', '2022-05-13 09:03:39'),
(58, 'editor2@gmail.com', 'editor', '2', '$2y$08$KRuGak76slWG1nwpzRzykehTwAib3eQmR8qcBnmMQHDWrwu6kC7K6', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Perempuan', 'bandung', '2022-05-26', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Informatika', '2022-05-13 19:19:30'),
(59, 'editor3@gmail.com', 'editor', '3', '$2y$08$ctA9DsLeGEHPDtPgpyiHjO0oifqEFgvPINvDgcOhf6DRkCSD38UHG', 1, 'default.jpg', '1234567891123456', '321', '123456789112345', 'Perempuan', 'CIMAHI', '1999-02-11', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:50:21'),
(60, 'editors1@gmail.com', 'editors', '1', '$2y$08$oyu6o617tbjF6aN/A1Mgn.aZ/acZHjjKOKnZL3uWPHrwTKDB555yO', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'CIMAHI', '2022-05-11', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Logistik', '2022-05-14 08:50:57'),
(61, 'editors2@gmail.com', 'editors', '2', '$2y$08$yil1uu3asfQmPKRNWZedneYLYyJz7aejKpBlztviv34W4ywkIBKru', 1, 'default.jpg', '1234567891123456', '123', '123456789112345', 'Laki-Laki', 'asd', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:51:36'),
(62, 'editors3@gmail.com', 'editors', '3', '$2y$08$ey97yTF80EdBSL8AcjEaeOrd2BqNHNQUpI3mY2X6p3T7Vy0cHQaYu', 1, 'default.jpg', '123', '2193013', '123456789112345', 'Laki-Laki', 'bandung', '2022-04-05', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:59:30'),
(63, 'editors4@gmail.com', 'editors', '4', '$2y$08$lUv7b4Qfp4ubBEd3rj3xseBO91v9Y9gxwRac4n/wIjBd/7jUj0jj.', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Perempuan', 'CIMAHI', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Bahasa Inggris', '2022-05-14 09:00:07'),
(64, 'editors5@gmail.com', 'editors', '5', '$2y$08$T4Glbf.x4IlIM7INEzKYEeAdaKscvL0dHKUiaCYkFvZZD5SgiLTma', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'bandung', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Logistik', '2022-05-14 09:00:40'),
(65, 'penuliscoba@gmail.com', 'penulis', 'coba', '$2y$08$6JerADIi0GWWmUO2mbJ3/eV5riSiw8Pk.Lc201BT5QLNkELbkTHiq', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'PURWOREJO', '2016-07-27', 'asdasdasd', '2222222', 'Sekretariat', 'Poltekpos', 'hjasbdhjasd', 'hjasbd@gmail.com', '0899999999', 'Dummy_PDF.pdf', 'Dummy_JPG.jpg', 'Dummy_PDF1.pdf', 'Dummy_PDF2.pdf', 'Dummy_JPG1.jpg', 'Manajemen', '2022-05-19 16:08:16'),
(66, 'penulis20@gmail.com', 'Penulis', '20', '$2y$08$YnETl.bqdL7D5LlJjeaBOeq7CXf3PawmSn5iOhqnOPMTTXn4XtEwq', 1, 'default.jpg', '1234567891123456', '290', '123456789112345', 'Laki-Laki', 'PURWOREJO', '2022-05-20', '1', '1', 'asndkjasdn', 'kjasndkja', 'kjasndkjasdnk', 'kjsandkjsad@kjsandk.com', '786786786', 'Dummy_PDF3.pdf', 'Dummy_PDF4.pdf', 'Dummy_PDF5.pdf', 'Dummy_PDF6.pdf', 'Dummy_PDF7.pdf', 'Akuntansi', '2022-05-20 08:33:57'),
(67, 'penulis21@gmail.com', 'penulis', '21', '$2y$08$mTuOIfp20JpZta0xgSrquO643U5X.GJuDi/hjMzfxXlgeXPh2j7DW', 1, 'default.jpg', '', '', '', 'Laki-Laki', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '2022-05-20 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(24, 1, 1),
(25, 2, 2),
(11, 3, 2),
(10, 4, 2),
(13, 5, 8),
(17, 6, 5),
(19, 7, 6),
(21, 8, 7),
(1, 9, 17),
(90, 12, 2),
(67, 12, 8),
(175, 51, 34),
(182, 56, 33),
(183, 57, 34),
(184, 58, 33),
(185, 59, 33),
(186, 60, 36),
(187, 61, 36),
(188, 62, 36),
(189, 63, 36),
(190, 64, 36),
(191, 65, 34),
(192, 66, 34),
(193, 67, 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_attach`
--
ALTER TABLE `file_attach`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `frontend_menu`
--
ALTER TABLE `frontend_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kti`
--
ALTER TABLE `jenis_kti`
  ADD PRIMARY KEY (`id_kti`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sunting`
--
ALTER TABLE `status_sunting`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tim_penulis`
--
ALTER TABLE `tim_penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `file_attach`
--
ALTER TABLE `file_attach`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `frontend_menu`
--
ALTER TABLE `frontend_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `jenis_kti`
--
ALTER TABLE `jenis_kti`
  MODIFY `id_kti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_sunting`
--
ALTER TABLE `status_sunting`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tim_penulis`
--
ALTER TABLE `tim_penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

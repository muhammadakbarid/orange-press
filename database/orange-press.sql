-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 08:04 AM
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
(3, 41, 10, 'Perpustakaan Daerah Cimahi', '2022-05-23'),
(4, 43, 102, 'Perpustakaan Kota Bandung', '2022-05-25'),
(5, 44, 10, 'Perpustakaan Nasional', '2022-05-27'),
(6, 41, 100, 'Perpustakaan Daerah Sumedang', '2022-05-26'),
(7, 43, 10, 'Perpustakaan Daerah Cianjur', '2022-05-28'),
(8, 43, 90, 'Perpustakaan Kota Bandung', '2022-06-01'),
(9, 41, 10, 'Perpustakaan Cimahi', '2022-05-11'),
(10, 47, 200, 'Perpustakaan Cimahi', '2022-05-27');

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
(17, 92, 'Dummy_PDF17.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF17.pdf', '2022-05-20 22:49:15'),
(18, 119, 'Dummy_PDF18.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF18.pdf', '2022-05-21 13:54:15'),
(19, 125, 'Dummy_PDF6.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF6.docx', '2022-05-21 22:03:27'),
(20, 127, 'Dummy_PDF7.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF7.docx', '2022-05-21 22:30:09'),
(21, 129, 'Dummy_PDF8.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF8.docx', '2022-05-21 22:37:01'),
(22, 133, 'Dummy_PDF9.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF9.docx', '2022-05-21 22:47:26'),
(23, 135, 'Dummy_PDF10.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF10.docx', '2022-05-21 22:58:20'),
(24, 141, 'Dummy_PDF11.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF11.docx', '2022-05-22 18:25:05'),
(25, 150, 'Dummy_PDF12.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF12.docx', '2022-05-22 19:33:28'),
(26, 151, 'Dummy_PDF13.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF13.docx', '2022-05-22 19:48:34'),
(27, 152, 'Dummy_PDF14.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF14.docx', '2022-05-22 19:56:59'),
(28, 153, 'Dummy_PDF15.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF15.docx', '2022-05-22 19:58:00'),
(29, 156, 'Dummy_PDF16.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF16.docx', '2022-05-22 21:17:02'),
(30, 157, 'Dummy_PDF17.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF17.docx', '2022-05-22 21:21:50'),
(31, 158, 'Dummy_PDF18.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF18.docx', '2022-05-22 21:42:36'),
(32, 159, 'Dummy_PDF19.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF19.docx', '2022-05-22 21:43:12'),
(33, 162, 'Dummy_PDF19.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF19.pdf', '2022-05-22 22:30:33'),
(34, 164, 'Dummy_PDF20.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF20.pdf', '2022-05-22 22:44:36'),
(35, 168, 'Dummy_PDF21.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF21.pdf', '2022-05-23 11:43:26'),
(36, 169, 'Dummy_PDF20.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF20.docx', '2022-05-23 17:26:06'),
(37, 175, 'Dummy_PDF21.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF21.docx', '2022-05-23 18:10:20'),
(38, 176, 'Dummy_PDF22.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF22.docx', '2022-05-23 18:10:30'),
(39, 179, 'Dummy_PDF23.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF23.docx', '2022-05-23 18:19:44'),
(40, 180, 'Dummy_PDF24.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF24.docx', '2022-05-23 18:21:29'),
(41, 183, 'Dummy_PDF25.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF25.docx', '2022-05-23 18:22:39'),
(42, 185, 'Dummy_PDF26.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF26.docx', '2022-05-23 18:23:19'),
(43, 192, 'Dummy_PDF27.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF27.docx', '2022-05-24 10:20:04'),
(44, 198, 'Dummy_PDF28.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF28.docx', '2022-05-24 10:57:25'),
(45, 199, 'Dummy_PDF29.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF29.docx', '2022-05-24 10:59:23'),
(46, 202, 'Dummy_PDF30.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF30.docx', '2022-05-24 11:01:41'),
(47, 203, 'Dummy_PDF31.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF31.docx', '2022-05-24 11:01:59'),
(48, 206, 'Dummy_PDF32.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF32.docx', '2022-05-24 11:04:02'),
(49, 208, 'Dummy_PDF33.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF33.docx', '2022-05-24 11:04:47'),
(50, 215, 'Dummy_PDF34.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF34.docx', '2022-05-24 16:55:47'),
(51, 216, 'Dummy_PDF35.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF35.docx', '2022-05-24 21:12:33'),
(52, 224, 'Dummy_PDF36.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF36.docx', '2022-05-27 09:38:10'),
(53, 230, 'Dummy_PDF37.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF37.docx', '2022-05-27 09:42:12'),
(54, 231, 'Dummy_PDF38.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF38.docx', '2022-05-27 09:42:45'),
(55, 234, 'Dummy_PDF39.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF39.docx', '2022-05-27 09:49:12'),
(56, 235, 'Dummy_PDF40.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF40.docx', '2022-05-27 09:49:51'),
(57, 238, 'Dummy_PDF41.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF41.docx', '2022-05-27 09:51:38'),
(58, 244, 'Dummy_PDF42.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF42.docx', '2022-05-28 19:59:07'),
(59, 250, 'Dummy_PDF43.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF43.docx', '2022-05-28 20:15:21'),
(60, 251, 'Dummy_PDF44.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF44.docx', '2022-05-28 20:15:44'),
(61, 254, 'Dummy_PDF45.docx', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF45.docx', '2022-05-28 20:28:40'),
(62, 255, 'Dummy_PDF22.pdf', 'http://localhost/orange-press/assets/uploads/files/file_attach/Dummy_PDF22.pdf', '2022-05-29 10:39:51');

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
(1, 122),
(1, 123),
(36, 121),
(35, 124),
(37, 125),
(34, 127),
(33, 128),
(34, 128),
(35, 128),
(36, 128),
(37, 128),
(0, 129);

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
(4, 26, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 24, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 21, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 18, 2, 92, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 19, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 20, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 25, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(92, 14, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(107, 22, 2, 40, 'fas fa-cog', 'Setting', 'setting', 'setting', 1),
(109, 23, 2, 40, 'fas fa-align-justify', 'Frontend Menu', 'frontend_menu', 'Frontend Menu', 1),
(114, 16, 2, 92, 'fas fa-edit', 'Status Sunting', 'Status_sunting', 'Status_sunting', 1),
(115, 17, 2, 92, 'fas fa-book', 'Jenis KTI', 'Jenis_kti', 'Jenis_kti', 1),
(116, 7, 2, 1, 'fas fa-check-square', 'Submission', 'Submission', '#', 1),
(117, 8, 2, 1, 'fas fa-check-double', 'List Submission', 'Submission/list', '#', 1),
(118, 9, 2, 1, 'fas fa-check-circle', 'List Submission', 'Submission/list_editor', '#', 1),
(119, 11, 2, 1, 'fas fa-clipboard-list', 'Log Riwayat', 'Riwayat/log', '#', 1),
(120, 10, 2, 1, 'fas fa-book', 'Riwayat Sunting', 'Riwayat/riwayat_sunting', '#', 1),
(121, 6, 2, 1, 'fas fa-check-circle', 'Submission List', 'Submission/list_editors', '#', 1),
(122, 4, 2, 1, 'fas fa-boxes', 'Distribusi', 'Distribusi', '#', 1),
(123, 15, 2, 92, 'fas fa-dollar-sign', 'Paket', 'Paket', '#', 1),
(124, 5, 2, 1, 'fas fa-check', 'Submission List', 'Submission/list_editor_proofreader', '#', 1),
(125, 3, 2, 1, 'far fa-check-circle', 'Submission List', 'Submission/list_desainer', '#', 1),
(127, 2, 2, 1, 'fas fa-boxes', 'Distribusi Produk', 'Distribusi/Penulis', '#', 1),
(128, 13, 2, 129, 'fas fa-anchor', 'Riwayat Sunting', 'Riwayat/riwayat_sunting', 'riwayat_sunting_all', 1),
(129, 12, 1, 0, 'fas fa-user-graduate', 'Hidden Menu', '#', '#', 1);

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
  `status` int(11) NOT NULL COMMENT '0 = Belum Lunas\r\n1 = Lunas',
  `bukti_bayar` text DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` int(50) NOT NULL COMMENT 'jenis paket'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_produk`, `tanggal_bayar`, `status`, `bukti_bayar`, `jumlah`, `jenis`) VALUES
(28, 33, '2022-05-21', 1, '', 1500000, 6),
(29, 31, '2022-05-21', 0, 'Dummy_JPG.jpg', 1500000, 9),
(30, 35, '2022-05-21', 1, 'Dummy_JPG1.jpg', 2000000, 1),
(31, 40, '2022-05-21', 1, NULL, 1500000, 12),
(32, 41, '2022-05-22', 1, NULL, 3700000, 12),
(33, 43, '2022-05-23', 1, NULL, 1500000, 1),
(34, 43, '2022-05-23', 1, 'Dummy_JPG2.jpg', 2000000, 14),
(35, 43, '2022-05-23', 0, 'Dummy_PDF.pdf', 2000000, 14),
(36, 44, '2022-05-24', 1, 'Dummy_JPG3.jpg', 3700000, 10),
(37, 44, '2022-05-24', 1, 'Dummy_JPG4.jpg', 2000000, 9),
(38, 46, '2022-05-24', 1, 'Dummy_PDF1.pdf', 2000000, 6),
(39, 47, '2022-05-27', 1, 'Dummy_JPG5.jpg', 3000000, 14),
(40, 47, '2022-05-27', 1, NULL, 4000000, 12),
(41, 48, '2022-05-28', 1, 'Dummy_JPG6.jpg', 1500000, 10);

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
(35, 12, 'Dokter APP', '123', '2022-05-21', NULL, NULL),
(36, 13, 'Top Top an', '1', '2022-05-21', NULL, NULL),
(37, 10, 'Histori Surat', '1', '2022-05-21', NULL, NULL),
(38, 13, 'Akuntansi Pengantar', '1', '2022-05-21', NULL, NULL),
(39, 14, 'Coba edit', '2', '2022-05-21', NULL, NULL),
(40, 12, 'Pingin di edit', '23', '2022-05-21', NULL, NULL),
(41, 12, 'Absensi ABC', '213', '2022-05-22', 'ISBN 978-602-8519-93-11', NULL),
(42, 13, 'Coba Coba', '123', '2022-05-23', NULL, NULL),
(43, 14, 'Penelitian Hutan Meksiko', '123', '2022-05-23', 'ISBN 978-602-8519-93-12', NULL),
(44, 13, '12 Minggu Buku', '2', '2022-05-24', 'ISBN 978-602-8519-93-14', NULL),
(45, 13, 'Penelitian Air Bersih', '12', '2022-05-24', NULL, NULL),
(46, 11, 'Penelitian Sumber Mata Air', '1', '2022-05-24', NULL, NULL),
(47, 12, 'Penelitian A', '11', '2022-05-27', 'ISBN 978-602-8519-93-20', 'Dummy_PDF22.pdf'),
(48, 13, 'Coba Coba', '1', '2022-05-28', NULL, NULL);

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
(115, 33, 51, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(116, 31, 51, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(117, 33, 56, NULL, NULL, 'Pembayaran telah diverifikasi', 17),
(119, 35, 51, NULL, NULL, 'Penulis melakukan submit', 11),
(120, 35, 56, '2022-05-21', NULL, NULL, 10),
(121, 35, 56, NULL, NULL, 'ok', 1),
(122, 35, 51, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(123, 35, 56, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(124, 33, 56, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(125, 36, 59, NULL, NULL, 'Penulis melakukan submit', 11),
(126, 36, 56, '2022-05-21', NULL, NULL, 10),
(127, 37, 58, NULL, NULL, 'Penulis melakukan submit', 11),
(128, 37, 59, '2022-05-21', NULL, NULL, 10),
(129, 38, 66, NULL, NULL, 'Penulis melakukan submit', 11),
(130, 38, 59, '2022-05-21', NULL, NULL, 10),
(131, 37, 59, NULL, '2022-05-21', 'jelek\n|', 2),
(132, 38, 59, NULL, NULL, 'oke', 1),
(133, 39, 59, NULL, NULL, 'Penulis melakukan submit', 11),
(134, 39, 58, '2022-05-21', NULL, NULL, 10),
(135, 40, 66, NULL, NULL, 'Penulis melakukan submit', 11),
(136, 40, 56, '2022-05-21', NULL, NULL, 10),
(137, 40, 56, NULL, NULL, 'oke di kopi', 1),
(138, 40, 66, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(139, 40, 56, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(140, 40, 63, '2022-05-21', NULL, NULL, 12),
(141, 41, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(142, 41, 58, '2022-05-22', NULL, NULL, 10),
(143, 39, 58, NULL, '2022-05-22', 'tolak', 2),
(144, 41, 58, NULL, NULL, '', 1),
(145, 41, 68, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(146, 41, 58, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(149, 41, 63, '2022-05-22', NULL, 'Editor Sunting PLotted', 12),
(150, 41, 63, '2022-05-22', NULL, '123', 4),
(151, 41, 68, '2022-05-22', NULL, 'sudah diperbaiki mohon di cek', 18),
(152, 41, 63, '2022-05-22', NULL, 'tolong perbaiki lagi\r\n', 4),
(153, 41, 68, '2022-05-22', NULL, 'oke sudah', 18),
(154, 41, 63, '2022-05-22', NULL, 'oke sudah ok', 5),
(155, 41, 69, '2022-05-22', NULL, 'Editor Proofreading Plotted', 19),
(156, 41, 69, '2022-05-22', NULL, 'tolong perbaiki', 13),
(157, 41, 68, '2022-05-22', NULL, 'sudah saya perbaiki', 20),
(158, 41, 69, '2022-05-22', NULL, 'masih belum ah', 13),
(159, 41, 68, '2022-05-22', NULL, 'ini udah', 20),
(160, 41, 69, '2022-05-22', NULL, 'okey', 6),
(161, 41, 70, '2022-05-22', NULL, 'Editor Layout Cover Plotted', 21),
(162, 41, 70, '2022-05-22', NULL, 'tolong periksa lagi', 7),
(163, 41, 68, NULL, '2022-05-22', 'desain kurang bagus', 22),
(164, 41, 70, '2022-05-22', NULL, 'saya perbaiki', 7),
(165, 41, 68, NULL, NULL, 'ok sudah sesuai', 8),
(167, 41, 1, NULL, NULL, 'No ISBN : ISBN 978-602-8519-93-11', 9),
(168, 42, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(169, 43, 71, NULL, NULL, 'Penulis melakukan submit', 11),
(170, 43, 59, '2022-05-23', NULL, 'Lead Editor Plotted', 10),
(171, 43, 59, NULL, NULL, '', 1),
(172, 43, 71, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(173, 43, 59, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(174, 43, 60, '2022-05-23', NULL, 'Editor Sunting PLotted', 12),
(175, 43, 60, '2022-05-23', NULL, 'perbaiki', 4),
(176, 43, 71, '2022-05-23', NULL, 'oke sudah', 18),
(177, 43, 60, '2022-05-23', NULL, '', 5),
(178, 43, 69, '2022-05-23', NULL, 'Editor Proofreading Plotted', 19),
(179, 43, 69, '2022-05-23', NULL, 'typo\r\n', 13),
(180, 43, 71, '2022-05-23', NULL, 'sudah', 20),
(181, 43, 69, '2022-05-23', NULL, '', 6),
(182, 43, 70, '2022-05-23', NULL, 'Editor Layout Cover Plotted', 21),
(183, 43, 70, '2022-05-23', NULL, '123', 7),
(184, 43, 71, NULL, '2022-05-23', 'masih kurang tepat', 22),
(185, 43, 70, '2022-05-23', NULL, 'sudah', 7),
(186, 43, 71, NULL, NULL, 'udah bagus', 8),
(187, 43, 1, NULL, NULL, 'No ISBN : ISBN 978-602-8519-93-12', 9),
(189, 43, 71, NULL, NULL, 'Penulis melakukan pembayaran', 23),
(190, 43, 1, NULL, NULL, 'Pembayaran telah diverifikasi, Proses cetak dimulai', 14),
(191, 43, 1, NULL, NULL, 'Proses cetak selesai', 9),
(192, 44, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(193, 44, 58, '2022-05-24', NULL, 'Lead Editor Plotted', 10),
(194, 44, 58, NULL, NULL, '', 1),
(195, 44, 68, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(196, 44, 58, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(197, 44, 64, '2022-05-24', NULL, 'Editor Sunting PLotted', 12),
(198, 44, 64, '2022-05-24', NULL, 'ada perbaikan', 4),
(199, 44, 68, '2022-05-24', NULL, 'sudah diperbaiki', 18),
(200, 44, 64, '2022-05-24', NULL, 'saya setujui', 5),
(201, 44, 69, '2022-05-24', NULL, 'Editor Proofreading Plotted', 19),
(202, 44, 69, '2022-05-24', NULL, 'typo', 13),
(203, 44, 68, '2022-05-24', NULL, 'saya perbaiki', 20),
(204, 44, 69, '2022-05-24', NULL, 'oke sudah sesuai', 6),
(205, 44, 70, '2022-05-24', NULL, 'Editor Layout Cover Plotted', 21),
(206, 44, 70, '2022-05-24', NULL, 'apakah sudah sesuai?', 7),
(207, 44, 68, NULL, '2022-05-24', 'belum, warna kurang oke', 22),
(208, 44, 70, '2022-05-24', NULL, 'sudah di perbaiki warnanya', 7),
(209, 44, 68, NULL, NULL, 'sudah saya setujui', 8),
(210, 44, 1, NULL, NULL, 'No ISBN : ISBN 978-602-8519-93-14', 9),
(211, 44, 68, NULL, NULL, 'Penulis melakukan pembayaran', 23),
(212, 44, 1, NULL, NULL, 'Pembayaran telah diverifikasi, Proses cetak dimulai', 14),
(213, 44, 1, NULL, NULL, 'Proses cetak selesai', 9),
(214, 42, 58, '2022-05-24', NULL, 'Lead Editor Plotted', 10),
(215, 45, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(216, 46, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(219, 46, 58, '2022-05-24', NULL, 'Lead Editor Plotted', 10),
(220, 46, 58, NULL, NULL, 'saya setujui', 1),
(221, 46, 68, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(222, 46, 58, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(223, 46, 63, '2022-05-24', NULL, 'Editor Sunting PLotted', 12),
(224, 47, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(225, 47, 58, '2022-05-27', NULL, 'Lead Editor Plotted', 10),
(226, 47, 58, NULL, NULL, 'saya setujui', 1),
(227, 47, 68, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(228, 47, 58, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(229, 47, 62, '2022-05-27', NULL, 'Editor Sunting PLotted', 12),
(230, 47, 62, '2022-05-27', NULL, 'masih ada typo', 4),
(231, 47, 68, '2022-05-27', NULL, 'saya sudah perbaiki', 18),
(232, 47, 62, '2022-05-27', NULL, 'ok saya setujui', 5),
(233, 47, 69, '2022-05-27', NULL, 'Editor Proofreading Plotted', 19),
(234, 47, 69, '2022-05-27', NULL, 'masih ada typo di bagian a', 13),
(235, 47, 68, '2022-05-27', NULL, 'jhasdj', 20),
(236, 47, 69, '2022-05-27', NULL, 'ok', 6),
(237, 47, 73, '2022-05-27', NULL, 'Editor Layout Cover Plotted', 21),
(238, 47, 73, '2022-05-27', NULL, 'sudah saya tambahkan', 7),
(239, 47, 68, NULL, NULL, 'ok saya terima', 8),
(240, 47, 1, NULL, NULL, 'No ISBN : ISBN 978-602-8519-93-20', 9),
(241, 47, 68, NULL, NULL, 'Penulis melakukan pembayaran', 23),
(242, 47, 1, NULL, NULL, 'Pembayaran telah diverifikasi, Proses cetak dimulai', 14),
(243, 47, 1, NULL, NULL, 'Proses cetak selesai', 9),
(244, 48, 68, NULL, NULL, 'Penulis melakukan submit', 11),
(245, 48, 59, '2022-05-28', NULL, 'Lead Editor Plotted', 10),
(246, 48, 59, NULL, NULL, '', 1),
(247, 48, 68, NULL, NULL, 'Penulis melakukan pembayaran', 17),
(248, 48, 59, NULL, NULL, 'Pembayaran telah diverifikasi', 3),
(249, 48, 63, '2022-05-28', NULL, 'Editor Sunting PLotted', 12),
(250, 48, 63, '2022-05-28', NULL, 'ok', 4),
(251, 48, 68, '2022-05-28', NULL, 'ok sudah diperbaiki', 18),
(252, 48, 63, '2022-05-28', NULL, 'ok sudah saya approve', 5),
(253, 48, 72, '2022-05-28', NULL, 'Editor Proofreading Plotted', 19),
(254, 48, 72, '2022-05-28', NULL, 'saya perbaiki typonya', 13),
(255, 47, 1, '2022-05-29', NULL, NULL, 24);

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
(16, 'Approve Cetak'),
(17, 'Waiting for Payment Verification'),
(18, 'Correction : Resubmit'),
(19, 'Proofreading Plotted'),
(20, 'Proofreading : Resubmit'),
(21, 'Desainer Plotted'),
(22, 'Layout Cover + Dummy Rejected'),
(23, 'Waiting for Payment Verification (Admin)'),
(24, 'File Hak Cipta Added');

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
(28, 51, 34, 1, NULL),
(29, 51, 35, 1, NULL),
(30, 51, 36, 1, NULL),
(31, 57, 37, 1, NULL),
(32, 65, 37, 2, NULL),
(33, 51, 38, 1, NULL),
(34, 66, 39, 1, NULL),
(35, 51, 40, 1, NULL),
(36, 66, 41, 1, NULL),
(37, 68, 41, 2, NULL),
(38, 51, 42, 1, NULL),
(39, 51, 43, 1, NULL),
(40, 57, 43, 2, NULL),
(41, 51, 44, 1, NULL),
(42, 51, 45, 1, NULL),
(43, 51, 46, 1, NULL),
(44, 66, 46, 2, NULL),
(45, 51, 47, 1, NULL),
(46, 57, 47, 2, NULL),
(47, 51, 48, 1, NULL);

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
  `no_ktp` varchar(16) DEFAULT NULL COMMENT '16 digit',
  `nip` varchar(20) DEFAULT NULL,
  `no_npwp` varchar(15) DEFAULT NULL COMMENT '15 digit',
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL COMMENT '- Laki-Laki\r\n- Perempuan',
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `profesi` varchar(50) DEFAULT NULL,
  `nama_instansi` varchar(100) DEFAULT NULL,
  `alamat_instansi` text DEFAULT NULL,
  `email_instansi` varchar(100) DEFAULT NULL,
  `no_telp_instansi` varchar(15) DEFAULT NULL,
  `sc_form_penulis` varchar(256) DEFAULT NULL,
  `sc_ktp` varchar(256) DEFAULT NULL,
  `sc_cv` varchar(256) DEFAULT NULL,
  `sc_npwp` varchar(256) DEFAULT NULL,
  `sc_foto` varchar(256) DEFAULT NULL,
  `bidang_kompetensi` varchar(100) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `active`, `image`, `no_ktp`, `nip`, `no_npwp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `profesi`, `nama_instansi`, `alamat_instansi`, `email_instansi`, `no_telp_instansi`, `sc_form_penulis`, `sc_ktp`, `sc_cv`, `sc_npwp`, `sc_foto`, `bidang_kompetensi`, `create_on`) VALUES
(1, 'admin@muhakbar.com', 'Akbar', 'Admin', '$2y$08$xW6CqiKByp3QEXUKdkHIhu.N6gMFQz3KYh5CsbwgcMc39dxYP7TXi', 1, 'akbr_pp_2.jpg', '', '', '', 'Laki-Laki', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(51, 'penulis1@gmail.com', 'penulis', '1', '$2y$08$t3AEH6.JmraK9cdTPdc7luHfXG36CXkeD1/KzS0HxglMJXDceGDM.', 1, 'ezgif_com-gif-maker.jpg', '123', '123', '123', 'Perempuan', 'asdasd', '1999-11-25', 'asdasdasd', '123213', 'asdasd', 'asdasd', 'asdasd', 'ins@gmail.com', '123213', 'vlcsnap-2022-01-23-12h20m45s850.png', 'vlcsnap-2021-12-21-23h25m07s5171.png', 'Picture1.png', 'Pengumuman_Pembayaran_UTS.pdf', 'Pelaksanaan_KBM_Luring_Semester_Genap_2021-2022.pdf', 'Akuntansi', '2022-05-02 08:55:32'),
(56, 'editor1@gmail.com', 'Lead editor', '1', '$2y$08$b8T715OYXnOr/weBYWE.rOOKO1WJ28DJshEmH5v7rQ7jEtpZbFlDW', 1, 'Dummy_JPG.jpg', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '1233', NULL, NULL, NULL, NULL, NULL, '20210918_071215jpg-20210918101648.jpg', '', '', '', '', NULL, '2022-05-11 13:18:10'),
(57, 'penulis2@gmail.com', 'Penulis', '2', '$2y$08$Slhw7Ac/pceQlshCw9JW..g92SbFWtt/5PYdjHr0HOHoR8j6wdc5K', 1, 'default.jpg', '1234567891123456', '123', '123456789112345', 'Perempuan', 'PURWOREJO', '1999-02-23', 'Jalan Sarijadi Blok 02 No 118 Rt 06/02', '+6289646817762', 'Sekretariat', 'Poltekpos', 'Jalan sariasih', 'asep@poltekpos.ac.id', '123456789112345', 'dummy.jpg', 'dummy1.jpg', 'dummy2.jpg', 'dummy3.jpg', 'dummy4.jpg', 'Bahasa Inggris', '2022-05-13 09:03:39'),
(58, 'editor2@gmail.com', 'Lead editor', '2', '$2y$08$KRuGak76slWG1nwpzRzykehTwAib3eQmR8qcBnmMQHDWrwu6kC7K6', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Perempuan', 'bandung', '2022-05-26', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Informatika', '2022-05-13 19:19:30'),
(59, 'editor3@gmail.com', 'Lead editor', '3', '$2y$08$ctA9DsLeGEHPDtPgpyiHjO0oifqEFgvPINvDgcOhf6DRkCSD38UHG', 1, 'default.jpg', '1234567891123456', '321', '123456789112345', 'Perempuan', 'CIMAHI', '1999-02-11', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:50:21'),
(60, 'editors1@gmail.com', 'editors', '1', '$2y$08$oyu6o617tbjF6aN/A1Mgn.aZ/acZHjjKOKnZL3uWPHrwTKDB555yO', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'CIMAHI', '2022-05-11', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Logistik', '2022-05-14 08:50:57'),
(61, 'editors2@gmail.com', 'editors', '2', '$2y$08$yil1uu3asfQmPKRNWZedneYLYyJz7aejKpBlztviv34W4ywkIBKru', 1, 'default.jpg', '1234567891123456', '123', '123456789112345', 'Laki-Laki', 'asd', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:51:36'),
(62, 'editors3@gmail.com', 'editors', '3', '$2y$08$ey97yTF80EdBSL8AcjEaeOrd2BqNHNQUpI3mY2X6p3T7Vy0cHQaYu', 1, 'default.jpg', '123', '2193013', '123456789112345', 'Laki-Laki', 'bandung', '2022-04-05', 'asdasdasd', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Akuntansi', '2022-05-14 08:59:30'),
(63, 'editors4@gmail.com', 'editors', '4', '$2y$08$lUv7b4Qfp4ubBEd3rj3xseBO91v9Y9gxwRac4n/wIjBd/7jUj0jj.', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Perempuan', 'CIMAHI', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Bahasa Inggris', '2022-05-14 09:00:07'),
(64, 'editors5@gmail.com', 'editors', '5', '$2y$08$T4Glbf.x4IlIM7INEzKYEeAdaKscvL0dHKUiaCYkFvZZD5SgiLTma', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'bandung', '2022-05-11', 'asdasdasd', '', 'asdasd', '', '', '', '', '', '', '', '', '', 'Logistik', '2022-05-14 09:00:40'),
(65, 'penuliscoba@gmail.com', 'penulis', 'coba', '$2y$08$6JerADIi0GWWmUO2mbJ3/eV5riSiw8Pk.Lc201BT5QLNkELbkTHiq', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'PURWOREJO', '2016-07-27', 'asdasdasd', '2222222', 'Sekretariat', 'Poltekpos', 'hjasbdhjasd', 'hjasbd@gmail.com', '0899999999', 'Dummy_PDF.pdf', 'Dummy_JPG.jpg', 'Dummy_PDF1.pdf', 'Dummy_PDF2.pdf', 'Dummy_JPG1.jpg', 'Manajemen', '2022-05-19 16:08:16'),
(66, 'penulis20@gmail.com', 'Penulis', '20', '$2y$08$YnETl.bqdL7D5LlJjeaBOeq7CXf3PawmSn5iOhqnOPMTTXn4XtEwq', 1, 'default.jpg', '1234567891123456', '290', '123456789112345', 'Laki-Laki', 'PURWOREJO', '2022-05-20', '1', '1', 'asndkjasdn', 'kjasndkja', 'kjasndkjasdnk', 'kjsandkjsad@kjsandk.com', '786786786', 'Dummy_PDF3.pdf', 'Dummy_PDF4.pdf', 'Dummy_PDF5.pdf', 'Dummy_PDF6.pdf', 'Dummy_PDF7.pdf', 'Akuntansi', '2022-05-20 08:33:57'),
(67, 'penulis21@gmail.com', 'penulis', '21', '$2y$08$mTuOIfp20JpZta0xgSrquO643U5X.GJuDi/hjMzfxXlgeXPh2j7DW', 1, 'default.jpg', '', '', '', 'Laki-Laki', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '2022-05-20 08:56:09'),
(68, 'penulis30@gmail.com', 'Penulis', '30', '$2y$08$fnq/ZkCYNrTy94nMVK7HaepR.FSgdta8nmzkXOT0.EV9d5w3Qhpnu', 1, 'default.jpg', '1234567891123456', '2193013', '123456789112345', 'Laki-Laki', 'PURWOREJO', '1999-09-05', 'Jalan Sarijadi', '089464817762', 'Sekretariat', 'Poltekpos', 'asdsadasd', 'a@a.com', '123456789112345', 'Dummy_JPG2.jpg', 'Dummy_JPG3.jpg', 'Dummy_JPG4.jpg', 'Dummy_JPG5.jpg', 'Dummy_JPG.jpg', 'Manajemen', '2022-05-22 18:22:10'),
(69, 'proofreader1@gmail.com', 'Proofreader', '1', '$2y$08$5Cg0fJJCxlKlToJlOxbqh.7hNMJd6OI2A85v3NpwPxNva0DC8cdZq', 1, 'default.jpg', '1234567891123456', '321', '123456789112345', 'Laki-Laki', 'PURWOREJO', '1999-09-22', 'ghvghvghvghv', '', 'Sekretariat', '', '', '', '', '', '', '', '', '', 'Informatika', '2022-05-22 20:39:50'),
(70, 'desainer1@gmail.com', 'Desainer', '1', '$2y$08$8RMUfK2KOQk7ZzN1IHCckuHSwgOevCiq6.MM5qJTTLmtIvJwj8L7.', 1, 'default.jpg', '1234567891123456', '321', '123456789112345', 'Laki-Laki', 'CIMAHI', '2022-05-12', 'asdsadasd', '', 'asndkjasdn', '', '', '', '', '', '', '', '', '', 'Informatika', '2022-05-22 22:02:33'),
(71, 'penulis40@gmail.com', 'Penulis', '40', '$2y$08$GLqREKoV0f2wrCKJINiky.uol3rlJqLdKsftdRcQuJb7nhu/DHpM6', 1, 'default.jpg', '1234567891123456', '21930132', '123456789112345', 'Perempuan', 'PURWOREJO', '2022-05-11', 'kjdsbnfkjnkj', '89789789', 'kjasdkjasdkj', 'jasndjasdn', 'hjasbdhjasbdhj', 'muh@gmail.com', '213213', 'Dummy_PDF8.pdf', 'Dummy_PDF9.pdf', 'Dummy_PDF10.pdf', 'Dummy_PDF11.pdf', 'Dummy_PDF12.pdf', 'Humaniora', '2022-05-23 17:23:20'),
(72, 'proofreader2@gmail.com', 'Proofreader', '2', '$2y$08$01Hk9Zawna6Xs2mYp7T2HuJh0qVFSNad6AN3.8dPIAP3.aIfSW9ku', 1, 'default.jpg', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '200002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-24 13:13:03'),
(73, 'desainer2@gmail.com', 'Desainer', '2', '$2y$08$qapm2BynB8Uxq3l8rBIGSuiiXxcJvQhrpJu2ZNfnpUC/Ol8ghScIm', 1, 'default.jpg', NULL, NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-24 13:41:40');

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
(198, 56, 33),
(183, 57, 34),
(199, 58, 33),
(200, 59, 33),
(186, 60, 36),
(187, 61, 36),
(188, 62, 36),
(189, 63, 36),
(190, 64, 36),
(191, 65, 34),
(192, 66, 34),
(193, 67, 34),
(194, 68, 34),
(195, 69, 35),
(196, 70, 37),
(197, 71, 34),
(201, 72, 35),
(202, 73, 37);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_last_riwayat`
-- (See below for the actual view)
--
CREATE TABLE `v_last_riwayat` (
`id_riwayat` int(11)
,`id_produk` int(11)
,`id_user` int(11)
,`tgl_plotting` date
,`tgl_selesai` date
,`keterangan` text
,`status_kerjaan` int(11)
,`rn` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `v_last_riwayat`
--
DROP TABLE IF EXISTS `v_last_riwayat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_last_riwayat`  AS  (select `ranked_messages`.`id_riwayat` AS `id_riwayat`,`ranked_messages`.`id_produk` AS `id_produk`,`ranked_messages`.`id_user` AS `id_user`,`ranked_messages`.`tgl_plotting` AS `tgl_plotting`,`ranked_messages`.`tgl_selesai` AS `tgl_selesai`,`ranked_messages`.`keterangan` AS `keterangan`,`ranked_messages`.`status_kerjaan` AS `status_kerjaan`,`ranked_messages`.`rn` AS `rn` from (select `riwayat`.`id_riwayat` AS `id_riwayat`,`riwayat`.`id_produk` AS `id_produk`,`riwayat`.`id_user` AS `id_user`,`riwayat`.`tgl_plotting` AS `tgl_plotting`,`riwayat`.`tgl_selesai` AS `tgl_selesai`,`riwayat`.`keterangan` AS `keterangan`,`riwayat`.`status_kerjaan` AS `status_kerjaan`,row_number() over ( partition by `riwayat`.`id_produk` order by `riwayat`.`id_riwayat` desc) AS `rn` from `riwayat`) `ranked_messages` where `ranked_messages`.`rn` = 1) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file_attach`
--
ALTER TABLE `file_attach`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

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
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_sunting`
--
ALTER TABLE `status_sunting`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tim_penulis`
--
ALTER TABLE `tim_penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

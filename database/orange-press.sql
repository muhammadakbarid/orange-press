-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 12:44 PM
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
-- Table structure for table `file_attach`
--

CREATE TABLE `file_attach` (
  `id_file` int(11) NOT NULL,
  `id_riwayat` int(11) NOT NULL,
  `nama_file` varchar(256) NOT NULL,
  `url_file` varchar(256) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'members', 'General User'),
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
(1, 1),
(2, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(1, 3),
(2, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(1, 118),
(5, 118),
(6, 118),
(7, 118),
(8, 118),
(9, 118),
(10, 118),
(11, 118),
(12, 118),
(13, 118),
(14, 118),
(15, 118),
(16, 118),
(17, 118),
(18, 118),
(19, 118),
(20, 118),
(21, 118),
(22, 118),
(23, 118),
(24, 118),
(25, 118),
(26, 118),
(27, 118),
(28, 118),
(29, 118),
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
(1, 115);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kti`
--

CREATE TABLE `jenis_kti` (
  `id_kti` int(11) NOT NULL,
  `nama_kti` varchar(256) NOT NULL,
  `harga_terbit` int(11) NOT NULL,
  `nama_paket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 11, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 9, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 6, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 3, 2, 92, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 4, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 5, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 10, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(92, 2, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(107, 7, 2, 40, 'fas fa-cog', 'Setting', 'setting', 'setting', 1),
(109, 8, 2, 40, 'fas fa-align-justify', 'Frontend Menu', 'frontend_menu', 'Frontend Menu', 1),
(114, 1, 2, 92, 'fas fa-edit', 'Status Sunting', 'Status_sunting', 'Status_sunting', 1),
(115, 1, 2, 92, 'fas fa-book', 'Jenis KTI', 'Jenis_kti', 'Jenis_kti', 1);

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
  `id_kti` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `edisi` varchar(256) NOT NULL,
  `tgl_submit` date NOT NULL,
  `no_isbn` varchar(50) NOT NULL,
  `file_hakcipta` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riyawat`
--

CREATE TABLE `riyawat` (
  `id_riwayat` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_plotting` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_kerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `tim_penulis`
--

CREATE TABLE `tim_penulis` (
  `id` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `penulis_ke` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tanggal_lahir` date NOT NULL,
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
  `create_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `active`, `image`, `no_ktp`, `nip`, `no_npwp`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `profesi`, `nama_instansi`, `alamat_instansi`, `email_instansi`, `no_telp_instansi`, `sc_form_penulis`, `sc_ktp`, `sc_cv`, `sc_npwp`, `sc_foto`, `bidang_kompetensi`, `create_on`) VALUES
(1, 'admin@muhakbar.com', 'Akbar', 'Admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', 1, 'akbr_pp_2.jpg', '', '', '', 'Laki-Laki', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(46, 'member@muhakbar.com', 'akbar', 'member', '$2y$08$I8//I82woWY5EUsaK5RV/.m28pLCMxwpg9nPEgijrh4rLSi37BEeu', 1, 'default.jpg', '', '', '', 'Laki-Laki', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(48, 'coba@gmail.com', 'coba', '1', '$2y$08$Lt7VVxsYwGjVtJ0AtsYhUeUILx8iNhOd89UfEYxx18M/T6iq6rkYi', 1, 'default.jpg', '', '', '', 'Laki-Laki', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00');

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
(123, 46, 2),
(126, 48, 2);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `riyawat`
--
ALTER TABLE `riyawat`
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
-- AUTO_INCREMENT for table `file_attach`
--
ALTER TABLE `file_attach`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_kti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riyawat`
--
ALTER TABLE `riyawat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_sunting`
--
ALTER TABLE `status_sunting`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_penulis`
--
ALTER TABLE `tim_penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

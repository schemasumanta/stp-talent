-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.22-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table db_talent_hub.tbl_admin_role
CREATE TABLE IF NOT EXISTS `tbl_admin_role` (
  `admin_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_talent_hub.tbl_admin_role: ~10 rows (lebih kurang)
INSERT INTO `tbl_admin_role` (`admin_role_id`, `user_id`, `role_id`) VALUES
	(38, 1, 1),
	(39, 1, 2),
	(40, 1, 3),
	(41, 1, 4),
	(42, 1, 5),
	(43, 1, 6),
	(44, 1, 7),
	(45, 1, 8),
	(46, 1, 9),
	(48, 38, 7);

-- membuang struktur untuk table db_talent_hub.tbl_bahasa_resume
CREATE TABLE IF NOT EXISTS `tbl_bahasa_resume` (
  `bahasa_resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bahasa_id` int(11) NOT NULL,
  `resume_bahasa_level` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bahasa_resume_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_bahasa_resume: ~2 rows (lebih kurang)
INSERT INTO `tbl_bahasa_resume` (`bahasa_resume_id`, `user_id`, `bahasa_id`, `resume_bahasa_level`) VALUES
	(12, 3, 1, 0),
	(13, 3, 2, 1);

-- membuang struktur untuk table db_talent_hub.tbl_chat
CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `chat_id` varchar(16) NOT NULL,
  `chat_pengirim` int(11) NOT NULL,
  `chat_penerima` int(11) NOT NULL,
  `chat_isi` text NOT NULL,
  `chat_tanggal` datetime NOT NULL,
  `chat_lampiran` text NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_chat: ~12 rows (lebih kurang)
INSERT INTO `tbl_chat` (`chat_id`, `chat_pengirim`, `chat_penerima`, `chat_isi`, `chat_tanggal`, `chat_lampiran`) VALUES
	('baHFuIVDYXIUmfKC', 32, 34, '', '2022-08-03 19:55:51', ''),
	('chC5cOm49Z9OBFJS', 32, 1, '', '2022-08-03 19:55:38', ''),
	('cOqO2TxPH4Kjr8Gk', 3, 34, '', '2022-07-29 17:33:34', ''),
	('gVnLEEBEuktUvOIj', 3, 33, '', '2022-07-29 21:51:44', ''),
	('hG4NvrkRSatJJWrj', 3, 6364, '', '2022-08-09 23:51:21', ''),
	('KhonU5WS6xBeQ315', 32, 4, '', '2022-08-03 19:55:45', ''),
	('lzY7Ga3NtDUBiezQ', 3, 35, '', '2022-07-29 23:30:15', ''),
	('MFf59Qr0SQFihXBW', 32, 33, '', '2022-08-03 19:27:42', ''),
	('OqEjZmBMvkmMGpXc', 1, 3, '', '2022-08-08 20:19:21', ''),
	('qg0JeCJ7nkmeRZTL', 3, 3, '', '2022-07-30 00:30:30', ''),
	('r8mGzt5lKFYSumrf', 3, 4, '', '2022-07-29 21:47:02', ''),
	('xrAxn9L834mkDxUW', 36, 4, '', '2022-08-02 15:21:31', ''),
	('zQ51PFO4FElmKDae', 3, 32, '', '2022-07-29 17:31:28', '');

-- membuang struktur untuk table db_talent_hub.tbl_history
CREATE TABLE IF NOT EXISTS `tbl_history` (
  `kode_history` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(50) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` text NOT NULL,
  PRIMARY KEY (`kode_history`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_history: ~202 rows (lebih kurang)
INSERT INTO `tbl_history` (`kode_history`, `tanggal`, `ip_address`, `id_user`, `aktivitas`) VALUES
	(13, '2022-07-04 08:10:44', '::1', 1, 'Menambah Data Skill Baru Corel Draw'),
	(14, '2022-07-04 08:11:53', '::1', 1, 'Menambah Data Skill Baru Corel Draw'),
	(15, '2022-07-04 08:15:34', '::1', 1, 'Menambah Data Skill Baru Corel Draw'),
	(16, '2022-07-04 08:20:44', '::1', 1, 'Mengubah Data Skill Corel Draw 2'),
	(17, '2022-07-04 08:20:50', '::1', 1, 'Mengubah Data Skill Corel Draw'),
	(18, '2022-07-04 08:20:58', '::1', 1, 'Mengubah Data Skill Corel Draw'),
	(19, '2022-07-04 08:26:24', '::1', 1, 'Menambah Data Skill Baru Adobe Photoshop'),
	(20, '2022-07-04 08:26:35', '::1', 1, 'Menambah Data Skill Baru Codeigniter'),
	(21, '2022-07-04 08:26:41', '::1', 1, 'Menambah Data Skill Baru Java'),
	(22, '2022-07-04 08:26:48', '::1', 1, 'Menambah Data Skill Baru Python'),
	(23, '2022-07-04 08:41:46', '::1', 1, 'Mengubah Data Level job_seeker2'),
	(24, '2022-07-04 08:41:51', '::1', 1, 'Mengubah Data Level job_seeker'),
	(25, '2022-07-04 08:41:57', '::1', 1, 'Menambah Data Level Baru test'),
	(26, '2022-07-04 08:42:02', '::1', 1, 'Mengubah Data Level test2'),
	(27, '2022-07-04 08:48:24', '::1', 1, 'Menambah Data Agama Baru Islam'),
	(28, '2022-07-04 08:49:34', '::1', 1, 'Menambah Data Agama Baru Protestan'),
	(29, '2022-07-04 08:49:42', '::1', 1, 'Menambah Data Agama Baru Katholik'),
	(30, '2022-07-04 08:49:53', '::1', 1, 'Menambah Data Agama Baru Hindu'),
	(31, '2022-07-04 08:50:01', '::1', 1, 'Menambah Data Agama Baru Buddha'),
	(32, '2022-07-04 08:50:23', '::1', 1, 'Menambah Data Agama Baru Konghucu'),
	(33, '2022-07-04 08:53:56', '::1', 1, 'Mengubah Data Agama Buddha2'),
	(34, '2022-07-04 08:54:00', '::1', 1, 'Mengubah Data Agama Buddha'),
	(35, '2022-07-04 08:57:04', '::1', 1, 'Menambah Data Pendidikan Baru SD'),
	(36, '2022-07-04 08:57:24', '::1', 1, 'Menambah Data Pendidikan Baru SMP/SLTP'),
	(37, '2022-07-04 08:57:34', '::1', 1, 'Menambah Data Pendidikan Baru SMA/SLTA/SMK'),
	(38, '2022-07-04 08:57:44', '::1', 1, 'Mengubah Data Pendidikan SMP/SLTP/MTs'),
	(39, '2022-07-04 08:57:53', '::1', 1, 'Menambah Data Pendidikan Baru D1'),
	(40, '2022-07-04 08:57:57', '::1', 1, 'Menambah Data Pendidikan Baru D2'),
	(41, '2022-07-04 08:58:01', '::1', 1, 'Menambah Data Pendidikan Baru D3'),
	(42, '2022-07-04 08:58:06', '::1', 1, 'Menambah Data Pendidikan Baru S1'),
	(43, '2022-07-04 08:58:10', '::1', 1, 'Menambah Data Pendidikan Baru S2'),
	(44, '2022-07-04 08:58:14', '::1', 1, 'Menambah Data Pendidikan Baru S3'),
	(45, '2022-07-05 07:33:07', '::1', 1, 'Menambah Data Agama Baru ere'),
	(46, '2022-07-11 12:50:02', '::1', 1, 'Menambah Data Bahasa Baru Indonesia'),
	(47, '2022-07-11 12:50:09', '::1', 1, 'Menambah Data Bahasa Baru English'),
	(48, '2022-07-11 12:50:16', '::1', 1, 'Menambah Data Bahasa Baru Mandarin'),
	(49, '2022-07-11 12:50:24', '::1', 1, 'Menambah Data Bahasa Baru Jepang'),
	(50, '2022-07-11 12:50:38', '::1', 1, 'Menambah Data Bahasa Baru Spanyol'),
	(51, '2022-07-11 12:56:33', '::1', 1, 'Menambah Data Jabatan Baru IT Staff'),
	(52, '2022-07-11 12:56:41', '::1', 1, 'Menambah Data Jabatan Baru IT Support'),
	(53, '2022-07-11 12:56:52', '::1', 1, 'Menambah Data Jabatan Baru Sales Representative'),
	(54, '2022-07-11 12:56:59', '::1', 1, 'Menambah Data Jabatan Baru Receptionist'),
	(55, '2022-07-11 12:57:05', '::1', 1, 'Menambah Data Jabatan Baru Office Boy'),
	(56, '2022-07-11 12:57:17', '::1', 1, 'Menambah Data Jabatan Baru IT Programmer'),
	(57, '2022-07-11 12:57:25', '::1', 1, 'Menambah Data Jabatan Baru IT Support'),
	(58, '2022-07-11 13:13:21', '::1', 1, 'Menambah Data Level Skill Baru Beginner'),
	(59, '2022-07-11 13:14:09', '::1', 1, 'Mengubah Data Level Skill Pemula'),
	(60, '2022-07-11 13:14:17', '::1', 1, 'Mengubah Data Level Skill Beginner'),
	(61, '2022-07-11 13:15:23', '::1', 1, 'Menambah Data Level Skill Baru Intermediate'),
	(62, '2022-07-11 13:15:30', '::1', 1, 'Menambah Data Level Skill Baru Professional'),
	(63, '2022-07-11 13:48:04', '::1', NULL, 'Menambah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(64, '2022-07-11 14:16:33', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(65, '2022-07-11 14:16:48', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(66, '2022-07-11 14:17:07', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(67, '2022-07-11 15:18:34', '::1', 1, 'Menambah Data Slider Baru '),
	(68, '2022-07-11 15:26:31', '::1', 1, 'Menambah Data Slider Baru '),
	(69, '2022-07-11 15:46:50', '::1', 1, 'Menambah Data Slider Baru '),
	(70, '2022-07-11 16:21:43', '::1', 1, 'Mengubah Data Slider'),
	(71, '2022-07-11 16:41:52', '::1', 1, 'Mengubah Data Slider'),
	(72, '2022-07-11 16:46:29', '::1', 1, 'Mengubah Data Slider'),
	(73, '2022-07-11 16:47:43', '::1', 1, 'Mengubah Data Slider'),
	(74, '2022-07-11 16:48:38', '::1', 1, 'Mengubah Data Slider'),
	(75, '2022-07-11 16:48:56', '::1', 1, 'Mengubah Data Slider'),
	(76, '2022-07-11 16:49:18', '::1', 1, 'Mengubah Data Slider'),
	(77, '2022-07-11 16:50:17', '::1', 1, 'Mengubah Data Slider'),
	(78, '2022-07-11 16:50:36', '::1', 1, 'Mengubah Data Slider'),
	(79, '2022-07-11 16:53:19', '::1', 1, 'Mengubah Data Slider'),
	(80, '2022-07-11 16:53:47', '::1', 1, 'Mengubah Data Slider'),
	(81, '2022-07-11 16:54:16', '::1', 1, 'Mengubah Data Slider'),
	(82, '2022-07-12 04:16:13', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Design & Creative'),
	(83, '2022-07-12 04:24:18', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative'),
	(84, '2022-07-12 04:24:29', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative 2'),
	(85, '2022-07-12 04:38:37', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama CEO'),
	(86, '2022-07-12 04:38:44', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama GM'),
	(87, '2022-07-12 04:38:50', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Director'),
	(88, '2022-07-12 04:39:09', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Senior Manager'),
	(89, '2022-07-12 04:39:56', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Senior Manager'),
	(90, '2022-07-12 04:40:17', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Assistant Manager'),
	(91, '2022-07-12 04:40:30', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Supervisor'),
	(92, '2022-07-12 04:40:43', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Coordinator'),
	(93, '2022-07-12 04:40:54', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Staff'),
	(94, '2022-07-12 04:41:06', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Fresh Graduate'),
	(95, '2022-07-12 04:41:17', '::1', NULL, 'Menambah Data Level Pekerjaan Baru dengan nama Internship'),
	(96, '2022-07-12 04:54:11', '::1', NULL, 'Mengubah Data Level Pekerjaan dengan nama Manager'),
	(97, '2022-07-12 05:10:53', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative'),
	(98, '2022-07-12 05:13:02', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Architecture'),
	(99, '2022-07-12 05:16:49', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Financial'),
	(100, '2022-07-12 05:33:56', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama PORN Hub'),
	(101, '2022-07-12 05:34:08', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama TalentHub'),
	(102, '2022-07-12 05:34:35', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(103, '2022-07-12 07:45:25', '::1', 1, 'Mengubah Data Jabatan Digital Creative'),
	(104, '2022-07-12 07:45:40', '::1', 1, 'Menambah Data Jabatan Baru HRD'),
	(105, '2022-07-18 08:00:31', '::1', 3, 'Menambah Data Bahasa Baru '),
	(106, '2022-07-18 08:09:29', '::1', 3, 'Menambah Profil Sumanta'),
	(107, '2022-07-18 08:13:39', '::1', 3, 'Menambah Profil Sumanta'),
	(108, '2022-07-18 10:24:26', '::1', 3, 'Mengupload CV '),
	(109, '2022-07-18 10:32:58', '::1', 3, 'Mengupload CV '),
	(110, '2022-07-18 10:35:16', '::1', 3, 'Mengupload CV '),
	(111, '2022-07-18 10:36:05', '::1', 3, 'Mengupload CV '),
	(112, '2022-07-18 10:36:23', '::1', 3, 'Mengupload CV '),
	(113, '2022-07-18 10:37:14', '::1', 3, 'Mengupload CV '),
	(114, '2022-07-19 04:42:36', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative'),
	(115, '2022-07-19 04:43:06', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative'),
	(116, '2022-07-19 04:46:55', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Financial & Economic'),
	(117, '2022-07-19 04:47:23', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Construction'),
	(118, '2022-07-19 08:24:13', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Design & Creative'),
	(119, '2022-07-19 08:24:45', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Construction'),
	(120, '2022-07-19 08:24:58', '::1', NULL, 'Mengubah Data Kategori Pekerjaan dengan nama Financial & Economic'),
	(121, '2022-07-19 08:27:36', '::1', 3, 'Mengupload CV '),
	(122, '2022-07-19 11:02:57', '::1', 16, 'Mengupload CV '),
	(123, '2022-07-20 07:18:38', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Real Estate'),
	(124, '2022-07-20 07:34:46', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Content Writer'),
	(125, '2022-07-20 07:35:12', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Software Engineer'),
	(126, '2022-07-20 07:36:04', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Administrative'),
	(127, '2022-07-20 07:37:47', '::1', NULL, 'Menambah Data Kategori Pekerjaan Baru dengan nama Manufacturing'),
	(128, '2022-07-20 08:10:30', '::1', 31, 'Mengupload CV '),
	(129, '2022-07-21 07:18:40', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(130, '2022-07-21 07:25:39', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(131, '2022-07-21 07:28:06', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(132, '2022-07-21 18:01:33', '::1', 3, 'Mengupload CV '),
	(133, '2022-07-21 18:23:16', '::1', 4, 'Mengubah Data Profil Perusahaan'),
	(134, '2022-07-21 18:34:19', '::1', 4, 'Mengubah Data Profil Perusahaan'),
	(135, '2022-07-21 18:35:42', '::1', 4, 'Mengubah Data Profil Perusahaan'),
	(136, '2022-07-21 18:35:53', '::1', 4, 'Mengubah Data Profil Perusahaan'),
	(137, '2022-07-21 18:38:12', '::1', 4, 'Mengubah Data Profil Perusahaan'),
	(138, '2022-07-22 07:53:37', '::1', 32, 'Mengubah Data Profil Perusahaan'),
	(139, '2022-07-22 08:29:58', '::1', 33, 'Mengubah Data Profil Perusahaan'),
	(140, '2022-07-25 07:24:36', '::1', 33, 'Mengubah Data Profil Perusahaan'),
	(141, '2022-07-26 07:02:02', '::1', 3, 'Menambah Profil Sumanta'),
	(142, '2022-07-26 09:11:44', '::1', 3, 'Mengubah Biodata Sumanta'),
	(143, '2022-07-26 09:13:07', '::1', 3, 'Mengubah Biodata Sumanta'),
	(144, '2022-07-26 10:48:03', '::1', 3, 'Mengubah Biodata Sumanta'),
	(145, '2022-07-26 10:48:35', '::1', 3, 'Mengubah Biodata Sumanta'),
	(146, '2022-07-26 10:54:25', '::1', 3, 'Mengupload CV '),
	(147, '2022-07-27 13:21:11', '::1', 35, 'Mengubah Data Profil Perusahaan'),
	(148, '2022-07-28 05:36:44', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(149, '2022-07-28 09:31:44', '::1', 3, 'Mengubah Biodata Sumanta'),
	(150, '2022-07-28 09:33:49', '::1', 3, 'Mengubah Biodata Sumanta'),
	(151, '2022-07-28 09:35:25', '::1', 3, 'Mengubah Biodata Mayang Nuranggraeni'),
	(152, '2022-08-01 03:03:21', '::1', 3, 'Menambah Skill'),
	(153, '2022-08-01 03:11:02', '::1', 3, 'Menambah Skill'),
	(154, '2022-08-01 04:12:59', '::1', 3, 'Menambah Skill'),
	(155, '2022-08-01 04:14:39', '::1', 3, 'Menambah Skill'),
	(156, '2022-08-01 04:15:07', '::1', 3, 'Menambah Skill'),
	(157, '2022-08-01 04:16:54', '::1', 3, 'Menambah Skill'),
	(158, '2022-08-01 04:51:22', '::1', 3, 'Menambah Skill'),
	(159, '2022-08-01 04:51:31', '::1', 3, 'Menambah Skill'),
	(160, '2022-08-01 04:51:41', '::1', 3, 'Menambah Skill'),
	(161, '2022-08-01 04:51:56', '::1', 3, 'Menambah Skill'),
	(162, '2022-08-01 04:52:14', '::1', 3, 'Menambah Skill'),
	(163, '2022-08-01 05:41:54', '::1', 3, 'Mengupload CV '),
	(164, '2022-08-01 10:36:32', '::1', 3, 'Menambah Data Pengalaman'),
	(165, '2022-08-01 11:03:14', '::1', 3, 'Menambah Data Pengalaman'),
	(166, '2022-08-01 11:03:52', '::1', 3, 'Menambah Data Pengalaman'),
	(167, '2022-08-01 17:05:38', '::1', 3, 'Menghapus Data Pengalaman'),
	(168, '2022-08-01 17:05:48', '::1', 3, 'Menghapus Data Pengalaman'),
	(169, '2022-08-01 17:07:08', '::1', 3, 'Menghapus Data Pengalaman'),
	(170, '2022-08-01 17:27:44', '::1', 3, 'Mengubah Data Pengalaman'),
	(171, '2022-08-01 17:30:07', '::1', 3, 'Menambah Data Pengalaman'),
	(172, '2022-08-02 03:22:22', '::1', 3, 'Menambah Bahasa'),
	(173, '2022-08-02 03:42:55', '::1', 3, 'Menambah Bahasa'),
	(174, '2022-08-02 03:43:08', '::1', 3, 'Mengubah Bahasa'),
	(175, '2022-08-02 03:43:32', '::1', 3, 'Mengubah Bahasa'),
	(176, '2022-08-02 04:06:16', '::1', 3, 'Menambah Data Tentang Saya'),
	(177, '2022-08-02 06:13:13', '::1', 3, 'Mengubah Biodata Mayang Nuranggraeni'),
	(178, '2022-08-02 06:15:31', '::1', 3, 'Mengubah Biodata Sumanta'),
	(179, '2022-08-03 07:41:01', '::1', 3, 'Mengupload CV '),
	(180, '2022-08-03 12:52:20', '::1', 3, 'Mengubah Data Pengalaman'),
	(181, '2022-08-05 08:54:01', '::1', 3, 'Mengupload CV '),
	(182, '2022-08-08 08:26:38', '::1', NULL, 'Blast Notifikasi Baru'),
	(183, '2022-08-08 09:04:36', '::1', NULL, 'Blast Notifikasi Baru'),
	(184, '2022-08-08 09:05:58', '::1', NULL, 'Blast Notifikasi Baru'),
	(185, '2022-08-08 09:11:21', '::1', NULL, 'Blast Notifikasi Baru'),
	(186, '2022-08-08 09:16:57', '::1', NULL, 'Blast Notifikasi Baru'),
	(187, '2022-08-08 09:19:17', '::1', NULL, 'Blast Notifikasi Baru'),
	(188, '2022-08-08 09:20:22', '::1', NULL, 'Blast Notifikasi Baru'),
	(189, '2022-08-08 09:40:03', '::1', NULL, 'Blast Notifikasi Baru'),
	(190, '2022-08-08 09:44:27', '::1', NULL, 'Blast Notifikasi Baru'),
	(191, '2022-08-08 09:45:16', '::1', NULL, 'Blast Notifikasi Baru'),
	(192, '2022-08-08 09:54:06', '::1', NULL, 'Blast Notifikasi Baru'),
	(193, '2022-08-08 09:55:51', '::1', NULL, 'Blast Notifikasi Baru'),
	(194, '2022-08-08 10:02:52', '::1', NULL, 'Blast Notifikasi Baru'),
	(195, '2022-08-08 17:12:07', '::1', NULL, 'Blast Notifikasi Baru'),
	(196, '2022-08-08 17:19:37', '::1', NULL, 'Blast Notifikasi Baru'),
	(197, '2022-08-08 17:21:29', '::1', NULL, 'Blast Notifikasi Baru'),
	(198, '2022-08-08 18:10:23', '::1', NULL, 'Blast Notifikasi Baru'),
	(199, '2022-08-08 18:11:57', '::1', NULL, 'Blast Notifikasi Baru'),
	(200, '2022-08-08 18:13:25', '::1', NULL, 'Blast Notifikasi Baru'),
	(201, '2022-08-08 18:14:50', '::1', NULL, 'Blast Notifikasi Baru'),
	(202, '2022-08-08 18:17:37', '::1', NULL, 'Blast Notifikasi Baru'),
	(203, '2022-08-08 18:21:18', '::1', NULL, 'Blast Notifikasi Baru'),
	(204, '2022-08-08 18:24:14', '::1', NULL, 'Blast Notifikasi Baru'),
	(205, '2022-08-08 18:25:06', '::1', NULL, 'Blast Notifikasi Baru'),
	(206, '2022-08-08 18:27:47', '::1', NULL, 'Blast Notifikasi Baru'),
	(207, '2022-08-08 18:32:43', '::1', NULL, 'Blast Notifikasi Baru'),
	(208, '2022-08-08 18:43:39', '::1', NULL, 'Blast Notifikasi Baru'),
	(209, '2022-08-08 18:47:53', '::1', NULL, 'Blast Notifikasi Baru'),
	(210, '2022-08-08 18:49:16', '::1', NULL, 'Blast Notifikasi Baru'),
	(211, '2022-08-08 20:10:26', '::1', NULL, 'Blast Notifikasi Baru'),
	(212, '2022-08-08 21:01:00', '::1', 1, 'Menambah Data Slider Baru '),
	(213, '2022-08-08 21:11:48', '::1', 1, 'Menambah Data Slider Baru '),
	(214, '2022-08-09 15:00:53', '::1', NULL, 'Mengubah Data Profil Aplikasi Baru atas nama Talent Hub'),
	(215, '2022-08-10 17:38:21', '::1', 32, 'Mengubah Data Profil Perusahaan'),
	(216, '2022-08-10 17:38:42', '::1', 32, 'Mengubah Data Profil Perusahaan'),
	(217, '2022-08-10 17:44:43', '::1', 36, 'Mengubah Data Profil Perusahaan');

-- membuang struktur untuk table db_talent_hub.tbl_langganan_premium
CREATE TABLE IF NOT EXISTS `tbl_langganan_premium` (
  `langganan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `premium_id` int(11) DEFAULT NULL,
  `premium_masa_aktif` date DEFAULT NULL,
  PRIMARY KEY (`langganan_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_langganan_premium: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_lowongan_pekerjaan
CREATE TABLE IF NOT EXISTS `tbl_lowongan_pekerjaan` (
  `lowongan_id` int(11) NOT NULL AUTO_INCREMENT,
  `joblevel_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `lowongan_judul` varchar(250) DEFAULT NULL,
  `lowongan_gaji_min` varchar(250) DEFAULT NULL,
  `lowongan_gaji_max` varchar(250) DEFAULT NULL,
  `lowongan_gaji_secret` varchar(50) DEFAULT NULL,
  `lowongan_created_date` datetime DEFAULT NULL,
  `lowongan_end_date` date DEFAULT NULL,
  `lowongan_updated_date` datetime DEFAULT NULL,
  `lowongan_deskripsi` text DEFAULT NULL,
  `lowongan_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`lowongan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_pekerjaan: ~5 rows (lebih kurang)
INSERT INTO `tbl_lowongan_pekerjaan` (`lowongan_id`, `joblevel_id`, `kategori_id`, `perusahaan_id`, `user_id`, `jabatan_id`, `lowongan_judul`, `lowongan_gaji_min`, `lowongan_gaji_max`, `lowongan_gaji_secret`, `lowongan_created_date`, `lowongan_end_date`, `lowongan_updated_date`, `lowongan_deskripsi`, `lowongan_status`) VALUES
	(4, 22, 8, 1, 4, 5, 'Office Boy Magang', '3500000', '0', NULL, '2022-07-22 14:21:12', '2022-08-06', NULL, '<p>Kami Mencari Office Boy Yang Telaten</p><p><b style=""><font color="#000000" style="background-color: rgb(255, 255, 255);">&nbsp;Syarat :</font></b></p><p>Mempunyai Kendaraan Sendiri</p><p>Mempunyai Dua Mata</p><p>Mempunyai Sendal Swallow&nbsp;</p>', 1),
	(5, 20, 9, 3, 32, 6, 'Junior IT Programmer', '8000000', '10000000', NULL, '2022-07-22 14:55:25', '2022-07-22', NULL, '<p>Kami Mencari Depelover Yang Dapat bekerja di bawah tekanan</p>', 1),
	(6, 20, 1, 4, 33, 7, 'Digital Marketing', '1500000', '3000000', NULL, '2022-07-22 15:34:19', '2022-07-22', NULL, '<p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;">The ideal candidate will oversee the online marketing strategy for the organization by planning and executing digital marketing campaigns. This candidate will launch advertisements and create content to increase brand awareness. This candidate will have previous marketing experience and be able to monitor the company\'s social media presence.</p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: var(--artdeco-reset-base-font-size-hundred-percent); vertical-align: var(--artdeco-reset-base-vertical-align-baseline); background: var(--artdeco-reset-base-background-transparent); outline: var(--artdeco-reset-base-outline-zero); font-weight: var(--artdeco-reset-typography-font-weight-bold);"><br></span></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: var(--artdeco-reset-base-font-size-hundred-percent); vertical-align: var(--artdeco-reset-base-vertical-align-baseline); background: var(--artdeco-reset-base-background-transparent); outline: var(--artdeco-reset-base-outline-zero);"><b>Responsibilities</b></span></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent); text-align: left;">Design, maintain, and supply content for the organization\'s website</span></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent); text-align: left;">Formulate strategies to build lasting digital connection with customers</span></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent); text-align: left;">Monitor company presence on social media</span></p><p style="text-align: justify; box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent); text-align: left;">Launch advertisements to increase brand awareness</span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><br style="box-sizing: inherit;"></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: var(--artdeco-reset-base-font-size-hundred-percent); vertical-align: var(--artdeco-reset-base-vertical-align-baseline); background: var(--artdeco-reset-base-background-transparent); outline: var(--artdeco-reset-base-outline-zero);"><b>Qualifications</b></span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent);">Bachelor\'s degree in Marketing or related field</span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent);">at least 1-2 years in the same field</span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent);">Excellent understanding of digital marketing concepts</span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent);">Experience with business to customer social media and content generation</span></p><p style="box-sizing: inherit; margin: var(--artdeco-reset-base-margin-zero); padding: var(--artdeco-reset-base-padding-zero); border: var(--artdeco-reset-base-border-zero); font-size: 14px; vertical-align: var(--artdeco-reset-base-vertical-align-baseline); --artdeco-reset-typography_getFontSize:1.6rem; --artdeco-reset-typography_getLineHeight:1.5; line-height: var(--artdeco-reset-typography_getLineHeight); color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif;"><span style="font-size: var(--artdeco-reset-base-font-size-hundred-percent);">Strong creative and analytical skills</span></p>', 1),
	(7, 20, 1, 5, 35, 7, 'Marketing Manager', '50000', '100000', NULL, '2022-07-27 20:27:22', '2022-09-27', NULL, '<p>Kami Mencari tim yang biasa aja&nbsp;</p>', 1),
	(8, 20, 1, 3, 32, 9, 'Desain Grafis Full Time', '5000000', '0', NULL, '2022-08-02 14:22:04', '2022-08-27', NULL, '<p>Mencari Desain Graphis dengan wajah tampan dan memiliki saldo crypto $500</p>', 1),
	(9, 15, 2, 10, 36, 5, 'Office Boy Berpengalaman', '3500000', '0', NULL, '2022-08-11 00:49:09', '2022-08-11', NULL, '<p>Mencari office boy berpengalaman dengan penampilan good looking</p>', 1);

-- membuang struktur untuk table db_talent_hub.tbl_lowongan_skill
CREATE TABLE IF NOT EXISTS `tbl_lowongan_skill` (
  `lowongan_skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `lowongan_id` int(11) NOT NULL DEFAULT 0,
  `skill_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lowongan_skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_skill: ~18 rows (lebih kurang)
INSERT INTO `tbl_lowongan_skill` (`lowongan_skill_id`, `lowongan_id`, `skill_id`) VALUES
	(1, 4, 9),
	(2, 5, 6),
	(3, 5, 7),
	(4, 5, 8),
	(5, 5, 10),
	(6, 6, 11),
	(7, 6, 12),
	(8, 6, 13),
	(9, 6, 14),
	(10, 6, 15),
	(11, 7, 13),
	(12, 7, 16),
	(13, 7, 17),
	(14, 8, 5),
	(15, 8, 4),
	(16, 8, 21),
	(17, 8, 22),
	(18, 8, 23),
	(19, 9, 9),
	(20, 9, 24);

-- membuang struktur untuk table db_talent_hub.tbl_lowongan_tersimpan
CREATE TABLE IF NOT EXISTS `tbl_lowongan_tersimpan` (
  `lowongan_tersimpan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `lowongan_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lowongan_tersimpan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_tersimpan: ~4 rows (lebih kurang)
INSERT INTO `tbl_lowongan_tersimpan` (`lowongan_tersimpan_id`, `user_id`, `lowongan_id`) VALUES
	(11, 3, 6),
	(12, 3, 7),
	(14, 3, 5),
	(15, 3, 8);

-- membuang struktur untuk table db_talent_hub.tbl_master_agama
CREATE TABLE IF NOT EXISTS `tbl_master_agama` (
  `agama_id` int(10) NOT NULL AUTO_INCREMENT,
  `agama_nama` varchar(50) DEFAULT NULL,
  `agama_status` int(11) DEFAULT 1,
  PRIMARY KEY (`agama_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_agama: ~6 rows (lebih kurang)
INSERT INTO `tbl_master_agama` (`agama_id`, `agama_nama`, `agama_status`) VALUES
	(1, 'Islam', 1),
	(2, 'Protestan', 1),
	(3, 'Katholik', 1),
	(4, 'Hindu', 1),
	(5, 'Buddha', 1),
	(6, 'Konghucu', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_bahasa
CREATE TABLE IF NOT EXISTS `tbl_master_bahasa` (
  `bahasa_id` int(11) NOT NULL AUTO_INCREMENT,
  `bahasa_nama` varchar(250) DEFAULT NULL,
  `bahasa_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`bahasa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_bahasa: ~5 rows (lebih kurang)
INSERT INTO `tbl_master_bahasa` (`bahasa_id`, `bahasa_nama`, `bahasa_status`) VALUES
	(1, 'Indonesia', 1),
	(2, 'English', 1),
	(3, 'Mandarin', 1),
	(4, 'Jepang', 1),
	(5, 'Spanyol', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_jabatan
CREATE TABLE IF NOT EXISTS `tbl_master_jabatan` (
  `jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan_nama` varchar(250) DEFAULT NULL,
  `jabatan_status` int(11) DEFAULT 1,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_jabatan: ~9 rows (lebih kurang)
INSERT INTO `tbl_master_jabatan` (`jabatan_id`, `jabatan_nama`, `jabatan_status`) VALUES
	(1, 'IT Staff', 1),
	(2, 'IT Support', 1),
	(3, 'Sales Representative', 1),
	(4, 'Receptionist', 1),
	(5, 'Office Boy', 1),
	(6, 'IT Programmer', 1),
	(7, 'Digital Creative', 1),
	(8, 'HRD', 1),
	(9, 'Desain Graphis', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_kabkota
CREATE TABLE IF NOT EXISTS `tbl_master_kabkota` (
  `prov_id` char(2) NOT NULL DEFAULT '0',
  `kabkota_nama` varchar(50) DEFAULT NULL,
  `kabkota_id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kabkota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_kabkota: ~514 rows (lebih kurang)
INSERT INTO `tbl_master_kabkota` (`prov_id`, `kabkota_nama`, `kabkota_id`) VALUES
	('AC', 'Aceh Barat', 1),
	('AC', 'Aceh Barat Daya', 2),
	('AC', 'Aceh Besar', 3),
	('AC', 'Aceh Jaya', 4),
	('AC', 'Aceh Selatan', 5),
	('AC', 'Aceh Singkil', 6),
	('AC', 'Aceh Tamiang', 7),
	('AC', 'Aceh Tengah', 8),
	('AC', 'Aceh Tenggara', 9),
	('AC', 'Aceh Timur', 10),
	('AC', 'Aceh Utara', 11),
	('AC', 'Bener Meriah', 12),
	('AC', 'Bireuen', 13),
	('AC', 'Gayo Lues', 14),
	('AC', 'Nagan Raya', 15),
	('AC', 'Pidie', 16),
	('AC', 'Pidie Jaya', 17),
	('AC', 'Simeulue', 18),
	('AC', 'Kota Banda Aceh', 19),
	('AC', 'Kota Langsa', 20),
	('AC', 'Kota Lhokseumawe', 21),
	('AC', 'Kota Sabang', 22),
	('AC', 'Kota Subulussalam', 23),
	('BA', 'Badung', 24),
	('BA', 'Bangli', 25),
	('BA', 'Buleleng', 26),
	('BA', 'Gianyar', 27),
	('BA', 'Jembrana', 28),
	('BA', 'Karangasem', 29),
	('BA', 'Klungkung', 30),
	('BA', 'Tabanan', 31),
	('BA', 'Kota Denpasar', 32),
	('BB', 'Bangka', 33),
	('BB', 'Bangka Barat', 34),
	('BB', 'Bangka Selatan', 35),
	('BB', 'Bangka Tengah', 36),
	('BB', 'Belitung', 37),
	('BB', 'Belitung Timur', 38),
	('BB', 'Kota Pangkal Pinang', 39),
	('BE', 'Bengkulu Selatan', 40),
	('BE', 'Bengkulu Tengah', 41),
	('BE', 'Bengkulu Utara', 42),
	('BE', 'Kaur', 43),
	('BE', 'Kepahyang', 44),
	('BE', 'Lebong', 45),
	('BE', 'Mukomuko', 46),
	('BE', 'Rejang Lebong', 47),
	('BE', 'Seluma', 48),
	('BE', 'Kota Bengkulu', 49),
	('BT', 'Lebak', 50),
	('BT', 'Pandeglang', 51),
	('BT', 'Serang', 52),
	('BT', 'Tangerang', 53),
	('BT', 'Kota Cilegon', 54),
	('BT', 'Kota Serang', 55),
	('BT', 'Kota Tangerang', 56),
	('BT', 'Kota Tangerang Selatan', 57),
	('GO', 'Boalemo', 58),
	('GO', 'Bone Bolango', 59),
	('GO', 'Gorontalo', 60),
	('GO', 'Gorontalo Utara', 61),
	('GO', 'Pohuwo', 62),
	('GO', 'Kota Gorontalo', 63),
	('JA', 'Batanghari', 64),
	('JA', 'Bungo', 65),
	('JA', 'Kerinci', 66),
	('JA', 'Merangin', 67),
	('JA', 'Muaro Jambi', 68),
	('JA', 'Sarolangun', 69),
	('JA', 'Tanjung Jabung Barat', 70),
	('JA', 'Tanjung Jabung Timur', 71),
	('JA', 'Tebo', 72),
	('JA', 'Kota Jambi', 73),
	('JA', 'Kota Sungaipenuh', 74),
	('JB', 'Bandung', 75),
	('JB', 'Bandung Barat', 76),
	('JB', 'Bekasi', 77),
	('JB', 'Bogor', 78),
	('JB', 'Ciamis', 79),
	('JB', 'Cianjur', 80),
	('JB', 'Cirebon', 81),
	('JB', 'Garut', 82),
	('JB', 'Indramayu', 83),
	('JB', 'Karawang', 84),
	('JB', 'Kuningan', 85),
	('JB', 'Majalengka', 86),
	('JB', 'Pangandaran', 87),
	('JB', 'Purwakarta', 88),
	('JB', 'Subang', 89),
	('JB', 'Sukabumi', 90),
	('JB', 'Sumedang', 91),
	('JB', 'Tasikmalaya', 92),
	('JB', 'Kota Bandung', 93),
	('JB', 'Kota Banjar', 94),
	('JB', 'Kota Bekasi', 95),
	('JB', 'Kota Bogor', 96),
	('JB', 'Kota Cimahi', 97),
	('JB', 'Kota Cirebon', 98),
	('JB', 'Kota Depok', 99),
	('JB', 'Kota Sukabumi', 100),
	('JB', 'Kota Tasikmalaya', 101),
	('JI', 'Bangkalan', 102),
	('JI', 'Banyuwangi', 103),
	('JI', 'Blitar', 104),
	('JI', 'Bojonegoro', 105),
	('JI', 'Bondowoso', 106),
	('JI', 'Gresik', 107),
	('JI', 'Jember', 108),
	('JI', 'Jombang', 109),
	('JI', 'Kediri', 110),
	('JI', 'Lamongan', 111),
	('JI', 'Lumajang', 112),
	('JI', 'Madiun', 113),
	('JI', 'Magetan', 114),
	('JI', 'Malang', 115),
	('JI', 'Mojokerto', 116),
	('JI', 'Nganjuk', 117),
	('JI', 'Ngawi', 118),
	('JI', 'Pacitan', 119),
	('JI', 'Pamekasan', 120),
	('JI', 'Pasuruan', 121),
	('JI', 'Ponorogo', 122),
	('JI', 'Probolinggo', 123),
	('JI', 'Sampang', 124),
	('JI', 'Sidoarjo', 125),
	('JI', 'Situbondo', 126),
	('JI', 'Sumenep', 127),
	('JI', 'Trenggalek', 128),
	('JI', 'Tuban', 129),
	('JI', 'Tulungagung', 130),
	('JI', 'Kota Batu', 131),
	('JI', 'Kota Blitar', 132),
	('JI', 'Kota Kediri', 133),
	('JI', 'Kota Madiun', 134),
	('JI', 'Kota Malang', 135),
	('JI', 'Kota Mojokerto', 136),
	('JI', 'Kota Pasuruan', 137),
	('JI', 'Kota Probolinggo', 138),
	('JI', 'Kota Surabaya', 139),
	('JK', 'Kepulauan Seribu', 140),
	('JK', 'Jakarta Barat', 141),
	('JK', 'Jakarta Pusat', 142),
	('JK', 'Jakarta Selatan', 143),
	('JK', 'Jakarta Timur', 144),
	('JK', 'Jakarta Utara', 145),
	('JT', 'Banjarnegara', 146),
	('JT', 'Banyumas', 147),
	('JT', 'Batang', 148),
	('JT', 'Blora', 149),
	('JT', 'Boyolali', 150),
	('JT', 'Brebes', 151),
	('JT', 'Cilacap', 152),
	('JT', 'Demak', 153),
	('JT', 'Grobogan', 154),
	('JT', 'Jepara', 155),
	('JT', 'Karanganyar', 156),
	('JT', 'Kebumen', 157),
	('JT', 'Kendal', 158),
	('JT', 'Klaten', 159),
	('JT', 'Kudus', 160),
	('JT', 'Magelang', 161),
	('JT', 'Pati', 162),
	('JT', 'Pekalongan', 163),
	('JT', 'Pemalang', 164),
	('JT', 'Purbalingga', 165),
	('JT', 'Purworejo', 166),
	('JT', 'Rembang', 167),
	('JT', 'Semarang', 168),
	('JT', 'Sragen', 169),
	('JT', 'Sukoharjo', 170),
	('JT', 'Tegal', 171),
	('JT', 'Temanggung', 172),
	('JT', 'Wonogiri', 173),
	('JT', 'Wonosobo', 174),
	('JT', 'Kota Magelang', 175),
	('JT', 'Kota Pekalongan', 176),
	('JT', 'Kota Salatiga', 177),
	('JT', 'Kota Semarang', 178),
	('JT', 'Kota Surakarta', 179),
	('JT', 'Kota Tegal', 180),
	('KB', 'Bengkayang', 181),
	('KB', 'Kapuas Hulu', 182),
	('KB', 'Kayong Utara', 183),
	('KB', 'Ketapang', 184),
	('KB', 'Kubu Raya', 185),
	('KB', 'Landak', 186),
	('KB', 'Melawi', 187),
	('KB', 'Mempawah', 188),
	('KB', 'Sambas', 189),
	('KB', 'Sanggau', 190),
	('KB', 'Sekadau', 191),
	('KB', 'Sintang', 192),
	('KB', 'Kota Pontianak', 193),
	('KB', 'Kota Singkawang', 194),
	('KI', 'Berau', 195),
	('KI', 'Kutai Barat', 196),
	('KI', 'Kutai Kertanegara', 197),
	('KI', 'Kutai Timur', 198),
	('KI', 'Mahakan Ulu', 199),
	('KI', 'Paser', 200),
	('KI', 'Penajam Paser Utara', 201),
	('KI', 'Kota Balikpapan', 202),
	('KI', 'Kota Bontang', 203),
	('KI', 'Kota Samarinda', 204),
	('KR', 'Bintan Kepulauan', 205),
	('KR', 'Karimun', 206),
	('KR', 'Kepulauan Anambas', 207),
	('KR', 'Lingga', 208),
	('KR', 'Natuna', 209),
	('KR', 'Kota Batam', 210),
	('KR', 'Kota Tanjung Pinang', 211),
	('KS', 'Balangan', 212),
	('KS', 'Banjar', 213),
	('KS', 'Barito Kuala', 214),
	('KS', 'Hulu Sungai Selatan', 215),
	('KS', 'Hulu Sungai Tengah', 216),
	('KS', 'Hulu Sungai Utara', 217),
	('KS', 'Kotabaru', 218),
	('KS', 'Tabalong', 219),
	('KS', 'Tanah Bumbu', 220),
	('KS', 'Tanah Laut', 221),
	('KS', 'Tapin', 222),
	('KS', 'Kota Banjarbaru', 223),
	('KS', 'Kota Banjarmasin', 224),
	('KT', 'Barito Selatan', 225),
	('KT', 'Barito Timur', 226),
	('KT', 'Barito Utara', 227),
	('KT', 'Gunung Mas', 228),
	('KT', 'Kapuas', 229),
	('KT', 'Katingan', 230),
	('KT', 'Kotawaringin Barat', 231),
	('KT', 'Kotawaringin Timur', 232),
	('KT', 'Lamandau', 233),
	('KT', 'Murung Raya', 234),
	('KT', 'Pulau Pisau', 235),
	('KT', 'Sukamara', 236),
	('KT', 'Seruyan', 237),
	('KT', 'Palangka Raya', 238),
	('KU', 'Bulungan', 239),
	('KU', 'Malinau', 240),
	('KU', 'Nunukan', 241),
	('KU', 'Tana Tidung', 242),
	('KU', 'Kota Tarakan', 243),
	('LA', 'Lampung Barat', 244),
	('LA', 'Lampung Selatan', 245),
	('LA', 'Lampung Tengah', 246),
	('LA', 'Lampung Timur', 247),
	('LA', 'Lampung Utara', 248),
	('LA', 'Mesuji', 249),
	('LA', 'Pesawaran', 250),
	('LA', 'Pesisir Barat', 251),
	('LA', 'Pringsewu', 252),
	('LA', 'Tanggamus', 253),
	('LA', 'Tulang Bawang', 254),
	('LA', 'Tulang Bawang Barat', 255),
	('LA', 'Way Kanan', 256),
	('LA', 'Kota Bandar Lampung', 257),
	('LA', 'Kota Metro', 258),
	('MA', 'Buru', 259),
	('MA', 'Buru Selatan', 260),
	('MA', 'Kepulauan Aru', 261),
	('MA', 'Maluku Barat Daya', 262),
	('MA', 'Maluku Tengah', 263),
	('MA', 'Maluku Tenggara', 264),
	('MA', 'Maluku Tenggara Barat', 265),
	('MA', 'Seram Bagian Barat', 266),
	('MA', 'Seram Bagian Timur', 267),
	('MA', 'Kota Ambon', 268),
	('MA', 'Kota Tual', 269),
	('MU', 'Halmahera Barat', 270),
	('MU', 'Halmahera Tengah', 271),
	('MU', 'Halmahera Timur', 272),
	('MU', 'Halmahera Selatan', 273),
	('MU', 'Halmahera Utara', 274),
	('MU', 'Kepulauan Sula', 275),
	('MU', 'Pulau Morotai', 276),
	('MU', 'Pulau Taliabu', 277),
	('MU', 'Kota Ternate', 278),
	('MU', 'Kota Tidore Kepulauan', 279),
	('NB', 'Bima', 280),
	('NB', 'Dompu', 281),
	('NB', 'Lombok Barat', 282),
	('NB', 'Lombok Tengah', 283),
	('NB', 'Lombok Timur', 284),
	('NB', 'Lombok Utara', 285),
	('NB', 'Sumbawa', 286),
	('NB', 'Sumbawa Barat', 287),
	('NB', 'Kota Bima', 288),
	('NB', 'Kota Mataram', 289),
	('NT', 'Alor', 290),
	('NT', 'Belu', 291),
	('NT', 'Ende', 292),
	('NT', 'Flores Timur', 293),
	('NT', 'Kupang', 294),
	('NT', 'Lembata', 295),
	('NT', 'Malaka', 296),
	('NT', 'Manggarai', 297),
	('NT', 'Manggarai Barat', 298),
	('NT', 'Manggarai Timur', 299),
	('NT', 'Ngada', 300),
	('NT', 'Nagekeo', 301),
	('NT', 'Rote Ndao', 302),
	('NT', 'Sabu Raijua', 303),
	('NT', 'Sikka', 304),
	('NT', 'Sumba Barat', 305),
	('NT', 'Sumba Barat Daya', 306),
	('NT', 'Sumba Tengah', 307),
	('NT', 'Sumba Timur', 308),
	('NT', 'Timor Tengah Selatan', 309),
	('NT', 'Timor Tengah Utara', 310),
	('NT', 'Kota Kupang', 311),
	('PA', 'Asmat', 312),
	('PA', 'Biak Numfor', 313),
	('PA', 'Boven Digoel', 314),
	('PA', 'Deiyai', 315),
	('PA', 'Dogiyai', 316),
	('PA', 'Intan Jaya', 317),
	('PA', 'Jayapura', 318),
	('PA', 'Jayawijaya', 319),
	('PA', 'Keerom', 320),
	('PA', 'Kepulauan Yapen', 321),
	('PA', 'Lanny Jaya', 322),
	('PA', 'Mamberamo Raya', 323),
	('PA', 'Memberamo Tengah', 324),
	('PA', 'Mappi', 325),
	('PA', 'Merauke', 326),
	('PA', 'Mimika', 327),
	('PA', 'Nabire', 328),
	('PA', 'Nduga', 329),
	('PA', 'Paniai', 330),
	('PA', 'Pegunungan Bintang', 331),
	('PA', 'Puncak', 332),
	('PA', 'Puncak Jaya', 333),
	('PA', 'Sarmi', 334),
	('PA', 'Supiori', 335),
	('PA', 'Tolikara', 336),
	('PA', 'Waropen', 337),
	('PA', 'Yahukimo', 338),
	('PA', 'Yalimo', 339),
	('PA', 'Kota Jayapura', 340),
	('PB', 'Fakfak', 341),
	('PB', 'Kaimana', 342),
	('PB', 'Manokwari', 343),
	('PB', 'Manokwari Selatan', 344),
	('PB', 'Maybrat', 345),
	('PB', 'Pegunungan Arfak', 346),
	('PB', 'Raja Ampat', 347),
	('PB', 'Sorong', 348),
	('PB', 'Sorong Selatan', 349),
	('PB', 'Tambraw', 350),
	('PB', 'Teluk Bintuni', 351),
	('PB', 'Teluk Wondama', 352),
	('PB', 'Kota Sorong', 353),
	('RI', 'Bengkalis', 354),
	('RI', 'Indragiri Hilir', 355),
	('RI', 'Indragiri Hulu', 356),
	('RI', 'Kampar', 357),
	('RI', 'Kepulauan Meranti', 358),
	('RI', 'Kuantan Singingi', 359),
	('RI', 'Pelalawan', 360),
	('RI', 'Rokan Hilir', 361),
	('RI', 'Rokan Hulu', 362),
	('RI', 'Siak', 363),
	('RI', 'Kota Dumai', 364),
	('RI', 'Kota Pekanbaru', 365),
	('SA', 'Bolaang Mongondow', 366),
	('SA', 'Bolaang Mongondow Selatan', 367),
	('SA', 'Bolaang Mongondow Timur', 368),
	('SA', 'Bolaang Mongondow Utara', 369),
	('SA', 'Kepulauan Sangihe', 370),
	('SA', 'Kepulauan Siau Tagulandang Biaro', 371),
	('SA', 'Kepulauan Talaud', 372),
	('SA', 'Minahasa', 373),
	('SA', 'Minahasa Selatan', 374),
	('SA', 'Minahasa Tenggara', 375),
	('SA', 'Minahasa Utara', 376),
	('SA', 'Kota Bitung', 377),
	('SA', 'Kota Kotamobagu', 378),
	('SA', 'Kota Manado', 379),
	('SA', 'Kota Tomohon', 380),
	('SB', 'Agam', 381),
	('SB', 'Dharmasraya', 382),
	('SB', 'Kepulauan Mentawai', 383),
	('SB', 'Lima Puluh Kota', 384),
	('SB', 'Padang Pariaman', 385),
	('SB', 'Pasaman', 386),
	('SB', 'Pasaman Barat', 387),
	('SB', 'Pesisir Selatan', 388),
	('SB', 'Sijunjung', 389),
	('SB', 'Solok', 390),
	('SB', 'Solok Selatan', 391),
	('SB', 'Tanah Datar', 392),
	('SB', 'Kota Bukittinggi', 393),
	('SB', 'Kota Padang', 394),
	('SB', 'Kota Padangpanjang', 395),
	('SB', 'Kota Pariaman', 396),
	('SB', 'Kota Payakumbuh', 397),
	('SB', 'Kota Sawahlunto', 398),
	('SB', 'Kota Solok', 399),
	('SG', 'Bombana', 400),
	('SG', 'Buton', 401),
	('SG', 'Buton Selatan', 402),
	('SG', 'Buton Tengah', 403),
	('SG', 'Buton Utara', 404),
	('SG', 'Kolaka', 405),
	('SG', 'Kolaka Timur', 406),
	('SG', 'Kolaka Utara', 407),
	('SG', 'Konawe', 408),
	('SG', 'Konawe Kepulauan', 409),
	('SG', 'Konawe Selatan', 410),
	('SG', 'Konawe Utara', 411),
	('SG', 'Muna', 412),
	('SG', 'Muna Barat', 413),
	('SG', 'Wakatobi', 414),
	('SG', 'Kota Bau-Bau', 415),
	('SG', 'Kendari', 416),
	('SN', 'Bantaeng', 417),
	('SN', 'Barru', 418),
	('SN', 'Bone', 419),
	('SN', 'Bulukumba', 420),
	('SN', 'Enrekang', 421),
	('SN', 'Gowa', 422),
	('SN', 'Jeneponto', 423),
	('SN', 'Kepulauan Selayar', 424),
	('SN', 'Luwu', 425),
	('SN', 'Luwu Timur', 426),
	('SN', 'Luwu Utara', 427),
	('SN', 'Maros', 428),
	('SN', 'Pangkajene dan Kepulauan', 429),
	('SN', 'Pinrang', 430),
	('SN', 'Sidenreng Rappang', 431),
	('SN', 'Sinjai', 432),
	('SN', 'Soppeng', 433),
	('SN', 'Takalar', 434),
	('SN', 'Tana Toraja', 435),
	('SN', 'Toraja Utara', 436),
	('SN', 'Wajo', 437),
	('SN', 'Kota Makassar', 438),
	('SN', 'Kota Palopo', 439),
	('SN', 'Kota Parepare', 440),
	('SR', 'Majene', 441),
	('SR', 'Mamasa', 442),
	('SR', 'Mamuju', 443),
	('SR', 'Mamuju Tengah', 444),
	('SR', 'Mamuju Utara', 445),
	('SR', 'Polewali Mandar', 446),
	('SS', 'Banyuasin', 447),
	('SS', 'Empat Lawang', 448),
	('SS', 'Lahat', 449),
	('SS', 'Muara Enim', 450),
	('SS', 'Musi Banyuasin', 451),
	('SS', 'Musi Rawas', 452),
	('SS', 'Musi Rawas Utara', 453),
	('SS', 'Ogan Ilir', 454),
	('SS', 'Ogan Komering Ilir', 455),
	('SS', 'ogan Komering Ulu', 456),
	('SS', 'ogan Komering Ulu Selatan', 457),
	('SS', 'Ogan Komering Ulu Timur', 458),
	('SS', 'Penukul Abab Lematang Ilir', 459),
	('SS', 'Kota Lubuklinggau', 460),
	('SS', 'Kota Pagar Alam', 461),
	('SS', 'Kota Palembang', 462),
	('SS', 'Kota Prabumulih', 463),
	('ST', 'Banggai', 464),
	('ST', 'Banggai Kepulauan', 465),
	('ST', 'Banggai Laut', 466),
	('ST', 'Buol', 467),
	('ST', 'Donggala', 468),
	('ST', 'Morowali', 469),
	('ST', 'Morowali Utara', 470),
	('ST', 'Parigi Moutong', 471),
	('ST', 'Poso', 472),
	('ST', 'Sigi', 473),
	('ST', 'Tojo Una-Una', 474),
	('ST', 'Toli Toli', 475),
	('ST', 'Kota Palu', 476),
	('SU', 'Asahan', 477),
	('SU', 'Batubara', 478),
	('SU', 'Dairi', 479),
	('SU', 'Deli Serdang', 480),
	('SU', 'Humbang Hasundutan', 481),
	('SU', 'Karo', 482),
	('SU', 'Labuhanbatu', 483),
	('SU', 'Labutanbatu Selatan', 484),
	('SU', 'Labuhanbatu Utara', 485),
	('SU', 'Langkat', 486),
	('SU', 'Mandailing Natal', 487),
	('SU', 'Nias', 488),
	('SU', 'Nias Barat', 489),
	('SU', 'Nias Selatan', 490),
	('SU', 'Nias Utara', 491),
	('SU', 'Padang Lawas', 492),
	('SU', 'Padang Lawas Utara', 493),
	('SU', 'Pakpak Bharat', 494),
	('SU', 'Samosir', 495),
	('SU', 'Serdang Bedagai', 496),
	('SU', 'Simalungun', 497),
	('SU', 'Tapanuli Selatan', 498),
	('SU', 'Tapanuli Tengah', 499),
	('SU', 'Tapanuli Utara', 500),
	('SU', 'Toba Samosir', 501),
	('SU', 'Kota Binjai', 502),
	('SU', 'Kota Gunungsitoli', 503),
	('SU', 'Kota Medan', 504),
	('SU', 'Kota Padangsidempuan', 505),
	('SU', 'Kota Pematangsiantar', 506),
	('SU', 'Kota Sibolga', 507),
	('SU', 'Kota Tanjungbalai', 508),
	('SU', 'Kota Tebing Tinggi', 509),
	('YO', 'Bantul', 510),
	('YO', 'GunungKidul', 511),
	('YO', 'Kulon Progo', 512),
	('YO', 'Sleman', 513),
	('YO', 'Kota Yogyakarta', 514);

-- membuang struktur untuk table db_talent_hub.tbl_master_kategori_job
CREATE TABLE IF NOT EXISTS `tbl_master_kategori_job` (
  `kategori_id` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(250) DEFAULT NULL,
  `kategori_status` int(11) DEFAULT NULL,
  `kategori_icon` text DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_kategori_job: ~9 rows (lebih kurang)
INSERT INTO `tbl_master_kategori_job` (`kategori_id`, `kategori_nama`, `kategori_status`, `kategori_icon`) VALUES
	(1, 'Design & Creative', 1, 'assets/img/icon_kategori/icon1658219053Vector500.svg'),
	(2, 'Construction', 1, 'assets/img/icon_kategori/icon1658219085Vectorconst.svg'),
	(3, 'Financial & Economic', 1, 'assets/img/icon_kategori/icon1658219098Vectorfinance.svg'),
	(4, 'Real Estate', 1, 'assets/img/icon_kategori/icon1658301518Vectorre.svg'),
	(5, 'Content Writer', 1, 'assets/img/icon_kategori/icon1658302486Vectorcw.svg'),
	(6, 'Software Engineer', 1, 'assets/img/icon_kategori/icon1658302512Vectorse (1).svg'),
	(7, 'Administrative', 1, 'assets/img/icon_kategori/icon1658302564Vectoradmin.svg'),
	(8, 'Manufacturing', 1, 'assets/img/icon_kategori/icon1658302667Vectormf.svg'),
	(9, 'News & Media', 1, 'assets/img/icon_kategori/icon1658301518Vectorre.svg');

-- membuang struktur untuk table db_talent_hub.tbl_master_level
CREATE TABLE IF NOT EXISTS `tbl_master_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_nama` varchar(50) NOT NULL DEFAULT '',
  `level_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_level: ~3 rows (lebih kurang)
INSERT INTO `tbl_master_level` (`level_id`, `level_nama`, `level_status`) VALUES
	(1, 'admin', 1),
	(2, 'job_seeker', 1),
	(3, 'job_provider', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_level_job
CREATE TABLE IF NOT EXISTS `tbl_master_level_job` (
  `joblevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `joblevel_nama` varchar(250) NOT NULL,
  `joblevel_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`joblevel_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_level_job: ~11 rows (lebih kurang)
INSERT INTO `tbl_master_level_job` (`joblevel_id`, `joblevel_nama`, `joblevel_status`) VALUES
	(12, 'CEO', 1),
	(13, 'GM', 1),
	(14, 'Director', 1),
	(15, 'Manager', 1),
	(16, 'Senior Manager', 1),
	(17, 'Assistant Manager', 1),
	(18, 'Supervisor', 1),
	(19, 'Coordinator', 1),
	(20, 'Staff', 1),
	(21, 'Fresh Graduate', 1),
	(22, 'Internship', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_pendidikan
CREATE TABLE IF NOT EXISTS `tbl_master_pendidikan` (
  `pendidikan_id` int(10) NOT NULL AUTO_INCREMENT,
  `pendidikan_nama` varchar(150) NOT NULL,
  `pendidikan_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`pendidikan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_pendidikan: ~9 rows (lebih kurang)
INSERT INTO `tbl_master_pendidikan` (`pendidikan_id`, `pendidikan_nama`, `pendidikan_status`) VALUES
	(1, 'SD', 1),
	(2, 'SMP/SLTP/MTs', 1),
	(3, 'SMA/SLTA/SMK', 1),
	(4, 'D1', 1),
	(5, 'D2', 1),
	(6, 'D3', 1),
	(7, 'S1', 1),
	(8, 'S2', 1),
	(9, 'S3', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_provinsi
CREATE TABLE IF NOT EXISTS `tbl_master_provinsi` (
  `prov_id` char(2) NOT NULL DEFAULT '0',
  `prov_nama` varchar(50) DEFAULT NULL,
  `prov_Lat` varchar(25) NOT NULL,
  `prov_Long` varchar(25) NOT NULL,
  PRIMARY KEY (`prov_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_provinsi: ~34 rows (lebih kurang)
INSERT INTO `tbl_master_provinsi` (`prov_id`, `prov_nama`, `prov_Lat`, `prov_Long`) VALUES
	('AC', 'Aceh', '4.695135', '96.7493993'),
	('BA', 'Bali', '-8.4095178', '115.188916'),
	('BB', 'Kepulauan Bangka Belitung', '-2.7410513', '106.4405872'),
	('BE', 'Bengkulu', '-3.5778471', '102.3463875'),
	('BT', 'Banten', '-6.4058172', '106.0640179'),
	('GO', 'Gorontalo', '0.6999372', '122.4467238'),
	('JA', 'Jambi', '-1.4851831', '102.4380581'),
	('JB', 'Jawa Barat', '-7.090911', '107.668887'),
	('JI', 'Jawa Timur', '-7.5360639', '112.2384017'),
	('JK', 'Jakarta', '-6.211544', '106.845172'),
	('JT', 'Jawa Tengah', '-7.150975', '110.1402594'),
	('KB', 'Kalimantan Barat', '-0.2787808', '111.4752851'),
	('KI', 'Kalimantan Timur', '1.6406296', '116.419389'),
	('KR', 'Kepulauan Riau', '3.9456514', '108.1428669'),
	('KS', 'Kalimantan Selatan', '-3.0926415', '115.2837585'),
	('KT', 'Kalimantan Tengah', '-1.6814878', '113.3823545'),
	('KU', 'Kalimantan Utara', '3.0731', '116.0414'),
	('LA', 'Lampung', '-4.5585849', '105.4068079'),
	('MA', 'Maluku', '-3.2384616', '130.1452734'),
	('MU', 'Maluku Utara', '1.5709993', '127.8087693'),
	('NB', 'Nusa Tenggara Barat', '-8.6529334', '117.3616476'),
	('NT', 'Nusa Tenggara Timur', '-8.6573819', '121.0793705'),
	('PA', 'Papua', '-4.269928', '138.0803529'),
	('PB', 'Papua Barat', '-1.3361154', '133.1747162'),
	('RI', 'Riau', '0.2933469', '101.7068294'),
	('SA', 'Sulawesi Utara', '0.6246932', '123.9750018'),
	('SB', 'Sumatera Barat', '-0.7399397', '100.8000051'),
	('SG', 'Sulawesi Tenggara', '-4.14491', '122.174605'),
	('SN', 'Sulawesi Selatan', '-3.6687994', '119.9740534'),
	('SR', 'Sulawesi Barat', '-2.8441371', '119.2320784'),
	('SS', 'Sumatera Selatan', '-3.3194374', '103.914399'),
	('ST', 'Sulawesi Tengah', '-1.4300254', '121.4456179'),
	('SU', 'Sumatera Utara', '2.1153547', '99.5450974'),
	('YO', 'Yogyakarta', '-7.8753849', '110.4262088');

-- membuang struktur untuk table db_talent_hub.tbl_master_role
CREATE TABLE IF NOT EXISTS `tbl_master_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_menu` varchar(255) DEFAULT NULL,
  `role_active` varchar(255) DEFAULT NULL,
  `role_subactive` varchar(255) DEFAULT NULL,
  `role_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_talent_hub.tbl_master_role: ~9 rows (lebih kurang)
INSERT INTO `tbl_master_role` (`role_id`, `role_menu`, `role_active`, `role_subactive`, `role_icon`) VALUES
	(1, 'Admin Role', 'user', NULL, '<i class="fas fa-fw fa-user"></i>'),
	(2, 'Job Provider', 'user', 'job_provider', '<i class="fas fa-fw fa-users"></i>'),
	(3, 'Job Seeker', 'user', 'job_seeker', '<i class="fas fa-fw fa-users"></i>'),
	(4, 'Job Posting', 'user', 'job_posting', '<i class="fas fa-fw fa-calendar-check"></i>'),
	(5, 'Fitur Premium', 'premium', NULL, '<i class="fas fa-fw fa-trophy"></i>'),
	(6, 'Notifikasi', 'notifikasi', NULL, '<i class="fas fa-bell fa-fw"></i>'),
	(7, 'Inbox', 'chat', NULL, '<i class="fas fa-comments fa-fw"></i>'),
	(8, 'Report', 'report', NULL, '<i class="fas fa-flag fa-fw"></i>'),
	(9, 'Settings', NULL, NULL, '<i class="fas fa-cog fa-fw"></i>');

-- membuang struktur untuk table db_talent_hub.tbl_master_skill
CREATE TABLE IF NOT EXISTS `tbl_master_skill` (
  `skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_nama` varchar(250) DEFAULT NULL,
  `skill_status` int(11) DEFAULT 1,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_skill: ~20 rows (lebih kurang)
INSERT INTO `tbl_master_skill` (`skill_id`, `skill_nama`, `skill_status`) VALUES
	(4, 'Corel Draw', 1),
	(5, 'Adobe Photoshop', 1),
	(6, 'Codeigniter', 1),
	(7, 'Java', 1),
	(8, 'Python', 1),
	(9, 'Maintenance Gedung', 1),
	(10, 'C++', 1),
	(11, 'SEO', 1),
	(12, 'Google Ads Manager', 1),
	(13, 'Creative Content Writing', 1),
	(14, 'Facebook Ads', 1),
	(15, 'Tiktok Ads', 1),
	(16, 'Seo Analyst', 1),
	(17, 'Tiktok Creator', 1),
	(18, 'Hacking', 1),
	(19, NULL, 1),
	(20, NULL, 1),
	(21, 'Adobe Illustrator', 1),
	(22, 'Figma', 1),
	(23, 'Adobe Premiere', 1),
	(24, 'Cleaning Services', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_slider
CREATE TABLE IF NOT EXISTS `tbl_master_slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_gambar` text DEFAULT NULL,
  `slider_tipe` varchar(50) DEFAULT NULL,
  `slider_status` int(11) DEFAULT 1,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_slider: ~5 rows (lebih kurang)
INSERT INTO `tbl_master_slider` (`slider_id`, `slider_gambar`, `slider_tipe`, `slider_status`) VALUES
	(1, 'assets/img/slider/slider1657552714jobless.jpg', 'main', 1),
	(2, 'assets/img/slider/slider1657553191cv_bg.jpg', 'cv', 1),
	(4, 'assets/img/slider/slider1657558456product7.jpg', 'how', 1),
	(5, 'assets/img/slider/slider1659992460talenthub.png', 'all', 1),
	(6, 'assets/img/slider/slider1659993108backgroundbawah.jpg', 'dashboard_seeker', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_stp
CREATE TABLE IF NOT EXISTS `tbl_master_stp` (
  `stp_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_nama` varchar(250) DEFAULT NULL,
  `stp_pemilik` varchar(250) DEFAULT NULL,
  `stp_logo` text DEFAULT NULL,
  `stp_facebook` text DEFAULT NULL,
  `stp_instagram` text DEFAULT NULL,
  `stp_website` text DEFAULT NULL,
  `stp_telepon` varchar(50) DEFAULT NULL,
  `stp_email` varchar(150) DEFAULT NULL,
  `stp_alamat` text DEFAULT NULL,
  `stp_tagline` text DEFAULT NULL,
  `stp_brand_icon` text DEFAULT NULL,
  PRIMARY KEY (`stp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_stp: ~1 rows (lebih kurang)
INSERT INTO `tbl_master_stp` (`stp_id`, `stp_nama`, `stp_pemilik`, `stp_logo`, `stp_facebook`, `stp_instagram`, `stp_website`, `stp_telepon`, `stp_email`, `stp_alamat`, `stp_tagline`, `stp_brand_icon`) VALUES
	(2, 'Talent Hub', 'Solo Techno Park', 'assets/img/foto_stp/logo1657549008LOGO STP warna besar.png', '', '', '', '', '', '', '', 'assets/img/foto_icon/icon1658986604logo apps.png');

-- membuang struktur untuk table db_talent_hub.tbl_master_user
CREATE TABLE IF NOT EXISTS `tbl_master_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(250) NOT NULL,
  `user_nama` varchar(150) DEFAULT NULL,
  `user_password` varchar(150) DEFAULT NULL,
  `user_status` int(1) DEFAULT 1,
  `perusahaan_id` int(11) DEFAULT 1,
  `user_level` int(1) DEFAULT NULL,
  `user_login_status` int(1) DEFAULT 0,
  `user_foto` text DEFAULT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_updated_date` datetime DEFAULT NULL,
  `user_telepon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_user: ~12 rows (lebih kurang)
INSERT INTO `tbl_master_user` (`user_id`, `user_email`, `user_nama`, `user_password`, `user_status`, `perusahaan_id`, `user_level`, `user_login_status`, `user_foto`, `user_created_date`, `user_updated_date`, `user_telepon`) VALUES
	(1, 'athoxusdah@gmail.com', 'Superadmin', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 1, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-06-28 11:14:54', '2022-08-09 11:45:29', '085921923978'),
	(3, 'schemasumanta@gmail.com', 'Sumanta', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 2, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-06-28 11:14:54', NULL, '085921923978'),
	(4, 'athoxzoemanta@gmail.com', 'Super Door', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 6, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-06-28 11:14:54', NULL, '085921923978'),
	(28, 'janu@gmail.com', 'Janu', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 2, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-20 08:11:11', NULL, '08787878787877'),
	(31, 'jimy@gmail.com', 'Jimy', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 2, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-20 10:08:25', NULL, '0878787878'),
	(32, 'metrotv212@gmail.com', 'MetrotvNews', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 3, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-22 09:50:27', NULL, '0878787878'),
	(33, 'suherman@gg.com', 'Suherman', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 4, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-22 10:27:03', NULL, '0879759878'),
	(34, 'mayang@gmail.com', 'mayang', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 0, 2, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-27 15:15:48', NULL, '08787878787'),
	(35, 'mayang2@gmail.com', 'Hamdani', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 5, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-07-27 15:17:23', NULL, '08787878'),
	(36, 'asih_schema@gmail.com', 'Asih', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 10, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-08-02 09:25:06', NULL, '0898 0723 2633'),
	(37, 'a@bcc.com', 'ucup2', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 11, 3, 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser.png?alt=media&token=a4827b22-b777-4bc4-89a9-96ee13810122', '2022-08-03 14:43:33', NULL, '0858585858588'),
	(38, 'a@b.com', 'admin2', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 1, 1, 1, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Ffoto_user%2Fuser-p.png?alt=media&token=01d48e7e-f959-4eff-a57b-af329fbb00aa', '2022-08-09 02:38:21', '2022-08-10 22:07:54', '087878878687');

-- membuang struktur untuk table db_talent_hub.tbl_notifikasi
CREATE TABLE IF NOT EXISTS `tbl_notifikasi` (
  `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `notifikasi_pengirim` int(11) DEFAULT NULL,
  `notifikasi_key` varchar(50) DEFAULT NULL,
  `notifikasi_isi` text DEFAULT NULL,
  `notifikasi_judul` text DEFAULT NULL,
  `notifikasi_tanggal` datetime DEFAULT NULL,
  `notifikasi_lampiran` text DEFAULT NULL,
  `notifikasi_link` text DEFAULT NULL,
  PRIMARY KEY (`notifikasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_notifikasi: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_pelamar_pekerjaan
CREATE TABLE IF NOT EXISTS `tbl_pelamar_pekerjaan` (
  `lamaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelamar_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `lamaran_tanggal` datetime NOT NULL,
  `lamaran_deskripsi` text NOT NULL,
  `lamaran_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lamaran_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_pelamar_pekerjaan: ~2 rows (lebih kurang)
INSERT INTO `tbl_pelamar_pekerjaan` (`lamaran_id`, `pelamar_id`, `lowongan_id`, `lamaran_tanggal`, `lamaran_deskripsi`, `lamaran_status`) VALUES
	(2, 3, 7, '2022-08-05 18:56:39', 'Saya Seorang Pekerja Keras dan Berparas anggun', 1),
	(3, 3, 8, '2022-08-05 19:36:04', 'gjkgjk', 1);

-- membuang struktur untuk table db_talent_hub.tbl_penerima_notifikasi
CREATE TABLE IF NOT EXISTS `tbl_penerima_notifikasi` (
  `penerima_notifikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `notifikasi_key` varchar(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `read_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`penerima_notifikasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_penerima_notifikasi: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_pengalaman_resume
CREATE TABLE IF NOT EXISTS `tbl_pengalaman_resume` (
  `pengalaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `joblevel_id` int(11) NOT NULL,
  `pengalaman_deskripsi` text DEFAULT NULL,
  `jabatan_id` int(11) NOT NULL DEFAULT 0,
  `pengalaman_tanggal_awal` date DEFAULT NULL,
  `pengalaman_tanggal_akhir` date DEFAULT NULL,
  `masih_bekerja` int(11) DEFAULT 0,
  PRIMARY KEY (`pengalaman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_pengalaman_resume: ~4 rows (lebih kurang)
INSERT INTO `tbl_pengalaman_resume` (`pengalaman_id`, `user_id`, `perusahaan_id`, `joblevel_id`, `pengalaman_deskripsi`, `jabatan_id`, `pengalaman_tanggal_awal`, `pengalaman_tanggal_akhir`, `masih_bekerja`) VALUES
	(1, 3, 3, 1, 'Mencari rejeki', 1, '0000-00-00', '0000-00-00', 0),
	(2, 3, 6, 15, '<p>Maintenance Komputer dan Jaringan</p>', 2, '2022-08-01', '2022-08-01', NULL),
	(3, 3, 7, 18, '<p>Menjadi Sales Pemasaran yang sholehah dan penyendiri</p>', 1, '2022-01-02', NULL, 1),
	(5, 3, 9, 22, '<p>Membersihkan tempat tidurku</p><p>bantal guling bau ompol</p>', 5, '2022-08-02', NULL, 1);

-- membuang struktur untuk table db_talent_hub.tbl_perusahaan
CREATE TABLE IF NOT EXISTS `tbl_perusahaan` (
  `perusahaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan_nama` varchar(250) NOT NULL DEFAULT '0',
  `perusahaan_sambutan` text NOT NULL,
  `perusahaan_prov` char(2) DEFAULT '0',
  `perusahaan_kabkota` int(5) DEFAULT 0,
  `perusahaan_alamat` text DEFAULT NULL,
  `perusahaan_telepon` varchar(150) DEFAULT '',
  `perusahaan_email` varchar(150) DEFAULT '',
  `perusahaan_website` varchar(250) DEFAULT '',
  `perusahaan_jml_karyawan` int(11) DEFAULT NULL,
  `perusahaan_logo` text DEFAULT NULL,
  `perusahaan_sampul` text DEFAULT NULL,
  `perusahaan_visitor` int(11) DEFAULT NULL,
  PRIMARY KEY (`perusahaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_perusahaan: ~10 rows (lebih kurang)
INSERT INTO `tbl_perusahaan` (`perusahaan_id`, `perusahaan_nama`, `perusahaan_sambutan`, `perusahaan_prov`, `perusahaan_kabkota`, `perusahaan_alamat`, `perusahaan_telepon`, `perusahaan_email`, `perusahaan_website`, `perusahaan_jml_karyawan`, `perusahaan_logo`, `perusahaan_sampul`, `perusahaan_visitor`) VALUES
	(1, 'Solo Techno Park', '', 'BT', 50, '', '0215212562367', 'a@b.com', '', 250, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fprovider%2Fperusahaan%2F1658427796260stempel%20clear.png?alt=media&token=373dc453-7ca3-4a6d-bbf9-fe13128a6bfd', NULL, NULL),
	(3, 'PT. Metro News TV', 'Perusahaan yang dibidang Jasa Pemesanan Pesawat Pesiar dan Pesaing Terberat Hollywoods yang terevakuasi dengan integritas yang solid dan dominan dalam kesenjangan sosial', 'JK', 142, 'Jl. Kapten Pierre Tendean No. 57 Gambir', '0215212562367', 'metroku@b.com', 'www.metrotv.com', 5000, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fperusahaan%2Fsbi%20logo.jpg?alt=media&token=56d472cc-f85d-4b56-862f-8f98ebfb0718', 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fperusahaan%2Fsampul.jpg?alt=media&token=1ee556ba-9b69-4f28-a597-cfb1c209d845', 2),
	(4, 'MANTA APPS', 'Perusahaan yang dibidang Jasa Pemesanan Pesawat Pesiar dan Pesaing Terberat Hollywoods yang terevakuasi dengan integritas yang solid dan dominan dalam kesenjangan sosial', 'JT', 179, 'Jl. Malioboro 27 Blok F29 Solo', '0215212562367', 'a@b.com', 'www.mantaapps.com', 50, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fprovider%2Fperusahaan%2F1658478597932MANTAAPPS.png?alt=media&token=e4fc698d-d1b8-498d-8001-c37fc9e6a1f0', NULL, NULL),
	(5, 'PT UNTUNG RUGI', 'Kami bergerak cepat seperti KRL dan MRT', 'BA', 25, 'Jl. Tani No 99 Namek', '', '', '', 0, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fprovider%2Fperusahaan%2F1658928070274pngtree-vector-illustration-lovely-mother-png-image_1115780.jpg?alt=media&token=eb071e0a-76bd-4034-a85c-48c4ce452ccf', NULL, NULL),
	(6, 'Super Door', '', '0', 0, NULL, '', '', '', NULL, NULL, NULL, NULL),
	(7, 'PT. Super Teknik', '', '0', 0, NULL, '', '', '', NULL, NULL, NULL, NULL),
	(8, 'PT. AbyNET', '', '0', 0, NULL, '', '', '', NULL, NULL, NULL, NULL),
	(9, 'PT. Raja Pintu Baja', '', '0', 0, NULL, '', '', '', NULL, NULL, NULL, NULL),
	(10, 'PT. Mayora Indah Jatake 2', 'Kami Bergerak di bidang food rescue', 'BT', 56, 'Jl. Jatake No. 18 Cikupa - Tangerang', '0215212562367', 'info@mayora.id', 'www.mayoraindah.com', 5000, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fperusahaan%2FMayora_logo.png?alt=media&token=db7af899-9ce5-40e3-aa8c-3e337a8ed0a3', 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fperusahaan%2F107041088-1649062227517-gettyimages-1235868440-INDONESIA_COAL.jpeg?alt=media&token=f6af4c6e-94be-4ded-8618-52b7e5e8efc1', 77),
	(11, 'PT SLEBEW', '', '0', 0, NULL, '', '', '', NULL, NULL, NULL, NULL);

-- membuang struktur untuk table db_talent_hub.tbl_premium
CREATE TABLE IF NOT EXISTS `tbl_premium` (
  `premium_id` int(11) NOT NULL AUTO_INCREMENT,
  `premium_nama` varchar(150) NOT NULL DEFAULT '0',
  `premium_tipe` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`premium_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_premium: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_report
CREATE TABLE IF NOT EXISTS `tbl_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter` int(11) NOT NULL,
  `reported` int(11) NOT NULL,
  `report_keterangan` text NOT NULL,
  `report_tanggal` datetime NOT NULL,
  `report_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`report_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_report: ~0 rows (lebih kurang)
INSERT INTO `tbl_report` (`report_id`, `reporter`, `reported`, `report_keterangan`, `report_tanggal`, `report_status`) VALUES
	(1, 3, 36, 'Penipuan', '2022-08-10 20:24:53', 1);

-- membuang struktur untuk table db_talent_hub.tbl_resume
CREATE TABLE IF NOT EXISTS `tbl_resume` (
  `resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pendidikan_id` int(11) DEFAULT NULL,
  `prov_id` char(2) DEFAULT NULL,
  `kabkota_id` int(5) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `resume_nama_pendidikan_terakhir` varchar(250) DEFAULT NULL,
  `resume_pendidikan_tahun_lulus` varchar(4) DEFAULT NULL,
  `resume_nama_lengkap` varchar(250) DEFAULT NULL,
  `resume_foto` text DEFAULT NULL,
  `resume_about` text DEFAULT NULL,
  `resume_nik` varchar(16) DEFAULT NULL,
  `resume_alamat_lengkap` text DEFAULT NULL,
  `resume_jenis_kelamin` char(2) DEFAULT NULL,
  `resume_tempat_lahir` varchar(150) DEFAULT NULL,
  `resume_tanggal_lahir` date DEFAULT NULL,
  `resume_created_date` datetime DEFAULT NULL,
  `resume_visitor` int(11) DEFAULT NULL,
  PRIMARY KEY (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_resume: ~1 rows (lebih kurang)
INSERT INTO `tbl_resume` (`resume_id`, `user_id`, `pendidikan_id`, `prov_id`, `kabkota_id`, `agama_id`, `resume_nama_pendidikan_terakhir`, `resume_pendidikan_tahun_lulus`, `resume_nama_lengkap`, `resume_foto`, `resume_about`, `resume_nik`, `resume_alamat_lengkap`, `resume_jenis_kelamin`, `resume_tempat_lahir`, `resume_tanggal_lahir`, `resume_created_date`, `resume_visitor`) VALUES
	(4, 3, 3, 'BT', 50, 1, 'SMK Mulia Hati Insani', '2013', 'Sumanta', 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fcv%2FPas%20Photo%20merah%20sumanta.JPG?alt=media&token=8682bcd4-c467-4f3e-b6fe-bc3977540d70', '<p>Saya seorang pekerja keras yang memiliki otak seperti RUCIKA yang kepintarannya mengalir sampai jauh. dan juga seperti tepung bumbu yang harus SERBAGUNA</p>', '3602240704950004', 'Jl. Sunan Giri No. 18L Rangkasbitung', 'L', 'Lebak', '1995-08-08', '2022-07-26 14:02:02', NULL);

-- membuang struktur untuk table db_talent_hub.tbl_resume_lampiran
CREATE TABLE IF NOT EXISTS `tbl_resume_lampiran` (
  `lampiran_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resume_lampiran` text DEFAULT NULL,
  `lampiran_created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lampiran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_resume_lampiran: ~1 rows (lebih kurang)
INSERT INTO `tbl_resume_lampiran` (`lampiran_id`, `user_id`, `resume_lampiran`, `lampiran_created_date`) VALUES
	(14, 3, 'https://firebasestorage.googleapis.com/v0/b/solo-digital-tech.appspot.com/o/talent_hub%2Fcv%2FSERTIFIKAT%20MAGANG%20NOVI.pdf?alt=media&token=bb5f12b6-59d0-40f0-ba19-45cbd55229fe', '2022-08-05 15:54:01');

-- membuang struktur untuk table db_talent_hub.tbl_skill_level
CREATE TABLE IF NOT EXISTS `tbl_skill_level` (
  `skill_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_level_nama` varchar(250) DEFAULT NULL,
  `skill_level_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`skill_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_skill_level: ~4 rows (lebih kurang)
INSERT INTO `tbl_skill_level` (`skill_level_id`, `skill_level_nama`, `skill_level_status`) VALUES
	(1, 'Beginner', 1),
	(2, 'Intermediate', 1),
	(3, 'Advance', 1),
	(4, 'Professional', 1);

-- membuang struktur untuk table db_talent_hub.tbl_skill_resume
CREATE TABLE IF NOT EXISTS `tbl_skill_resume` (
  `skill_resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `skill_level_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`skill_resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_skill_resume: ~2 rows (lebih kurang)
INSERT INTO `tbl_skill_resume` (`skill_resume_id`, `skill_id`, `user_id`, `skill_level_id`) VALUES
	(20, 4, 3, 4),
	(21, 5, 3, 3);

-- membuang struktur untuk table db_talent_hub.tbl_subscribe
CREATE TABLE IF NOT EXISTS `tbl_subscribe` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscribe_status` int(11) NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_subscribe: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_token
CREATE TABLE IF NOT EXISTS `tbl_token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token_isi` varchar(150) DEFAULT NULL,
  `token_expired_date` datetime DEFAULT NULL,
  `token_keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `token_isi` (`token_isi`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT='Y ';

-- Membuang data untuk tabel db_talent_hub.tbl_token: ~0 rows (lebih kurang)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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

-- membuang struktur untuk table db_talent_hub.tbl_bahasa_resume
CREATE TABLE IF NOT EXISTS `tbl_bahasa_resume` (
  `bahasa_resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bahasa_id` int(11) NOT NULL,
  `resume_bahasa_level` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bahasa_resume_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `bahasa_id` (`bahasa_id`),
  CONSTRAINT `tbl_bahasa_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_bahasa_resume_ibfk_2` FOREIGN KEY (`bahasa_id`) REFERENCES `tbl_master_bahasa` (`bahasa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_bahasa_resume: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_chat
CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_pengirim` int(11) NOT NULL,
  `chat_penerima` int(11) NOT NULL,
  `chat_isi` text NOT NULL,
  `chat_tanggal` datetime NOT NULL,
  `chat_lampiran` text NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `chat_pengirim` (`chat_pengirim`),
  KEY `chat_penerima` (`chat_penerima`),
  CONSTRAINT `tbl_chat_ibfk_1` FOREIGN KEY (`chat_pengirim`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_chat_ibfk_2` FOREIGN KEY (`chat_penerima`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_chat: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_history
CREATE TABLE IF NOT EXISTS `tbl_history` (
  `kode_history` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(50) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` text NOT NULL,
  PRIMARY KEY (`kode_history`) USING BTREE,
  KEY `id_user` (`id_user`),
  CONSTRAINT `tbl_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_history: ~92 rows (lebih kurang)
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
	(104, '2022-07-12 07:45:40', '::1', 1, 'Menambah Data Jabatan Baru HRD');

-- membuang struktur untuk table db_talent_hub.tbl_langganan_premium
CREATE TABLE IF NOT EXISTS `tbl_langganan_premium` (
  `langganan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `premium_id` int(11) DEFAULT NULL,
  `premium_masa_aktif` date DEFAULT NULL,
  PRIMARY KEY (`langganan_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `premium_id` (`premium_id`),
  CONSTRAINT `tbl_langganan_premium_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_langganan_premium_ibfk_2` FOREIGN KEY (`premium_id`) REFERENCES `tbl_premium` (`premium_id`)
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
  `lowongan_gaji` varchar(250) DEFAULT NULL,
  `lowongan_created_date` datetime DEFAULT NULL,
  `lowongan_end_date` datetime DEFAULT NULL,
  `lowongan_updated_date` datetime DEFAULT NULL,
  `lowongan_deskripsi` text DEFAULT NULL,
  `lowongan_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`lowongan_id`),
  KEY `joblevel_id` (`joblevel_id`),
  KEY `perusahaan_id` (`perusahaan_id`),
  KEY `user_id` (`user_id`),
  KEY `jabatan_id` (`jabatan_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `tbl_lowongan_pekerjaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_lowongan_pekerjaan_ibfk_2` FOREIGN KEY (`joblevel_id`) REFERENCES `tbl_master_level_job` (`joblevel_id`),
  CONSTRAINT `tbl_lowongan_pekerjaan_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_master_kategori_job` (`kategori_id`),
  CONSTRAINT `tbl_lowongan_pekerjaan_ibfk_4` FOREIGN KEY (`perusahaan_id`) REFERENCES `tbl_perusahaan` (`perusahaan_id`),
  CONSTRAINT `tbl_lowongan_pekerjaan_ibfk_5` FOREIGN KEY (`jabatan_id`) REFERENCES `tbl_master_jabatan` (`jabatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_pekerjaan: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_lowongan_skill
CREATE TABLE IF NOT EXISTS `tbl_lowongan_skill` (
  `lowongan_skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `lowongan_id` int(11) NOT NULL DEFAULT 0,
  `skill_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lowongan_skill_id`),
  KEY `lowongan_id` (`lowongan_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `tbl_lowongan_skill_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `tbl_lowongan_pekerjaan` (`lowongan_id`),
  CONSTRAINT `tbl_lowongan_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `tbl_master_skill` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_skill: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_lowongan_tersimpan
CREATE TABLE IF NOT EXISTS `tbl_lowongan_tersimpan` (
  `lowongan_tersimpan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `lowongan_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lowongan_tersimpan_id`),
  KEY `user_id` (`user_id`),
  KEY `lowongan_id` (`lowongan_id`),
  CONSTRAINT `tbl_lowongan_tersimpan_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `tbl_lowongan_pekerjaan` (`lowongan_id`),
  CONSTRAINT `tbl_lowongan_tersimpan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_lowongan_tersimpan: ~0 rows (lebih kurang)

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_jabatan: ~8 rows (lebih kurang)
INSERT INTO `tbl_master_jabatan` (`jabatan_id`, `jabatan_nama`, `jabatan_status`) VALUES
	(1, 'IT Staff', 1),
	(2, 'IT Support', 1),
	(3, 'Sales Representative', 1),
	(4, 'Receptionist', 1),
	(5, 'Office Boy', 1),
	(6, 'IT Programmer', 1),
	(7, 'Digital Creative', 1),
	(8, 'HRD', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_kabkota
CREATE TABLE IF NOT EXISTS `tbl_master_kabkota` (
  `prov_id` char(2) NOT NULL DEFAULT '0',
  `kabkota_nama` varchar(50) DEFAULT NULL,
  `kabkota_id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kabkota_id`),
  KEY `prov_ID` (`prov_id`) USING BTREE
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_kategori_job: ~3 rows (lebih kurang)
INSERT INTO `tbl_master_kategori_job` (`kategori_id`, `kategori_nama`, `kategori_status`, `kategori_icon`) VALUES
	(1, 'Design & Creative', 1, 'assets/img/icon_kategori/icon1657599869chatbubble.png'),
	(2, 'Architecture', 1, 'assets/img/icon_kategori/icon1657602782logoraja.png'),
	(3, 'Financial', 1, 'assets/img/icon_kategori/icon1657603009ig1.jpg');

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
  `prov_Nama` varchar(50) DEFAULT NULL,
  `prov_Lat` varchar(25) NOT NULL,
  `prov_Long` varchar(25) NOT NULL,
  PRIMARY KEY (`prov_id`) USING BTREE,
  CONSTRAINT `tbl_master_provinsi_ibfk_1` FOREIGN KEY (`prov_id`) REFERENCES `tbl_master_kabkota` (`prov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_provinsi: ~34 rows (lebih kurang)
INSERT INTO `tbl_master_provinsi` (`prov_id`, `prov_Nama`, `prov_Lat`, `prov_Long`) VALUES
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

-- membuang struktur untuk table db_talent_hub.tbl_master_skill
CREATE TABLE IF NOT EXISTS `tbl_master_skill` (
  `skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_nama` varchar(250) DEFAULT NULL,
  `skill_status` int(11) DEFAULT 1,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_skill: ~5 rows (lebih kurang)
INSERT INTO `tbl_master_skill` (`skill_id`, `skill_nama`, `skill_status`) VALUES
	(4, 'Corel Draw', 1),
	(5, 'Adobe Photoshop', 1),
	(6, 'Codeigniter', 1),
	(7, 'Java', 1),
	(8, 'Python', 1);

-- membuang struktur untuk table db_talent_hub.tbl_master_slider
CREATE TABLE IF NOT EXISTS `tbl_master_slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_gambar` text DEFAULT NULL,
  `slider_tipe` varchar(50) DEFAULT NULL,
  `slider_status` int(11) DEFAULT 1,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_slider: ~3 rows (lebih kurang)
INSERT INTO `tbl_master_slider` (`slider_id`, `slider_gambar`, `slider_tipe`, `slider_status`) VALUES
	(1, 'assets/img/slider/slider1657552714jobless.jpg', 'main', 1),
	(2, 'assets/img/slider/slider1657553191cv_bg.jpg', 'cv', 1),
	(4, 'assets/img/slider/slider1657558456product7.jpg', 'how', 1);

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
  PRIMARY KEY (`stp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_stp: ~1 rows (lebih kurang)
INSERT INTO `tbl_master_stp` (`stp_id`, `stp_nama`, `stp_pemilik`, `stp_logo`, `stp_facebook`, `stp_instagram`, `stp_website`, `stp_telepon`, `stp_email`, `stp_alamat`, `stp_tagline`) VALUES
	(2, 'Talent Hub', 'Solo Techno Park', 'assets/img/foto_stp/logo1657549008LOGO STP warna besar.png', '', '', '', '', '', '', '');

-- membuang struktur untuk table db_talent_hub.tbl_master_user
CREATE TABLE IF NOT EXISTS `tbl_master_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(250) NOT NULL,
  `user_nama` varchar(150) DEFAULT NULL,
  `user_password` varchar(150) DEFAULT NULL,
  `user_status` int(1) DEFAULT 1,
  `user_level` int(1) DEFAULT NULL,
  `user_login_status` int(1) DEFAULT 0,
  `user_foto` text DEFAULT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_updated_date` datetime DEFAULT NULL,
  `user_telepon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `user_level` (`user_level`),
  CONSTRAINT `tbl_master_user_ibfk_1` FOREIGN KEY (`user_level`) REFERENCES `tbl_master_level` (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_master_user: ~1 rows (lebih kurang)
INSERT INTO `tbl_master_user` (`user_id`, `user_email`, `user_nama`, `user_password`, `user_status`, `user_level`, `user_login_status`, `user_foto`, `user_created_date`, `user_updated_date`, `user_telepon`) VALUES
	(1, 'athoxusdah@gmail.com', 'Sumanta', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 1, 0, 'assets_admin/img/profile.svg', '2022-06-28 11:14:54', NULL, '085921923978'),
	(3, 'schemasumanta@gmail.com', 'Sumanta', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 2, 1, 'assets_admin/img/profile.svg', '2022-06-28 11:14:54', NULL, '085921923978');

-- membuang struktur untuk table db_talent_hub.tbl_notifikasi
CREATE TABLE IF NOT EXISTS `tbl_notifikasi` (
  `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `notifikasi_pengirim` int(11) DEFAULT NULL,
  `notifikasi_penerima` int(11) DEFAULT NULL,
  `notifikasi_isi` text DEFAULT NULL,
  `notifikasi_tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`notifikasi_id`),
  KEY `notifikasi_pengirim` (`notifikasi_pengirim`),
  KEY `notifikasi_penerima` (`notifikasi_penerima`),
  CONSTRAINT `tbl_notifikasi_ibfk_1` FOREIGN KEY (`notifikasi_pengirim`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_notifikasi_ibfk_2` FOREIGN KEY (`notifikasi_penerima`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_notifikasi: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_pelamar_pekerjaan
CREATE TABLE IF NOT EXISTS `tbl_pelamar_pekerjaan` (
  `lamaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `lamaran_tanggal` datetime NOT NULL,
  `lamaran_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`lamaran_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `lowongan_id` (`lowongan_id`),
  CONSTRAINT `tbl_pelamar_pekerjaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_pelamar_pekerjaan_ibfk_2` FOREIGN KEY (`lowongan_id`) REFERENCES `tbl_lowongan_pekerjaan` (`lowongan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_pelamar_pekerjaan: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_pengalaman_resume
CREATE TABLE IF NOT EXISTS `tbl_pengalaman_resume` (
  `pengalaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `joblevel_id` int(11) NOT NULL,
  `pengalaman_deskripsi` text NOT NULL,
  `jabatan_id` int(11) NOT NULL DEFAULT 0,
  `pengalaman_tahun_awal` int(5) NOT NULL,
  `pengalaman_tahun_akhir` int(5) NOT NULL,
  PRIMARY KEY (`pengalaman_id`),
  KEY `perusahaan_id` (`perusahaan_id`),
  KEY `joblevel_id` (`joblevel_id`),
  KEY `user_id` (`user_id`),
  KEY `jabatan_id` (`jabatan_id`),
  CONSTRAINT `tbl_pengalaman_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_pengalaman_resume_ibfk_2` FOREIGN KEY (`perusahaan_id`) REFERENCES `tbl_perusahaan` (`perusahaan_id`),
  CONSTRAINT `tbl_pengalaman_resume_ibfk_3` FOREIGN KEY (`joblevel_id`) REFERENCES `tbl_master_level_job` (`joblevel_id`),
  CONSTRAINT `tbl_pengalaman_resume_ibfk_4` FOREIGN KEY (`jabatan_id`) REFERENCES `tbl_master_jabatan` (`jabatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_pengalaman_resume: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_perusahaan
CREATE TABLE IF NOT EXISTS `tbl_perusahaan` (
  `perusahaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan_nama` varchar(250) NOT NULL DEFAULT '0',
  `perusahaan_prov` char(2) NOT NULL DEFAULT '0',
  `perusahaan_kabkota` int(5) NOT NULL DEFAULT 0,
  `perusahaan_alamat` text NOT NULL,
  `perusahaan_telepon` varchar(150) NOT NULL DEFAULT '',
  `perusahaan_email` varchar(150) NOT NULL DEFAULT '',
  `perusahaan_website` varchar(250) NOT NULL DEFAULT '',
  `perusahaan_jml_karyawan` int(11) NOT NULL,
  `perusahaan_logo` text NOT NULL,
  PRIMARY KEY (`perusahaan_id`),
  KEY `perusahaan_prov` (`perusahaan_prov`),
  KEY `perusahaan_kabkota` (`perusahaan_kabkota`),
  CONSTRAINT `tbl_perusahaan_ibfk_1` FOREIGN KEY (`perusahaan_kabkota`) REFERENCES `tbl_master_kabkota` (`kabkota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_perusahaan: ~0 rows (lebih kurang)

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
  PRIMARY KEY (`report_id`) USING BTREE,
  KEY `reporter` (`reporter`),
  KEY `reported` (`reported`),
  CONSTRAINT `tbl_report_ibfk_1` FOREIGN KEY (`reporter`) REFERENCES `tbl_master_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbl_report_ibfk_2` FOREIGN KEY (`reported`) REFERENCES `tbl_perusahaan` (`perusahaan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_report: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_resume
CREATE TABLE IF NOT EXISTS `tbl_resume` (
  `resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pendidikan_id` int(11) NOT NULL,
  `prov_id` char(2) DEFAULT NULL,
  `kabkota_id` int(5) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `resume_nama_pendidikan_terakhir` varchar(250) NOT NULL,
  `resume_pendididkan_tahun_lulus` int(5) NOT NULL,
  `resume_nama_lengkap` varchar(250) NOT NULL,
  `resume_foto` text NOT NULL,
  `resume_lampiran` text DEFAULT NULL,
  `resume_nik` int(12) DEFAULT NULL,
  `resume_alamat_lengkap` text DEFAULT NULL,
  `resume_jenis_kelamin` char(2) DEFAULT NULL,
  `resume_tempat_lahir` varchar(150) DEFAULT NULL,
  `resume_tanggal_lahir` date DEFAULT NULL,
  PRIMARY KEY (`resume_id`),
  KEY `user_id` (`user_id`),
  KEY `pendidikan_id` (`pendidikan_id`),
  KEY `agama_id` (`agama_id`),
  KEY `prov_id` (`prov_id`),
  KEY `kabkota_id` (`kabkota_id`),
  CONSTRAINT `tbl_resume_ibfk_1` FOREIGN KEY (`agama_id`) REFERENCES `tbl_master_agama` (`agama_id`),
  CONSTRAINT `tbl_resume_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_resume_ibfk_3` FOREIGN KEY (`pendidikan_id`) REFERENCES `tbl_master_pendidikan` (`pendidikan_id`),
  CONSTRAINT `tbl_resume_ibfk_4` FOREIGN KEY (`kabkota_id`) REFERENCES `tbl_master_kabkota` (`kabkota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_resume: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_skill_level
CREATE TABLE IF NOT EXISTS `tbl_skill_level` (
  `skill_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_level_nama` varchar(250) DEFAULT NULL,
  `skill_level_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`skill_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_skill_level: ~3 rows (lebih kurang)
INSERT INTO `tbl_skill_level` (`skill_level_id`, `skill_level_nama`, `skill_level_status`) VALUES
	(1, 'Beginner', 1),
	(2, 'Intermediate', 1),
	(3, 'Professional', 1);

-- membuang struktur untuk table db_talent_hub.tbl_skill_resume
CREATE TABLE IF NOT EXISTS `tbl_skill_resume` (
  `skill_resume_id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `skill_level_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`skill_resume_id`),
  KEY `skill_id` (`skill_id`),
  KEY `user_id` (`user_id`),
  KEY `skill_level_id` (`skill_level_id`),
  CONSTRAINT `tbl_skill_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`),
  CONSTRAINT `tbl_skill_resume_ibfk_2` FOREIGN KEY (`skill_level_id`) REFERENCES `tbl_skill_level` (`skill_level_id`),
  CONSTRAINT `tbl_skill_resume_ibfk_3` FOREIGN KEY (`skill_id`) REFERENCES `tbl_master_skill` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_skill_resume: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_subscribe
CREATE TABLE IF NOT EXISTS `tbl_subscribe` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscribe_status` int(11) NOT NULL,
  PRIMARY KEY (`subscribe_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_subscribe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y';

-- Membuang data untuk tabel db_talent_hub.tbl_subscribe: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_token
CREATE TABLE IF NOT EXISTS `tbl_token` (
  `token_id` int(11) NOT NULL,
  `token_isi` varchar(150) DEFAULT NULL,
  `token_expired_date` datetime DEFAULT NULL,
  `token_keterangan` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `token_isi` (`token_isi`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_master_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Y ';

-- Membuang data untuk tabel db_talent_hub.tbl_token: ~0 rows (lebih kurang)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

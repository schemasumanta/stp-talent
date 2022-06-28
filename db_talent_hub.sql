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

-- membuang struktur untuk table db_talent_hub.tbl_master_agama
CREATE TABLE IF NOT EXISTS `tbl_master_agama` (
  `agama_id` int(10) NOT NULL AUTO_INCREMENT,
  `agama_nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`agama_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_agama: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_kabkota
CREATE TABLE IF NOT EXISTS `tbl_master_kabkota` (
  `kabkota_id` int(10) NOT NULL AUTO_INCREMENT,
  `prov_id` int(10) NOT NULL,
  `kabkota_nama` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`kabkota_id`),
  KEY `prov_id` (`prov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_kabkota: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_kategori_job
CREATE TABLE IF NOT EXISTS `tbl_master_kategori_job` (
  `kategori_id` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_nama` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_kategori_job: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_level
CREATE TABLE IF NOT EXISTS `tbl_master_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_nama` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_level: ~3 rows (lebih kurang)
INSERT INTO `tbl_master_level` (`level_id`, `level_nama`) VALUES
	(1, 'admin'),
	(2, 'job_seeker'),
	(3, 'job_provider');

-- membuang struktur untuk table db_talent_hub.tbl_master_pendidikan
CREATE TABLE IF NOT EXISTS `tbl_master_pendidikan` (
  `pendidikan_id` int(10) NOT NULL AUTO_INCREMENT,
  `pendidikan_nama` varchar(150) NOT NULL,
  PRIMARY KEY (`pendidikan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_pendidikan: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_provinsi
CREATE TABLE IF NOT EXISTS `tbl_master_provinsi` (
  `prov_id` int(10) NOT NULL AUTO_INCREMENT,
  `prov_nama` varchar(150) NOT NULL,
  PRIMARY KEY (`prov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_provinsi: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_skill
CREATE TABLE IF NOT EXISTS `tbl_master_skill` (
  `skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skil_nama` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_skill: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_talent_hub.tbl_master_stp
CREATE TABLE IF NOT EXISTS `tbl_master_stp` (
  `stp_id` int(11) NOT NULL AUTO_INCREMENT,
  `stp_nama` varchar(250) DEFAULT NULL,
  `stp_logo` text DEFAULT NULL,
  `stp_facebook` text DEFAULT NULL,
  `stp_instagram` text DEFAULT NULL,
  `stp_website` text DEFAULT NULL,
  `stp_telepon` varchar(50) DEFAULT NULL,
  `stp_email` varchar(150) DEFAULT NULL,
  `stp_alamat` text DEFAULT NULL,
  `stp_tagline` text DEFAULT NULL,
  PRIMARY KEY (`stp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_stp: ~0 rows (lebih kurang)

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
  KEY `user_level` (`user_level`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_talent_hub.tbl_master_user: ~1 rows (lebih kurang)
INSERT INTO `tbl_master_user` (`user_id`, `user_email`, `user_nama`, `user_password`, `user_status`, `user_level`, `user_login_status`, `user_foto`, `user_created_date`, `user_updated_date`, `user_telepon`) VALUES
	(1, 'athoxusdah@gmail.com', 'Sumanta', 'fbade9e36a3f36d3d676c1b808451dd7', 1, 1, 0, 'assets_admin/img/profile.svg', '2022-06-28 11:14:54', NULL, '085921923978');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

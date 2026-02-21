-- --------------------------------------------------------
-- Versi Perbaikan untuk Compatibility XAMPP/MariaDB
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Buat Database
CREATE DATABASE IF NOT EXISTS `ukk3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ukk3`;

-- 1. Tabel Admin
CREATE TABLE IF NOT EXISTS `admin` (
  `ID_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`ID_admin`, `username`, `password`) VALUES (1, 'Ikan', 'ikan123');

-- 2. Tabel Kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `ket_kategori` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
	(1, 'Fasilitas Sekolah'),
	(2, 'Kebersihan'),
	(3, 'Kegiatan Belajar'),
	(4, 'Lainnya');

-- 3. Tabel Siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '',
  `kelas` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=111223 DEFAULT CHARSET=utf8mb4;

INSERT INTO `siswa` (`nis`, `nama`, `kelas`) VALUES
	(111111, 'ihsan', '12 TKJ'),
	(111112, 'fafa', '11 RPL'),
	(111113, 'pandi', '12 RPL');

-- 4. Tabel Aspirasi (Dibuat terakhir karena butuh FK dari Siswa & Kategori)
CREATE TABLE IF NOT EXISTS `i_aspirasi` (
  `id_pelaporan` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `nis` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan`),
  KEY `FK_i_inspirasi_siswa` (`nis`),
  KEY `FK_i_aspirasi_kategori` (`id_kategori`),
  CONSTRAINT `FK_i_aspirasi_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_i_inspirasi_siswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO `i_aspirasi` (`id_pelaporan`, `id_kategori`, `lokasi`, `nis`, `status`, `ket`, `created_at`, `updated_at`) VALUES
	(18, 2, 'Sekolah', 111112, 'pending', 'pppp', '2026-02-21 11:25:22', '2026-02-21 07:00:30'),
	(22, 1, 'lapangan', 111113, 'selesai', 'tolong di perbaiki', '2026-02-21 11:40:10', NULL),
	(24, 2, 'sekolah', 111112, 'pending', 'ikan', '2026-02-21 06:52:51', '2026-02-21 07:00:58'),
	(26, 1, 'Lab 2', 111111, 'pending', 'Butuh projektor tambahan 3 unit', '2026-02-21 07:14:27', '2026-02-21 15:23:18');

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
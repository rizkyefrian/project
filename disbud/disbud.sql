-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`) VALUES
(1,	'disbud',	'97b3943f49421547b0bba4202c84c3f3',	'Dinas Kebudayaan Provinsi Sumbar',	'fotodisbud.png');

DROP TABLE IF EXISTS `bidang`;
CREATE TABLE `bidang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bidang` (`id`, `nip`, `bidang`, `nama`) VALUES
(1,	'196604041990101001',	'Kasubbag Umum dan Kepegawaian',	'Aprimas,S.Pd.,M.pd'),
(2,	'196604041899121001',	'Kasubbag Program dan Keuangan',	'Ilfitra,S.Stp.,MPA'),
(4,	'196211151993062001',	'Kabid Kesenian dan Diplomasi Budaya',	'Elvina Adi Yanti,SE,MM'),
(5,	'196809051997021002',	'Kabid Warisan Budaya dan Bahasa MinangKabau ',	'Drs.Syaifullah,M.M'),
(10,	'196501191963031001',	'kabid Sejarah, Adat, dan Nilai Tradisional',	'Drs.Januarison,M.Lis'),
(13,	'444',	'4444',	''),
(14,	'21',	'21',	'21');

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempatlhr` varchar(30) NOT NULL,
  `tgllahir` date NOT NULL,
  `jeniskelamin` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` varchar(40) NOT NULL,
  `hp` int(12) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gol` varchar(25) NOT NULL,
  `level` enum('Admin','Kepala Dinas','Kepala Bidang','Fungsional Umum') NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `tempatlhr`, `tgllahir`, `jeniskelamin`, `alamat`, `status`, `hp`, `jabatan`, `gol`, `level`, `password`, `foto`) VALUES
(5,	'admin',	'admin',	'Kota Padang',	'1995-10-10',	'Laki-Laki',	'Kota Padang',	'Belum Menikah',	2147483647,	'Admin Program',	'IV B',	'Admin',	'admin',	''),
(6,	'kepaladinas',	'Dra. Gemala ranti,M.Si',	'Kota Padang',	'1995-10-02',	'Perempuan',	'Kota Padang',	'Sudah Menikah',	213321,	'Kepala Dinas',	'IV B',	'Kepala Dinas',	'kepaladinas',	''),
(7,	'kepalabidang',	'kepalabidang',	'kepalabidang',	'1995-10-10',	'kepalabidang',	'kepalabidang',	'kepalabidang',	23312213,	'kepalabidang',	'kepalabidang',	'Kepala Bidang',	'kepalabidang',	''),
(8,	'fungsionalumum',	'fungsionalumum',	'fungsionalumum',	'1995-10-10',	'fungsionalumum',	'fungsionalumum',	'fungsionalumum',	312213,	'fungsionalumum',	'fungsionalumum',	'Fungsional Umum',	'fungsionalumum',	'Screenshot_(1).png');

DROP TABLE IF EXISTS `suratkeluar`;
CREATE TABLE `suratkeluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomorsk` varchar(50) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `tglsurat` date NOT NULL,
  `judulsurat` text NOT NULL,
  `tujuan` text NOT NULL,
  `perihal` text NOT NULL,
  `filesurat` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `suratkeluar` (`id`, `nomorsk`, `id_bidang`, `tglsurat`, `judulsurat`, `tujuan`, `perihal`, `filesurat`, `alamat`, `catatan`) VALUES
(24,	'sk/002/DNS',	10,	'2019-07-24',	'Surat pengajuan peminjaman ruang rapat II',	'Kominfo Kota Padang',	'Peminjaman gedung selama 2 hari untuk pelaksanaan bimtek',	'image5.jpg',	'Kota Padang',	'Surat Untuk seluruh OPD se-kota padang'),
(25,	'sk/002/DNS',	1,	'2019-07-05',	'0',	'0',	'0',	'image6.jpg',	'Kota Padang',	'Surat Untuk seluruh OPD se-kota padang'),
(27,	'sk/001/umum',	5,	'2019-07-05',	'Perjalanan dinas',	'Untuk melakukan perjalanan',	'Melakukan perjlana dinas',	'image8.jpg',	'Kota Padang',	'Surat Untuk seluruh OPD se-kota padang'),
(28,	'sk/umum/001',	5,	'2019-08-08',	'Surat Peminjaman Mobil Dinas',	'Untuk melakukan perjalanan',	'Perjalanan dinas',	'image9.jpg',	'Kota Padang',	'Selama 3 hari'),
(29,	'Nulla cum eum est qu',	5,	'2004-07-01',	'Quidem aliquam eveni',	'Deserunt nostrud quo',	'Porro ut quis rerum ',	'130819162805170900.png',	'Anim est magni neque',	'Dolorum voluptates e');

DROP TABLE IF EXISTS `suratmasuk`;
CREATE TABLE `suratmasuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomorsm` varchar(50) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `tglsurat` date NOT NULL,
  `tglditerima` date NOT NULL,
  `judulsurat` varchar(50) NOT NULL,
  `asalsurat` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `filesurat` varchar(100) NOT NULL,
  `perihalsurat` varchar(200) NOT NULL,
  `alamatsurat` varchar(100) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `website` varchar(30) NOT NULL,
  `status` varchar(50) DEFAULT 'Belum Di disposisi',
  `ket` text,
  `isidisposisi` text,
  `tgldisposisi` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `suratmasuk` (`id`, `nomorsm`, `id_bidang`, `tglsurat`, `tglditerima`, `judulsurat`, `asalsurat`, `email`, `filesurat`, `perihalsurat`, `alamatsurat`, `kodepos`, `website`, `status`, `ket`, `isidisposisi`, `tgldisposisi`) VALUES
(3,	'21212121',	1,	'2019-07-05',	'2019-07-06',	'Surat perjalanan Dinas',	'a',	'kominfopadang@gmail.com',	'logo.png',	'Pasfs',	'Padang',	25518,	'kominfopdg.go.id',	'ditolak',	'Dolorem facilis magn',	'Sit voluptatem sed ',	'1984-01-17'),
(4,	'sm/umum/123',	0,	'2019-07-05',	'2019-07-06',	'Surat perjalanan Dinas',	'kominfo',	'kominfopadang@gmail.com',	'logo1.png',	'Bimtek',	'Padang Barat',	25518,	'kominfopdg.go.id',	'',	'',	NULL,	NULL),
(7,	'sm/umum/123',	0,	'2019-07-05',	'2019-07-06',	'Surat perjalanan Dinas',	'Dishub',	'kominfopadang@gmail.com',	'logo4.png',	'Bimtek',	'Padang',	25518,	'kominfopdg.go.id',	'Confirm',	'Sudah Dijalankan',	NULL,	NULL),
(8,	'21212121',	0,	'2019-07-05',	'2019-07-06',	'Surat perjalanan Dinas',	'Dinsos',	'dinsos@gmail.com',	'image.jpg',	'haushaidksalda',	'Padang Barat',	25518,	'dinsos.go.id',	'Belum Di disposisi',	'Sudah Dijalankan',	NULL,	NULL),
(9,	'345683828765',	0,	'2019-09-08',	'2019-07-06',	'Surat Pelaksanaan Bimtek',	'Dishub',	'dinsos@gmail.com',	'image1.jpg',	'Bimtek',	'Kota Padang',	25518,	'dinsos.go.id',	'Belum Di disposisi',	'Sudah Dijalankan',	NULL,	NULL),
(10,	'sm/002/umum',	2,	'2019-08-08',	'2019-08-08',	'Perjalanan dinas',	'Kominfo',	'kominfo@gmail.com',	'image10.jpg',	'perjalanan dinas',	'Kota Padang',	3456,	'frge',	'acc',	'Enim corporis esse s',	'Laborum fugiat rem ',	'1983-10-24'),
(11,	'sm/002/umum',	2,	'2019-08-08',	'2019-08-08',	'Perjalanan dinas',	'Kominfo',	'kominfo@gmail.com',	'image11.jpg',	'perjalanan dinas',	'Kota Padang',	3456,	'frge',	'Belum Di disposisi',	'hdiewfnfe',	NULL,	NULL),
(12,	'sm/002/umum',	2,	'2019-08-08',	'2019-08-08',	'Perjalanan dinas',	'Kominfo',	'kominfo@gmail.com',	'image10.jpg',	'perjalanan dinas',	'Kota Padang',	3456,	'frge',	'Belum Di disposisi',	'hdiewfnfe',	NULL,	NULL),
(13,	'Voluptates irure lab',	5,	'1990-12-16',	'1980-03-27',	'Quis in quisquam con',	'Eiusmod eos nihil i',	'xovyja@mailinator.net',	'130819153442441400.png',	'Cumque debitis enim ',	'Rem qui dolor incidi',	12,	'https://www.fymyj.cc',	'Belum Di disposisi',	NULL,	NULL,	NULL);

-- 2019-08-13 17:20:20

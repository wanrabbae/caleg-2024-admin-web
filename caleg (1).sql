-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2022 pada 04.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caleg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(6) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `nama_agenda` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `caleg`
--

CREATE TABLE `caleg` (
  `id_caleg` int(4) NOT NULL,
  `nama_caleg` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `id_legislatif` int(4) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_partai` int(4) NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `caleg`
--

INSERT INTO `caleg` (`id_caleg`, `nama_caleg`, `nama_lengkap`, `id_legislatif`, `alamat`, `no_hp`, `email`, `id_partai`, `aktif`, `username`, `password`, `foto`) VALUES
(4, 'ajiz', 'iqbal', 1, 'Jl. Perjuangan No 45 Kota Cirebon', 2147483647, 'iqbalmr.pengusaha@gmail.com', 1, 'Y', 'admin', '808e2ed2ac6da54a945ce10a82c4fc1e', 'logo_kopdigital.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_isu`
--

CREATE TABLE `daftar_isu` (
  `id_isu` int(11) NOT NULL,
  `jenis` enum('L','O') NOT NULL DEFAULT 'L',
  `dampak` enum('P','N') NOT NULL DEFAULT 'P',
  `tanggal` date NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_relawan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggapi` date NOT NULL,
  `tanggapan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dapil`
--

CREATE TABLE `dapil` (
  `id_dapil` int(4) NOT NULL,
  `nama_dapil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dapil`
--

INSERT INTO `dapil` (`id_dapil`, `nama_dapil`) VALUES
(2, 'Dapil 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(6) UNSIGNED NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `dpt` int(10) NOT NULL,
  `tps` int(6) NOT NULL,
  `suara` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`id_desa`, `nama_desa`, `type`, `id_kecamatan`, `dpt`, `tps`, `suara`) VALUES
(1, 'Arjawinangun', 'Desa', 1, 0, 0, 0),
(2, 'Bulak', 'Desa', 1, 0, 0, 0),
(30, 'Geyongan', 'Desa', 1, 0, 0, 0),
(31, 'Jungjang  Wetan', 'Desa', 1, 0, 0, 0),
(32, 'Jungjang', 'Desa', 1, 0, 0, 0),
(33, 'Karangsambung', 'Desa', 1, 0, 0, 0),
(34, 'Kebonturi', 'Desa', 1, 0, 0, 0),
(35, 'Rawagatel', 'Desa', 1, 0, 0, 0),
(36, 'Sende', 'Desa', 1, 0, 0, 0),
(37, 'Tegalgubug', 'Desa', 1, 0, 0, 0),
(38, 'Tegalgubug Lor', 'Desa', 1, 0, 0, 0),
(39, 'Astanajapura', 'Desa', 2, 0, 0, 0),
(40, 'Buntet', 'Desa', 2, 0, 0, 0),
(41, 'Japura Kidul', 'Desa', 2, 0, 0, 0),
(42, 'Japurabakti', 'Desa', 2, 0, 0, 0),
(43, 'Kanci', 'Desa', 2, 0, 0, 0),
(44, 'Kanci Kulon', 'Desa', 2, 0, 0, 0),
(45, 'Kendal', 'Desa', 2, 0, 0, 0),
(46, 'Mertapada Kulon', 'Desa', 2, 0, 0, 0),
(47, 'Mertapada Wetan', 'Desa', 2, 0, 0, 0),
(48, 'Munjul', 'Desa', 2, 0, 0, 0),
(49, 'Sidamulya', 'Desa', 2, 0, 0, 0),
(50, 'Babakan', 'Desa', 3, 0, 0, 0),
(51, 'Babakangebang', 'Desa', 3, 0, 0, 0),
(52, 'Bojonggebang', 'Desa', 3, 0, 0, 0),
(53, 'Cangkuang', 'Desa', 3, 0, 0, 0),
(54, 'Gembongan', 'Desa', 3, 0, 0, 0),
(55, 'Gembonganmekar', 'Desa', 3, 0, 0, 0),
(56, 'Karangwangun', 'Desa', 3, 0, 0, 0),
(57, 'Kudukeras', 'Desa', 3, 0, 0, 0),
(58, 'Kudumulya', 'Desa', 3, 0, 0, 0),
(59, 'Pakusamben', 'Desa', 3, 0, 0, 0),
(60, 'Serang Kulon', 'Desa', 3, 0, 0, 0),
(61, 'Serang Wetan', 'Desa', 3, 0, 0, 0),
(62, 'Sumber Kidul', 'Desa', 3, 0, 0, 0),
(63, 'Sumber Lor', 'Desa', 3, 0, 0, 0),
(64, 'Beber', 'Desa', 4, 0, 0, 0),
(65, 'Ciawigajah', 'Desa', 4, 0, 0, 0),
(66, 'Cikancas', 'Desa', 4, 0, 0, 0),
(67, 'Cipinang', 'Desa', 4, 0, 0, 0),
(68, 'Halimpu', 'Desa', 4, 0, 0, 0),
(69, 'Kondangsari', 'Desa', 4, 0, 0, 0),
(70, 'Patapan', 'Desa', 4, 0, 0, 0),
(71, 'Sindanghayu', 'Desa', 4, 0, 0, 0),
(72, 'Sindangkasih', 'Desa', 4, 0, 0, 0),
(73, 'Wanayasa', 'Desa', 4, 0, 0, 0),
(74, 'Bojongnegara', 'Desa', 5, 0, 0, 0),
(75, 'Ciledug Kulon', 'Desa', 5, 0, 0, 0),
(76, 'Ciledug Lor', 'Desa', 5, 0, 0, 0),
(77, 'Ciledug Tengah', 'Desa', 5, 0, 0, 0),
(78, 'Ciledug Wetan', 'Desa', 5, 0, 0, 0),
(79, 'Damarguna', 'Desa', 5, 0, 0, 0),
(80, 'Jatiseeng', 'Desa', 5, 0, 0, 0),
(81, 'Jatiseeng Kidul', 'Desa', 5, 0, 0, 0),
(82, 'Leuweunggajah', 'Desa', 5, 0, 0, 0),
(83, 'Tenjomaya', 'Desa', 5, 0, 0, 0),
(84, 'Babakan', 'Desa', 6, 0, 0, 0),
(85, 'Bringin', 'Desa', 6, 0, 0, 0),
(86, 'Budur', 'Desa', 6, 0, 0, 0),
(87, 'Ciwaringin', 'Desa', 6, 0, 0, 0),
(88, 'Galagamba', 'Desa', 6, 0, 0, 0),
(89, 'Gintung Kidul', 'Desa', 6, 0, 0, 0),
(90, 'Gintung Tengah', 'Desa', 6, 0, 0, 0),
(91, 'Gintungranjeng', 'Desa', 6, 0, 0, 0),
(92, 'Cikeduk', 'Desa', 7, 0, 0, 0),
(93, 'Depok', 'Desa', 7, 0, 0, 0),
(94, 'Getasan', 'Desa', 7, 0, 0, 0),
(95, 'Karangwangi', 'Desa', 7, 0, 0, 0),
(96, 'Kasugengan Kidul', 'Desa', 7, 0, 0, 0),
(97, 'Kasugengan Lor', 'Desa', 7, 0, 0, 0),
(98, 'Keduanan', 'Desa', 7, 0, 0, 0),
(99, 'Kejuden', 'Desa', 7, 0, 0, 0),
(100, 'Warugede', 'Desa', 7, 0, 0, 0),
(101, 'Warujaya', 'Desa', 7, 0, 0, 0),
(102, 'Warukawung', 'Desa', 7, 0, 0, 0),
(103, 'Waruroyom', 'Desa', 7, 0, 0, 0),
(104, 'Balad', 'Desa', 8, 0, 0, 0),
(105, 'Bobos', 'Desa', 8, 0, 0, 0),
(106, 'Cangkoak', 'Desa', 8, 0, 0, 0),
(107, 'Cikalahang', 'Desa', 8, 0, 0, 0),
(108, 'Cipanas', 'Desa', 8, 0, 0, 0),
(109, 'Cisaat', 'Desa', 8, 0, 0, 0),
(110, 'Dukupuntang', 'Desa', 8, 0, 0, 0),
(111, 'Girinata', 'Desa', 8, 0, 0, 0),
(112, 'Kedongdong Kidul', 'Desa', 8, 0, 0, 0),
(113, 'Kepunduan', 'Desa', 8, 0, 0, 0),
(114, 'Mandala', 'Desa', 8, 0, 0, 0),
(115, 'Sindangjawa', 'Desa', 8, 0, 0, 0),
(116, 'Sindangmekar', 'Desa', 8, 0, 0, 0),
(117, 'Dompyong Kulon', 'Desa', 9, 0, 0, 0),
(118, 'Dompyong Wetan', 'Desa', 9, 0, 0, 0),
(119, 'Gagasari', 'Desa', 9, 0, 0, 0),
(120, 'Gebang', 'Desa', 9, 0, 0, 0),
(121, 'Gebangilir', 'Desa', 9, 0, 0, 0),
(122, 'Gebangkulon', 'Desa', 9, 0, 0, 0),
(123, 'Gebangmekar', 'Desa', 9, 0, 0, 0),
(124, 'Gebangudik', 'Desa', 9, 0, 0, 0),
(125, 'Kalimaro', 'Desa', 9, 0, 0, 0),
(126, 'Kalimekar', 'Desa', 9, 0, 0, 0),
(127, 'Kalipasung', 'Desa', 9, 0, 0, 0),
(128, 'Melakasari', 'Desa', 9, 0, 0, 0),
(129, 'Pelayangan', 'Desa', 9, 0, 0, 0),
(130, 'Bayalangu Kidul', 'Desa', 10, 0, 0, 0),
(131, 'Bayalangu Lor', 'Desa', 10, 0, 0, 0),
(132, 'Gegesik Kidul', 'Desa', 10, 0, 0, 0),
(133, 'Gegesik Kulon', 'Desa', 10, 0, 0, 0),
(134, 'Gegesik Lor', 'Desa', 10, 0, 0, 0),
(135, 'Gegesik Wetan', 'Desa', 10, 0, 0, 0),
(136, 'Jagapura Kidul', 'Desa', 10, 0, 0, 0),
(137, 'Jagapura Kulon', 'Desa', 10, 0, 0, 0),
(138, 'Jagapura Lor', 'Desa', 10, 0, 0, 0),
(139, 'Jagapura Wetan', 'Desa', 10, 0, 0, 0),
(140, 'Kedungdalem', 'Desa', 10, 0, 0, 0),
(141, 'Panunggul', 'Desa', 10, 0, 0, 0),
(142, 'Sibubut', 'Desa', 10, 0, 0, 0),
(143, 'Slendra', 'Desa', 10, 0, 0, 0),
(144, 'Cupang', 'Desa', 11, 0, 0, 0),
(145, 'Cikeusal', 'Desa', 11, 0, 0, 0),
(146, 'Gempol', 'Desa', 11, 0, 0, 0),
(147, 'Kedungbunder', 'Desa', 11, 0, 0, 0),
(148, 'Kempek', 'Desa', 11, 0, 0, 0),
(149, 'Palimanan Barat', 'Desa', 11, 0, 0, 0),
(150, 'Walahar', 'Desa', 11, 0, 0, 0),
(151, 'Winong', 'Desa', 11, 0, 0, 0),
(152, 'Durajaya', 'Desa', 12, 0, 0, 0),
(153, 'Greged', 'Desa', 12, 0, 0, 0),
(154, 'Gumulunglebak', 'Desa', 12, 0, 0, 0),
(155, 'Gumulungtonggoh', 'Desa', 12, 0, 0, 0),
(156, 'Jatipancur', 'Desa', 12, 0, 0, 0),
(157, 'Kamarang', 'Desa', 12, 0, 0, 0),
(158, 'Kamarang Lebak', 'Desa', 12, 0, 0, 0),
(159, 'Lebakmekar', 'Desa', 12, 0, 0, 0),
(160, 'Nanggela', 'Desa', 12, 0, 0, 0),
(161, 'Sindangkempeng', 'Desa', 12, 0, 0, 0),
(162, 'Adidharma', 'Desa', 13, 0, 0, 0),
(163, 'Astana', 'Desa', 13, 0, 0, 0),
(164, 'Babadan', 'Desa', 13, 0, 0, 0),
(165, 'Buyut', 'Desa', 13, 0, 0, 0),
(166, 'Grogol', 'Desa', 13, 0, 0, 0),
(167, 'Jadimulya', 'Desa', 13, 0, 0, 0),
(168, 'Jatimerta', 'Desa', 13, 0, 0, 0),
(169, 'Kalisapu', 'Desa', 13, 0, 0, 0),
(170, 'Klayan', 'Desa', 13, 0, 0, 0),
(171, 'Mayung', 'Desa', 13, 0, 0, 0),
(172, 'Mertasinga', 'Desa', 13, 0, 0, 0),
(173, 'Pasindangan', 'Desa', 13, 0, 0, 0),
(174, 'Sambeng', 'Desa', 13, 0, 0, 0),
(175, 'Sirnabaya', 'Desa', 13, 0, 0, 0),
(176, 'Wanakaya', 'Desa', 13, 0, 0, 0),
(177, 'Bakung Kidul', 'Desa', 14, 0, 0, 0),
(178, 'Bakung Lor', 'Desa', 14, 0, 0, 0),
(179, 'Bojong Lor', 'Desa', 14, 0, 0, 0),
(180, 'Bojong Wetan', 'Desa', 14, 0, 0, 0),
(181, 'Jamblang', 'Desa', 14, 0, 0, 0),
(182, 'Orimalang', 'Desa', 14, 0, 0, 0),
(183, 'Sitiwinangun', 'Desa', 14, 0, 0, 0),
(184, 'Wangunharja', 'Desa', 14, 0, 0, 0),
(185, 'Guwa Kidul', 'Desa', 15, 0, 0, 0),
(186, 'Guwa Lor', 'Desa', 15, 0, 0, 0),
(187, 'Kalideres', 'Desa', 15, 0, 0, 0),
(188, 'Kaliwedi Kidul', 'Desa', 15, 0, 0, 0),
(189, 'Kaliwedi Lor', 'Desa', 15, 0, 0, 0),
(190, 'Prajawinangun Kulon', 'Desa', 15, 0, 0, 0),
(191, 'Prajawinangun Wetan', 'Desa', 15, 0, 0, 0),
(192, 'Ujungsemi', 'Desa', 15, 0, 0, 0),
(193, 'Wargabinangun', 'Desa', 15, 0, 0, 0),
(194, 'Bungko', 'Desa', 16, 0, 0, 0),
(195, 'Bungko Lor', 'Desa', 16, 0, 0, 0),
(196, 'Dukuh', 'Desa', 16, 0, 0, 0),
(197, 'Grogol', 'Desa', 16, 0, 0, 0),
(198, 'Kapetakan', 'Desa', 16, 0, 0, 0),
(199, 'Karangkendal', 'Desa', 16, 0, 0, 0),
(200, 'Kertasura', 'Desa', 16, 0, 0, 0),
(201, 'Pegagan Kidul', 'Desa', 16, 0, 0, 0),
(202, 'Pegagan Lor', 'Desa', 16, 0, 0, 0),
(203, 'Kalimeang', 'Desa', 17, 0, 0, 0),
(204, 'Karangmalang', 'Desa', 17, 0, 0, 0),
(205, 'Karangmekar', 'Desa', 17, 0, 0, 0),
(206, 'Karangsembung', 'Desa', 17, 0, 0, 0),
(207, 'Karangsuwung', 'Desa', 17, 0, 0, 0),
(208, 'Karangtengah', 'Desa', 17, 0, 0, 0),
(209, 'Kubangkarang', 'Desa', 17, 0, 0, 0),
(210, 'Tambelang', 'Desa', 17, 0, 0, 0),
(211, 'Blender', 'Desa', 18, 0, 0, 0),
(212, 'Jatipiring', 'Desa', 18, 0, 0, 0),
(213, 'Karanganyar', 'Desa', 18, 0, 0, 0),
(214, 'Karangasem', 'Desa', 18, 0, 0, 0),
(215, 'Karangwangi', 'Desa', 18, 0, 0, 0),
(216, 'Karangwareng', 'Desa', 18, 0, 0, 0),
(217, 'Kubangdeleg', 'Desa', 18, 0, 0, 0),
(218, 'Seuseupan', 'Desa', 18, 0, 0, 0),
(219, 'Sumurkondang', 'Desa', 18, 0, 0, 0),
(220, 'Kalikoa', 'Desa', 19, 0, 0, 0),
(221, 'Kedawung', 'Desa', 19, 0, 0, 0),
(222, 'Kedungdawa', 'Desa', 19, 0, 0, 0),
(223, 'Kedungjaya', 'Desa', 19, 0, 0, 0),
(224, 'Kertawinangun', 'Desa', 19, 0, 0, 0),
(225, 'Pilangsari', 'Desa', 19, 0, 0, 0),
(226, 'Sutawinangun', 'Desa', 19, 0, 0, 0),
(227, 'Tuk', 'Desa', 19, 0, 0, 0),
(228, 'Bangodua', 'Desa', 20, 0, 0, 0),
(229, 'Danawinangun', 'Desa', 20, 0, 0, 0),
(230, 'Jemaras Kidul', 'Desa', 20, 0, 0, 0),
(231, 'Jemaras Lor', 'Desa', 20, 0, 0, 0),
(232, 'Klangenan', 'Desa', 20, 0, 0, 0),
(233, 'Kreyo', 'Desa', 20, 0, 0, 0),
(234, 'Pekantingan', 'Desa', 20, 0, 0, 0),
(235, 'Serang', 'Desa', 20, 0, 0, 0),
(236, 'Slangit', 'Desa', 20, 0, 0, 0),
(237, 'Asem', 'Desa', 21, 0, 0, 0),
(238, 'Belawa', 'Desa', 21, 0, 0, 0),
(239, 'Cipeujeuh Kulon', 'Desa', 21, 0, 0, 0),
(240, 'Cipeujeuh Wetan', 'Desa', 21, 0, 0, 0),
(241, 'Lemahabang', 'Desa', 21, 0, 0, 0),
(242, 'Lemahabang Kulon', 'Desa', 21, 0, 0, 0),
(243, 'Leuwidingding', 'Desa', 21, 0, 0, 0),
(244, 'Picungpugur', 'Desa', 21, 0, 0, 0),
(245, 'Sarajaya', 'Desa', 21, 0, 0, 0),
(246, 'Sigong', 'Desa', 21, 0, 0, 0),
(247, 'Sindanglaut', 'Desa', 21, 0, 0, 0),
(248, 'Tuk Karangsuwung', 'Desa', 21, 0, 0, 0),
(249, 'Wangkelang', 'Desa', 21, 0, 0, 0),
(250, 'Ambulu', 'Desa', 22, 0, 0, 0),
(251, 'Astanalanggar', 'Desa', 22, 0, 0, 0),
(252, 'Barisan', 'Desa', 22, 0, 0, 0),
(253, 'Kalirahayu', 'Desa', 22, 0, 0, 0),
(254, 'Kalisari', 'Desa', 22, 0, 0, 0),
(255, 'Losari Kidul', 'Desa', 22, 0, 0, 0),
(256, 'Losari Lor', 'Desa', 22, 0, 0, 0),
(257, 'Mulyasari', 'Desa', 22, 0, 0, 0),
(258, 'Panggangsari', 'Desa', 22, 0, 0, 0),
(259, 'Tawangsari', 'Desa', 22, 0, 0, 0),
(260, 'Bandengan', 'Desa', 23, 0, 0, 0),
(261, 'Banjarwangunan', 'Desa', 23, 0, 0, 0),
(262, 'Citemu', 'Desa', 23, 0, 0, 0),
(263, 'Luwung', 'Desa', 23, 0, 0, 0),
(264, 'Mundumesigit', 'Desa', 23, 0, 0, 0),
(265, 'Mundupesisir', 'Desa', 23, 0, 0, 0),
(266, 'Pamengkang', 'Desa', 23, 0, 0, 0),
(267, 'Penpen', 'Desa', 23, 0, 0, 0),
(268, 'Setupatok', 'Desa', 23, 0, 0, 0),
(269, 'Sinarancang', 'Desa', 23, 0, 0, 0),
(270, 'Suci', 'Desa', 23, 0, 0, 0),
(271, 'Waruduwur', 'Desa', 23, 0, 0, 0),
(272, 'Babakan Losari', 'Desa', 24, 0, 0, 0),
(273, 'Babakan Losari Lor', 'Desa', 24, 0, 0, 0),
(274, 'Dukuhwidara', 'Desa', 24, 0, 0, 0),
(275, 'Kalibuntu', 'Desa', 24, 0, 0, 0),
(276, 'Kalimukti', 'Desa', 24, 0, 0, 0),
(277, 'Pabedilan Kaler', 'Desa', 24, 0, 0, 0),
(278, 'Pabedilan Kidul', 'Desa', 24, 0, 0, 0),
(279, 'Pabedilan Kulon', 'Desa', 24, 0, 0, 0),
(280, 'Pabedilan Wetan', 'Desa', 24, 0, 0, 0),
(281, 'Pasuruan', 'Desa', 24, 0, 0, 0),
(282, 'Sidaresmi', 'Desa', 24, 0, 0, 0),
(283, 'Silihasih', 'Desa', 24, 0, 0, 0),
(284, 'Tersana', 'Desa', 24, 0, 0, 0),
(285, 'Hulubanteng', 'Desa', 25, 0, 0, 0),
(286, 'Hulubanteng Lor', 'Desa', 25, 0, 0, 0),
(287, 'Jatirenggang', 'Desa', 25, 0, 0, 0),
(288, 'Pabuaran Kidul', 'Desa', 25, 0, 0, 0),
(289, 'Pabuaran Lor', 'Desa', 25, 0, 0, 0),
(290, 'Pabuaran Wetan', 'Desa', 25, 0, 0, 0),
(291, 'Sukadana', 'Desa', 25, 0, 0, 0),
(292, 'Balerante', 'Desa', 26, 0, 0, 0),
(293, 'Beberan', 'Desa', 26, 0, 0, 0),
(294, 'Cengkuang', 'Desa', 26, 0, 0, 0),
(295, 'Ciawi', 'Desa', 26, 0, 0, 0),
(296, 'Cilukrak', 'Desa', 26, 0, 0, 0),
(297, 'Kepuh', 'Desa', 26, 0, 0, 0),
(298, 'Lungbenda', 'Desa', 26, 0, 0, 0),
(299, 'Palimanan Timur', 'Desa', 26, 0, 0, 0),
(300, 'Panongan', 'Desa', 26, 0, 0, 0),
(301, 'Pegagan', 'Desa', 26, 0, 0, 0),
(302, 'Semplo', 'Desa', 26, 0, 0, 0),
(303, 'Tegalkarang', 'Desa', 26, 0, 0, 0),
(304, 'Astanamukti', 'Desa', 27, 0, 0, 0),
(305, 'Bendungan', 'Desa', 27, 0, 0, 0),
(306, 'Beringin', 'Desa', 27, 0, 0, 0),
(307, 'Ender', 'Desa', 27, 0, 0, 0),
(308, 'Getrakmoyan', 'Desa', 27, 0, 0, 0),
(309, 'Japura Lor', 'Desa', 27, 0, 0, 0),
(310, 'Pangenan', 'Desa', 27, 0, 0, 0),
(311, 'Pangarengan', 'Desa', 27, 0, 0, 0),
(312, 'Rawaurip', 'Desa', 27, 0, 0, 0),
(313, 'Gujeg', 'Desa', 28, 0, 0, 0),
(314, 'Kalianyar', 'Desa', 28, 0, 0, 0),
(315, 'Karanganyar', 'Desa', 28, 0, 0, 0),
(316, 'Kroya', 'Desa', 28, 0, 0, 0),
(317, 'Lemahtamba', 'Desa', 28, 0, 0, 0),
(318, 'Panguragan', 'Desa', 28, 0, 0, 0),
(319, 'Panguragan Kulon', 'Desa', 28, 0, 0, 0),
(320, 'Panguragan Lor', 'Desa', 28, 0, 0, 0),
(321, 'Panguragan Wetan', 'Desa', 28, 0, 0, 0),
(322, 'Cigobang', 'Desa', 29, 0, 0, 0),
(323, 'Cigobangwangi', 'Desa', 29, 0, 0, 0),
(324, 'Cilengkrang', 'Desa', 29, 0, 0, 0),
(325, 'Cilengkranggirang', 'Desa', 29, 0, 0, 0),
(326, 'Pasaleman', 'Desa', 29, 0, 0, 0),
(327, 'Tanjunganom', 'Desa', 29, 0, 0, 0),
(328, 'Tonjong', 'Desa', 29, 0, 0, 0),
(329, 'Cangkring', 'Desa', 30, 0, 0, 0),
(330, 'Gamel', 'Desa', 30, 0, 0, 0),
(331, 'Kaliwulu', 'Desa', 30, 0, 0, 0),
(332, 'Panembahan', 'Desa', 30, 0, 0, 0),
(333, 'Pangkalan', 'Desa', 30, 0, 0, 0),
(334, 'Sarabau', 'Desa', 30, 0, 0, 0),
(335, 'Tegalsari', 'Desa', 30, 0, 0, 0),
(336, 'Trusmi Kulon', 'Desa', 30, 0, 0, 0),
(337, 'Trusmi Wetan', 'Desa', 30, 0, 0, 0),
(338, 'Wotgali', 'Desa', 30, 0, 0, 0),
(339, 'Bodelor', 'Desa', 31, 0, 0, 0),
(340, 'Bodesari', 'Desa', 31, 0, 0, 0),
(341, 'Cempaka', 'Desa', 31, 0, 0, 0),
(342, 'Danamulya', 'Desa', 31, 0, 0, 0),
(343, 'Gombang', 'Desa', 31, 0, 0, 0),
(344, 'Karangasem', 'Desa', 31, 0, 0, 0),
(345, 'Karangmulya', 'Desa', 31, 0, 0, 0),
(346, 'Kebarepan', 'Desa', 31, 0, 0, 0),
(347, 'Kedungsana', 'Desa', 31, 0, 0, 0),
(348, 'Lurah', 'Desa', 31, 0, 0, 0),
(349, 'Marikangen', 'Desa', 31, 0, 0, 0),
(350, 'Pamijahan', 'Desa', 31, 0, 0, 0),
(351, 'Pasanggrahan', 'Desa', 31, 0, 0, 0),
(352, 'Plumbon', 'Desa', 31, 0, 0, 0),
(353, 'Purbawinangun', 'Desa', 31, 0, 0, 0),
(354, 'Karangwuni', 'Desa', 32, 0, 0, 0),
(355, 'Kertawangun', 'Desa', 32, 0, 0, 0),
(356, 'Panambangan', 'Desa', 32, 0, 0, 0),
(357, 'Panongan', 'Desa', 32, 0, 0, 0),
(358, 'Panongan Lor', 'Desa', 32, 0, 0, 0),
(359, 'Putat', 'Desa', 32, 0, 0, 0),
(360, 'Sedong Kidul', 'Desa', 32, 0, 0, 0),
(361, 'Sedong Lor', 'Desa', 32, 0, 0, 0),
(362, 'Winduhaji', 'Desa', 32, 0, 0, 0),
(363, 'Windujaya', 'Desa', 32, 0, 0, 0),
(364, 'Matangaji', 'Desa', 33, 0, 0, 0),
(365, 'Sidawangi', 'Desa', 33, 0, 0, 0),
(366, 'Babakan', 'Kelurahan', 33, 0, 0, 0),
(367, 'Gegunung', 'Kelurahan', 33, 0, 0, 0),
(368, 'Kaliwadas', 'Kelurahan', 33, 0, 0, 0),
(369, 'Kemantren', 'Kelurahan', 33, 0, 0, 0),
(370, 'Kenanga', 'Kelurahan', 33, 0, 0, 0),
(371, 'Pasalakan', 'Kelurahan', 33, 0, 0, 0),
(372, 'Pejambon', 'Kelurahan', 33, 0, 0, 0),
(373, 'Perbutulan', 'Kelurahan', 33, 0, 0, 0),
(374, 'Sendang', 'Kelurahan', 33, 0, 0, 0),
(375, 'Sumber', 'Kelurahan', 33, 0, 0, 0),
(376, 'Tukmudal', 'Kelurahan', 33, 0, 0, 0),
(377, 'Watubelah', 'Kelurahan', 33, 0, 0, 0),
(378, 'Karangreja', 'Desa', 34, 0, 0, 0),
(379, 'Keraton', 'Desa', 34, 0, 0, 0),
(380, 'Muara', 'Desa', 34, 0, 0, 0),
(381, 'Purwawinangun', 'Desa', 34, 0, 0, 0),
(382, 'Surakarta', 'Desa', 34, 0, 0, 0),
(383, 'Suranenggala', 'Desa', 34, 0, 0, 0),
(384, 'Suranenggala Kidul', 'Desa', 34, 0, 0, 0),
(385, 'Suranenggala Lor', 'Desa', 34, 0, 0, 0),
(386, 'Suranenggala Kulon', 'Desa', 34, 0, 0, 0),
(387, 'Bojong Kulon', 'Desa', 35, 0, 0, 0),
(388, 'Bunder', 'Desa', 35, 0, 0, 0),
(389, 'Gintung Lor', 'Desa', 35, 0, 0, 0),
(390, 'Jatianom', 'Desa', 35, 0, 0, 0),
(391, 'Jatipura', 'Desa', 35, 0, 0, 0),
(392, 'Kedongdong', 'Desa', 35, 0, 0, 0),
(393, 'Kejiwan', 'Desa', 35, 0, 0, 0),
(394, 'Luwungkencana', 'Desa', 35, 0, 0, 0),
(395, 'Susukan', 'Desa', 35, 0, 0, 0),
(396, 'Tangkil', 'Desa', 35, 0, 0, 0),
(397, 'Ujunggebang', 'Desa', 35, 0, 0, 0),
(398, 'Wiyong', 'Desa', 35, 0, 0, 0),
(399, 'Ciawiasih', 'Desa', 36, 0, 0, 0),
(400, 'Ciawijapura', 'Desa', 36, 0, 0, 0),
(401, 'Curug', 'Desa', 36, 0, 0, 0),
(402, 'Curug Wetan', 'Desa', 36, 0, 0, 0),
(403, 'Kaligawe', 'Desa', 36, 0, 0, 0),
(404, 'Kaligawe Wetan', 'Desa', 36, 0, 0, 0),
(405, 'Karangmanggu', 'Desa', 36, 0, 0, 0),
(406, 'Pasawahan', 'Desa', 36, 0, 0, 0),
(407, 'Sampih', 'Desa', 36, 0, 0, 0),
(408, 'Susukanagung', 'Desa', 36, 0, 0, 0),
(409, 'Susukanlebak', 'Desa', 36, 0, 0, 0),
(410, 'Susukantonggoh', 'Desa', 36, 0, 0, 0),
(411, 'Wilulang', 'Desa', 36, 0, 0, 0),
(412, 'Cempaka', 'Desa', 37, 0, 0, 0),
(413, 'Ciperna', 'Desa', 37, 0, 0, 0),
(414, 'Cirebon Girang', 'Desa', 37, 0, 0, 0),
(415, 'Kecomberan', 'Desa', 37, 0, 0, 0),
(416, 'Kepongpongan', 'Desa', 37, 0, 0, 0),
(417, 'Kerandon', 'Desa', 37, 0, 0, 0),
(418, 'Kubang', 'Desa', 37, 0, 0, 0),
(419, 'Sampiran', 'Desa', 37, 0, 0, 0),
(420, 'Sarwadadi', 'Desa', 37, 0, 0, 0),
(421, 'Wanasaba Kidul', 'Desa', 37, 0, 0, 0),
(422, 'Wanasaba Lor', 'Desa', 37, 0, 0, 0),
(423, 'Astapada', 'Desa', 38, 0, 0, 0),
(424, 'Battembat', 'Desa', 38, 0, 0, 0),
(425, 'Dawuan', 'Desa', 38, 0, 0, 0),
(426, 'Gesik', 'Desa', 38, 0, 0, 0),
(427, 'Kalibaru', 'Desa', 38, 0, 0, 0),
(428, 'Kalitengah', 'Desa', 38, 0, 0, 0),
(429, 'Kemlakagede', 'Desa', 38, 0, 0, 0),
(430, 'Palir', 'Desa', 38, 0, 0, 0),
(431, 'Ambit', 'Desa', 39, 0, 0, 0),
(432, 'Cibogo', 'Desa', 39, 0, 0, 0),
(433, 'Cikulak', 'Desa', 39, 0, 0, 0),
(434, 'Cikulak Kidul', 'Desa', 39, 0, 0, 0),
(435, 'Cisaat', 'Desa', 39, 0, 0, 0),
(436, 'Ciuyah', 'Desa', 39, 0, 0, 0),
(437, 'Gunungsari', 'Desa', 39, 0, 0, 0),
(438, 'Karangsari', 'Desa', 39, 0, 0, 0),
(439, 'Mekarsari', 'Desa', 39, 0, 0, 0),
(440, 'Waledasem', 'Desa', 39, 0, 0, 0),
(441, 'Waleddesa', 'Desa', 39, 0, 0, 0),
(442, 'Waledkota', 'Desa', 39, 0, 0, 0),
(443, 'Karangsari', 'Desa', 40, 0, 0, 0),
(444, 'Kertasari', 'Desa', 40, 0, 0, 0),
(445, 'Megu Cilik', 'Desa', 40, 0, 0, 0),
(446, 'Megu Gede', 'Desa', 40, 0, 0, 0),
(447, 'Setu Kulon', 'Desa', 40, 0, 0, 0),
(448, 'Setu Wetan', 'Desa', 40, 0, 0, 0),
(449, 'Tegalwangi', 'Desa', 40, 7600, 21, 569),
(450, 'Weru Kidul', 'Desa', 40, 0, 0, 0),
(451, 'Weru Lor', 'Desa', 40, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_dapil`
--

CREATE TABLE `detail_dapil` (
  `id_detail` int(6) NOT NULL,
  `id_kecamatan` int(4) NOT NULL,
  `id_dapil` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detail_dapil`
--

INSERT INTO `detail_dapil` (`id_detail`, `id_kecamatan`, `id_dapil`) VALUES
(3, 3, 2),
(4, 6, 2),
(5, 40, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_suara`
--

CREATE TABLE `detail_suara` (
  `id_detail` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `id_caleg` int(11) NOT NULL,
  `id_partai` int(11) NOT NULL,
  `suara_2024` int(11) NOT NULL,
  `suara_2019` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id_donasi` int(6) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `donatur` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `tgl_donasi` date NOT NULL,
  `bukti_tf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id_donasi`, `jumlah`, `donatur`, `id_caleg`, `tgl_donasi`, `bukti_tf`) VALUES
(2, 500000, 'ajiz', 4, '2022-03-04', 'logo_kop.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dukungan`
--

CREATE TABLE `dukungan` (
  `id_dukungan` int(6) NOT NULL,
  `pesan` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id_galery` int(6) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `publish` enum('Y','N') NOT NULL,
  `id_caleg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id_galery`, `judul`, `foto`, `publish`, `id_caleg`) VALUES
(1, 'Kunjungan kerja', 'logo_pks.png', 'N', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(6) NOT NULL,
  `id_survey` int(4) NOT NULL,
  `id_pertanyaan` int(6) NOT NULL,
  `id_caleg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(4) NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama_kabupaten`) VALUES
(1, 'Cirebon Kab'),
(2, 'Kota Cirebon'),
(3, 'Indramayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(20) UNSIGNED NOT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kabupaten` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`, `wilayah`, `id_kabupaten`) VALUES
(1, 'Arjawinangun', '<iframe width=\"600\" height=\"500\" id=\"gmap_canvas\" src=\"https://maps.google.com/maps?q=arjawinangun&t=&z=13&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"></iframe>', 1),
(2, 'Astanajapura', '', 1),
(3, 'Babakan', '', 1),
(4, 'Beber', '', 1),
(5, 'Ciledug Cirebon Timur', '', 1),
(6, 'Ciwaringin', '', 1),
(7, 'Depok', '', 1),
(8, 'Dukupuntang', '', 1),
(9, 'Gebang', '', 1),
(10, 'Gegesik', '', 1),
(11, 'Gempol', '', 1),
(12, 'Greged Greget', '', 1),
(13, 'Gunung Jati Cirebon Utara', '', 1),
(14, 'Jamblang', '', 1),
(15, 'Kaliwedi', '', 1),
(16, 'Kapetakan', '', 1),
(17, 'Karangsembung', '', 1),
(18, 'Karangwareng', '', 1),
(19, 'Kedawung Cirebon Barat', '', 1),
(20, 'Klangenan', '', 1),
(21, 'Lemahabang', '', 1),
(22, 'Losari', '', 1),
(23, 'Mundu', '', 1),
(24, 'Pabedilan', '', 1),
(25, 'Pabuaran', '', 1),
(26, 'Palimanan', '', 1),
(27, 'Pangenan', '', 1),
(28, 'Panguragan', '', 1),
(29, 'Pasaleman', '', 1),
(30, 'Plered', '', 1),
(31, 'Plumbon', '', 1),
(32, 'Sedong', '', 1),
(33, 'Sumber', '', 1),
(34, 'Suranenggala', '', 1),
(35, 'Susukan', '', 1),
(36, 'Susukan Lebak', '', 1),
(37, 'Talun Cirebon Selatan', '', 1),
(38, 'Tengah Tani', '', 1),
(39, 'Waled', '', 1),
(40, 'Weru', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `legislatif`
--

CREATE TABLE `legislatif` (
  `id_legislatif` int(4) NOT NULL,
  `nama_legislatif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `link`
--

CREATE TABLE `link` (
  `id_link` int(4) NOT NULL,
  `url` text NOT NULL,
  `id_medsos` int(4) NOT NULL,
  `id_caleg` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `medsos`
--

CREATE TABLE `medsos` (
  `id_medsos` int(4) NOT NULL,
  `nama_medsos` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id_news` int(6) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tgl_publish` date NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `partai`
--

CREATE TABLE `partai` (
  `id_partai` int(4) NOT NULL,
  `nama_partai` varchar(100) NOT NULL,
  `no_urut` int(4) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(6) NOT NULL,
  `nama_pertanyaan` text NOT NULL,
  `id_variabel` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `nama_pertanyaan`, `id_variabel`) VALUES
(1, 'Apakah anda mengenal caleg dengan nama diatas', 1),
(2, 'Menurut anda jika beliau terplih anda mewakili aspirasi anda ', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(6) NOT NULL,
  `pesan` text NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N',
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `pesan`, `aktif`, `tanggal`) VALUES
(2, 'Selamat bergabung ya', 'Y', '2022-06-07'),
(3, 'Selamat Lebaran ya...', 'N', '2022-06-07'),
(4, 'Selamat hari jadi PKS Ya... kawan', 'N', '2022-06-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id_program` int(4) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `judul_program` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `relawan`
--

CREATE TABLE `relawan` (
  `id_relawan` int(6) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_relawan` varchar(100) NOT NULL,
  `jabatan` enum('0','1','2') NOT NULL DEFAULT '0',
  `upline` int(11) NOT NULL DEFAULT 1,
  `id_desa` int(6) NOT NULL,
  `saksi` enum('Y','N') NOT NULL DEFAULT 'N',
  `foto_ktp` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `loyalis` enum('1','2','3') NOT NULL DEFAULT '1',
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rk_bank`
--

CREATE TABLE `rk_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_bank` varchar(255) NOT NULL,
  `pemilik_bank` varchar(255) NOT NULL,
  `saldo_bank` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rk_bank`
--

INSERT INTO `rk_bank` (`id_bank`, `nama_bank`, `nomor_bank`, `pemilik_bank`, `saldo_bank`) VALUES
(16, 'BRI Syariah', '001', 'An Upin', 0),
(22, 'KAS TEAM PEMENANGAN', '002', 'an. Susanti', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rk_kategori`
--

CREATE TABLE `rk_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` int(6) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `jenis_transaksi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rk_kategori`
--

INSERT INTO `rk_kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`, `jenis_transaksi`) VALUES
(1, 100, 'Donasi Relawan', 'Pemasukan'),
(2, 101, 'Bantuan Partai', 'Pemasukan'),
(3, 103, 'Donasi caleg', 'Pemasukan'),
(4, 151, 'Biaya Spanduk', 'Pengeluaran'),
(5, 152, 'Transport rapat relawan', 'Pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rk_pemilih`
--

CREATE TABLE `rk_pemilih` (
  `id_pemilih` int(15) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tps` int(4) NOT NULL,
  `id_desa` int(4) NOT NULL,
  `relawan` enum('Y','T') NOT NULL,
  `saksi` enum('Y','T') NOT NULL,
  `tgl_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_users` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rk_transaksi`
--

CREATE TABLE `rk_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis_transaksi` enum('Pengeluaran','Pemasukan') NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_bank` int(4) NOT NULL,
  `id_users` int(4) NOT NULL DEFAULT 107,
  `create_data` datetime NOT NULL DEFAULT current_timestamp(),
  `hutang` int(6) NOT NULL,
  `bayar_hutang` int(6) NOT NULL,
  `penggajian` int(6) NOT NULL,
  `alumni` int(6) NOT NULL,
  `siswa` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rk_transaksi`
--

INSERT INTO `rk_transaksi` (`id_transaksi`, `tgl_transaksi`, `jenis_transaksi`, `id_kategori`, `jumlah`, `deskripsi`, `id_bank`, `id_users`, `create_data`, `hutang`, `bayar_hutang`, `penggajian`, `alumni`, `siswa`) VALUES
(1, '2022-04-11', 'Pemasukan', 3, 2000000, 'donasi Ibu Netty', 22, 107, '2022-04-11 13:35:30', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saksi`
--

CREATE TABLE `saksi` (
  `nik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(6) NOT NULL,
  `nama_survey` varchar(100) NOT NULL,
  `mulai_tanggal` date NOT NULL,
  `sampai_tanggal` date NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `id_variabel` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id_temp` int(6) NOT NULL,
  `id_kabupaten` int(4) NOT NULL,
  `id_dapil` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `temp`
--

INSERT INTO `temp` (`id_temp`, `id_kabupaten`, `id_dapil`) VALUES
(8, 1, '99'),
(9, 1, '99'),
(10, 2, '99'),
(11, 3, '99');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(4) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `warna` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'bg-primary',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `foto_user` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `warna`, `id_session`, `foto_user`) VALUES
(24, 'finance', '21232f297a57a5a743894a0e4a801fc3', 'ical calita', 'csjagatgenius@gmail.com', '0231 8897789', 'admin', 'N', 'bg-primary', 'd41d8cd98f00b204e9800998ecf8427e-20210801192823', 'marketing1.jpg'),
(25, 'admin', '$2y$10$iY09UbTC5cu1zgJhsI07VeLPYw7Vf24yKQUbeD/8VD/nJyK3u7zTe', 'Iqro Negoro', 'iqronegoro0@gmail.com', '08978405369', 'superadmin', 'N', 'bg-primary', '', 'miku.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `variabel`
--

CREATE TABLE `variabel` (
  `id_variabel` int(4) NOT NULL,
  `nama_variabel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `variabel`
--

INSERT INTO `variabel` (`id_variabel`, `nama_variabel`) VALUES
(1, 'Survey Awal Caleg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indeks untuk tabel `caleg`
--
ALTER TABLE `caleg`
  ADD PRIMARY KEY (`id_caleg`);

--
-- Indeks untuk tabel `daftar_isu`
--
ALTER TABLE `daftar_isu`
  ADD PRIMARY KEY (`id_isu`);

--
-- Indeks untuk tabel `dapil`
--
ALTER TABLE `dapil`
  ADD PRIMARY KEY (`id_dapil`);

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indeks untuk tabel `detail_dapil`
--
ALTER TABLE `detail_dapil`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `detail_suara`
--
ALTER TABLE `detail_suara`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indeks untuk tabel `dukungan`
--
ALTER TABLE `dukungan`
  ADD PRIMARY KEY (`id_dukungan`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id_galery`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indeks untuk tabel `legislatif`
--
ALTER TABLE `legislatif`
  ADD PRIMARY KEY (`id_legislatif`);

--
-- Indeks untuk tabel `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id_link`);

--
-- Indeks untuk tabel `medsos`
--
ALTER TABLE `medsos`
  ADD PRIMARY KEY (`id_medsos`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indeks untuk tabel `partai`
--
ALTER TABLE `partai`
  ADD PRIMARY KEY (`id_partai`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indeks untuk tabel `relawan`
--
ALTER TABLE `relawan`
  ADD PRIMARY KEY (`id_relawan`);

--
-- Indeks untuk tabel `rk_bank`
--
ALTER TABLE `rk_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `rk_kategori`
--
ALTER TABLE `rk_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `rk_pemilih`
--
ALTER TABLE `rk_pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indeks untuk tabel `rk_transaksi`
--
ALTER TABLE `rk_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `saksi`
--
ALTER TABLE `saksi`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `variabel`
--
ALTER TABLE `variabel`
  ADD PRIMARY KEY (`id_variabel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `caleg`
--
ALTER TABLE `caleg`
  MODIFY `id_caleg` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `daftar_isu`
--
ALTER TABLE `daftar_isu`
  MODIFY `id_isu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dapil`
--
ALTER TABLE `dapil`
  MODIFY `id_dapil` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

--
-- AUTO_INCREMENT untuk tabel `detail_dapil`
--
ALTER TABLE `detail_dapil`
  MODIFY `id_detail` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_suara`
--
ALTER TABLE `detail_suara`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id_donasi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dukungan`
--
ALTER TABLE `dukungan`
  MODIFY `id_dukungan` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id_galery` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `legislatif`
--
ALTER TABLE `legislatif`
  MODIFY `id_legislatif` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `link`
--
ALTER TABLE `link`
  MODIFY `id_link` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `medsos`
--
ALTER TABLE `medsos`
  MODIFY `id_medsos` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `partai`
--
ALTER TABLE `partai`
  MODIFY `id_partai` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id_relawan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rk_bank`
--
ALTER TABLE `rk_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `rk_kategori`
--
ALTER TABLE `rk_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rk_pemilih`
--
ALTER TABLE `rk_pemilih`
  MODIFY `id_pemilih` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `rk_transaksi`
--
ALTER TABLE `rk_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `variabel`
--
ALTER TABLE `variabel`
  MODIFY `id_variabel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2021 pada 06.21
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumahsakit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_beliobat`
--

CREATE TABLE `tb_beliobat` (
  `id_beli` int(11) NOT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `id_pasien` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_beliobat`
--

INSERT INTO `tb_beliobat` (`id_beli`, `id_obat`, `id_pasien`) VALUES
(19, 116, 'P001'),
(20, 114, 'P0018'),
(21, 119, 'P0019'),
(22, 118, 'P0020'),
(23, 112, 'P0021'),
(24, 117, 'P0022'),
(25, NULL, 'P0023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_biaya`
--

CREATE TABLE `tb_biaya` (
  `id_biaya` int(20) NOT NULL,
  `id_pasien` varchar(20) DEFAULT NULL,
  `biaya_pemeriksaan` int(20) DEFAULT NULL,
  `biaya_obat` int(20) DEFAULT NULL,
  `total_biaya` int(20) DEFAULT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_biaya`
--

INSERT INTO `tb_biaya` (`id_biaya`, `id_pasien`, `biaya_pemeriksaan`, `biaya_obat`, `total_biaya`, `Status`) VALUES
(18, 'P001', 35000, 25000, 35000, 'Lunas'),
(19, 'P0018', 10000, 45000, 55000, 'Lunas'),
(20, 'P0019', 15000, 30000, 45000, 'Lunas'),
(21, 'P0020', 300000, 30000, 330000, 'Belum Lunas'),
(22, 'P0021', 330000, 40000, 370000, 'Belum Lunas'),
(23, 'P0022', 500000, 139000, 639000, 'Belum Lunas'),
(24, 'P0023', 15500, NULL, 15500, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `harga_obat` int(30) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `harga_obat`, `nama_penyakit`) VALUES
(110, 'Sanbe Tears', 30000, 'Alergi'),
(111, 'Derma', 30000, 'Iritasi'),
(112, 'Tablet Steroid Oral', 40000, 'Asma'),
(113, 'Antibiotik', 30000, 'TBC'),
(114, 'Astharol', 45000, 'BronkitisAm'),
(115, 'Amoxcilin', 30000, 'Infeksi Gusi'),
(116, 'Paracetamol', 25000, 'Radang Gusi'),
(117, 'Dekongestan', 139000, 'Sinusitis'),
(118, 'Hexadol', 30000, 'Laringitis'),
(119, 'Termorex Paracetamol ', 30000, 'Demam'),
(120, 'Cairan oralit', 41000, 'Diare');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `kode` int(20) NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Alamat` varchar(30) NOT NULL,
  `Jenis_kelamin` enum('L','P') NOT NULL,
  `Tgl_lahir_pasien` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`kode`, `id_pasien`, `Nama`, `Alamat`, `Jenis_kelamin`, `Tgl_lahir_pasien`) VALUES
(17, 'P001', 'Jabbar', 'Samarinda', 'L', '2001-02-21'),
(18, 'P0018', 'Adit', 'sangata', 'L', '2000-10-19'),
(19, 'P0019', 'Ical', 'Tarakan', 'L', '2000-02-01'),
(20, 'P0020', 'Fendi', 'Balikpapan', 'L', '2006-06-22'),
(21, 'P0021', 'Harry', 'Samarinda', 'L', '1999-07-07'),
(22, 'P0022', 'Rheza', 'Samarinda', 'L', '1999-11-22'),
(23, 'P0023', 'Andri', 'Samarinda', 'L', '2003-06-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pilihpoli`
--

CREATE TABLE `tb_pilihpoli` (
  `id_pilihpoli` int(10) NOT NULL,
  `id_pasien` varchar(20) DEFAULT NULL,
  `id_poli` int(20) DEFAULT NULL,
  `Keluhan` text DEFAULT NULL,
  `Catatan_medis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pilihpoli`
--

INSERT INTO `tb_pilihpoli` (`id_pilihpoli`, `id_pasien`, `id_poli`, `Keluhan`, `Catatan_medis`) VALUES
(27, 'P001', 104, 'gk ada', 'gk'),
(28, 'P0018', 104, '-', '-'),
(29, 'P0019', 103, '-', '-'),
(30, 'P0020', 110, '-', '-'),
(31, 'P0021', 110, '-', '-'),
(32, 'P0022', 102, '-', '-'),
(33, 'P0023', 111, 'matii', 'mataa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_poli`
--

CREATE TABLE `tb_poli` (
  `id_poli` int(30) NOT NULL,
  `nama_poli` varchar(50) NOT NULL,
  `biaya_poli` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_poli`
--

INSERT INTO `tb_poli` (`id_poli`, `nama_poli`, `biaya_poli`) VALUES
(102, 'Paru', 300000),
(103, 'Gigi', 100000),
(104, 'THT', 225000),
(110, 'Anak', 0),
(111, 'Mata', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `Password` varchar(99) DEFAULT NULL,
  `Status` varchar(20) NOT NULL,
  `Nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `Username`, `Password`, `Status`, `Nama`) VALUES
(1, 'Rizani', 'Rizani123', 'Super Admin', 'Rizani Husyairi'),
(2, 'Anita', 'Anita123', 'Admin Apotik', 'Anita Zakhinah Zahrah'),
(3, 'Nanda', 'Nanda123', 'Admin Pendaftaran', 'Nidya Putri Nanda'),
(4, 'Aprilia', 'Aprilia123', 'Admin Poliklinik', 'Aprilia Dorothea Pabianan'),
(9, 'Nidya', 'Nidya123', 'Admin Kasir', 'Nidya Putri Nanda');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_beliobat`
--
ALTER TABLE `tb_beliobat`
  ADD PRIMARY KEY (`id_beli`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `tb_biaya`
--
ALTER TABLE `tb_biaya`
  ADD PRIMARY KEY (`id_biaya`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `tb_pilihpoli`
--
ALTER TABLE `tb_pilihpoli`
  ADD PRIMARY KEY (`id_pilihpoli`),
  ADD KEY `id_pasien` (`id_pasien`) USING BTREE,
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `tb_poli`
--
ALTER TABLE `tb_poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_beliobat`
--
ALTER TABLE `tb_beliobat`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_biaya`
--
ALTER TABLE `tb_biaya`
  MODIFY `id_biaya` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `kode` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_pilihpoli`
--
ALTER TABLE `tb_pilihpoli`
  MODIFY `id_pilihpoli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tb_poli`
--
ALTER TABLE `tb_poli`
  MODIFY `id_poli` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_beliobat`
--
ALTER TABLE `tb_beliobat`
  ADD CONSTRAINT `id_obat` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`),
  ADD CONSTRAINT `tb_beliobat_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`);

--
-- Ketidakleluasaan untuk tabel `tb_biaya`
--
ALTER TABLE `tb_biaya`
  ADD CONSTRAINT `tb_biaya_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`);

--
-- Ketidakleluasaan untuk tabel `tb_pilihpoli`
--
ALTER TABLE `tb_pilihpoli`
  ADD CONSTRAINT `tb_pilihpoli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`),
  ADD CONSTRAINT `tb_pilihpoli_ibfk_2` FOREIGN KEY (`id_poli`) REFERENCES `tb_poli` (`id_poli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

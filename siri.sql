-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2022 pada 19.16
-- Versi server: 10.4.21-MariaDB-log
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `role_id`) VALUES
(3, 'adminWeb', '$2y$10$2rOids17E.XNXjfy/TWiU.PXZoidadexhBq3njoD4cFtfkPqBnYjm', 3),
(4, 'admin', '$2y$10$ywN8P09f1bGMIrQkRFXwFehJy0jiezNGfEBCmggY8UEImHnPrYFiS', 2),
(11, 'asdfg', '$2y$10$x8PVSV93XipvmQSrlwKp1O75v8VIba/yIcSICB/B8Luz4H52TwgOW', 6),
(13, 'satriapasien', '$2y$10$UU0N6/VcTtZFeGlPsKeweuI.Un5Kgx1tbc5i9JsxfYt8iUYUpy7UW', 1),
(14, 'yogip', '$2y$10$paD3c45yyzKtjyoOg3LUwu/HsyK1SlIeYpOJqtF5JCUsrC2wTGeHq', 1),
(16, 'udinaja', '$2y$10$K308woQA87ICDSP/ZfLLoeS5RsEPbxN4Wuw4dIpV2If.CXtJ.4Uw6', 2),
(17, 'administrasi', '$2y$10$2T/iU9UPNSkxzPzoDj7SM.XRTxmuSZ9PtWFLStISVltdhZMrWwe26', 2),
(18, 'suster1', '$2y$10$Fr0D.wogQKw.8DecMGWupexG8SWuAosU.JDpGdZxeoOA2OtLyYSNK', 4),
(19, 'dokter1', '$2y$10$s5drKWNdMyH1yuOJoYm7sOvSKSgoA95B1b2D4Cd8dXAMNQIlsPkXm', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `kd_dokter` int(12) NOT NULL,
  `nama_dokter` varchar(25) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `resep_dokter` varchar(25) NOT NULL,
  `jenis_dokter` varchar(25) NOT NULL,
  `akun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`kd_dokter`, `nama_dokter`, `alamat`, `no_telepon`, `resep_dokter`, `jenis_dokter`, `akun_id`) VALUES
(34, 'dokter1', 'Metroi', '08967450', 'antimo', 'Bedah gaming', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `no_kamar` int(11) NOT NULL,
  `kelas_kamar` varchar(25) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `status` enum('TERSEDIA','TIDAK') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`no_kamar`, `kelas_kamar`, `harga_kamar`, `status`) VALUES
(1, 'A', 1000000, 'TERSEDIA'),
(2, 'B', 500000, 'TIDAK'),
(3, 'C', 250000, 'TERSEDIA'),
(6, 'D', 2000000, 'TERSEDIA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `no_transaksi` int(11) NOT NULL,
  `periode_transaksi` date NOT NULL,
  `total_biaya` int(255) NOT NULL,
  `statusPembayaran` enum('Lunas','Belum') NOT NULL,
  `no_rawatinap` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kd_obat` int(11) NOT NULL,
  `nm_obat` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kd_obat`, `nm_obat`, `stok`, `satuan`, `harga`) VALUES
(3, 'paracetamol', 32, 'Kaplet', 10000),
(4, 'Tramadolaa', 188, 'Kaplet', 23000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `alamat_rumah` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `akun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `tgl_lahir`, `umur`, `jk`, `pekerjaan`, `alamat_rumah`, `telepon`, `tanggal_masuk`, `akun_id`) VALUES
(3, 'yogi andaru', '2022-05-03', 12, 'Pria', 'ngoding', 'metro', '0896967867', '2022-05-28', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_obat`
--

CREATE TABLE `penggunaan_obat` (
  `id_penggunaan_obat` int(11) NOT NULL,
  `no_rekap_medis` int(255) NOT NULL,
  `tanggal_pemberian` date NOT NULL,
  `kd_obat` int(11) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penggunaan_obat`
--

INSERT INTO `penggunaan_obat` (`id_penggunaan_obat`, `no_rekap_medis`, `tanggal_pemberian`, `kd_obat`, `jumlah`, `harga`) VALUES
(6, 2, '2022-05-28', 4, 10, 230000),
(10, 2, '2022-05-11', 4, 12, 20000),
(11, 1, '2022-05-18', 3, 12, 230000),
(12, 1, '2022-05-18', 4, 12, 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rawat_inap`
--

CREATE TABLE `rawat_inap` (
  `no_rawatinap` int(11) NOT NULL,
  `no_rekap_medis` int(11) NOT NULL,
  `id_pasien` int(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `status` enum('Kritis','Stabil') NOT NULL,
  `biaya_tindakan` int(255) NOT NULL,
  `biaya_obat` int(255) NOT NULL,
  `biaya_kamar` int(255) NOT NULL,
  `no_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rawat_inap`
--

INSERT INTO `rawat_inap` (`no_rawatinap`, `no_rekap_medis`, `id_pasien`, `tanggal_masuk`, `tanggal_keluar`, `status`, `biaya_tindakan`, `biaya_obat`, `biaya_kamar`, `no_kamar`) VALUES
(14, 2, 3, '2022-05-28', '2022-05-13', 'Stabil', 10000000, 250000, 500000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_medis`
--

CREATE TABLE `rekap_medis` (
  `no_rekap_medis` int(11) NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `riwayat_penyakit` varchar(255) NOT NULL,
  `diagnose` varchar(255) NOT NULL,
  `kd_tindakan` int(11) NOT NULL,
  `biaya` int(255) NOT NULL,
  `kd_dokter` int(11) NOT NULL,
  `id_pasien` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekap_medis`
--

INSERT INTO `rekap_medis` (`no_rekap_medis`, `tanggal_periksa`, `riwayat_penyakit`, `diagnose`, `kd_tindakan`, `biaya`, `kd_dokter`, `id_pasien`) VALUES
(1, '2022-05-26', 'kesurupan', 'jantung', 2, 50000, 34, 3),
(2, '2022-05-11', 'ASAM URAT', 'diare', 2, 50000, 34, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'Pasien'),
(2, 'Administrasi'),
(3, 'AdminWeb'),
(4, 'Perawat'),
(5, 'Dokter'),
(6, 'Kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindakan`
--

CREATE TABLE `tindakan` (
  `kd_tindakan` int(255) NOT NULL,
  `nama_tindakan` varchar(255) NOT NULL,
  `biaya` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tindakan`
--

INSERT INTO `tindakan` (`kd_tindakan`, `nama_tindakan`, `biaya`) VALUES
(1, 'operasi usus buntu', 15000000),
(2, 'AMPUTASI', 10000000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kd_dokter`),
  ADD KEY `akun_id` (`akun_id`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no_kamar`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `keuangan_ibfk_1` (`no_rawatinap`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `pasien_ibfk_1` (`akun_id`);

--
-- Indeks untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  ADD PRIMARY KEY (`id_penggunaan_obat`),
  ADD KEY `no_rekap_medis` (`no_rekap_medis`),
  ADD KEY `penggunaan_obat_ibfk_1` (`kd_obat`);

--
-- Indeks untuk tabel `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD PRIMARY KEY (`no_rawatinap`),
  ADD KEY `rawat_inap_ibfk_2` (`no_kamar`),
  ADD KEY `rawat_inap_ibfk_1` (`no_rekap_medis`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `rekap_medis`
--
ALTER TABLE `rekap_medis`
  ADD PRIMARY KEY (`no_rekap_medis`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `kd_tindakan` (`kd_tindakan`),
  ADD KEY `kd_dokter` (`kd_dokter`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`kd_tindakan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `kd_dokter` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `no_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `kd_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  MODIFY `id_penggunaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `rawat_inap`
--
ALTER TABLE `rawat_inap`
  MODIFY `no_rawatinap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `rekap_medis`
--
ALTER TABLE `rekap_medis`
  MODIFY `no_rekap_medis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `kd_tindakan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`no_rawatinap`) REFERENCES `rawat_inap` (`no_rawatinap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id_akun`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggunaan_obat`
--
ALTER TABLE `penggunaan_obat`
  ADD CONSTRAINT `penggunaan_obat_ibfk_1` FOREIGN KEY (`kd_obat`) REFERENCES `obat` (`kd_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penggunaan_obat_ibfk_2` FOREIGN KEY (`no_rekap_medis`) REFERENCES `rekap_medis` (`no_rekap_medis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rawat_inap`
--
ALTER TABLE `rawat_inap`
  ADD CONSTRAINT `rawat_inap_ibfk_1` FOREIGN KEY (`no_rekap_medis`) REFERENCES `rekap_medis` (`no_rekap_medis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rawat_inap_ibfk_2` FOREIGN KEY (`no_kamar`) REFERENCES `kamar` (`no_kamar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rawat_inap_ibfk_3` FOREIGN KEY (`id_pasien`) REFERENCES `rekap_medis` (`id_pasien`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekap_medis`
--
ALTER TABLE `rekap_medis`
  ADD CONSTRAINT `rekap_medis_ibfk_4` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekap_medis_ibfk_6` FOREIGN KEY (`kd_tindakan`) REFERENCES `tindakan` (`kd_tindakan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rekap_medis_ibfk_7` FOREIGN KEY (`kd_dokter`) REFERENCES `dokter` (`kd_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

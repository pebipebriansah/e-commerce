-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2024 pada 04.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deviin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `chart`
--

CREATE TABLE `chart` (
  `id_chart` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(50) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `foto_profil` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tempat_tinggal` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `point` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `foto_profil`, `jenis_kelamin`, `tempat_tinggal`, `no_hp`, `point`, `email`, `password`) VALUES
('CSM-000', 'Michael', '', 'Laki-Laki', 'adasas', '0810238123', '0', '', ''),
('CSM-001', 'asdasd', '', 'Perempuan', 'asdsad', '123123', '2000', 'customer@gmail.com', '$2y$10$a/vZCwFHi0L0guIHHBY7SOvg9GTzhHD2FCnkW0JfiaU0KqcHkdt.S'),
('CSM-002', 'Michael', '1718291101162-removebg-preview_1.png', 'Laki-laki', 'Desa Kuningan No 1 Kecamatan Kuningan Kabupaten Ku', '0810238123', '4000', 'michael@gmail.com', '$2y$10$92LKfa8vtuclNsj/2CJ2EOhHnKesLWrNDspuXKxuA7Nr8i2yyTpLW'),
('CSM-003', 'Aan', '1718291101162-removebg-preview_2.png', 'Laki-laki', 'Majalengka', '0810238123', '-84000', 'aan@gmail.com', '$2y$10$2.eZJaTfzymDT3Hr.WDoJuk/jObYn4cMgRwTI6JPVHVQqJoKHTRFG'),
('CSM-004', 'Michael', '1718291101162-removebg-preview_3.png', 'Laki-laki', 'Kosan patra, cijoho, kuningan, jabar.', '085171002389', '1000', 'michalfransm@gmail.com', '$2y$10$45XFlG7iEnBct05WHVpv7uL9lg4iVAXzyOaPYDIw7AyzkKDjuX.Li');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` varchar(50) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_produk`, `harga`) VALUES
('DPSN--05', 'PSN-006', 'BR-002', '60000'),
('DPSN-1', 'PSN-001', 'BR-001', '70000'),
('DPSN-10', 'PSN-008', 'BR-001', '70000'),
('DPSN-2', 'PSN-002', 'BR-003', '60000'),
('DPSN-3', 'PSN-003', 'BR-001', '70000'),
('DPSN-4', 'PSN-003', 'BR-004', '50000'),
('DPSN-5', 'PSN-004', 'BR-001', '70000'),
('DPSN-6', 'PSN-005', 'BR-002', '60000'),
('DPSN-7', 'PSN-007', 'BR-001', '70000'),
('DPSN-8', 'PSN-007', 'BR-001', '70000'),
('DPSN-9', 'PSN-007', 'BR-004', '50000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Baju'),
(2, 'Celana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(50) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `id_customer`, `total`, `bukti_pembayaran`) VALUES
('PMON001', 'PSN-001', 'CSM-002', '85000', '1718432241_4964ca2fc406de9f226c.jpg'),
('PMON002', 'PSN-002', 'CSM-002', '75000', '1718432998_f3384eaaa32eeb28d2b2.jpg'),
('PMON003', 'PSN-003', 'CSM-003', '135000', '1718712421_f0a259da1373ac68d4a2.png'),
('PMON004', 'PSN-005', 'CSM-004', '360000', '1718727007_f5c0d1bb7bdd6a381e8f.png'),
('PMON005', 'PSN-006', 'CSM-004', '75000', '1718727742_f1b8f28e6766fb8c4a3c.jpg'),
('PMON006', 'PSN-008', 'CSM-004', '85000', '1718727860_34357d10c16f8d2213f3.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(50) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_pesanan`, `id_customer`, `tanggal`, `status`, `total`) VALUES
('TRS001', 'PSN-001', 'CSM-002', '2024-06-15', 'Diterima', '85000'),
('TRS002', 'PSN-001', 'CSM-002', '2024-06-15', 'Diterima', '85000'),
('TRS003', 'PSN-001', 'CSM-002', '2024-06-15', 'Diterima', '85000'),
('TRS004', 'PSN-001', 'CSM-002', '2024-06-15', 'Diterima', '85000'),
('TRS005', 'PSN-002', 'CSM-002', '2024-06-15', 'Diterima', '75000'),
('TRS006', 'PSN-003', 'CSM-003', '2024-06-18', 'Diterima', '135000'),
('TRS007', 'PSN-005', 'CSM-004', '2024-06-18', 'Diterima', '360000'),
('TRS008', 'PSN-008', 'CSM-004', '2024-06-18', 'Diterima', '85000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(50) NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `status` enum('Menunggu Konfirmasi','Belum Bayar','Sudah Bayar','Belum Di Approve','Sudah Di Approve','Sudah Dikirim','Diterima') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_customer`, `total`, `tanggal`, `bukti_pembayaran`, `status`) VALUES
('PSN-001', 'CSM-002', '85000', '2024-06-15', '1718432241_4964ca2fc406de9f226c.jpg', 'Diterima'),
('PSN-002', 'CSM-002', '75000', '2024-06-15', '1718432998_f3384eaaa32eeb28d2b2.jpg', 'Diterima'),
('PSN-003', 'CSM-003', '135000', '2024-06-18', '1718712421_f0a259da1373ac68d4a2.png', 'Diterima'),
('PSN-004', 'CSM-003', '84000', '2024-06-18', 'Tidak ada Data', 'Belum Bayar'),
('PSN-005', 'CSM-004', '360000', '2024-06-18', '1718727007_f5c0d1bb7bdd6a381e8f.png', 'Diterima'),
('PSN-006', 'CSM-004', '75000', '2024-06-18', '1718727742_f1b8f28e6766fb8c4a3c.jpg', 'Belum Di Approve'),
('PSN-007', 'CSM-004', '204000', '2024-06-18', 'Tidak ada Data', 'Belum Bayar'),
('PSN-008', 'CSM-004', '85000', '2024-06-18', '1718727860_34357d10c16f8d2213f3.png', 'Diterima'),
('PSN-009', 'CSM-004', '70000', '2024-06-18', 'Tidak ada Data', 'Menunggu Konfirmasi'),
('PSN-010', 'CSM-004', '70000', '2024-06-18', 'Tidak ada Data', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `keterangan`, `jumlah`, `photo`) VALUES
('BR-001', 1, 'Kemeja XL', '70000', 'Deskripsi Produk:\r\n\r\nKemeja XL Bekas dalam Kondisi Baik\r\n\r\nDeskripsi:\r\nDapatkan kemeja berkualitas dengan harga terjangkau! Kemeja ini adalah pilihan sempurna untuk gaya kasual Anda. Meskipun bekas, kemeja ini masih dalam kondisi yang sangat baik tanpa cacat yang signifikan. Cocok untuk digunakan dalam berbagai kesempatan, dari pertemuan santai hingga acara formal yang lebih santai.\r\n\r\nFitur Produk:\r\n\r\nUkuran: XL\r\nKondisi: Bekas, namun dalam kondisi sangat baik\r\nWarna: Sesuai gambar\r\nBahan: [Tambahkan bahan jika diketahui]\r\nDesain: [Jelaskan desain atau gaya kemeja]\r\nKeterangan Tambahan:\r\nKemeja ini telah diperiksa dengan cermat untuk memastikan kualitasnya tetap terjaga. Tanpa cacat yang signifikan, kemeja ini memberikan tampilan yang rapi dan stylish. Ideal bagi mereka yang mengutamakan nilai dan kenyamanan dalam pakaian mereka.\r\n\r\nJangan lewatkan kesempatan untuk memiliki kemeja berkualitas ini dengan harga yang terjangkau! Segera dapatkan sebelum kehabisan!', 1, '1718246832_669f2caf817ed30fb3af.jpg'),
('BR-002', 1, 'Kemeja L', '60000', 'Deskripsi Produk:\r\n\r\nKemeja XL Bekas dengan Noda Kecil\r\n\r\nDeskripsi:\r\nDapatkan kemeja berkualitas dengan harga terjangkau! Kemeja ini adalah pilihan sempurna untuk gaya kasual Anda. Meskipun bekas, kemeja ini masih dalam kondisi baik dengan noda kecil yang tidak mengganggu. Cocok untuk digunakan dalam berbagai kesempatan, dari pertemuan santai hingga acara formal yang lebih santai.\r\n\r\nFitur Produk:\r\n\r\nUkuran: XL\r\nKondisi: Bekas, namun masih dalam kondisi baik\r\nWarna: Sesuai gambar\r\nBahan: [Tambahkan bahan jika diketahui]\r\nDesain: [Jelaskan desain atau gaya kemeja]\r\nKeterangan Tambahan:\r\nKemeja ini telah diperiksa dengan cermat untuk memastikan kualitasnya tetap terjaga. Meskipun memiliki noda kecil, kemeja ini tetap dapat memberikan tampilan yang rapi dan stylish. Ideal bagi mereka yang mengutamakan nilai dan kenyamanan dalam pakaian mereka.\r\n\r\nJangan lewatkan kesempatan untuk memiliki kemeja berkualitas ini dengan harga yang terjangkau! Segera dapatkan sebelum kehabisan!', 1, '1718246873_8938d26d8095db8dc264.jpg'),
('BR-003', 2, 'Rok L', '60000', 'Deskripsi Produk: Rok Midi Bekas dalam Kondisi Baik Deskripsi: Temukan rok berkualitas dengan harga yang ramah di kantong! Rok ini memberikan sentuhan elegan pada gaya Anda. Meskipun bekas, rok ini masih dalam kondisi yang sangat baik tanpa kerusakan yang signifikan. Cocok untuk berbagai kesempatan, mulai dari pertemuan santai hingga acara formal yang lebih kasual. Fitur Produk: Ukuran: Sesuai Standar Kondisi: Bekas, tetapi dalam kondisi sangat baik Warna: Sesuai gambar Bahan: [Tambahkan bahan jika diketahui] Desain: Potongan midi dengan detail [Tambahkan deskripsi detail atau motif rok] Keterangan Tambahan: Rok ini telah diperiksa dengan teliti untuk memastikan kualitasnya tetap terjaga. Tanpa cacat yang signifikan, rok ini memberikan tampilan yang rapi dan elegan. Ideal bagi mereka yang menginginkan pakaian berkualitas dengan harga yang terjangkau. Jangan lewatkan kesempatan ini untuk memperoleh rok berkualitas ini sebelum kehabisan!', 1, '1718249793_3fb032be609903b8522b.jpg'),
('BR-004', 2, 'Rok XL', '50000', 'Deskripsi Produk: Rok Midi Bekas dengan Kondisi Ringan Mengkerut Deskripsi: Temukan rok berkualitas dengan sentuhan yang tetap elegan meskipun mengalami sedikit kerutan! Rok ini menambahkan nuansa klasik pada gaya Anda. Meskipun bekas dan mengalami sedikit kerutan, rok ini masih dalam kondisi yang baik dan dapat dipakai dengan percaya diri. Cocok untuk berbagai kesempatan, mulai dari pertemuan santai hingga acara formal yang lebih kasual. Fitur Produk: Ukuran: Sesuai Standar Kondisi: Bekas, dengan sedikit kerutan Warna: Sesuai gambar Bahan: [Tambahkan bahan jika diketahui] Desain: Potongan midi dengan detail [Tambahkan deskripsi detail atau motif rok] Keterangan Tambahan: Meskipun mengalami sedikit kerutan, rok ini masih memberikan tampilan yang rapi dan elegan. Ideal bagi mereka yang mencari pakaian berkualitas dengan sentuhan klasik yang tetap terjaga. Jangan lewatkan kesempatan ini untuk memperoleh rok berkualitas ini sebelum kehabisan!', 1, '1718249941_1d9a505eae9642fc625e.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Pebi Pebriansah', 'pegawai@gmail.com', '$2y$10$v.vQ1QXn.Ra2JmdMDyJF.uPcDZMaDGV1rMTbHKJnN7HbEjHRCbX1m', '2'),
(11, 'Adelline', 'adelline@gmail.com', '$2y$10$n6tDydqHxaDa.eFxFfkb8eyHRWf8VXygKctVQaIPH.RuUaK9bkIhO', '2'),
(12, 'Asep', 'asep@gmail.com', '$2y$10$aU/tdKPfJVB.iIwtApjITO1eOZg7A/bi.BlMUH5342xWSvbyMKadu', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id_chart`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

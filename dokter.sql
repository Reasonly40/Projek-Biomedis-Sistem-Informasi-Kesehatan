-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2024 pada 18.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_kesehatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `Lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `name`, `hari`, `jam`, `Lokasi`) VALUES
(1, 'Dr. David Browner', 'Selasa', '10:00 - 13:00', 'Poli Bedah - Lantai 3'),
(2, 'Dr. David Browner', 'Kamis', '15:00 - 18:00', 'Poli Bedah - Lantai 3'),
(3, 'Dr. David Browner', 'Jumat', '08:30 - 11:30', 'Poli Bedah - Lantai 3'),
(4, 'Dr. Jasmine Cooper', 'Senin', '09:00 - 12:00', 'Poli Anak - Lantai 2'),
(5, 'Dr. Jasmine Cooper', 'Rabu', '13:00 - 16:00', 'Poli Anak - Lantai 2'),
(6, 'Dr. Jasmine Cooper', 'Jumat', '10:00 - 13:00', 'Poli Anak - Lantai 2'),
(7, 'Dr. Jennifer Clark', 'Selasa', '09:30 - 12:30', 'Poli Kandungan - Lantai 4'),
(8, 'Dr. Jennifer Clark', 'Kamis', '14:00 - 17:00', 'Poli Kandungan - Lantai 4'),
(9, 'Dr. Jennifer Clark', 'Minggu', '08:00 - 11:30', 'Poli Kandungan - Lantai 4'),
(10, 'Dr. Linda Davis', 'Senin', '10:00 - 13:00', 'Poli Kulit - Lantai 2'),
(11, 'Dr. Linda Davis', 'Kamis', '14:00 - 17:00', 'Poli Kulit - Lantai 2'),
(12, 'Dr. Linda Davis', 'Sabtu', '09:00 - 11:30', 'Poli Kulit - Lantai 2'),
(13, 'Dr. Michael Lee', 'Senin', '08:00 - 11:00', 'Poli Penyakit Dalam - Lantai 3'),
(14, 'Dr. Michael Lee', 'Rabu', '13:30 - 16:30', 'Poli Penyakit Dalam - Lantai 3'),
(15, 'Dr. Michael Lee', 'Sabtu', '09:00 - 12:00', 'Poli Penyakit Dalam - Lantai 3'),
(16, 'Dr. Sarah Williams', 'Selasa', '09:00 - 12:00', 'Poli THT - Lantai 1'),
(17, 'Dr. Sarah Williams', 'Jumat', '13:00 - 16:00', 'Poli THT - Lantai 1'),
(18, 'Dr. Sarah Williams', 'Minggu', '08:30 - 11:30', 'Poli THT - Lantai 1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

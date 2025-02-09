-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2025 at 02:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_feeder`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `serial_number` varchar(30) NOT NULL,
  `jenis_controller` varchar(30) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`serial_number`, `jenis_controller`, `lokasi`, `aktif`) VALUES
('12345678', 'ESP32', 'Bandung', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id` int NOT NULL,
  `jenis_sensor` varchar(30) NOT NULL,
  `data_sensor` varchar(30) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `serial_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id`, `jenis_sensor`, `data_sensor`, `waktu`, `serial_number`) VALUES
(1, 'suhu', 'dasda', '2024-07-10 11:34:33', '12345678'),
(4, 'suhu', '20', '2024-07-10 11:38:21', '12345678'),
(5, 'suhu', '20', '2024-07-10 11:38:21', '12345678'),
(6, 'suhu', '20', '2024-07-10 11:38:27', '12345678'),
(7, 'suhu', '20', '2024-07-10 11:38:27', '12345678'),
(8, 'suhu', '20', '2024-07-10 11:41:32', '12345678'),
(9, 'suhu', '20', '2024-07-10 11:41:32', '12345678'),
(10, 'suhu', '20', '2024-07-10 11:43:43', '12345678'),
(11, 'suhu', '20', '2024-07-10 11:43:43', '12345678'),
(12, 'suhu', '20', '2024-07-10 12:06:28', '12345678'),
(13, 'suhu', '20', '2024-07-10 12:06:28', '12345678'),
(14, 'suhu', '20', '2024-07-10 12:06:35', '12345678'),
(15, 'suhu', '20', '2024-07-10 12:06:35', '12345678'),
(18, 'temperature', '75', '2024-07-10 12:09:02', '12345678'),
(19, 'temperature', '80', '2024-07-10 12:09:31', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `hak_akses` enum('user','admin') NOT NULL DEFAULT 'user',
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_lengkap`, `hak_akses`, `aktif`) VALUES
('Diaz', '$2y$10$3bY3eM91hrhGZ2XVI9iDV..CcgrPD9kcHuxs9berkUzUQhglVliim', 'Diaz Adriansyah', 'admin', 'Tidak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serial_number` (`serial_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `sensor_ibfk_1` FOREIGN KEY (`serial_number`) REFERENCES `devices` (`serial_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

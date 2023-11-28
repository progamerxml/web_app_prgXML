-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2019 at 01:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gaji`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `no_slip` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `pendapatan` varchar(100) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `gaji_bersih` varchar(100) NOT NULL,
  `nip` int(15) NOT NULL,
  `tun_anak` varchar(100) NOT NULL,
  `kode_petugas` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`no_slip`, `tanggal`, `pendapatan`, `potongan`, `gaji_bersih`, `nip`, `tun_anak`, `kode_petugas`) VALUES
('GJ001', '2017-01-27', '5200000', '260000', '4940000', 11500390, '0', 'PTG02'),
('GJ002', '2017-01-27', '5450000', '272500', '5177500', 11500391, '500000', 'PTG02'),
('GJ003', '2017-01-30', '6700000', '335000', '6365000', 11500416, '1500000', 'PTG02');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(2) NOT NULL,
  `tunjangan_istri` varchar(100) NOT NULL,
  `tunjangan_anak` varchar(100) NOT NULL,
  `uang_makan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `tunjangan_istri`, `tunjangan_anak`, `uang_makan`) VALUES
('1A', '1000000', '750000', '1000000'),
('2A', '750000', '500000', '750000'),
('3A', '500000', '500000', '500000'),
('4A', '0', '0', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `gaji_pokok` varchar(100) NOT NULL,
  `tunjangan_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `gaji_pokok`, `tunjangan_jabatan`) VALUES
('JB001', 'Direktur', '5000000', '2000000'),
('JB002', 'Wakil Direktur', '4500000', '1800000'),
('JB003', 'Manager', '4000000', '1500000'),
('JB004', 'Karyawan', '3000000', '1200000');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` int(50) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_golongan` varchar(5) NOT NULL,
  `kode_jabatan` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `jumlah_anak` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `kode_golongan`, `kode_jabatan`, `status`, `jumlah_anak`) VALUES
(11500390, 'Riski Andriyanto', 'Jepara', '2000-11-01', '1A', 'JB004', 'Belum Menikah', 0),
(11500391, 'Ahmad Yusuf Abdillah', 'Jepara', '1995-04-19', '2A', 'JB004', 'Menikah', 1),
(11500416, 'Dynud Gilar Ramadhan', 'Jepara', '1999-12-12', '1A', 'JB004', 'Menikah', 2);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kode_petugas` varchar(5) NOT NULL,
  `nama_petugas` varchar(40) NOT NULL,
  `password_petugas` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kode_petugas`, `nama_petugas`, `password_petugas`, `status`) VALUES
('PTG01', 'Riski Andriyanto', '5e8ee81ed1db9c83f8bced76de84e29a', 'Direktur'),
('PTG02', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`no_slip`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kode_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

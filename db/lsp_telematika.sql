-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 02:58 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lsp_telematika`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admin`
--

CREATE TABLE IF NOT EXISTS `table_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `table_admin`
--

INSERT INTO `table_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `table_detail_pesanan`
--

CREATE TABLE IF NOT EXISTS `table_detail_pesanan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_pesanan`
--

CREATE TABLE IF NOT EXISTS `table_pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(60) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pesanan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_pesan` date NOT NULL,
  `status` int(11) NOT NULL,
  `status_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `table_pesanan`
--

INSERT INTO `table_pesanan` (`id_pesanan`, `id_transaksi`, `id_user`, `id_produk`, `nama_pesanan`, `jumlah`, `alamat`, `tgl_pesan`, `status`, `status_read`) VALUES
(8, 'KD-220170816075949', 2, 3, 'aaaa', 1, 'jl kosgoro1', '2017-08-16', 3, 0),
(13, 'KD-220170816082435', 2, 4, 'sdasff', 1, 'jl kosgoro1', '2017-08-16', 3, 0),
(14, 'KD-220170816102834', 2, 4, 'sdasff', 4, 'jl kosgoro1', '2017-08-16', 0, 0),
(15, 'KD-220170816090531', 2, 3, 'aaaa', 1, 'jl kosgoro1', '2017-08-16', 0, 0),
(18, '0', 2, 5, 'ayam bakar saus', 1, 'jl kosgoro1', '2017-08-16', 0, 0),
(19, '0', 4, 6, 'Nasi Ayam Bakar', 1, 'jl made suharta\r\n', '2017-08-17', 0, 0),
(20, 'KD-520170817022503', 5, 5, 'ayam bakar saus', 5, 'pettarani\r\n', '2017-08-17', 1, 0),
(21, 'KD-520170817022503', 5, 8, 'Nasi Daging Panggang', 100, 'jl uho', '2017-08-17', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_produk`
--

CREATE TABLE IF NOT EXISTS `table_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(150) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `table_produk`
--

INSERT INTO `table_produk` (`id_produk`, `nama_produk`, `harga`, `gambar`) VALUES
(4, 'Kue Kapas', '12000', '20170816055753.jpg'),
(5, 'ayam bakar saus', '22000', '20170816060243.jpg'),
(6, 'Nasi Ayam Bakar', '34000', '20170816060312.jpg'),
(7, 'Nasi Sate Daging', '43000', '20170816060353.jpg'),
(8, 'Nasi Daging Panggang', '32000', '20170816060413.jpg'),
(9, 'ayam kalasan', '24000', '20170816101803.jpg'),
(10, 'Nasi Ayam Super', '35000', '20170816102108.jpg'),
(11, 'Nasi Ayam Jakarta', '30000', '20170816102200.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE IF NOT EXISTS `table_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(55) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id_user`, `nama_lengkap`, `alamat`, `email`, `no_telepon`, `username`, `password`) VALUES
(2, 'Admin1', 'jl kosgoro1', 'admin@gmail.com1', '085210600958', 'admin1', '21232f297a57a5a743894a0e4a801fc3'),
(3, '', 'jl made sabara', 'ahriadi@gmail.com', '085210600958', 'ahriadi', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'firman', 'jl made suharta\r\n', 'firman@gmail.com', '085210600958', 'firman', '21232f297a57a5a743894a0e4a801fc3'),
(5, 'Indra', 'jl uho', 'indra@gmail.com', '085210600957', 'indra', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

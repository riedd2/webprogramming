-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2015 at 01:02 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pchammer`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id_category` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `categoryname`) VALUES
(1, 'disc'),
(2, 'graphicscard'),
(3, 'mainboard'),
(4, 'cpu');

-- --------------------------------------------------------

--
-- Table structure for table `cpu`
--

CREATE TABLE IF NOT EXISTS `cpu` (
`id_cpu` int(11) NOT NULL,
  `socket` varchar(150) NOT NULL,
  `frequency` float NOT NULL,
  `cores` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cpu`
--

INSERT INTO `cpu` (`id_cpu`, `socket`, `frequency`, `cores`) VALUES
(3, 'L3', 3.3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `disc`
--

CREATE TABLE IF NOT EXISTS `disc` (
`id_disc` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `volume` int(11) NOT NULL,
  `dimension` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `disc`
--

INSERT INTO `disc` (`id_disc`, `type`, `volume`, `dimension`) VALUES
(4, 'ssd', 300, 2.2);

-- --------------------------------------------------------

--
-- Table structure for table `graphicscard`
--

CREATE TABLE IF NOT EXISTS `graphicscard` (
`id_graphicscard` int(11) NOT NULL,
  `RAM` varchar(150) NOT NULL,
  `RAMType` varchar(150) NOT NULL,
  `PCIeType` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `graphicscard`
--

INSERT INTO `graphicscard` (`id_graphicscard`, `RAM`, `RAMType`, `PCIeType`) VALUES
(2, '3GB', 'DDR5', '16');

-- --------------------------------------------------------

--
-- Table structure for table `mainboard`
--

CREATE TABLE IF NOT EXISTS `mainboard` (
`id_mainboard` int(11) NOT NULL,
  `dimension` float NOT NULL,
  `USB2quant` int(11) DEFAULT NULL,
  `USB3quant` int(11) DEFAULT NULL,
  `PCIE16quant` int(11) DEFAULT NULL,
  `SATA3quant` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mainboard`
--

INSERT INTO `mainboard` (`id_mainboard`, `dimension`, `USB2quant`, `USB3quant`, `PCIE16quant`, `SATA3quant`) VALUES
(1, 4.4, 3, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `delivered` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `user_id`, `paid`, `delivered`) VALUES
(31, 1, NULL, NULL),
(32, 1, NULL, NULL),
(33, 1, NULL, NULL),
(34, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderposition`
--

CREATE TABLE IF NOT EXISTS `orderposition` (
`id_orderposition` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `orderposition`
--

INSERT INTO `orderposition` (`id_orderposition`, `order_id`, `product_id`, `quantity`) VALUES
(48, 31, 1, 1),
(49, 32, 1, 1),
(50, 33, 1, 1),
(51, 34, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id_product` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `quantAvailable` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `category_id`, `name`, `price`, `quantAvailable`, `image`) VALUES
(1, 3, 'mainboard1', '99.0000', 10, 'mainboard.png'),
(2, 2, 'nvidea bla3000', '300.0000', 4, 'graphicscard.png'),
(3, 4, 'i5 2.2', '99.0000', 2, 'cpu.png'),
(4, 1, 'superstar300', '250.0000', 24, 'harddisc.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `admin`) VALUES
(1, 'boschung', 'bsochung@sdf.com', 'Hallo123', 1),
(2, 'riedo', 'riedo@rie.com', 'Hallo123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id_category`), ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
 ADD PRIMARY KEY (`id_cpu`);

--
-- Indexes for table `disc`
--
ALTER TABLE `disc`
 ADD PRIMARY KEY (`id_disc`);

--
-- Indexes for table `graphicscard`
--
ALTER TABLE `graphicscard`
 ADD PRIMARY KEY (`id_graphicscard`);

--
-- Indexes for table `mainboard`
--
ALTER TABLE `mainboard`
 ADD PRIMARY KEY (`id_mainboard`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id_order`), ADD KEY `order_ibfk_2` (`user_id`);

--
-- Indexes for table `orderposition`
--
ALTER TABLE `orderposition`
 ADD PRIMARY KEY (`id_orderposition`), ADD KEY `order_id_fk` (`order_id`), ADD KEY `product_fk1` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id_product`), ADD KEY `category_id` (`category_id`), ADD KEY `category_id_2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cpu`
--
ALTER TABLE `cpu`
MODIFY `id_cpu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `disc`
--
ALTER TABLE `disc`
MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `graphicscard`
--
ALTER TABLE `graphicscard`
MODIFY `id_graphicscard` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mainboard`
--
ALTER TABLE `mainboard`
MODIFY `id_mainboard` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `orderposition`
--
ALTER TABLE `orderposition`
MODIFY `id_orderposition` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpu`
--
ALTER TABLE `cpu`
ADD CONSTRAINT `cpu_ibfk_1` FOREIGN KEY (`id_cpu`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `disc`
--
ALTER TABLE `disc`
ADD CONSTRAINT `disc_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `graphicscard`
--
ALTER TABLE `graphicscard`
ADD CONSTRAINT `graphicscard_ibfk_1` FOREIGN KEY (`id_graphicscard`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `mainboard`
--
ALTER TABLE `mainboard`
ADD CONSTRAINT `mainboard_ibfk_1` FOREIGN KEY (`id_mainboard`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `orderposition`
--
ALTER TABLE `orderposition`
ADD CONSTRAINT `order_fk1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `orderposition_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2022 at 10:47 PM
-- Server version: 10.5.15-MariaDB-0+deb11u1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_fsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `meme`
--

CREATE TABLE `meme` (
  `id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meme`
--

INSERT INTO `meme` (`id`, `likes`, `url`) VALUES
(1, 83, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(2, 91, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(3, 101, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(4, 130, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(5, 151, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(6, 170, 'http://kenhosting.ddns.net/img/meme2.png'),
(7, 191, 'http://kenhosting.ddns.net/img/meme1.png'),
(8, 240, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(9, 260, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(10, 280, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(11, 200, 'http://kenhosting.ddns.net/img/meme3.png'),
(12, 350, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(13, 370, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(14, 391, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(15, 310, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(16, 330, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(17, 459, 'http://kenhosting.ddns.net/img/meme4.png'),
(18, 480, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(19, 400, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(20, 411, 'http://kenhosting.ddns.net/img/meme-dog.jpg'),
(21, 430, 'http://kenhosting.ddns.net/img/meme-dog.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, '160420119', '160420119'),
(2, '160420115', '160420115'),
(3, '160420134', '160420134');

-- --------------------------------------------------------

--
-- Table structure for table `user_likes_meme`
--

CREATE TABLE `user_likes_meme` (
  `iduser` int(11) NOT NULL,
  `idmeme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_likes_meme`
--

INSERT INTO `user_likes_meme` (`iduser`, `idmeme`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 5),
(2, 7),
(2, 9),
(2, 14),
(2, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_likes_meme`
--
ALTER TABLE `user_likes_meme`
  ADD PRIMARY KEY (`iduser`,`idmeme`),
  ADD KEY `fk_idmeme` (`idmeme`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meme`
--
ALTER TABLE `meme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_likes_meme`
--
ALTER TABLE `user_likes_meme`
  ADD CONSTRAINT `fk_idmeme` FOREIGN KEY (`idmeme`) REFERENCES `meme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

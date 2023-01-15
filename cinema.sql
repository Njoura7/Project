-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 03:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_Id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `movie-name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movierequests`
--

CREATE TABLE `movierequests` (
  `id` int(11) NOT NULL,
  `movie` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movierequests`
--

INSERT INTO `movierequests` (`id`, `movie`, `name`, `email`, `phone`) VALUES
(1, 'copium', 'Mazen', 'Crusader.light@yahoo.com', ''),
(2, 'onepiece red', 'mazen', 'Crusader.light@yahoo.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `url`) VALUES
(1, 'black killer', 'movie blah blah', 'https://m.media-amazon.com/images/M/MV5BNjQyM2IxMDQtN2ZkNi00N2FkLWI5NWUtYzEzZDFhM2Q4MGJiL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTYxNjkxOQ@@._V1_.jpg'),
(2, 'onepiece red', 'movie', 'https://upload.wikimedia.org/wikipedia/en/4/44/One_Piece_Film_Red_Visual_Poster.jpg'),
(3, 'Harry Potter', NULL, 'https://static.posters.cz/image/1300/plakatok/harry-potter-es-a-boelcsek-koeve-i104639.jpg'),
(4, 'The Dark Knight', 'The Dark Knight', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg'),
(5, 'Avatar', 'nice movie', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKqYSs5skK8J1LzG6hDLcwkRfn68xXnTD4yA&usqp=CAU'),
(6, 'The Godfather', 'epic movie', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQ3FFBjN-zw9FIz6i6zQmrV2N_p3kFb89qYQ&usqp=CAU'),
(7, 'The Avengers', 'The Avengers', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvgtM_buVNm1Ruh1pCwcgbB436kax-MzNOZg&usqp=CAU'),
(8, 'Hunter X Hunter : Phantom rouge', 'Anime Movie', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEXQTK8DyVV6-FSykpHdwtbm1TzXsOsyKHT3TvETzH3x-mx5zLSZ8A-kc8XfIZ4pvPPgk&usqp=CAU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'EN-US',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `license_accepted` tinyint(4) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `auth_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `email`, `username`, `dob`, `sex`, `lang`, `fname`, `lname`, `license_accepted`, `auth_token`, `auth_expire`) VALUES
(2, '$2y$10$uCS1iHxxvqkhJPyueDYZr.tLM6.muY6DbnIbTbV//IxFfCe9n0UBK', 'Crusader.light@yahoo.com', 'Mazenoo', '2023-01-03', 1, 'en-US', 'mald', 'cope', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_Id` (`movie_Id`);

--
-- Indexes for table `movierequests`
--
ALTER TABLE `movierequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movierequests`
--
ALTER TABLE `movierequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`movie_Id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

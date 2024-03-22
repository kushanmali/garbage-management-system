-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 06:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '$2y$10$oEOWutvwgm0QJOoRtfUVMuph5KcYRz4mz5bSOuMFZFKeWEi8sf52a');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `created_at`) VALUES
(1, 'Article name', 'Content', '', '2023-05-11 04:55:43'),
(2, 'What is Lorem Ipsum?', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2023-05-11 04:57:41'),
(3, 'article new', 'qwertyuiop[sdfghjkl;\'ghjkl;ljjojoij oijoijoinjoij', '', '2023-05-11 05:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `gtf_members`
--

CREATE TABLE `gtf_members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gtf_members`
--

INSERT INTO `gtf_members` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'Lakshan', 'Pramuka', 'lakshanpramuka@gmail.com', '$2y$10$oEOWutvwgm0QJOoRtfUVMuph5KcYRz4mz5bSOuMFZFKeWEi8sf52a', '2023-05-11 04:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `gtf_member_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `impact` text NOT NULL,
  `importance` enum('low','medium','high') NOT NULL,
  `status` enum('reported','approved','rejected','cleared') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_url` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `gtf_member_id`, `description`, `image_url`, `latitude`, `longitude`, `impact`, `importance`, `status`, `created_at`, `updated_at`, `img_url`, `image_path`) VALUES
(88260, 1, 'test', '', '6.92135955', '79.95726013', 'Impact Impact', 'low', 'approved', '2023-05-11 04:37:49', '2023-05-11 04:52:23', 'images/88260.jpg', 'images/88260.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('green_captain','collecting_staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'sajith', 'sajith@gmail.com', '$2y$10$WEstmsOKUO1zXZScWlL8tePSjUk3s3F8rgRNx4jt6U.QYKkZW6Dg6', 'green_captain'),
(3, 'sajith', 'sajith@gmail.comrd', '$2y$10$11wgNcCVodRBzbPQxez8w.UykkGinUpt..LThqgiuRDmmD7NJLyBG', 'green_captain'),
(5, 'sajith', 'sajith@gmaisl.comrd', '$2y$10$o21nYrnBse.LLU7igrFlJu7QT96Xuq9jeW6sYnM7mDFlhw71HHaCm', 'green_captain'),
(6, 'sajith', 'sajithlakmal@gmail.com', '$2y$10$PtfgaVxSptV5NbZoIMA.MuwAYaeqigx4YE5pGSi4I1rmNcAwO0aae', 'green_captain'),
(7, 'green Captains ', 'green@gmail.com', '$2y$10$oEOWutvwgm0QJOoRtfUVMuph5KcYRz4mz5bSOuMFZFKeWEi8sf52a', 'green_captain'),
(8, 'Pramuka Geethanjana', 'lakshanpramuka@gmail.com', '$2y$10$.zbHvSPpRv8LrBwg1a1m5eo/SLocNqEgfY8.hkYkSQYryVdOaoUOm', 'green_captain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gtf_members`
--
ALTER TABLE `gtf_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gtf_member_id` (`gtf_member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gtf_members`
--
ALTER TABLE `gtf_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88261;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`gtf_member_id`) REFERENCES `gtf_members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 07:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `event_id`, `user_id`, `ticket_number`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'TICKET-67332BC0D707E', '2024-11-12 10:19:44', '2024-11-12 10:19:44'),
(2, 3, 2, 'TICKET-67333082D75E9', '2024-11-12 10:40:02', '2024-11-12 10:40:02'),
(3, 1, 2, 'TICKET-6733318F6F888', '2024-11-12 10:44:31', '2024-11-12 10:44:31'),
(4, 2, 2, 'TICKET-67333231E90A2', '2024-11-12 10:47:13', '2024-11-12 10:47:13'),
(5, 3, 2, 'TICKET-6733329F23592', '2024-11-12 10:49:03', '2024-11-12 10:49:03'),
(6, 3, 2, 'TICKET-673332D66B8BF', '2024-11-12 10:49:58', '2024-11-12 10:49:58'),
(7, 5, 2, 'TICKET-673395BA72E13', '2024-11-12 17:51:54', '2024-11-12 17:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `event_image` varchar(255) DEFAULT NULL,
  `book_status` enum('Available','Booked') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `event_date`, `event_location`, `event_price`, `event_image`, `book_status`, `created_at`, `updated_at`) VALUES
(1, 'Mrg', 'sss', '2024-10-30 00:00:00', '', '30000.00', NULL, 'Booked', '2024-11-12 08:44:42', '2024-11-12 10:44:31'),
(2, 'Mrg', '6u767', '2024-11-14 00:00:00', '', '4000.00', NULL, 'Booked', '2024-11-12 08:45:00', '2024-11-12 10:47:13'),
(3, 'BirthDay', 'no', '2024-11-16 00:00:00', '', '90000.00', NULL, 'Booked', '2024-11-12 10:39:24', '2024-11-12 10:49:58'),
(4, 'Mrg event', 'nothing', '2024-11-12 00:00:00', '', '20000.00', '', 'Available', '2024-11-12 16:09:22', '2024-11-12 16:09:22'),
(5, 'Mrg party', 'no', '2024-11-06 00:00:00', '', '10000.00', 'uploads/abs.png', 'Booked', '2024-11-12 16:19:56', '2024-11-12 17:51:54'),
(0, 'Mrg777', '67676ghghgh', '2024-11-07 00:00:00', 'bbsr', '20000.00', 'uploads/image_2024-11-13_095352177.png', 'Available', '2024-11-13 04:23:53', '2024-11-13 04:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','User','Guest') NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `name`, `email`, `username`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(2, 'User', 'Rashmi', 'iuiu@hhh.com', 'Rashmi', '3535353533', '$2y$10$cjzHAiIeKT/vgubdpagWRu5iNaAeVpagVwKMtDw7glR9iizJkXSSG', '2024-11-11 11:41:53', '2024-11-11 11:41:53'),
(5, 'Admin', 'RashmiPrava', 'wwww@gmail.comyhjyh', 'RashmiPrava', '3535353533', '$2y$10$TjHfmfSeVYHHipwqF055KOIST2iOYzSWEYg40NtjGkuA9NTd6y4NS', '2024-11-11 11:52:13', '2024-11-11 11:52:13'),
(0, 'Admin', 'Admin1', 'wwwrfgrgw@gmail.com', 'Admin1', '3535353533', '$2y$10$Mpe3t5CRhXlJiwCDhafvoeI8sBqouMm/06ja8Wt1XOFPUXLR3fy8O', '2024-11-12 11:21:33', '2024-11-12 11:21:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

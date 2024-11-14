-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 12, 2024 at 12:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `event_id`, `user_id`, `ticket_number`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'TICKET-67332BC0D707E', '2024-11-12 10:19:44', '2024-11-12 10:19:44'),
(2, 3, 2, 'TICKET-67333082D75E9', '2024-11-12 10:40:02', '2024-11-12 10:40:02'),
(3, 1, 2, 'TICKET-6733318F6F888', '2024-11-12 10:44:31', '2024-11-12 10:44:31'),
(4, 2, 2, 'TICKET-67333231E90A2', '2024-11-12 10:47:13', '2024-11-12 10:47:13'),
(5, 3, 2, 'TICKET-6733329F23592', '2024-11-12 10:49:03', '2024-11-12 10:49:03'),
(6, 3, 2, 'TICKET-673332D66B8BF', '2024-11-12 10:49:58', '2024-11-12 10:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `event_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `book_status` enum('Available','Booked') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `event_date`, `event_price`, `book_status`, `created_at`, `updated_at`) VALUES
(1, 'Mrg', 'sss', '2024-10-30 00:00:00', 30000.00, 'Booked', '2024-11-12 08:44:42', '2024-11-12 10:44:31'),
(2, 'Mrg', '6u767', '2024-11-14 00:00:00', 4000.00, 'Booked', '2024-11-12 08:45:00', '2024-11-12 10:47:13'),
(3, 'BirthDay', 'no', '2024-11-16 00:00:00', 90000.00, 'Booked', '2024-11-12 10:39:24', '2024-11-12 10:49:58');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `name`, `email`, `username`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(2, 'User', 'Rashmi', 'iuiu@hhh.com', 'Rashmi', '3535353533', '$2y$10$cjzHAiIeKT/vgubdpagWRu5iNaAeVpagVwKMtDw7glR9iizJkXSSG', '2024-11-11 11:41:53', '2024-11-11 11:41:53'),
(5, 'Admin', 'RashmiPrava', 'wwww@gmail.comyhjyh', 'RashmiPrava', '3535353533', '$2y$10$TjHfmfSeVYHHipwqF055KOIST2iOYzSWEYg40NtjGkuA9NTd6y4NS', '2024-11-11 11:52:13', '2024-11-11 11:52:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `fk_event_id` (`event_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

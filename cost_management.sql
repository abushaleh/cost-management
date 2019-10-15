-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2019 at 05:00 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cost_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cat`
--

CREATE TABLE `tbl_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cat`
--

INSERT INTO `tbl_cat` (`cat_id`, `cat_name`) VALUES
(1, 'Computer'),
(2, 'Food'),
(3, 'Internet Bill'),
(4, 'Current Bill');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cost`
--

CREATE TABLE `tbl_cost` (
  `cost_id` int(11) NOT NULL,
  `cost_name` varchar(255) NOT NULL,
  `cost_details` text NOT NULL,
  `cost_amount` int(11) NOT NULL,
  `cost_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cost`
--

INSERT INTO `tbl_cost` (`cost_id`, `cost_name`, `cost_details`, `cost_amount`, `cost_date`, `cat_id`) VALUES
(1, 'singara', 'singara for guest', 120, '2019-10-15 00:00:00', 2),
(2, 'Laptop', 'macbook pro for emplyee', 12000, '2019-10-08 00:00:00', 1),
(5, 'Dell', 'Dell pc foor hr ba', 50000, '2019-10-02 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_cost`
--
ALTER TABLE `tbl_cost`
  ADD PRIMARY KEY (`cost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cat`
--
ALTER TABLE `tbl_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cost`
--
ALTER TABLE `tbl_cost`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

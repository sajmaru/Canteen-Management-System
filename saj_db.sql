-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2020 at 01:47 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saj_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'parth', 'admin@admin.com', '123'),
(4, 'saj', 'sajmaru360@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category_description` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `category_description`) VALUES
(12, 'Starter', 1, ''),
(13, 'Main Course', 1, ''),
(14, 'Drinks', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `deleteduser`
--

CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleteduser`
--

INSERT INTO `deleteduser` (`id`, `email`, `deltime`) VALUES
(21, 'saj@saj.com', '2019-03-03 16:32:59'),
(22, 'saj.maru@somaiya.edu', '2019-03-04 19:01:59'),
(23, 'saj.maru@somaiya.edu', '2019-03-04 19:20:54'),
(24, 'sajmaru360@gmail.com', '2019-03-05 16:31:32'),
(25, 'sajmaru360@gmail.com', '2019-03-28 18:28:47'),
(26, 'a@a.com', '2019-03-28 20:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `pid` int(11) NOT NULL,
  `cid` varchar(11) NOT NULL,
  `cname` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `rate` varchar(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`pid`, `cid`, `cname`, `name`, `rate`, `description`, `status`) VALUES
(4, '13', 'Starteeeeer', 'lays', '20', 'yummy', '1'),
(7, '13', 'Main Course', 'Frankie', '22', 'chilly,potato,very spicy', '1'),
(8, '13', 'Starteeeeer', 'bhel', '20', 'wet', '1'),
(9, '14', 'drinks', 'Coca Cola', '46', 'cold', '1'),
(10, '14', 'Drinks', 'Pepsi', '40', 'ice', '1'),
(11, '14', 'Drinks', 'Chocolate Milkshake', '100', ' cold', '1'),
(12, '14', 'Drinks', 'Tea', '20', 'Special Tea  made By Parth', '1'),
(13, '14', 'Drinks', 'Coffee', '10', 'Parth don\'t like coffee', '1'),
(14, '13', 'Main Course', 'Sandwich', '35', 'New Arrival', '1'),
(16, '12', 'Starter', 'Samosa', '30', 'Punjabi', '1'),
(17, '13', 'Main Course', 'Dosa', '500', 'Riddhi dosa', '1'),
(18, '12', 'Starter', 'eeee', '343', 'sfsfsd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(18, '123', 'Admin', 'Create Account', '2019-03-02 08:03:26'),
(19, 'saj@saj.com', 'Admin', 'Create Account', '2019-03-02 08:07:06'),
(20, 'dilip@parth.com', 'Admin', 'Create Account', '2019-03-03 16:31:35'),
(21, 'sajmaru360@gmail.com', 'Admin', 'Create Account', '2019-03-04 18:42:50'),
(22, 'sajmaru360@gmail.com', 'Admin', 'Create Account', '2019-03-04 18:58:45'),
(23, 'saj.maru@somaiya.edu', 'Admin', 'Create Account', '2019-03-04 19:00:21'),
(24, 'a@a.com', 'Admin', 'Create Account', '2019-03-05 10:27:48'),
(25, 'sajmaru360@gmail.com', 'Admin', 'Create Account', '2019-03-05 16:26:53'),
(26, 'saj@gmail.com', 'Admin', 'Create Account', '2019-04-01 17:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `items` varchar(200) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `items`, `quantity`, `amount`, `status`) VALUES
(10, 'dilip@parth.com', '10,11,12,13', '2,2,2,2', 357, 1),
(11, 'dilip@parth.com', '5,6,7', '2,1,2', 400, 1),
(12, 'parth@gmail.com', '5,6,7', '1,2,1', 398, 1),
(13, 'parth', '12,13', '1,1', 32, 1),
(14, 'parth@gmail.com', '16', '2', 63, 1),
(15, 'sajmaru360@gmail.com', '11', '1', 105, 1),
(16, 'saj', '13', '1', 11, 1),
(17, 'saj', '11,13', '2,1', 221, 1),
(18, 'saj', '17', '1', 525, 1),
(19, 'parth@gmail.com', '16', '2', 63, 1),
(20, 'saj', '', '', 0, 1),
(21, 'saj', '', '', 0, 1),
(22, 'saj', '18', '3', 1080, 1),
(23, 'parth@gmail.com', '16', '1', 32, 1),
(24, 'parth@gmail.com', '', '', 0, 1),
(25, 'parth@gmail.com', '9', '1', 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobno` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobno`) VALUES
(3, 'parth', 'parth.maniar@somaiya', '113', '1292'),
(5, 'saj', 'sajmaru370@gmail.com', '123', ''),
(7, 'vinayak', 'vinayak', '1234', '1818'),
(8, 'anuu', 'anuj@gmail.com', 'qnuu', '8097'),
(9, 'qwe', 'dd', '123', '1234567'),
(10, 'Anuj', 'moreanuj1307@gmail.c', 'anuj', '9322609366'),
(11, 'riddhi', 'riddhi@rid@gmail.com', '123', '1234567'),
(12, 'ridhi', 'ridhi@ridhi.com', '123', '123'),
(13, 'Janvi', 'janm@gmail.com', '678954', '9856475664'),
(14, 'saj', 'sajmaru360@gmail.com', '123', '9920677347'),
(15, 'bhavesh maru', 'bhaveshmaru2018@gmai', 'gatugala12', '9869008209'),
(16, 'abc', 'abc@gmail', 'sahil', '627383637'),
(17, 'Ayush', 'ayushdeshia2003@gmai', 'Ayush28071423', '7021122425'),
(18, 'bro', 'brosis2003@gmail.com', 'brosis2003', '7021122426');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `mobile`, `designation`, `image`, `status`) VALUES
(20, 'Parth Maniar', 'parth@gmail.com', '202cb962ac59075b964b07152d234b70', 'Male', '8692047749', 'Developer', 'inshot_20180629_011411354-(1).jpg', 1),
(22, 'Dilip Maniar', 'dilip@parth.com', '202cb962ac59075b964b07152d234b70', 'Male', '8692047749', 'Parth\'s Father', 'img_20181121_143705-01.jpeg', 1),
(23, 'saj', 'saj@gmail.com', '202cb962ac59075b964b07152d234b70', 'Male', '9', 'student', 'parth.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

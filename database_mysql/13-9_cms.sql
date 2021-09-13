-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 07:34 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'PYTHON'),
(3, 'PHP'),
(9, 'JAVASCRIPT'),
(17, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 25, 'DEV JOSHI', 'example@gmail.com', 'This is really cool', 'Approved', '2021-06-16'),
(4, 34, 'JOSHI DEO', 'joshi@joshi.com', 'This is cool and awesome', 'Approved', '2021-06-16'),
(21, 25, 'JOSHI', 'dev@example.com', 'sdflvkmsdfknj', 'Approved', '2021-09-13'),
(22, 50, 'DeoJoshi', 'rajan@mail.com', 'erdkjflnisedfkj', 'Approved', '2021-09-13'),
(23, 50, 'DevJoshi', 'dev@example.com', 'srekjdvlm', 'Approved', '2021-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(25, 9, 'LEARN PHP', 'Dev Joshi', '2021-09-13', 'blog1.jpg', 'This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.This is great we made it till here.\r\n', 'php,javascript', 77, 'Published', 0, -1),
(34, 1, 'LEARN C , PHP', 'DeoJoshi', '2021-06-30', 'blog2.jpg', 'This is great we made it till here.', 'sql , python', 8, 'Published', 6, 0),
(35, 1, 'AWESOME POST', 'DevJoshi', '2021-06-30', 'image_1.jpg', 'WE ARE LEARNING!!', 'php , java , c', 5, 'Published', 0, 0),
(50, 9, 'Hii Another , I am tired :)', 'DevJoshi', '2029-06-21', 'image_3.jpg', 'This is some content', 'bootstrap', 0, 'Published', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(16, 'DevJoshi', '$2y$10$HzX2PQBjMmeQdTwfp0RaFOQ25OdIuKKXqiizugS6ArNWY02gkJ2yy', '', '', 'dev@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(17, 'DeoJoshi', '$2y$10$ZsTRXRbDLwKyZ377iEe3Kum2eY17XzRMVImNEY9nftT/00yUz.9fu', 'Deo', 'Joshi', 'deo@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '75e41ojdkfmunu6h6ju2jvcpek', 1625779796),
(2, 'etgqo4udd1qq1sb0qoaj0jcfs8', 1625778722),
(3, 'jpb33m86poqc1ib27fvab2e2m1', 1625778652),
(4, '13t7r5i5fst41vs8u6nmm0evof', 1625782023),
(5, 'suvmi9ldffeq5hknueituaobla', 1625779790),
(6, '', 1625812888),
(7, 'qesca58dqr2nro2ruh829b8i7o', 1625813090),
(8, 'ofqj0jnetegnf1bfllt14uheb5', 1625813062),
(9, 'cblsbgjbv0vs5ojukguli21mo7', 1625813049),
(10, 'i7mg4cv3ad2kr8iqd4ffj21faa', 1625862788),
(11, 'cu1fnjbt551dv4sqq3rvikkvql', 1625860650),
(12, 'urvplj7fkmhk2npu9cf1nqpi4s', 1625956281),
(13, '3lffvub5hq79aampdsb2ru8pms', 1626017249),
(14, 'qgh2rgu93p2dru981nqe7rmgua', 1629658547),
(15, 'apnp2vkp3ojq171gkn76cg09a3', 1629745107),
(16, 'eqc0hl63hap6f7g53lpu5uu9es', 1630324952),
(17, '2vghvavijl2t9phg7ddkvu72gs', 1630444017),
(18, 'nvs7vkcu1e506iu357nrkutnnb', 1630524110),
(19, '05c31sekl43kle8pdcphbn6gb6', 1630616894),
(20, '6aemc85l4u2vmbh2v9439tejp2', 1630673868),
(21, 'fehaer2lvj4erc5cmfv4enomro', 1631125706),
(22, 'ftcs2r197rsa5pqdrb3e6al69f', 1631470520),
(23, '56ragj0qrovqa9s5of7pnhu3cg', 1631554473),
(24, 'n0joh83die8t9o89eg2uun5v48', 1631554184);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

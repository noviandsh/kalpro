-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2020 at 03:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `send_to` varchar(20) NOT NULL,
  `send_by` varchar(20) NOT NULL,
  `message` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classID` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `member` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classID`, `teacher`, `name`, `member`) VALUES
(4, 'davB0Z', 'Novian D Syahrizal', 'PTI 13 B', ''),
(5, 'PCiPvO', 'Novian D Syahrizal', 'PTI 12 A', ''),
(10, 'YTGplX', 'Azka Raisa', 'kelas baru', ''),
(11, 'Inp3xy', 'Novian D Syahrizal', 'PTE 16 E', ''),
(12, 'K1r6hT', 'Novian D Syahrizal', 'TI 16 D', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_member`
--

CREATE TABLE `class_member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `classID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_member`
--

INSERT INTO `class_member` (`id`, `username`, `classID`) VALUES
(6, 'ahmad mahasiswa', 'davB0Z'),
(7, 'ahmad mahasiswa', 'hnJ7tE'),
(14, 'Doyan Coding', 'davB0Z');

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `classID` varchar(6) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `sender`, `classID`, `content`, `date`) VALUES
(10, 'Novian D Syahrizal', 'davB0Z', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae id aperiam, officiis ratione expedita, neque incidunt unde cupiditate sequi fugiat doloremque laudantium! Possimus sint corporis perferendis fugiat, voluptate alias aspernatur debitis voluptatum laudantium, ipsam mollitia ratione a cumque? Eveniet magnam eos fugiat consequuntur minima? Quas nihil sapiente recusandae pariatur nostrum!', '2019-08-01 07:52:50'),
(14, 'Azka Raisa', 'YTGplX', 'coba', '2020-05-23 15:42:57'),
(15, 'ahmad mahasiswa', 'davB0Z', 'Possimus sint corporis perferendis fugiat, voluptate alias aspernatur debitis voluptatum laudantium, ipsam mollitia ratione a cumque? Eveniet magnam eos fugiat consequuntur minima? Quas nihil sapiente recusandae pariatur nostrum!', '2020-05-23 18:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `feed_comment`
--

CREATE TABLE `feed_comment` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `feedID` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feed_comment`
--

INSERT INTO `feed_comment` (`id`, `sender`, `feedID`, `comment`, `date`) VALUES
(6, 'ahmad mahasiswa', 10, 'Quas nihil sapiente recusandae pariatur nostrum!', '2019-08-01 08:43:03'),
(8, 'Novian D Syahrizal', 12, 'asdadasds', '2020-05-21 17:40:52'),
(9, 'Novian D Syahrizal', 13, 'oke mas', '2020-05-21 21:49:17'),
(11, 'Novian D Syahrizal', 10, 'Recusandae id aperiam, officiis ratione expedita, neque incidunt unde cupiditate sequi fugiat doloremque laudantium!', '2020-05-23 18:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `question_fill`
--

CREATE TABLE `question_fill` (
  `id` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question_flow`
--

CREATE TABLE `question_flow` (
  `id` int(11) NOT NULL,
  `quizID` varchar(15) NOT NULL,
  `questionNumber` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_flow`
--

INSERT INTO `question_flow` (`id`, `quizID`, `questionNumber`, `question`, `answer`) VALUES
(14, '5d427af04a733', 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti sint vel dicta soluta nihil nam, velit inventore iusto nemo magnam dolorum deserunt nesciunt. Illo accusamus expedita nemo hic, quas quia!', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"Illo accusamus expedita nemo hic, quas quia!\"},\"target-4\":{\"shape\":\"input-output\",\"answer\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit.\"},\"target-5\":{\"shape\":\"decision\",\"answer\":\"Corrupti sint vel dicta soluta nihil nam,\"},\"arrow-1\":{\"arrow\":\"tail-arrow2\"},\"arrow-3\":{\"arrow\":\"head-arrow2\"},\"arrow-4\":{\"arrow\":\"arrow10\"},\"arrow-6\":{\"arrow\":\"arrow11\"}}'),
(15, '5d428f6c41f5f', 0, 'nnnn', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"xxx\"},\"target-5\":{\"shape\":\"decision\",\"answer\":\"bbb\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(16, '5ec81663afa34', 0, '', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `question_multi`
--

CREATE TABLE `question_multi` (
  `id` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `optionList` longtext NOT NULL,
  `rightOption` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` varchar(15) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `classID` varchar(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  `duration` int(3) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `teacher`, `classID`, `title`, `date`, `dueDate`, `duration`, `publish`) VALUES
('5d427af04a733', 'Novian D Syahrizal', 'davB0Z', 'untitled quiz 2019-08-01', '2019-08-02 00:00:00', '2019-08-05 00:00:00', 60, 0),
('5d428f6c41f5f', 'Novian D Syahrizal', 'davB0Z', 'untitled quiz 2019-08-01', '2019-08-02 00:00:00', '2019-08-06 07:32:00', 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `quizID` varchar(15) NOT NULL,
  `correctAnswer` varchar(10) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`id`, `username`, `quizID`, `correctAnswer`, `score`) VALUES
(19, 'ahmad', '5d428f6c41f5f', '5/5', 100),
(20, 'budi', '5d428f6c41f5f', '1/5', 20),
(21, 'abdul', '5d428f6c41f5f', '0/5', 0),
(22, 'abdul', '5d428f6c41f5f', '0/5', -3),
(23, 'dosen', '5d427af04a733', '0/9', 0),
(24, 'mahasiswa', '5d428f6c41f5f', '0/5', 0),
(25, 'dosen', '5d427af04a733', '2/9', 22),
(26, 'mahasiswa', '5d428f6c41f5f', '0/5', 0),
(27, 'Novian D Syahrizal', '5d427af04a733', '4/9', 44);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` char(1) NOT NULL,
  `google` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `photo`, `email`, `password`, `type`, `google`) VALUES
('1', 'abdul dosen', 'http://localhost/kalpro/assets/img/photos/default.png', 'dosen@gmail.com', '$2y$10$u9xyvB8UUAYFn5Kmj2iOMuKnn1MFfpUnVPDhY2kxEdDKZ5jaDuTiC', 'd', 0),
('102099794150484206015', 'Azka Raisa', 'https://lh3.googleusercontent.com/-xTgxfSxa5Dw/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucn4HkF2WwBuOBNcSIyY1sNHE-W1EQ/s96-c/photo.jpg', 'azkayra431@gmail.com', '', 'd', 1),
('110376814704472451437', 'Doyan Coding', 'https://lh3.googleusercontent.com/a-/AOh14GiPf_2GpErZ6QUECl4SoCeuePAj9sWAPusCre7k=s96-c', 'doyancoding@gmail.com', '', 'm', 1),
('111213002107183220470', 'Novian D Syahrizal', 'https://lh3.googleusercontent.com/a-/AOh14Gg96lsAdVAa32hQePNjCLFBJ-XKu-b0MFVnjbDPvQ=s96-c', 'rijalpookez@gmail.com', '', 'd', 1),
('2', 'ahmad mahasiswa', 'http://localhost/kalpro/assets/img/photos/default.png', 'mahasiswa@gmail.com', '$2y$10$dSpvMltZdAcnNC9uXtC8renxrosShlnLJbgoowgavahBGqz3dWvTa', 'm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `quizID` varchar(15) NOT NULL,
  `startTime` datetime NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`id`, `username`, `quizID`, `startTime`, `answer`) VALUES
(42, 'ahmad', '5d428f6c41f5f', '2019-08-01 14:08:09', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"xxx\"},\"target-5\":{\"shape\":\"decision\",\"answer\":\"bbb\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(43, 'ahmad', '5d428f6c41f5f', '2019-08-01 14:09:12', ''),
(44, 'budi', '5d428f6c41f5f', '2019-08-01 14:09:46', '{\"target-2\":{\"shape\":\"document\",\"answer\":\"bbb\"},\"target-5\":{\"shape\":\"input-output\",\"answer\":\"xxx\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(45, 'abdul', '5d428f6c41f5f', '2019-08-05 14:01:20', '{\"arrow-1\":{\"arrow\":\"arrow9\"},\"arrow-3\":{\"arrow\":\"head-arrow2\"}}'),
(46, 'abdul', '5d428f6c41f5f', '2019-08-05 15:14:56', '{\"arrow-1\":{\"arrow\":\"arrow9\"},\"arrow-3\":{\"arrow\":\"head-arrow2\"}}'),
(47, 'abdul', '5d427af04a733', '2019-10-27 09:28:12', ''),
(48, 'dosen', '5d427af04a733', '2020-02-25 13:29:48', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"Corrupti sint vel dicta soluta nihil nam,\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(49, 'mahasiswa', '5d428f6c41f5f', '2020-04-13 19:48:26', '[]'),
(50, 'dosen', '5d428f6c41f5f', '2020-04-28 10:39:57', ''),
(51, 'dosen', '5d427af04a733', '2020-04-28 11:23:31', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"Corrupti sint vel dicta soluta nihil nam,\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(52, 'dosen', '5d427af04a733', '2020-05-09 09:40:51', '{\"target-2\":{\"shape\":\"process\",\"answer\":\"Corrupti sint vel dicta soluta nihil nam,\"},\"arrow-4\":{\"arrow\":\"arrow10\"}}'),
(53, 'mahasiswa', '5d427af04a733', '2020-05-15 11:07:36', ''),
(54, 'mahasiswa', '5d428f6c41f5f', '2020-05-15 12:12:43', '[]'),
(55, 'Novian D Syahrizal', '5d427af04a733', '2020-05-23 19:01:53', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_member`
--
ALTER TABLE `class_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_comment`
--
ALTER TABLE `feed_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_fill`
--
ALTER TABLE `question_fill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_flow`
--
ALTER TABLE `question_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_multi`
--
ALTER TABLE `question_multi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `Unik` (`name`,`email`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_member`
--
ALTER TABLE `class_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feed_comment`
--
ALTER TABLE `feed_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_fill`
--
ALTER TABLE `question_fill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_flow`
--
ALTER TABLE `question_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `question_multi`
--
ALTER TABLE `question_multi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

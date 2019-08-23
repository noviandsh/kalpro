-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 01:11 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classID` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `teacher` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `member` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classID`, `teacher`, `name`, `member`) VALUES
(4, 'davB0Z', 'abdul', 'bahasa inggris', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_member`
--

CREATE TABLE `class_member` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `classID` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_member`
--

INSERT INTO `class_member` (`id`, `username`, `classID`) VALUES
(6, 'ahmad', 'davB0Z');

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `sender` varchar(15) NOT NULL,
  `classID` varchar(6) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `sender`, `classID`, `content`, `date`) VALUES
(10, 'abdul', 'davB0Z', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae id aperiam, officiis ratione expedita, neque incidunt unde cupiditate sequi fugiat doloremque laudantium! Possimus sint corporis perferendis fugiat, voluptate alias aspernatur debitis voluptatum laudantium, ipsam mollitia ratione a cumque? Eveniet magnam eos fugiat consequuntur minima? Quas nihil sapiente recusandae pariatur nostrum!', '2019-08-01 07:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `feed_comment`
--

CREATE TABLE `feed_comment` (
  `id` int(11) NOT NULL,
  `sender` varchar(15) NOT NULL,
  `feedID` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feed_comment`
--

INSERT INTO `feed_comment` (`id`, `sender`, `feedID`, `comment`, `date`) VALUES
(6, 'ahmad', 10, 'Quas nihil sapiente recusandae pariatur nostrum!', '2019-08-01 08:43:03');

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
(14, '5d427af04a733', 0, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti sint vel dicta soluta nihil nam, velit inventore iusto nemo magnam dolorum deserunt nesciunt. Illo accusamus expedita nemo hic, quas quia!', '{"target-2":{"shape":"process","answer":"Illo accusamus expedita nemo hic, quas quia!"},"target-4":{"shape":"input-output","answer":"Lorem ipsum dolor sit amet consectetur adipisicing elit."},"target-5":{"shape":"decision","answer":"Corrupti sint vel dicta soluta nihil nam,"},"arrow-1":{"arrow":"tail-arrow2"},"arrow-3":{"arrow":"head-arrow2"},"arrow-4":{"arrow":"arrow10"},"arrow-6":{"arrow":"arrow11"}}'),
(15, '5d428f6c41f5f', 0, 'nnnn', '{"target-2":{"shape":"process","answer":"xxx"},"target-5":{"shape":"decision","answer":"bbb"},"arrow-4":{"arrow":"arrow10"}}');

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
  `teacher` varchar(15) NOT NULL,
  `classID` varchar(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  `duration` int(3) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `teacher`, `classID`, `title`, `date`, `dueDate`, `duration`, `publish`) VALUES
('5d427af04a733', 'abdul', 'davB0Z', 'untitled quiz 2019-08-01', '2019-08-02 00:00:00', '2019-08-05 00:00:00', 60, 0),
('5d428f6c41f5f', 'abdul', 'davB0Z', 'untitled quiz 2019-08-01', '2019-08-02 00:00:00', '2019-08-06 07:32:00', 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
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
(22, 'abdul', '5d428f6c41f5f', '0/5', -3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`) VALUES
('abdul', '+OrwsW40WVBNCXfoyJeWxjjND/GG5KnNWBtc+5XLwhVEM4f3tEdvmtShYpTHw6xV5kfpqnYIUWJeYnCsnvgEQw==', 'd'),
('ahmad', 'M9rmuBtqwxRkIG5idANCi++eRtb34pyQ4eo/H9kyGNYeUXmwNXM0xwBx0zFB+QuTrDcIWzunZfebxlNhNLuquw==', 'm'),
('budi', 'oZH92HpDIL4nadjiwsq85lMdfyl0WPuvg+Rip0RV8Ba3QdM2t8IWMcmy3tS9I7NGjklmtB+VRmvZIBFSu6DHsA==', 'm'),
('siti', '3oYUDUj/7Cpf83LyVfDY3MLWodkOBMYFrSkXG/flS6Bwa7e5Nk0SY8iBdq1OxQjSYshuoqGYO7Q9zSuuxER4BA==', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `quizID` varchar(15) NOT NULL,
  `startTime` datetime NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`id`, `username`, `quizID`, `startTime`, `answer`) VALUES
(42, 'ahmad', '5d428f6c41f5f', '2019-08-01 14:08:09', '{"target-2":{"shape":"process","answer":"xxx"},"target-5":{"shape":"decision","answer":"bbb"},"arrow-4":{"arrow":"arrow10"}}'),
(43, 'ahmad', '5d428f6c41f5f', '2019-08-01 14:09:12', ''),
(44, 'budi', '5d428f6c41f5f', '2019-08-01 14:09:46', '{"target-2":{"shape":"document","answer":"bbb"},"target-5":{"shape":"input-output","answer":"xxx"},"arrow-4":{"arrow":"arrow10"}}'),
(45, 'abdul', '5d428f6c41f5f', '2019-08-05 14:01:20', '{"arrow-1":{"arrow":"arrow9"},"arrow-3":{"arrow":"head-arrow2"}}'),
(46, 'abdul', '5d428f6c41f5f', '2019-08-05 15:14:56', '{"arrow-1":{"arrow":"arrow9"},"arrow-3":{"arrow":"head-arrow2"}}');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class_member`
--
ALTER TABLE `class_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `feed_comment`
--
ALTER TABLE `feed_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `question_fill`
--
ALTER TABLE `question_fill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question_flow`
--
ALTER TABLE `question_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `question_multi`
--
ALTER TABLE `question_multi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

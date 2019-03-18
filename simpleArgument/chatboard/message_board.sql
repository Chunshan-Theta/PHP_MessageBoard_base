-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 11:43 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.0.33-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `message_board`
--

CREATE TABLE `message_board` (
  `id` int(11) NOT NULL,
  `title` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auther` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(228) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roomTag` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_board`
--

INSERT INTO `message_board` (`id`, `title`, `auther`, `content`, `posttime`, `roomTag`) VALUES
(25, 'hi', '王君善', '123', '2019-03-18 12:32:40', ''),
(37, '||chatroom-1', '王君善', '安安', '2019-03-18 13:17:48', '1'),
(38, '||chatroom-1', '雞排人', '你是誰？', '2019-03-18 13:20:05', '1'),
(39, '||chatroom-1', '雞排人', 'gji 8\r\n', '2019-03-18 13:20:35', '1'),
(40, '||chatroom-1', '雞排人', '8 ?\r\nwierjiwe\r\n?\r\nwerwer', '2019-03-18 13:20:42', '1'),
(41, '||chatroom-1', '雞排人', 'gji cj844\r\n', '2019-03-18 13:20:54', '1'),
(42, '||chatroom-1', '雞排人', '123123', '2019-03-18 13:20:56', '1'),
(43, '||chatroom-1', '雞排人', '123123123123', '2019-03-18 13:27:11', '1'),
(44, '||chatroom-1', '雞排人', '安安你好這是新的\r\n', '2019-03-18 13:27:27', '1'),
(45, '||chatroom-1', '雞排人', '東西會不見錒北七', '2019-03-18 13:28:29', '1'),
(46, '||chatroom-1', '雞排人', '安安安', '2019-03-18 13:42:21', '1'),
(47, '||chatroom-1', '雞排人', '安安安123', '2019-03-18 13:46:00', '1'),
(48, '||chatroom-1', '雞排人', 'www', '2019-03-18 13:46:37', '1'),
(49, '||chatroom-1', '雞排人', '123', '2019-03-18 13:47:35', '1'),
(50, '||chatroom-1', '雞排人', '60秒刷一次\r\n應該還可以吧？你覺得呢？ 不要跟老師提到這件事情好了 反正也不會知道 你說不是嗎哭哭 廢物 煩死了 一分鐘其實很久你知道嗎？', '2019-03-18 13:59:48', '1'),
(60, 'to##58', '王君善', '0 0 ', '2019-03-18 15:03:58', 'asc1'),
(61, 'to ##57', '王君善', '安安', '2019-03-18 15:08:39', 'asc1'),
(62, '開頭一下', '王君善', '安安', '2019-03-18 15:09:36', 'asc1'),
(63, '22', '王君善', '22', '2019-03-18 15:09:45', 'asc1'),
(64, '123', '王君善', '123', '2019-03-18 15:13:03', 'asc1'),
(65, 'to ##62', '王君善', ' 安', '2019-03-18 15:14:23', 'asc1'),
(66, 'to ##62', '王君善', '?', '2019-03-18 15:15:16', 'asc1'),
(67, '||chatroom-123', '雞排人', '安安', '2019-03-18 15:17:25', '123'),
(68, '||chatroom-123', '雞排人', '怎樣啊·～\r\n', '2019-03-18 15:18:19', '123'),
(69, '||chatroom-123', '雞排人', '是喔\r\n', '2019-03-18 15:18:26', '123'),
(70, '||chatroom-123', '雞排人', '好喔', '2019-03-18 15:18:32', '123'),
(71, '||chatroom-sync1', '王君善', '123123213222', '2019-03-18 15:29:40', 'sync1'),
(72, '||chatroom-sync1', '王君善', '123123213222222', '2019-03-18 15:29:46', 'sync1'),
(73, '||chatroom-sync1', 'hi', '123123', '2019-03-18 15:30:01', 'sync1'),
(74, '||chatroom-sync1', '王君善', '123', '2019-03-18 15:31:09', 'sync1'),
(75, '||chatroom-sync1', '王君善', '安安', '2019-03-18 15:31:33', 'sync1'),
(76, '||chatroom-sync1', '王君善', '安安我是小夥伴', '2019-03-18 15:31:48', 'sync1'),
(77, '||chatroom-sync1', '王君善', '安安', '2019-03-18 15:32:09', 'sync1'),
(78, '||chatroom-sync1', '王君善', '安安', '2019-03-18 15:33:07', 'sync1'),
(79, '||chatroom-sync1', '王君善', '我是小夥伴喔', '2019-03-18 15:33:13', 'sync1'),
(80, '||chatroom-sync1', 'hi', '是喔 歡迎你', '2019-03-18 15:33:30', 'sync1'),
(81, '自我介紹', '王君善', '我是君善 你是誰？', '2019-03-18 15:35:32', 'async1'),
(82, 'to ##81', '王君善', '哈摟', '2019-03-18 15:35:42', 'async1'),
(83, '不想自我介紹了啦', '王君善', '好喔', '2019-03-18 15:36:04', 'async1'),
(84, 'to ##83', '王君善', '關你屁事', '2019-03-18 15:36:14', 'async1'),
(85, 'to ##83', '王君善', '吃大便啦', '2019-03-18 15:36:24', 'async1'),
(86, 'to ##43', '', '', '2019-03-18 15:39:46', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message_board`
--
ALTER TABLE `message_board`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message_board`
--
ALTER TABLE `message_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

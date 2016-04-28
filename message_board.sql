-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-04-28 04:46:14
-- 伺服器版本: 10.1.8-MariaDB
-- PHP 版本： 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `blueooth`
--

-- --------------------------------------------------------

--
-- 資料表結構 `message_board`
--

CREATE TABLE `message_board` (
  `id` int(11) NOT NULL,
  `title` varchar(228) NOT NULL,
  `auther` varchar(228) NOT NULL,
  `content` varchar(228) NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `message_board`
--

INSERT INTO `message_board` (`id`, `title`, `auther`, `content`, `posttime`) VALUES
(1, '1', '1', '1', '2016-03-30 15:33:53'),
(2, '2', '2', '2', '2016-04-28 02:45:11'),
(3, '3', '3', '4', '2016-04-28 02:45:14');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `message_board`
--
ALTER TABLE `message_board`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `message_board`
--
ALTER TABLE `message_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-06-26 02:31
-- 서버 버전: 10.4.27-MariaDB
-- PHP 버전: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `bitcoin_simulation`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `bitcoins`
--

CREATE TABLE `bitcoins` (
  `key` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `counts` int(20) NOT NULL,
  `total` bigint(100) NOT NULL,
  `dates` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `bitcoins`
--

INSERT INTO `bitcoins` (`key`, `name`, `price`, `counts`, `total`, `dates`) VALUES
(8, 'BSSM', 15463.917525773, 194, 3000000, '2023-06-05'),
(9, 'bitcoin', 34500000, 10000, 345000000000, '2023-06-05'),
(80, 'bitcoin', 34848484.848485, 9900, 345000000000, '2023-06-11'),
(81, 'bitcoin', 35204081.632653, 9800, 345000000000, '2023-06-11'),
(82, 'bitcoin', 35567010.309278, 9700, 345000000000, '2023-06-11'),
(83, 'bitcoin', 35937500, 9600, 345000000000, '2023-06-11'),
(84, 'bitcoin', 36315789.473684, 9500, 345000000000, '2023-06-11'),
(85, 'bitcoin', 36702127.659574, 9400, 345000000000, '2023-06-11'),
(86, 'bitcoin', 37096774.193548, 9300, 345000000000, '2023-06-11'),
(87, 'bitcoin', 37500000, 9200, 345000000000, '2023-06-11'),
(88, 'bitcoin', 37581699.346405, 9180, 345000000000, '2023-06-11'),
(89, 'bitcoin', 37787513.691128, 9130, 345000000000, '2023-06-11'),
(90, 'bitcoin', 37378114.842904, 9230, 345000000000, '2023-06-11'),
(91, 'bitcoin', 39518900.343643, 8730, 345000000000, '2023-06-11'),
(92, 'bitcoin', 35457348.406989, 9730, 345000000000, '2023-06-11'),
(93, 'bitcoin', 35468284.1575, 9727, 345000000000, '2023-06-11'),
(94, 'bitcoin', 35541361.903781, 9707, 345000000000, '2023-06-11'),
(96, 'bitcoin', 1666666666.6667, 207, 345000000000, '2023-06-11');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `bitcoins`
--
ALTER TABLE `bitcoins`
  ADD PRIMARY KEY (`key`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bitcoins`
--
ALTER TABLE `bitcoins`
  MODIFY `key` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

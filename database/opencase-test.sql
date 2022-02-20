-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 21 2022 г., 02:55
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `opencase-test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `balance` int NOT NULL DEFAULT '0',
  `silver-case` int NOT NULL DEFAULT '0',
  `border-case` int NOT NULL DEFAULT '0',
  `addicted-case` int NOT NULL DEFAULT '0',
  `persist-case` int NOT NULL DEFAULT '0',
  `compartment-case` int NOT NULL DEFAULT '0',
  `admin` int NOT NULL DEFAULT '0',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `login`, `password`, `balance`, `silver-case`, `border-case`, `addicted-case`, `persist-case`, `compartment-case`, `admin`, `avatar`) VALUES
(30, 'zxczxc', '4320e593e36aaae7a7102fabf7a976b5', 0, 0, 0, 0, 0, 0, 0, '3f2b6db57806d53dc02f8e0385a7222a.png'),
(29, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(28, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(27, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(26, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(25, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(24, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(23, '', '37928e07878410733a3501d19f7a55d3', 0, 0, 0, 0, 0, 0, 0, 'default.png'),
(22, 'dalboeb', 'd5566a2eaead9c381a26f227e03d36c7', 650, 1, 3, 2, 0, 0, 1, 'default.png'),
(21, 'admin', 'dc1b14f58c32e32989b341da92a8a40e', 0, 0, 2, 1, 0, 0, 0, 'd3dbfda2f460d4f71f35c795946ab991.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

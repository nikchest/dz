-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 28 2017 г., 13:38
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u307379916_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users_dz4`
--

CREATE TABLE `users_dz4` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `photo` text COLLATE utf8_unicode_ci,
  `salt` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cookie` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users_dz4`
--

INSERT INTO `users_dz4` (`id`, `login`, `password`, `name`, `age`, `description`, `photo`, `salt`, `cookie`) VALUES
(58, '222', 'MMfNwYAkEVt.6', '222', 22, '222', NULL, 'MM7O*HO', '(1Sp2FWw6QiMI'),
(60, '444', '*0', '444', 44, '444', '60.png', '_0.A-)', ',oxxaN.EvnjI'),
(61, '555', 'vBhS67ObR.U', '555', 55, '555', NULL, 'YIZ>', '-28yWakvYWDf.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users_dz4`
--
ALTER TABLE `users_dz4`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users_dz4`
--
ALTER TABLE `users_dz4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

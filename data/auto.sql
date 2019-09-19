-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 19 2019 г., 13:32
-- Версия сервера: 10.4.7-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `mark` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Марка',
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Модель',
  `price` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Цена',
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Тип кузова',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Описание',
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Фото'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Машины';

-- --------------------------------------------------------

--
-- Структура таблицы `cars_colors`
--

CREATE TABLE `cars_colors` (
  `id` int(11) UNSIGNED NOT NULL,
  `colors_id` int(11) UNSIGNED DEFAULT NULL,
  `cars_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Цвет'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Цвета для авто';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cars_colors`
--
ALTER TABLE `cars_colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_363be1e5ea39d4f74ea049208b7c0bd0daaf5d18` (`cars_id`,`colors_id`),
  ADD KEY `index_foreignkey_cars_colors_colors` (`colors_id`),
  ADD KEY `index_foreignkey_cars_colors_cars` (`cars_id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cars_colors`
--
ALTER TABLE `cars_colors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

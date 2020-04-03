-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 03 2020 г., 12:28
-- Версия сервера: 5.7.29-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aws_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Наименование таска',
  `file` varchar(255) NOT NULL COMMENT 'Имя файла',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'На кого назначено',
  `is_done` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Таск завершен?',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Задачи';

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `name`, `file`, `user_id`, `is_done`, `created`, `modified`) VALUES
(1, 'First Task', 'image.png', 2, 1, '2020-04-02 22:03:41', '2020-04-03 08:48:03'),
(2, 'Test Task', 'pic1.png', 3, 0, '2020-04-02 22:03:41', '2020-04-03 08:47:49'),
(3, 'Super Task', 'pic2.png', 0, 0, '2020-04-02 22:03:41', '2020-04-03 08:48:48'),
(4, 'My Task', 'pic3.png', 0, 0, '2020-04-02 22:03:41', '2020-04-03 08:48:56'),
(5, 'Last Task', 'pic4.png', 0, 0, '2020-04-02 22:03:41', '2020-04-03 08:49:03');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Mother','Father','Child','') NOT NULL DEFAULT 'Child'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Пользователи';

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES
(1, 'Mother', '$2y$12$/YTS281FexIN/0Mt0/qI0e7123gBQSWYaVAuMzLWO4XbM3e.BzPem', 'Mother'),
(2, 'Father', '$2y$12$xxAjUBUK4MwUcVKzibmFze5VbE4mr9f.pTUqlwaPRVWkMMqyIJRSS', 'Father'),
(3, 'Child1', '$2y$12$5oPVJgImiRIA.NhAMGZPi.kl3dLI1hGYyN7LKsYvse9mY6X6eP3WW', 'Child'),
(4, 'Child2', '$2y$12$NSSYA2dyymzBi9tYuKhRkeefinV.mV7iRS.oZufGmek79j7/E03R6', 'Child'),
(5, 'admin', '$2y$12$TSKQz6dvRPhkt9CyiwuLZ.A4YmY/0ua7aerbBMDyLNj1/ggZOWlbG', 'Father');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `is_done` (`is_done`),
  ADD KEY `created` (`created`),
  ADD KEY `modified` (`modified`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`) USING BTREE,
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

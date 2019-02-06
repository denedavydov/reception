-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 06 2019 г., 19:44
-- Версия сервера: 5.7.24-0ubuntu0.18.04.1
-- Версия PHP: 5.6.39-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `reception`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appeals`
--

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `theme` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appeals`
--

INSERT INTO `appeals` (`id`, `user_id`, `mail`, `theme`, `message`, `status`, `date`, `time`) VALUES
(1, 1, 'denedavydov@gmail.com', 'dfgfdgdfgdf', 'fdgfdgfdgfdgfdg', 'Отправлено', '04.02.2019', '09:33'),
(2, 1, 'denedavydov@gmail.com', 'ываываывавыавыа', 'ывавыавыавыавыавыа', 'Отправлено', '04.02.2019', '10:05');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `passport`, `status`, `password`) VALUES
(1, 'Давыдов', 'Денис', 'denedavydov@gmail.com', '1234545454', 'Родитель обучающегося', '12345678'),
(2, 'Иванов', 'Петр', 'denedavydov@yandex.ru', '7878787878', 'Родитель обучающегося', 'qwerty'),
(3, 'Петров', 'Сергей Иванович', 'davydov@school416spb.ru', '4545454545', 'Законный представитель обучающегося', '123456'),
(4, 'admin', '', 'admin@gmail.com', '', '', 'admin1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

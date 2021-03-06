-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 02 2019 г., 21:57
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
  `date` varchar(6) NOT NULL,
  `year` varchar(4) NOT NULL,
  `time` varchar(5) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appeals`
--

INSERT INTO `appeals` (`id`, `user_id`, `mail`, `theme`, `message`, `status`, `date`, `year`, `time`, `answer`) VALUES
(1, 1, 'denedavydov@gmail.com', 'dfgfdgdfgdf', 'nvjdzvnjlkjgjh', 'Получен ответ', '04.02.', '2019', '09:33', 'szd,fvnl gfsiuh '),
(2, 1, 'denedavydov@gmail.com', 'ываываывавыавыа', 'ывавыавыавыавыавыа', 'Получен ответ', '04.02.', '2019', '10:05', ''),
(3, 1, 'denedavydov@gmail.com', 'ываывавыавыавы ', 'ыва выа выа выа ыва выа ', 'Отправлено', '11.02.', '2019', '12:06', ''),
(4, 1, 'denedavydov@gmail.com', 'ewrw cv werr wer ', 'wer wer ewr ewr wer wer ', 'Находится на рассмотрении', '11.02.', '2019', '12:08', ''),
(5, 1, 'denedavydov@gmail.com', 'dfgd kljklj', 'rfdljgkldfjk lgjdfklklg dfjlkjg k', 'Отправлено', '11.02.', '2019', '12:09', ''),
(6, 1, 'denedavydov@gmail.com', '.knml  b', ',dm v;xmvdf\r\n\r\ndbs\r\nbr\r\n,bg\r\ndg,;br', 'Находится на рассмотрении', '12.02.', '2019', '11:26', '');

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `time` varchar(5) NOT NULL,
  `status` varchar(9) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `theme` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `day`, `time`, `status`, `name`, `mail`, `theme`) VALUES
(1, '23.03.2019', '12:30', 'Свободно', '', '', ''),
(2, '21.11.2019', '12:30', 'Занята', 'Денис', 'denedavydov@gmail.com', 'sdlfmkldsjfl'),
(3, '01.03.2019', '16:30', 'Занята', 'Денис', 'denedavydov@gmail.com', 'дфтвмыа фарра вл');

-- --------------------------------------------------------

--
-- Структура таблицы `canceled`
--

CREATE TABLE `canceled` (
  `id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `canceled`
--

INSERT INTO `canceled` (`id`, `day`) VALUES
(3, '12.12.2019');

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `day` int(1) NOT NULL,
  `time_from` varchar(5) NOT NULL,
  `time_to` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `timetable`
--

INSERT INTO `timetable` (`id`, `day`, `time_from`, `time_to`) VALUES
(1, 4, '13.30', '17.00');

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
(4, 'admin', 'admin', 'admin@gmail.com', '', '', 'admin1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appeals`
--
ALTER TABLE `appeals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `canceled`
--
ALTER TABLE `canceled`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `canceled`
--
ALTER TABLE `canceled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

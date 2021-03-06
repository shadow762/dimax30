-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 03 2017 г., 15:02
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dimax`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `type` varchar(4) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `created_at`, `updated_at`) VALUES
  (101, 'бла бла', '1', 'wolff.nathan@yahoo.com', '2017-01-11 09:37:42', '2017-03-03 08:46:28'),
  (102, 'Emily Halvorson', '1-425-875-62371', 'tressie86@hotmail.com', '2017-01-11 09:37:42', '2017-01-16 08:41:12'),
  (103, 'Dr. Ray Dicki MD', '(540) 478-2044 x23480', 'troy.howe@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (104, 'Prof. Arely Marvin', '+1-341-680-5966', 'reinhold81@jerde.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (105, 'Wanda Pfeffer', '434.331.9271', 'mayert.candido@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (106, 'Dr. Jessika Stracke DVM', '+12693100824', 'ylesch@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (107, 'Donny Rogahn Jr.', '(504) 536-1126', 'rklocko@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (108, 'Lura Schaefer', '1-215-262-3271', 'arvid81@douglas.org', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (109, 'Mariane Huels', '506-883-6359', 'rgrady@lubowitz.org', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (110, 'Ramiro Thiel', '(904) 861-3167', 'leffler.ada@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (111, 'Mr. Devin Fadel V', '960.450.1186', 'brown.jean@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (112, 'Lee Hane DVM', '886-396-6547 x2892', 'saige.ebert@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (113, 'Dashawn White', '501.976.8293', 'vincent.gislason@rosenbaum.net', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (114, 'Xzavier Reinger Jr.', '(461) 994-2750', 'rowe.norene@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (115, 'Lupe Cole MD', '+1.247.264.0235', 'leuschke.gerald@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (116, 'Brant Gusikowski Sr.', '+18633393560', 'simeon.towne@lind.net', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (117, 'Abe Kautzer', '436.818.2075 x4751', 'bosco.kaci@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (118, 'Dion Considine', '(574) 286-8307', 'lafayette.lebsack@gmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (119, 'Nestor Renner', '732.362.2430', 'kelli.ullrich@gmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (120, 'Mr. Brandon Mohr', '(507) 662-7690', 'mayert.magnolia@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (121, 'Maxine Krajcik', '(486) 893-0822 x8196', 'prudence31@grant.info', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (122, 'Ms. Imogene Morar', '807.702.9255 x0560', 'skiles.abel@pfeffer.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (123, 'Madisen Champlin I', '+1-694-715-7694', 'tyrique45@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (124, 'Shanny Hamill III', '1-742-449-8724 x56273', 'russel.mclaughlin@gmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (125, 'Kenneth Keeling', '1-326-442-2388 x4744', 'marques.williamson@block.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (126, 'Dr. Amy Jones', '1-726-524-8339 x642', 'kiana62@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (127, 'Corine Steuber', '301-941-0247 x331', 'maud.dare@hayes.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (128, 'Alva Wunsch', '865.351.4510 x48309', 'terence23@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (129, 'Mr. Silas Goyette DVM', '(781) 282-6649 x858', 'dereck76@marvin.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (130, 'Bell Torp', '(302) 282-0434', 'wrunolfsson@cassin.org', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (131, 'Ms. Felipa Ondricka DVM', '448-468-7932 x94041', 'will.daron@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (132, 'Joanie Jerde', '395.545.9045 x03427', 'foster44@von.net', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (133, 'Dr. Felipe Watsica V', '(656) 270-7769 x7797', 'haleigh43@gerlach.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (134, 'Haley Feil', '(787) 310-3695 x5395', 'hyman.hermiston@gmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (135, 'Xavier Parker DDS', '1-885-909-0424 x5348', 'skylar41@larson.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (136, 'Ms. Tomasa Beer', '(385) 582-4466 x611', 'zrutherford@goldner.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (137, 'Ashley DuBuque', '910.373.0861', 'deckow.leta@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (138, 'Miss Gisselle Kuvalis I', '1-326-945-3154 x657', 'weimann.kale@cole.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (139, 'Dr. Nathan Schumm', '1-442-936-1942', 'tamara.ohara@daniel.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (140, 'Guillermo Fahey', '503-545-6226 x617', 'ablick@hills.info', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (141, 'Ernie Johnston PhD', '1-940-779-0861 x09321', 'ileannon@rowe.org', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (142, 'Prof. Will Gleichner', '1-648-970-1529 x8214', 'nikko.baumbach@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (143, 'Dr. Ransom Kihn', '1-559-957-8916 x8491', 'ward.lucy@hotmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (144, 'Dr. Monty Cummings', '657-987-5965 x3339', 'ubaldo.kirlin@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (145, 'Miss Clara Morar', '818-488-6136', 'collier.aaliyah@yahoo.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (146, 'Miss Dorris Pouros PhD', '951.600.6109 x8728', 'rosanna48@sanford.org', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (147, 'Micah Jerde', '412-712-0056', 'kylie.hauck@thiel.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (148, 'Dr. Charles Gaylord II', '1-614-246-7132 x5389', 'rstiedemann@mante.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (149, 'Prof. Marcelo Green', '+1-660-291-1752', 'jerry.rohan@gmail.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (150, 'Ashlynn McClure', '359.230.8119 x9955', 'rboyle@vonrueden.com', '2017-01-11 09:37:42', '2017-01-11 09:37:42'),
  (151, 'eterty', 'tfhfgh', 'hfghf@gdfsgd', '2017-01-13 08:27:20', '2017-01-13 08:27:20'),
  (152, 'fdfd@3\" \'//script<>', 'fdfd@3\" \'//script<>', 'fdfsf@fdsf', '2017-01-13 08:32:32', '2017-01-13 08:32:32'),
  (153, '123', '123456789', '', '2017-03-03 08:30:31', '2017-03-03 08:30:31');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `model` text,
  `type` text,
  `brend` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `device_dictionaries`
--

CREATE TABLE `device_dictionaries` (
  `id` int(11) NOT NULL,
  `model` text,
  `type` text,
  `brend` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (34, '2014_10_12_000000_create_users_table', 1),
  (35, '2014_10_12_100000_create_password_resets_table', 1),
  (36, '2016_01_09_075739_create_statuses_table', 1),
  (37, '2016_12_29_123856_create_clients_table', 1),
  (38, '2016_12_29_123928_create_comments_table', 1),
  (39, '2016_12_29_124007_create_types_table', 1),
  (40, '2016_12_29_124015_create_brends_table', 1),
  (41, '2016_12_29_124035_create_services_table', 1),
  (42, '2016_12_29_124047_create_parts_table', 1),
  (43, '2017_01_10_121953_create_models_table', 1),
  (44, '2017_01_10_122629_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sn` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `user_created` int(10) UNSIGNED NOT NULL,
  `user_closed` int(10) UNSIGNED DEFAULT NULL,
  `user_resp` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `cost` mediumint(8) UNSIGNED DEFAULT '0',
  `client_id` int(10) UNSIGNED NOT NULL,
  `closed` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `numbers` int(11) DEFAULT NULL,
  `price_own` int(11) DEFAULT NULL,
  `price_sell` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `name`, `numbers`, `price_own`, `price_sell`, `order_id`) VALUES
  (2, 'Запчасть 2', 3, 100, 500, 7),
  (3, 'Запчасть 2', 1, 100, 200, 36),
  (4, 'Запчасть 2', 2, 200, 500, 38),
  (5, 'Запчасть 2', 1, 1, 1, 39);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `numbers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `order_id`, `numbers`) VALUES
  (9, 'Услуга 1', 2, 34, 2),
  (10, 'Услуга 3', 3, 34, 3),
  (11, 'Услуга 1', 100, 7, 5),
  (12, 'Услуга 1', 400, 36, 2),
  (13, 'Услуга 1', 1, 38, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
  (1, 'Принят'),
  (2, 'Закрыт');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
  (1, '123', '123', '123', '123', NULL, NULL),
  (2, 'user', 'user@user.ru', '123', '123', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `clients_name_unique` (`name`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `devices`
--
ALTER TABLE `devices`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `device_dictionaries`
--
ALTER TABLE `device_dictionaries`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id`),
ADD KEY `orders_client_id_foreign` (`client_id`),
ADD KEY `orders_status_id_foreign` (`status_id`),
ADD KEY `orders_user_created_foreign` (`user_created`),
ADD KEY `orders_user_closed_foreign` (`user_closed`),
ADD KEY `orders_user_resp_foreign` (`user_resp`);

--
-- Индексы таблицы `parts`
--
ALTER TABLE `parts`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
ADD KEY `password_resets_email_index` (`email`),
ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `devices`
--
ALTER TABLE `devices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `device_dictionaries`
--
ALTER TABLE `device_dictionaries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `parts`
--
ALTER TABLE `parts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orders_user_closed_foreign` FOREIGN KEY (`user_closed`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orders_user_created_foreign` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orders_user_resp_foreign` FOREIGN KEY (`user_resp`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

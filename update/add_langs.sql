-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.16-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5144
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица lonis.langs
CREATE TABLE IF NOT EXISTS `langs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL,
  `var` varchar(64) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=369 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.langs: ~358 rows (приблизительно)
/*!40000 ALTER TABLE `langs` DISABLE KEYS */;
INSERT INTO `langs` (`id`, `lang`, `var`, `value`) VALUES
	(1, 'ru', 'ThemeNotFound', 'тема не существует'),
	(2, 'ru', 'Main', 'Главная'),
	(3, 'ru', 'home', 'Начало'),
	(4, 'ru', 'achiev', 'Достижения'),
	(5, 'ru', 'ucp', 'Личный кабинет'),
	(6, 'ru', 'logout', 'Выйти'),
	(7, 'ru', 'Title', 'Lonis'),
	(8, 'ru', 'admin_achiev', 'Настройка достижений'),
	(9, 'ru', 'admin_langs', 'Словарь'),
	(10, 'ru', 'RegErrors', 'Произошли следующие ошибки:'),
	(11, 'ru', 'NotInputNick', 'Вы не ввели ник!'),
	(12, 'ru', 'NotInputPassword', 'Вы не ввели пароль!'),
	(13, 'ru', 'NotInputMail', 'Вы не ввели e-mail!'),
	(14, 'ru', 'AlreadyLogin', 'Вы уже вошли!'),
	(15, 'ru', 'Warning', 'Внимание!'),
	(16, 'ru', 'UserNotFound', 'Игрок не найден'),
	(17, 'ru', 'Name', 'Имя'),
	(18, 'ru', 'Password', 'Пароль'),
	(19, 'ru', 'login', 'Войти'),
	(20, 'ru', 'loginReg', 'Войти / Регистрация'),
	(21, 'ru', 'reg', 'Регистрация'),
	(22, 'ru', 'regTitle', 'Регистрация'),
	(23, 'ru', 'MustLogin', 'Необходимо войти!'),
	(24, 'ru', 'DataUpdated', 'Данные успешно обновлены!'),
	(25, 'ru', 'IP', 'IP'),
	(26, 'ru', 'SteamID', 'Steam ID'),
	(27, 'ru', 'Update', 'Обновить'),
	(28, 'ru', 'Readme', 'Бла бла бла'),
	(29, 'ru', 'Current', 'Текущий'),
	(30, 'ru', 'InActive', 'Учётная запись неактивна!'),
	(31, 'ru', 'AlreadyRegister', 'Вы уже зарегистрированы!'),
	(32, 'ru', 'regSuccess', 'Вы успешно зарегистрированы!'),
	(33, 'ru', 'AlreadyUsed', 'Такой игрок существует!'),
	(34, 'ru', 'Email', 'e-mail'),
	(35, 'ru', 'ActiveSuccess', 'Учётная запись успешно активирована!'),
	(36, 'ru', 'ActiveError', 'Неверный либо старый ключ активации!'),
	(37, 'ru', 'ActiveMail', 'Для активации пройдите по следующей ссылке:'),
	(38, 'ru', 'sendMailError', 'Ошибка отправки почты'),
	(39, 'ru', 'achievsPlayers', 'Игроки, выполнившие достижение'),
	(40, 'ru', 'achievPlayerTotal', 'Всего выполнено достижений:'),
	(41, 'ru', 'achievsUnlocked', 'Разблокировано'),
	(42, 'ru', 'Description', 'Описание'),
	(43, 'ru', 'Count', 'Количество'),
	(44, 'ru', 'Type', 'Тип'),
	(45, 'ru', 'Add', 'Добавить'),
	(46, 'ru', 'achiev_admin', 'Управление достижениями'),
	(47, 'ru', 'achiev_players', 'Достижения игроков'),
	(48, 'ru', 'MyAchiev', 'Мои достижения'),
	(49, 'ru', 'Search', 'Поиск'),
	(50, 'ru', 'green_chat', 'Префикс VIP в чате'),
	(51, 'ru', 'seeing_list', 'Список наблюдающих'),
	(52, 'ru', 'trail', '/trail'),
	(53, 'ru', 'whois', 'Whois'),
	(54, 'ru', 'kzpro', 'Про'),
	(55, 'ru', 'kznoob', 'Новички'),
	(56, 'ru', 'kzall', 'Все'),
	(57, 'ru', 'Stats', 'Статистика'),
	(58, 'ru', 'Map', 'Карта '),
	(59, 'ru', 'player', 'Игрок'),
	(60, 'ru', 'players', 'Игроки'),
	(61, 'ru', 'Time', 'Время'),
	(62, 'ru', 'Cp', 'Чекпоинтов'),
	(63, 'ru', 'GoCp', 'Телепортов'),
	(64, 'ru', 'Weapon', 'Оружие'),
	(65, 'ru', 'Records', 'Рекордов'),
	(66, 'ru', 'Country', 'Страна'),
	(67, 'ru', 'View', 'подробно...'),
	(68, 'ru', 'Recs', 'Рекорд'),
	(69, 'ru', 'WorldRecord', 'Мировой рекорд'),
	(70, 'ru', 'RuRecord', 'Русский рекорд'),
	(71, 'ru', 'kznum', 'Всего'),
	(72, 'ru', 'kztop1', 'Первый'),
	(73, 'ru', 'kznorec', 'Не пройденные'),
	(74, 'ru', 'kzrec', 'Пройденные'),
	(75, 'ru', 'KzStats', 'KZ Статистика'),
	(76, 'ru', 'DRStats', 'DR Статистика'),
	(77, 'ru', 'City', 'Город'),
	(78, 'ru', 'achievCompleted', 'Выполнил достижений'),
	(79, 'ru', 'MapCompleted', 'Прошёл KZ карт'),
	(80, 'ru', 'kz_duels', 'KZ Дуэль'),
	(81, 'ru', 'kz_maps', 'KZ карты'),
	(82, 'ru', 'kz_players', 'KZ игроки'),
	(83, 'ru', 'Winner', 'Победитель'),
	(84, 'ru', 'Looser', 'Проигравший'),
	(85, 'ru', 'WinnerPoint', 'Очков победителя'),
	(86, 'ru', 'LooserPoint', 'Очков проигравшего'),
	(87, 'ru', 'MyKz', 'Мои KZ рекорды'),
	(88, 'ru', 'AuthNickPassword', 'Ник и пароль'),
	(89, 'ru', 'AuthSteamId', 'Steam ID'),
	(90, 'ru', 'AuthType', 'Тип авторизации'),
	(91, 'ru', 'Banned', 'Вы забанены!!!'),
	(92, 'ru', 'TitleGameAcc', 'Игровой аккаунт'),
	(93, 'ru', 'TitleSettings', 'Настройки'),
	(94, 'ru', 'TitlePersonalData', 'Личные данные'),
	(95, 'ru', 'ICQ', 'ICQ'),
	(96, 'ru', 'Avatar', 'Аватар'),
	(98, 'ru', 'NoSteamLogin', 'Или заполните форму'),
	(99, 'ru', 'setup', 'Настройка конфига'),
	(100, 'ru', 'Save', 'Сохранить'),
	(101, 'ru', 'Saved', 'Сохранено'),
	(102, 'ru', 'Reset', 'Сбросить'),
	(103, 'ru', 'ResetDef', 'Сбросить настройки'),
	(104, 'ru', 'Confirm', 'Подтвердите действие'),
	(105, 'ru', 'timezone', 'Временная зона'),
	(106, 'ru', 'charset', 'Кодировка'),
	(107, 'ru', 'mysql_user', 'Пользователь базы'),
	(108, 'ru', 'mysql_password', 'Пароль базы'),
	(109, 'ru', 'mysql_host', 'Адрес базы'),
	(110, 'ru', 'mysql_db', 'База'),
	(111, 'ru', 'mysql_prefix', 'Префикс'),
	(112, 'ru', 'activateTime', 'Время активации профиля'),
	(113, 'ru', 'baseUrl', 'Адрес сайта'),
	(114, 'ru', 'gravatarSize', 'Размер аватара'),
	(115, 'ru', 'playerPerPage', 'Игроков на странице'),
	(116, 'ru', 'mapsPerPage', 'Карт на странице'),
	(117, 'ru', 'playersPerPage', 'Игроков на странице KZ'),
	(118, 'ru', 'list', 'Список языков (через пробел)'),
	(119, 'ru', 'lang', 'Язык по умолчанию'),
	(120, 'ru', 'themelist', 'Список тем (через пробел)'),
	(121, 'ru', 'theme', 'Тема по умолчанию'),
	(122, 'ru', 'cstheme', 'Тема по умолчанию в CS'),
	(123, 'ru', 'email', 'E-mail'),
	(124, 'ru', 'cookieKey', 'Cookie Ключ'),
	(125, 'ru', 'Generate', 'Генерировать'),
	(126, 'ru', 'setupGeneral', 'Основные настройки'),
	(127, 'ru', 'setupDb', 'База данных'),
	(128, 'ru', 'setupLang', 'Язык'),
	(129, 'ru', 'DbTitle', 'Работа с базой данных'),
	(130, 'ru', 'Base', 'База'),
	(131, 'ru', 'Tables', 'Таблицы'),
	(132, 'ru', 'Data', 'Данные'),
	(133, 'ru', 'Create', 'Создать'),
	(134, 'ru', 'Delete', 'Удалить'),
	(135, 'ru', 'Clear', 'Очистить'),
	(136, 'ru', 'Edit', 'Изменить'),
	(137, 'ru', 'DbNotConnect', 'Нет подключения к базе данных'),
	(138, 'ru', 'DbNotTablesFile', 'Файл с таблицами не существует'),
	(139, 'ru', 'DbNotDataFile', 'Файл с данными не существует'),
	(140, 'ru', 'Global', 'Глобальные'),
	(141, 'ru', 'Local', 'Локальные'),
	(142, 'ru', 'Error', 'Ошибка'),
	(143, 'en', 'ThemeNotFound', 'Theme not found'),
	(144, 'en', 'Main', 'Main'),
	(145, 'en', 'home', 'Home'),
	(146, 'en', 'achiev', 'Achievs'),
	(147, 'en', 'ucp', 'Personal account'),
	(148, 'en', 'logout', 'Logout'),
	(149, 'en', 'Title', 'Lonis'),
	(150, 'en', 'admin_achiev', 'Setup achiev'),
	(151, 'en', 'admin_langs', 'Dictonaries'),
	(152, 'en', 'RegErrors', 'Failed with the following error:'),
	(153, 'en', 'NotInputNick', 'You did not enter nick!'),
	(154, 'en', 'NotInputPassword', 'You have not entered a password!'),
	(155, 'en', 'NotInputMail', 'You have not entered e-mail!'),
	(156, 'en', 'AlreadyLogin', 'You already entered!'),
	(157, 'en', 'Warning', 'Warning!'),
	(158, 'en', 'UserNotFound', 'Player not found'),
	(159, 'en', 'Name', 'Name'),
	(160, 'en', 'Password', 'Password'),
	(161, 'en', 'login', 'Login'),
	(162, 'en', 'loginReg', 'Login/Register'),
	(163, 'en', 'reg', 'Register'),
	(164, 'en', 'regTitle', 'Registration'),
	(165, 'en', 'achiev_players', 'Achievs players'),
	(166, 'en', 'MustLogin', 'You need to login!'),
	(167, 'en', 'DataUpdated', 'Data updated successfully!'),
	(168, 'en', 'IP', 'IP'),
	(169, 'en', 'SteamID', 'Steam ID'),
	(170, 'en', 'Update', 'Update'),
	(171, 'en', 'Readme', 'Bla Bla Bla'),
	(172, 'en', 'Current', 'Current'),
	(173, 'en', 'InActive', 'Account inactive!'),
	(174, 'en', 'AlreadyRegister', 'You are already registered!'),
	(175, 'en', 'regSuccess', 'You have successfully registered!'),
	(176, 'en', 'AlreadyUsed', 'This player is already exists!'),
	(177, 'en', 'Email', 'e-mail'),
	(178, 'en', 'ActiveSuccess', 'Account is successfully activated!'),
	(179, 'en', 'ActiveError', 'Old or invalid activation key!'),
	(180, 'en', 'ActiveMail', 'To activate click on the following link:'),
	(181, 'en', 'sendMailError', 'Error mail send'),
	(182, 'en', 'achievsPlayers', 'Players who complete the achievement'),
	(183, 'en', 'achievPlayerTotal', 'Just completed the achievements:'),
	(184, 'en', 'achievsUnlocked', 'Unlocked'),
	(185, 'en', 'Description', 'Description'),
	(186, 'en', 'Count', 'Count'),
	(187, 'en', 'Type', 'Type'),
	(188, 'en', 'Add', 'Add'),
	(189, 'en', 'achiev_admin', 'Management achievements'),
	(190, 'en', 'MyAchiev', 'My achievements'),
	(191, 'en', 'Search', 'Search'),
	(192, 'en', 'green_chat', 'The VIP prefix in chat'),
	(193, 'en', 'seeing_list', 'List watching'),
	(194, 'en', 'trail', '/trail'),
	(195, 'en', 'whois', 'Whois'),
	(196, 'en', 'kzpro', 'Pro'),
	(197, 'en', 'kznoob', 'Noob'),
	(198, 'en', 'kzall', 'All'),
	(199, 'en', 'Stats', 'Statistics'),
	(200, 'en', 'Map', 'Map'),
	(201, 'en', 'player', 'Player'),
	(202, 'en', 'players', 'Players'),
	(203, 'en', 'Time', 'Time'),
	(204, 'en', 'Cp', 'Checkpoints'),
	(205, 'en', 'GoCp', 'Teleports'),
	(206, 'en', 'Weapon', 'Weapon'),
	(207, 'en', 'Records', 'Records'),
	(208, 'en', 'Country', 'Country'),
	(209, 'en', 'View', 'detail...'),
	(210, 'en', 'Recs', 'Record'),
	(211, 'en', 'WorldRecord', 'World record'),
	(212, 'en', 'RuRecord', 'Russian record'),
	(213, 'en', 'kznum', 'All'),
	(214, 'en', 'kztop1', 'First'),
	(215, 'en', 'kznorec', 'Not jumped'),
	(216, 'en', 'kzrec', 'Passed'),
	(217, 'en', 'KzStats', 'KZ Statistics'),
	(218, 'en', 'DRStats', 'DR Statistics'),
	(219, 'en', 'City', 'City'),
	(220, 'en', 'achievCompleted', 'Fulfilled achievements'),
	(221, 'en', 'MapCompleted', 'Went KZ maps'),
	(222, 'en', 'kz_duels', 'KZ Duels'),
	(223, 'en', 'kz_maps', 'KZ Maps'),
	(224, 'en', 'kz_players', 'KZ Players'),
	(225, 'en', 'Winner', 'Winner'),
	(226, 'en', 'Looser', 'Looser'),
	(227, 'en', 'WinnerPoint', 'Winner Point'),
	(228, 'en', 'LooserPoint', 'Looser Point'),
	(229, 'en', 'MyKz', 'My KZ records'),
	(230, 'en', 'AuthNickPassword', 'Username and password'),
	(231, 'en', 'AuthSteamId', 'Steam ID'),
	(232, 'en', 'AuthType', 'The type of authorization'),
	(233, 'en', 'Banned', 'You are banned!!!'),
	(234, 'en', 'TitleGameAcc', 'Game account'),
	(235, 'en', 'TitleSettings', 'Setting'),
	(236, 'en', 'TitlePersonalData', 'Personal Data'),
	(237, 'en', 'ICQ', 'ICQ'),
	(238, 'en', 'Avatar', 'Avatar'),
	(240, 'en', 'NoSteamLogin', 'Or fill out the form'),
	(241, 'en', 'setup', 'Setup config'),
	(242, 'en', 'Save', 'Save'),
	(243, 'en', 'Saved', 'Saved'),
	(244, 'en', 'Reset', 'Reset'),
	(245, 'en', 'ResetDef', 'Reset to default'),
	(246, 'en', 'Confirm', 'Confirmed action'),
	(247, 'en', 'timezone', 'Time zone'),
	(248, 'en', 'charset', 'Charset'),
	(249, 'en', 'mysql_user', 'User db'),
	(250, 'en', 'mysql_password', 'Password db'),
	(251, 'en', 'mysql_host', 'Host db'),
	(252, 'en', 'mysql_db', 'Database'),
	(253, 'en', 'mysql_prefix', 'Prefix db'),
	(254, 'en', 'activateTime', 'Activation time e-mail'),
	(255, 'en', 'baseUrl', 'Url site'),
	(256, 'en', 'gravatarSize', 'Avatar size'),
	(257, 'en', 'playerPerPage', 'Players per page'),
	(258, 'en', 'mapsPerPage', 'Maps per page'),
	(259, 'en', 'playersPerPage', 'Players per page KZ'),
	(260, 'en', 'list', 'Language list (space specarate)'),
	(261, 'en', 'lang', 'Language default'),
	(262, 'en', 'themelist', 'Theme list (space specarate)'),
	(263, 'en', 'theme', 'Theme default'),
	(264, 'en', 'cstheme', 'Theme default in CS'),
	(265, 'en', 'email', 'E-mail'),
	(266, 'en', 'cookieKey', 'Cookie Key'),
	(267, 'en', 'Generate', 'Generate'),
	(268, 'en', 'setupGeneral', 'General setting'),
	(269, 'en', 'setupDb', 'Database'),
	(270, 'en', 'setupLang', 'Language'),
	(271, 'en', 'DbTitle', 'Working with database'),
	(272, 'en', 'Base', 'DB'),
	(273, 'en', 'Tables', 'Tables'),
	(274, 'en', 'Data', 'Data'),
	(275, 'en', 'Create', 'Create'),
	(276, 'en', 'Delete', 'Delete'),
	(277, 'en', 'Clear', 'Clear'),
	(278, 'en', 'Edit', 'Edit'),
	(279, 'en', 'DbNotConnect', 'Not connection to database'),
	(280, 'en', 'DbNotTablesFile', 'File with tables not found'),
	(281, 'en', 'DbNotDataFile', 'File with data not found'),
	(282, 'en', 'Global', 'Global'),
	(283, 'en', 'Local', 'Local'),
	(284, 'en', 'Error', 'Error'),
	(285, 'en', 'Var', 'Variable'),
	(286, 'ru', 'Var', 'Переменная'),
	(287, 'en', 'Value', 'Value'),
	(288, 'ru', 'Value', 'Значение'),
	(289, 'en', 'kz_player', 'KZ Player'),
	(290, 'ru', 'kz_player', 'KZ Игрок'),
	(291, 'en', 'kz_map', 'Kz Map'),
	(292, 'ru', 'kz_map', 'KZ Карта'),
	(293, 'en', 'Total', 'Total'),
	(294, 'ru', 'Total', 'Всего'),
	(295, 'en', 'admin_players', 'Edit players'),
	(296, 'ru', 'admin_players', 'Редактировать игроков'),
	(297, 'en', 'error', 'Error'),
	(298, 'ru', 'error', 'Ошибка'),
	(299, 'en', 'Admin', 'Admin'),
	(300, 'ru', 'Admin', 'Админ'),
	(301, 'en', 'Active', 'Active'),
	(302, 'ru', 'Active', 'Активный'),
	(303, 'en', 'Yes', 'Yes'),
	(304, 'ru', 'Yes', 'Да'),
	(305, 'en', 'No', 'No'),
	(306, 'ru', 'No', 'Нет'),
	(307, 'en', 'NotAutorised', 'Not autorised'),
	(308, 'ru', 'NotAutorised', 'Пользователь не авторизован'),
	(309, 'en', 'AccessDenied', 'Access denied'),
	(310, 'ru', 'AccessDenied', 'Доспуп запещен'),
	(311, 'en', 'PagesNotFound', 'Pages Not Found'),
	(312, 'ru', 'PagesNotFound', 'Страница не существует'),
	(313, 'en', 'InternalServerError', 'Internal Server Error'),
	(314, 'ru', 'InternalServerError', 'Внутренняя ошибка сервера'),
	(315, 'en', 'Download', 'Download'),
	(316, 'ru', 'Download', 'Скачать'),
	(317, 'en', 'servers', 'Servers'),
	(318, 'ru', 'servers', 'Сервера'),
	(319, 'en', 'Welcome', 'Welcome to game server'),
	(320, 'ru', 'Welcome', 'Добро пожаловать на игровые сервера'),
	(321, 'en', 'achievPerPage', 'Lines in Achiev'),
	(322, 'ru', 'achievPerPage', 'Строк в Достижениях'),
	(323, 'en', 'Bots', 'Bots'),
	(324, 'ru', 'Bots', 'Боты'),
	(325, 'en', 'OS', 'OS'),
	(326, 'ru', 'OS', 'ОС'),
	(327, 'en', 'Descriptor', 'Descriptor'),
	(328, 'ru', 'Descriptor', 'Дескриптор'),
	(329, 'en', 'Mod', 'Mod'),
	(330, 'ru', 'Mod', 'Мод'),
	(331, 'en', 'Frags', 'Frags'),
	(332, 'ru', 'Frags', 'Очки'),
	(333, 'en', 'ServerNotFound', 'Server not found'),
	(334, 'ru', 'ServerNotFound', 'Сервер не найден'),
	(335, 'en', 'Check', 'Check'),
	(336, 'ru', 'Check', 'Проверить'),
	(337, 'en', 'Language', 'Language'),
	(338, 'ru', 'Language', 'Язык'),
	(339, 'en', 'admin_servers', 'Edit servers'),
	(340, 'ru', 'admin_servers', 'Изменить сервера'),
	(341, 'en', 'PlayerNotFound', 'Player not found'),
	(342, 'ru', 'PlayerNotFound', 'Игрок не найден'),
	(343, 'en', 'lastRecKZ', 'Last Records on Kreedz'),
	(344, 'ru', 'lastRecKZ', 'Последние рекорды на Kreedz'),
	(353, 'ru', 'auth', 'Войти'),
	(354, 'en', 'auth', 'Login'),
	(355, 'ru', 'Authorization', 'Авторизация'),
	(356, 'en', 'Authorization', 'Authorization'),
	(357, 'en', 'ourLastTime', 'Our Last Time'),
	(358, 'ru', 'ourLastTime', 'Последний заход'),
	(359, 'en', 'SharedOnline', 'Shared Online'),
	(360, 'ru', 'SharedOnline', 'Общий онлайн'),
	(363, 'en', 'WrongIP', 'Wrong IP'),
	(364, 'ru', 'WrongIP', 'Неправильный IP'),
	(365, 'en', 'WrongSteamId', 'Wrong Steam Id, e.g. STEAM_#:#:#..#'),
	(366, 'ru', 'WrongSteamId', 'Неправильный Steam Id, вид STEAM_#:#:#..#'),
	(367, 'en', 'WrongEmail', 'Wrong E-mail'),
	(368, 'ru', 'WrongEmail', 'Неправильный e-mail'),
	(369, 'en', 'regActivate', 'Activation link sent to your e-mail'),
	(370, 'ru', 'regActivate', 'Ссылка для активации отправлена на e-mail'),
	(371, 'en', 'ResetPassword', 'Reset Password'),
	(372, 'ru', 'ResetPassword', 'Произведен сброс пароля');
/*!40000 ALTER TABLE `langs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

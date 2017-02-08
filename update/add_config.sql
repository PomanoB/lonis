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

-- Дамп структуры для таблица lonis.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(3) unsigned NOT NULL,
  `var` varchar(32) NOT NULL,
  `value` varchar(128) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы lonis.config: ~17 rows (приблизительно)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `var`, `value`, `type`) VALUES
	(1, 'timezone', 'Europe/Moscow', 'text'),
	(2, 'charset', 'utf-8', 'text'),
	(3, 'server_name', '[K.lan] Counter-Strike', 'text'),
	(4, 'email', 'admin@klan-hub.ru', 'text'),
	(5, 'activateTime', '259200', 'number'),
	(6, 'playerPerPage', '15', 'number'),
	(7, 'mapsPerPage', '15', 'number'),
	(8, 'playersPerPage', '15', 'number'),
	(9, 'achievPerPage', '50', 'number'),
	(10, 'achievPlayersPerPage', '10', 'number'),
	(11, 'server_update', '1800', 'number'),
	(12, 'servers_autoupdate', '1', 'number'),
	(13, 'avatarSize_Icon', '24', 'number'),
	(14, 'avatarSize_Medium', '80', 'number'),
	(15, 'avatarSize_Full', '150', 'number'),
	(16, 'cookieKey', 'cc1f891423db1ee24498e76f3b107bbe', 'text'),
	(17, 'menuStart', 'home', 'text');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

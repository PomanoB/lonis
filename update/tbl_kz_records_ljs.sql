/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `kz_records_ljs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plname` varchar(32) NOT NULL,
  `distance` varchar(8) NOT NULL,
  `block` varchar(3) NOT NULL,
  `prestrafe` varchar(8) NOT NULL,
  `speed` varchar(8) NOT NULL,
  `type` varchar(8) NOT NULL,
  `country` varchar(2) NOT NULL,
  `comm` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `kz_records_ljs` DISABLE KEYS */;
INSERT INTO `kz_records_ljs` (`id`, `plname`, `distance`, `block`, `prestrafe`, `speed`, `type`, `country`, `comm`) VALUES
	(1, 'DeathClaw', '258.027', '257', '275.238', '343.053', 'lj', 'ru', 'kzru'),
	(2, 'Rub1', '257.489', '257', '275.81', '343.028', 'lj', 'ru', 'kzru'),
	(3, 'bEN', '257.249', '257', '274.714', '341.712', 'lj', 'ru', 'kzru'),
	(4, 'round', '257.536', '256', '275.177', '335.598', 'lj', 'ru', 'kzru'),
	(5, 'A4Tech', '256.864', '256', '275.866', '339.196', 'lj', 'ru', 'kzru'),
	(6, 'HhnDrop', '270.316', '269', '294.242', '355.402', 'cj', 'ru', 'kzru'),
	(7, 'mF^', '269.778', '269', '293.261', '354.010', 'cj', 'ru', 'kzru'),
	(8, 'showbrew', '269.489', '269', '293.671', '356.936', 'cj', 'ru', 'kzru'),
	(9, 'torrenz', '269.394', '268', '292.293', '357.395', 'cj', 'ru', 'kzru'),
	(10, 'aquatic', '268.379', '268', '292.483', '353.577', 'cj', 'ru', 'kzru'),
	(11, 'DeathClaw', '274.510', '273', '299.890', '364.562', 'dcj', 'ru', 'kzru'),
	(12, 'round', '273.631', '273', '299.507', '357.631', 'dcj', 'ru', 'kzru'),
	(13, 'mF^', '273.608', '273', '299.741', '362.325', 'dcj', 'ru', 'kzru'),
	(14, 'Laa', '273.509', '273', '298.899', '360.640', 'dcj', 'ru', 'kzru'),
	(15, 'trancer', '273.396', '273', '299.605', '362.092', 'dcj', 'ru', 'kzru'),
	(16, 'Risible Ripple', '255.547', '245', '273.985', '334.850', 'hj', 'ru', 'kzru'),
	(17, 'DeathClaw', '256.898', '244', '275.315', '341.298', 'hj', 'ru', 'kzru'),
	(18, 'aquatic', '256.455', '243', '272.775', '341.989', 'hj', 'ru', 'kzru'),
	(19, 'awaY', '256.032', '243', '274.422', '342.153', 'hj', 'ru', 'kzru'),
	(20, 'Womanaizer', '255.977', '243', '273.395', '340.665', 'hj', 'ru', 'kzru'),
	(21, 'akseon', '248.326', '248', '299.840', '356.076', 'bj', 'ru', 'kzru'),
	(22, 'trancer', '247.948', '247', '299.717', '355.898', 'bj', 'ru', 'kzru'),
	(23, 'SWAP1K', '247.733', '247', '299.199', '353.624', 'bj', 'ru', 'kzru'),
	(24, 'DeathClaw', '247.694', '247', '299.425', '356.921', 'bj', 'ru', 'kzru'),
	(25, 'dex7eR', '247.688', '247', '299.588', '354.038', 'bj', 'ru', 'kzru'),
	(26, 'DeathClaw', '258.027', '257', '275.238', '343.053', 'lj', 'ru', 'xj'),
	(27, 'kQbmig', '257.708', '257', '274.534', '343.306', 'lj', 'dn', 'xj'),
	(28, 'FreestyleR', '257.666', '257', '276.279', '339.929', 'lj', 'bg', 'xj'),
	(29, 'max3semne', '257.638', '257', '276.300', '337.376', 'lj', 'cz', 'xj'),
	(30, 'Laa', '257.494', '257', '275.866', '339.607', 'lj', 'ru', 'xj'),
	(31, 'fame', '271.252', '270', '293.246', '359.180', 'cj', 'ea', 'xj'),
	(32, 'chip', '270.515', '270', '293.733', '359.150', 'cj', 'sw', 'xj'),
	(33, 'Avatar', '270.495', '270', '295.173', '357.843', 'cj', 'at', 'xj'),
	(34, 'memek', '270.636', '269', '292.907', '356.630', 'cj', 'pl', 'xj'),
	(35, 'Beterok', '270.257', '269', '294.219', '361.129', 'cj', 'ea', 'xj'),
	(36, 'DeathClaw', '274.511', '273', '299.890', '364.562', 'dcj', 'ru', 'xj'),
	(37, 'max3semne', '274.051', '273', '299.299', '356.569', 'dcj', 'cz', 'xj'),
	(38, 'memek', '273.945', '273', '299.180', '362.095', 'dcj', 'pl', 'xj'),
	(39, 'mursux', '273.865', '273', '299.299', '357.922', 'dcj', 'fi', 'xj'),
	(40, 'PU9maker', '273.771', '273', '299.889', '356.877', 'dcj', 'cz', 'xj'),
	(41, 'max3semne', '257.810', '245', '275.403', '343.786', 'hj', 'cz', 'xj'),
	(42, 'Risible Ripple', '255.547', '245', '273.985', '334.850', 'hj', 'ru', 'xj'),
	(43, 'fame', '257.384', '244', '273.966', '339.182', 'hj', 'ea', 'xj'),
	(44, 'cr0ucher', '257.304', '244', '275.426', '341.151', 'hj', 'lt', 'xj'),
	(45, '2Dex', '257.218', '244', '275.199', '344.418', 'hj', 'bg', 'xj'),
	(46, 'Beterok', '248.759', '248', '299.885', '360.684', 'bj', 'uk', 'xj'),
	(47, 'akseon', '248.325', '248', '299.840', '356.076', 'bj', 'ru', 'xj'),
	(48, 'vLy', '248.130', '248', '299.654', '355.155', 'bj', 'cn', 'xj'),
	(49, 'lrs', '248.304', '247', '299.470', '356.408', 'bj', 'sw', 'xj'),
	(50, 'N1k1t1Ch^', '247.993', '247', '299.304', '355.006', 'bj', 'lv', '"xj"');
/*!40000 ALTER TABLE `kz_records_ljs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE `kz_map_tops1` (
	`id` INT(10) UNSIGNED NOT NULL,
	`map` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NOT NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL,
	`name` VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci',
	`wname` VARCHAR(16) NULL COLLATE 'utf8_general_ci',
	`dname` VARCHAR(32) NULL COLLATE 'utf8_general_ci',
	`ddot` INT(1) NULL,
	`dcolor` CHAR(16) NULL COLLATE 'utf8_general_ci',
	`download` TEXT NULL COLLATE 'utf8_general_ci',
	`type` VARCHAR(32) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `kz_map_tops1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_map_tops1` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`p`.`name` AS `name`,`w`.`wname` AS `wname`,`d`.`dname` AS `dname`,`d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor`,replace(`c`.`download`,'%map%',`m`.`mapname`) AS `download`,`m`.`type` AS `type` from ((((((`kz_map_top` `t` join `kz_map_top_min` on(((`t`.`map` = `kz_map_top_min`.`minmap`) and (`t`.`time` = `kz_map_top_min`.`mintime`)))) join `unr_players` `p` on((`p`.`id` = `t`.`player`))) left join `weapons` `w` on((`w`.`id` = `t`.`weapon`))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`))) left join `kz_comm` `c` on((`m`.`comm` = `c`.`name`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

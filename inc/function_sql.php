<?
/* FUNCTIONS SQL */

// Create Config Table
function createConfigTable($db, $conf_def, $conf_type) {
	mysqli_query($db, "DROP TABLE IF EXISTS `config`;");
	
	$q = "CREATE TABLE `config` (
				`id` INT(3) UNSIGNED NOT NULL,
				`var` VARCHAR(32) NOT NULL,
				`value` VARCHAR(128) NOT NULL,
				`type` VARCHAR(16) NOT NULL DEFAULT 'text'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
	mysqli_query($db, $q);
	
	$i=0;
	$q = "INSERT INTO `config` (`id`, `var`, `value`, `type`) VALUES ";
	foreach($conf_def as $var=>$value) {
		$i++;
		$q .= "({$i}, '{$var}', '{$value}', '{$conf_type[$var]}'),";
	}
	$q = substr($q, 0, strlen($q)-1).";";
	mysqli_query($db, $q);
}
	
// Get Config from DB
function getConfigVar($db) {
	$q = "SELECT * FROM `config`";
	$r = mysqli_query($db, $q);
	
	$config = array();
	while($row = mysqli_fetch_assoc($r)) {
		$config[$row['var']] = $row['value'];
	}
	
	return $config;
}

// Get Config from DB
function getConfigType($db) {
	$q = "SELECT * FROM `config`";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_assoc($r)) {
		$type[$row['var']] = $row['type'];
	}
	
	return $type;
}
	
// Get Menus from DB
function getMenus($db, $lang) {
	global $actionList;
	
	$q = "SELECT `l`.`value` as `name`, `action` FROM `menu` `m` LEFT JOIN `langs` `l` ON `action` = `var` 
			WHERE `admin` = 0 AND `lang`='{$lang}' AND `lvl` = 1 ORDER BY `num`";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_assoc($r)) {
		$row["url"] = $actionList[$row["action"]];
		$menu["normal"][] = $row;
	}

	$q = "SELECT `l`.`value` as `name`, `action` FROM `menu` `m` LEFT JOIN `langs` `l` ON `action` = `var` 
			WHERE `admin` = 1 AND `lang`='{$lang}' AND `lvl` = 1 ORDER BY `num`";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_assoc($r)) {
		$row["url"] = $actionList[$row["action"]];
		$menu["admin"][] = $row;
	}
	
	return $menu;
}

// Get Themes from DB
function getThemes($db, $lang) {
	global $theme, $cstheme;
	$q = "SELECT * FROM `themes` LEFT JOIN `themes_lang` ON `themes`.`id` = `themesid` WHERE `lang` = '{$lang}'";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1) $theme = $row['theme'];
		if($row['cs']==1) $cstheme = $row['theme'];
			
		$themeselect[$row['theme']] = $row["name"];
	}
	
	return $themeselect;
}

function getLang($db) {
	global $lang_def;
	
	$r = mysqli_query($db, "SELECT * FROM `lang` WHERE `use` = 1 ORDER BY `name` ");
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1)
			$lang_def = $row['lang'];
		
		$langselect[$row['lang']] = $row["name"];
	}
	
	return $langselect;
}

// Get Langs from DB
function getLangs($db, $lang) {
	$dblangs = array();
	$r = mysqli_query($db, "SELECT * FROM `langs` WHERE `lang`='{$lang}'");
	while($row = mysqli_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["value"];
	}
	
	return $dblangs;
}
	
// Get Player from DB
function getPlayer($db, $name, $id) {
	$name = slashes($name);
		
	$q = "SELECT * FROM `unr_players` WHERE `name` = '{$name}' OR `id` = {$id} ORDER BY `id` LIMIT 1";	
	$r = mysqli_query($db, $q);
	$player = mysqli_fetch_assoc($r);
	
	if(!isset($player)) {
		$player["id"] = $id;
		$player["name"] = $name;
	}
	
	$player["name_url"] = url_replace($player["name"]);
	
	return $player;
}

// Get GeoIP country_code from DB
function geoip($db, $ip, $lang) {
	if(isset($ip) && $ip!="") {
		$q = "SELECT `code`, `country_name` as `country` FROM
					(SELECT * FROM `geoip_whois` WHERE `ip_to` >= INET_ATON('{$ip}') ORDER BY `ip_to` ASC LIMIT 1) AS `cnt`,
					`geoip_locations`
				WHERE `code` = `country_iso_code` AND `locale_code` = '{$lang}'";
		return mysqli_fetch_assoc(mysqli_query($db, $q));
	}
	else 
		return 0;
}

?>
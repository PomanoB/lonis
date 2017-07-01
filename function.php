<?php

// CONFIG
// Mysql DB config
$dbconf_def = array (
	'mysql_host' => 'localhost',
	'mysql_user' => '',
	'mysql_password' => '',
	'mysql_db' => '',
	'mysql_prefix' => '',
	
);

// Default config
// achievAvatar: img, fa, gravatar;
// avatarD: 404, mm, identicon, monsterid, wavatar, retro, blank
$conf_def = array (
	'timezone' => 'Europe/Moscow',
	'charset' => 'utf-8',
	'server_name' => 'Server name',
	'server_email' => 'admin@site.ru',
	'cookieKey' => '',
	'style' => 'default',
	'csstyle' => 'default',
	'homepage' => 'home',
	'lang' => 'ru',
);

// Menu footer
$menu_footer = array(
	// 'icon name' => 'Username'
	'bug' => 'Jeronimo.',
	'aid-kit' => 'PomanoB'
);

$social = array(
	'steam2' => '',
	'vk' => '',
	'dice' => '',
	'skype' => '',
	'shield' => '',

);

// The sequence is important
$parseRules = array(
	"/^error\/([0-9]+)/" => "index.php?action=error&err=%1%",
	"/^setup\/(.*)/" => "index.php?action=setup&acts=%1%",
);

// FUNCTION 
// langs
function langs($var) {
	global $langs;
	
	if(!isset($langs[$var]))
		return $var;
	
	return $langs[$var];
}

// slashes
function slashes($str) {
	return get_magic_quotes_gpc() ? $str : addslashes($str);
}

// check $_GET, $_POST, $_SESSION
function get_request($var) {
	$var = isset($_GET[$var]) ? (isset($_POST[$var]) ? $_POST[$var] : $_GET[$var]) : "";
	return slashes($var);
}

// Parse URL. Exp: ##/##/## from array($rule, $url)
function parse_uri($uri, $rules) {
	$uris = explode("?", $uri);
	
	$ret = "";
	
	if(isset($uris[0])) {
		$ret =  parse_match($uris[0], $rules);
	}
	
	if(isset($uris[1]))
		$ret .= ($ret=="" ? "?" : "&").$uris[1];
	
	return $ret;
}

// Parse current matches
function parse_match($uri, $rules) {
	$uri = urldecode($uri);
	
	$match = array();
	$href = array();
	foreach($rules as $str=>$value) {
		preg_match_all($str, $uri, $matches);
		if(isset($matches[0][0][0])) {
			$match[] = $matches;
			$href[] = $value;
		}
	}

	if(isset($match[0]) && isset($href[0])) {
		foreach($match[0] as $key=>$v) {
			foreach($v as $value) {
				$rep = $value ? $value : "";
				$href[0] = str_replace("%$key%", $rep, $href[0]);
			}
		}
	}
	
	return isset($href[0]) ? $href[0] : "";
}

//Parse URI. Exp: key1=value1&key2=value2
function parse_urls($url) {
	$urls = parse_url($url);
	$urls["url"] = $url;
	
	$q = isset($urls["query"]) ? $urls["query"] : (isset($urls["path"]) ? $urls["path"] : "");
	if($q) {
		$ret_vars = explode("&", $q);
		foreach($ret_vars as $key=>$value) {
			if(isset($key)) {
				$pos = strpos($value, "=");
				$ret_delim[0] = substr($value, 0, $pos);
				$ret_delim[1] = substr($value, $pos+1, strlen($value));
				$rets[$ret_delim[0]] = isset($ret_delim[1]) ? $ret_delim[1] : "";
			}
		}

		$urls["uri"] = $rets;
	}
	else
		$urls["uri"] = array();
	
	return $urls;
}

// Time format ##:##.##
function timed($ftime, $pad=0) {
	if(!$ftime)
		return "";
	
	$min = floor($ftime/60);
	$sec = $ftime%60;
	$ms = $ftime * pow(10,$pad) % pow(10,$pad);
	if ($min < 10) $min = '0'.$min;
	if ($sec < 10) $sec = '0'.$sec;
	if ($ms < pow(10,$pad-1) && $ms!=0) $ms = '0'.$ms;
	$ms = str_pad($ms, $pad, '0');
	
	return $min.':'.$sec.'.'.$ms;
}

// Elasped time
function time_elasped($time) {
	$sec = $time%60;
	$mins = floor($time/60);
	$min = $mins%60;
	$hours = floor($mins/60);
	$hour = $hours%24;
	$days = floor($hours/24);
	$day = $days%365;
	$year = floor($days/365);
	
	$out = "{$year}y {$day}d {$hour}h {$min}m {$sec}s";
	
	return $out;
}

// Name of variable
function vname( &$var, $scope=false, $prefix="unique", $suffix="value") {
	$vals = $scope ? $scope : $GLOBALS;
	$old = $var;
	$var = $new = $prefix.rand().$suffix;
	$vname = FALSE;
	foreach($vals as $key => $val) {
		if($val === $new) $vname = $key;
	}
	$var = $old;
	return $vname;
}

// Print PRE
// Type: 0 - GET, POST; 1 - SERVER
function print_p($var="") {
	if($var!="") {
		echo "<p><pre>"; print_r($var); echo "</pre>";
	} 
	else {
		echo "<p><pre>_GET: "; print_r($_GET); echo "</pre>";
		echo "<p><pre>_POST: "; print_r($_POST); echo "</pre>";
	}
}

function br() {
	echo "<br>";
}

// Row to col massive
function row2col($var) {
	foreach($var as $key=>$value) {
		foreach($value as $name) {
			$ret[$name] = $key;
		}
	}
	return $ret;
}

// Save ini file
function save_ini_file(array $var, array $parent = array()) {
    $ret = '';
    foreach ($var as $key => $value) {
        if (is_array($value)) {
            $sec = array_merge((array) $parent, (array) $key);
            $ret .= '[".join('.',$sec)."]'.PHP_EOL;
            $ret .= save_ini_file($value, $sec);
        }
        else {
            $ret .= $key."=".$value.PHP_EOL;
        }
    }
    return $ret;
}

// Saved config file
function save_config_file($file, $conf) {
	$fp = fopen($file, 'w');
	$text = "";
	foreach($conf as $key=>$value) {
		$text .= $key." = '".$value."'\n";
	}
	fwrite($fp, $text);
	fclose($fp);
}

// Mysql from file
function mysql_query_file($file) {
	if(!$file = file($file)) return 1;
	
	$q_data = explode(";", implode("",$file));
	foreach($q_data as $value) {
		$r = mysqli_query($db, $value);
		if($r===false) return 2;
	}
	
	return $r;
}

// Sort massive
function action_sort($action) {
	$mass = explode("|", $action);
	rsort($mass);
	return implode("|", $mass);
}

// Menu
function parse_menu($menu) {
	$menu = explode("|", $menu);
	$i=-1;
	$ret = array();
	foreach($menu as $value) {
		if(isset($value))	 {
			$i++;
			$menux = explode("=", $value);
			if(isset($menux[1])) {
				$ret[$menux[0]] = $menux[1];
			}
			else {
				$ret[$i] = $menux[0];
			}
		}
	}
	
	return $ret;
}

// Mysql_result
function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}

// Mysql: LIMIT $start, $perpage
function mysqli_fetch_limit($r, $start, $perpage) {
	$i=0;
	$rows_limit = array();
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>($start+$perpage)) break;
		if($i>$start) $rows_limit[] = $rows;
	}
	
	return $rows_limit;
}

// Replace fake simbol
DEFINE ("BACK", 1);
function url_replace($str, $r = 0) {
	$list = array(
		"?" => "•",
		"#" => "○",
		"<" => "♂",
		">" => "♀",
		"*" => "∟",
		'"' => "↔",
		"|" => "▲",
		":" => "▼",
		"/" => "←",
		"_" => "↨",
		"+" => "§",
	);

	foreach($list as $key=>$value) {
		$str = $r==0 ? str_replace($key, $value, $str) : str_replace($value, $key, $str);
	}
	
	$str = ($r==0) ? urlencode($str) : urldecode($str);
	
	return $str;
}
			
// Generate pages
function generate_page($page, $all, $perpage) {
	$page = isset($page) ? abs((int)$page) : 1;
	$page = !$page ? 1 : $page;
	$total = ceil($all/$perpage);
	$page = ($page > $total) ? 1 : $page;
	$start = ($page - 1) * $perpage;
	
	return ["page"=>$page, "total"=>$total, "start"=>$start, "perpage"=>$perpage];
}

function mb_str_replace($needle, $replacement, $haystack) {
    $needle_len = mb_strlen($needle);
    $replacement_len = mb_strlen($replacement);
    $pos = mb_strpos($haystack, $needle);
    while($pos !== false) {
        $haystack = mb_substr($haystack, 0, $pos).$replacement.mb_substr($haystack, $pos + $needle_len);
        $pos = mb_strpos($haystack, $needle, $pos + $replacement_len);
    }
    return $haystack;
}

// FUNCTION SQL

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
function getMenus($db, $parent = "") {
	global $langs;
	$menu = array();
	
	$where = $parent ? "AND `parent` = '{$parent}'" : "";
	
	$q = "SELECT * FROM `menu` {$where} WHERE `mname` <> '' ORDER BY `num`";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_assoc($r)) {
		$row["name"] = 	isset($langs[$row["mname"]]) ? $langs[$row["mname"]] : $row["mname"];
		$row["url"] = "/".str_replace("_", "/", $row["action"])."/";
		$menu[$row["parent"]][$row["action"]] = $row;
	}
	
	return $menu;
}

function getMenuParent($db, $action) {
	$r = mysqli_query($db, "SELECT `parent` FROM `menu` WHERE `action`='{$action}' AND `parent` <> 'main'");
	return mysqli_result($r, 0);
}

// Get styles from DB
function getstyles($db, $lang) {
	global $style;
	$styles = array();
	
	$q = "SELECT * FROM `styles` LEFT JOIN `styles_lang` ON stylesid = styles.id WHERE lang='{$lang}'";
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1) $style = $row['style'];
			
		$styles[] = $row;
	}
	
	return $styles;
}

function getLang($db) {
	global $lang_def;
	$langs = array();
	
	$r = mysqli_query($db, "SELECT * FROM `lang` WHERE `use` = 1 ORDER BY `lang` ");
	while($row = mysqli_fetch_array($r)) {
		if($row['default']==1)
			$lang_def = $row['lang'];
		
		$langs[] = $row;
	}
	
	return $langs;
}

// Get Langs from DB
function getLangs($db, $lang) {
	$dblangs = array();
	$r = mysqli_query($db, "SELECT var FROM `langs` GROUP BY var");
	while($row = mysqli_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["var"];
	}
	
	$r = mysqli_query($db, "SELECT * FROM `langs` WHERE `lang`='{$lang}'");
	while($row = mysqli_fetch_array($r)) {
		$dblangs[$row["var"]] = $row["value"];
	}
	
	return $dblangs;
}

// Get GeoIP country_code from DB
function geoip($db, $ip, $lang) {
	if(isset($ip) && $ip!="") {
		$q = "SELECT `code`, `country_name` as `country` FROM
					(SELECT * FROM `geoip_whois` WHERE `ip_from` <= INET_ATON('{$ip}') ORDER BY `ip_from` DESC LIMIT 1) AS `cnt`,
					`geoip_locations`
				WHERE `code` = `country_iso_code` AND `locale_code` = '{$lang}'";
		return mysqli_fetch_assoc(mysqli_query($db, $q));
	}
	else 
		return 0;
}

// FUNCTION
// SteamId64 to SteamId (bc)
function bc_getSteamId($steamId64) {
	$iServer = bcmod($$steamId64, "2")=="0" ? 0 : 1;
	$steamId = bcsub($steamId64, $iServer);
	$steamId = (bccomp("76561197960265728",$steamId) == -1) ? bcsub($steamId,"76561197960265728") : $steamId;
	$steamId = bcdiv($steamId, "2");
	return ("STEAM_0:".$iServer.":" .$steamId);
}

// SteamId64 to STEAM_0:0:00000000
function getSteamId($steamId64) {
	return "STEAM_".((($steamId64 >> 56) & 0xFF)==1 ? 0 : 1).":".($steamId64 & 1).":".(($steamId64 >> 1) & 0x7FFFFFF);
}

// STEAM_0:0:00000000 to SteamId64
function getSteamId64($steamId) {
	if(strpos($steamId, "STEAM_0:") === false)
		return 0;
	
	$bit = explode(":", str_replace("STEAM_0:", "", $steamId));
	
	if(isset($bit[0]) && isset($bit[1]))
		return (76561197960265728 + $bit[0] + $bit[1]*2);	
	
	return 0;
}

// Avatar: Folder or gravatar.com or Steam
function getAvatar($id, $steam_id_64, $email, $size) {
	global $conf, $docRoot, $theme, $bTheme;
	
	$gravatar = "http://gravatar.com/avatar/".md5($email)."?d={$conf["avatarD"]}&s={$conf[$size]}";
	$dir = "$docRoot/themes/$theme/img/players/$size/";
	if(!file_exists($dir)) mkdir($dir, 0700);
	
	$file = "$dir/$id.jpg";
	$aurl = "$bTheme/img/players/avatarfull/$id.jpg";
	if(!file_exists($file)) {
		$steamInfo = getSteamInfo($steam_id_64);
		$avatarp = $steamInfo!=0 ? $steamInfo[$size] : $gravatar;
		file_put_contents($file, file_get_contents($avatarp));
	}
}
			
// Get steam_info
function getSteamInfoOld($steamId64, $key) {
	$steamProfile = "http://steamcommunity.com/profiles/{$steamId64}/?xml=1";
	$str = file_get_contents($steamProfile);

	$str = str_replace("<![CDATA[", "", $str);
	$str = str_replace("]]>", "", $str);
	
	$str = explode("<{$key}>", $str);
	$str = isset($str[1]) ? $str[1] : $str[0] ;
	$str = explode("</{$key}>", $str);
	$str = isset($str[0]) ? $str[0] : "";
	
	return $str;
}

function getSteamInfo($steamId64) {
	global $steamAPI;
	
	$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$steamAPI}&steamids={$steamId64}";
	$json_object= file_get_contents($url);
	$json_user = json_decode($json_object, true);
	
	return isset($json_user["response"]["players"][0]) ? $json_user["response"]["players"][0] : 0;
}

?>
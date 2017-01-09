<?php
/*---------------------------------------------------------------------------------------------*
	Function
*---------------------------------------------------------------------------------------------*/

// assign smarty or ...
function assign($name, $var = "") {
	global $smarty;
	
	if($var=="" && isset($$name))
		$var = $$name;

	$smarty->assign($name, $var);
}

// slashes
function slashes($str) {
	return get_magic_quotes_gpc() ? $str : addslashes($str);
}

// check $_GET, $_POST, $_SESSION
function get_request($var) {
	return $act = isset($_GET["act"]) ? (isset($_POST["act"]) ? $_POST["act"] : $_GET["act"]) : "";
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
	$min = floor($ftime/60);
	$sec = $ftime%60;
	$ms = $ftime * pow(10,$pad) % pow(10,$pad);
	if ($min < 10) $min = '0'.$min;
	if ($sec < 10) $sec = '0'.$sec;
	$ms = str_pad($ms, $pad, '0');
	if ($ms < pow(10,$pad-1) && $ms!=0) $ms = '0'.$ms;
	

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
function save_config_file($file) {
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

// Replace fake simbol
DEFINE ("BACK", 1);
function url_replace($str, $r = 0) {
	$list = array(
		"?" => "•",
		"#" => "○",
		"<" => "♂",
		">" => "♀",
	);

	foreach($list as $key=>$value) {
		$str = $r==0 ? str_replace($key, $value, $str) : str_replace($value, $key, $str);
	}
	
	$str = ($r==0) ? urlencode($str) : urldecode($str);
	
	return $str;
}

// SteamId64 to SteamId (bc)
function bcGetAuthID($steamId64) {
	$iServer = bcmod($$steamId64, "2")=="0" ? 0 : 1;
	$steamId = bcsub($steamId64, $iServer);
	$steamId = (bccomp("76561197960265728",$steamId) == -1) ? bcsub($steamId,"76561197960265728") : $steamId;
	$steamId = bcdiv($steamId, "2");
	return ("STEAM_0:".$iServer.":" .$steamId);
}

// SteamId64 to STEAM_0:0:00000000
function GetAuthID($steamId64) {
	return "STEAM_".((($steamId64 >> 56) & 0xFF)==1 ? 0 : 1).":".($steamId64 & 1).":".(($steamId64 >> 1) & 0x7FFFFFF);
}

// STEAM_0:0:00000000 to SteamId64
function GetAuthID64($steamId) {
	if(strpos("STEAM_0:", $steamId) === false)
		return 0;
	
	$bit = explode(":", str_replace("STEAM_0:", "", $steamId));
	
	if(isset($bit[0]) && isset($bit[1]))
		return (76561197960265728 + $bit[0] + $bit[1]*2);	
	
	return 0;
}

// Steam info from: http://steamcommunity.com/profiles/{$steamId64}/?xml=1
function get_steam_info($data, $key) {
	$p1 = strpos($data, "<{$key}><![CDATA[") + strlen("<{$key}><![CDATA[");
	$p2 = strpos($data, "]]></{$key}>");
	
	return substr($data, $p1, $p2 - $p1);
}

// Generate massive pages
function generate_page($page, $total, $perpage) {
	$page = isset($page) ? abs((int)$page) : 1;
	$page = !$page ? 1 : $page;
	$totalPages = ceil($total/$perpage);	
	$page = ($page > $totalPages) ? 1 : $page;
	$start = ($page - 1) * $perpage;
	
	$pages["page"] = $page;
	$pages["totalPages"] = $totalPages;
	$pages["start"] = $start;
	$pages["perpage"] = $perpage;
	$pages["end"] = $start + $perpage;
	
	return $pages;
}
?>
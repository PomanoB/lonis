<?php
/*---------------------------------------------------------------------------------------------*
	Function
*---------------------------------------------------------------------------------------------*/

// check $_GET, $_POST, $_SESSION
function get_request($var) {
	return $act = isset($_GET["act"]) ? (isset($_POST["act"]) ? $_POST["act"] : $_GET["act"]) : "";
}

// Parse URL. Exp: ##/##/## from array($rule, $url)
function parse_uri($uri, $rules) {
	$uri = urldecode($uri);
	$uris = parse_url($uri);
	
	$ret = "";
	if(isset($uris["path"])) {
		foreach($rules as $str=>$value) {
			preg_match_all($str, $uris["path"], $matches);
			if(isset($matches[0][0])) {		
				foreach($matches as $key=>$v) {
					$rep = $v[0] ? $v[0] : "";
					$value = str_replace("%$key%", $rep, $value);
				}
				$ret_uri[] = $value;
			}
		}
		$ret = $ret_uri[0];
	}
	
	if(isset($uris["query"]))
		$ret .= "&".$uris["query"];
	
	return $ret;
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
				$ret_delim = explode("=", $value);
				$rets[$ret_delim[0]] = isset($ret_delim[1]) ? $ret_delim[1] : "";
			}
		}

		$urls["uri"] = $rets;
	}
	else
		$urls["uri"] = array();
	
	return $urls;
}

// Connect to db
function db_connect($host, $user, $password, $db, $charset) {
	if (!mysql_connect($host, $user, $password)) return 0;
	if (!mysql_select_db($db)) return 0;
	if (!mysql_fetch_assoc(mysql_query("show tables"))) return 0;
	
	mysql_query("SET NAMES ".$charset);
	return 1;
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

function save_config_file($file) {
	$fp = fopen($file, 'w');
	$text = "";
	foreach($conf as $key=>$value) {
		$text .= $key." = '".$value."'\n";
	}
	fwrite($fp, $text);
	fclose($fp);
}

function mysql_query_file($file) {
	if(!$file = file($file)) return 1;
	
	$q_data = explode(";", implode("",$file));
	foreach($q_data as $value) {
		$r = mysql_query($value);
		if($r===false) return 2;
	}
	
	return $r;
}
?>
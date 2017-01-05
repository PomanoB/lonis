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
	$uris = explode("?", $uri);
	
	$ret = "";
	if(isset($uris[0]))
		$ret =  parse_match($uris[0], $rules);
	
	if(isset($uris[1]))
		$ret .= ($ret=="" ? "?" : "&").$uris[1];
	
	return $ret;
}

// Parse current matches
function parse_match($uri, $rules) {
	$uri = urldecode($uri);
	
	foreach($rules as $str=>$value) {
		preg_match_all($str, $uri, $matches);
		if(isset($matches[0][0][0])) {
			$match[] = $matches;
			$href[] = $value;
		}
	}
	
	foreach($match[0] as $key=>$v) {
		foreach($v as $value) {
			$rep = $value ? $value : "";
			$href[0] = str_replace("%$key%", $rep, $href[0]);
		}
	}
	
	return $href[0];
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
		$r = mysqli_query($db, $value);
		if($r===false) return 2;
	}
	
	return $r;
}

function action_sort($action) {
	$mass = explode("|", $action);
	rsort($mass);
	return implode("|", $mass);
}

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

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}

DEFINE ("BACK", 1);
function url_replace($str, $r = 0) {
	$list1 = "?|#";
	$list2 = "•|○";
	
	$list = $r==0 ? $list1 : $list2;
	$listr = $r==0 ? $list2 : $list1;
	
	$list = explode("|", $list);
	$listr = explode("|", $listr);

	foreach($list as $key=>$value) {
		$str = str_replace($value, $listr[$key], $str);
	}
	
	return $str;
}

?>
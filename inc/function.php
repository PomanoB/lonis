<?php
/*---------------------------------------------------------------------------------------------*
	Function
*---------------------------------------------------------------------------------------------*/

// check $_GET, $_POST, $_SESSION
function get_request($var) {
	return $act = isset($_GET['act']) ? (isset($_POST['act']) ? $_POST['act'] : $_GET['act']) : "";
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
function print_p($var="") {
	if(isset($var)) {
		echo "<p><pre>"; print_r($var); echo "</pre>";
	} 
	else {
		echo "<p><pre>"; print_r($_GET); echo "</pre>";
		echo "<p><pre>"; print_r($_POST); echo "</pre>";
		echo "<p><pre>"; print_r($_SERVER); echo "</pre>";
	}
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
            $ret .= '['.join('.',$sec).']'.PHP_EOL;
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
?>
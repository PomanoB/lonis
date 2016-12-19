<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	
// Get languages
$r = mysql_query("SELECT `lang` FROM `lang` GROUP BY `lang` ORDER BY `lang`");
while($row = mysql_fetch_array($r)) {
	$lang_list[] = $row["lang"];
}

$smarty->assign('lang_list', $lang_list);


if ($act == "add") {
	//$langa = get_magic_quotes_gpc() ? $_POST["langa"] : addslashes($_POST["langa"]);
	$langkey = get_magic_quotes_gpc() ? $_POST["langx"] : addslashes($_POST["langx"]);
	$var = get_magic_quotes_gpc() ? $_POST["var"] : addslashes($_POST["var"]);
	$value = get_magic_quotes_gpc() ? $_POST["value"] : addslashes($_POST["value"]);
	
	//$langkey = $langa ? $langa : $langx;
	if($langkey && $var && $value) {
		$q = "INSERT INTO `lang` (`lang`, `var`, `value`) VALUES ";
		foreach($lang_list as $key=>$v) {
			$delim = $key==(count($lang_list)-1) ? "" : ",";
			$q .= "('$v', '$var', '')".$delim;
		};
		mysql_query($q);
		
		$q = "UPDATE `lang` SET `value` = '$value' WHERE `lang` = '$langkey' AND `var` = '$var'";
		mysql_query($q);	
	}
	else
		$smarty->assign('message', $langs["langError"]);
}
else
if ($act == "edit") {
	$var = get_magic_quotes_gpc() ? $_POST["var"] : addslashes($_POST["var"]);	
	
	foreach($_POST as $key=>$value) {
		if(strpos("_$key", $var)) {
			$langkey = str_replace($var."_", "", $key);
			$value = get_magic_quotes_gpc() ? $value : addslashes($value);
				$q = "UPDATE `lang` SET `value` = '$value' WHERE `lang` = '$langkey' AND `var` = '$var'";
				mysql_query($q);
		
		}
	}
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$var = get_magic_quotes_gpc() ? $_POST["var"] : addslashes($_POST["var"]);	
		$q = "DELETE FROM `lang` WHERE `var` = '$var'";
		mysql_query($q);
	}
	else {
		$message = "<script>alert('".$langs["langConfirm"]."');</script>";
		$smarty->assign('confirm_msg', $message);
	}
}

// Get language list
$r = mysql_query("SELECT * FROM `lang` ORDER BY `lang`");
while($row = mysql_fetch_array($r)) {
	$dblangs[$row["lang"]][$row["var"]] = $row["value"];
}	

foreach ($dblangs as $l => $arr) {
	foreach ($arr as $name => $value) {
		$row[$name][$l] = $value;
	}
}

$smarty->assign('lang_row', $row);
		
		
?>
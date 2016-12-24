<?php
if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	
// Get languages
$r = mysqli_query($db, "SELECT `lang` FROM `langs` GROUP BY `lang` ORDER BY `lang`");
while($row = mysqli_fetch_array($r)) {
	$lang_list[] = $row["lang"];
}

$smarty->assign('lang_list', $lang_list);

if ($act == "add") {
	$langkey = get_magic_quotes_gpc() ? $_POST["langx"] : addslashes($_POST["langx"]);
	$var = get_magic_quotes_gpc() ? $_POST["var"] : addslashes($_POST["var"]);
	$value = get_magic_quotes_gpc() ? $_POST["value"] : addslashes($_POST["value"]);
	
	if($langkey && $var && $value) {
		$q = "INSERT INTO `langs` (`lang`, `var`, `value`) VALUES ";
		foreach($lang_list as $key=>$v) {
			$delim = $key==(count($lang_list)-1) ? "" : ",";
			$q .= "('$v', '$var', '')".$delim;
		};
		mysqli_query($db, $q);
		
		$q = "UPDATE `langs` SET `value` = '$value' WHERE `lang` = '$langkey' AND `var` = '$var'";
		mysqli_query($db, $q);	
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
				$q = "UPDATE `langs` SET `value` = '$value' WHERE `lang` = '$langkey' AND `var` = '$var'";
				mysqli_query($db, $q);
		
		}
	}
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$var = get_magic_quotes_gpc() ? $_POST["var"] : addslashes($_POST["var"]);	
		$q = "DELETE FROM `langs` WHERE `var` = '$var'";
		mysqli_query($db, $q);
	}
	else {
		$message = "<script>alert('".$langs["langConfirm"]."');</script>";
		$smarty->assign('confirm_msg', $message);
	}
}

// Get language list
$r = mysqli_query($db, "SELECT * FROM `langs` ORDER BY `lang`");
while($row = mysqli_fetch_array($r)) {
	$dblangs[$row["lang"]][$row["var"]] = $row["value"];
}	

foreach ($dblangs as $l => $arr) {
	foreach ($arr as $name => $value) {
		$row[$name][$l] = $value;
	}
}

$smarty->assign('lang_row', $row);	
?>
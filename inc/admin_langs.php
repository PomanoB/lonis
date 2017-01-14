<?php


if (!(isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1)) {
	header('Location: '.$baseUrl);
}

$act = isset($_POST["act"]) ? $_POST["act"] : "";	
// Get languages
$r = mysqli_query($db, "SELECT `lang` FROM `langs` GROUP BY `lang` ORDER BY `lang`");
while($row = mysqli_fetch_assoc($r)) {
	$lang_list[] = $row["lang"];
}

assign('lang_list', $lang_list);

if ($act == "add") {
	$langkey = slashes($_POST["langx"]);
	$var = slashes($_POST["var"]);
	$value = slashes($_POST["value"]);
	
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
		$message = $langs["Error"];
}
else
if ($act == "edit") {
	$var = slashes($_POST["var"]);	
	
	foreach($_POST as $key=>$value) {
		if(strpos("_$key", $var)) {
			$langkey = str_replace($var."_", "", $key);
			$value = slashes($value);
				$q = "UPDATE `langs` SET `value` = '$value' WHERE `lang` = '$langkey' AND `var` = '$var'";
				mysqli_query($db, $q);
		
		}
	}
}
else
if ($act == "delete") {
	if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
		$var = slashes($_POST["var"]);	
		$q = "DELETE FROM `langs` WHERE `var` = '$var'";
		mysqli_query($db, $q);
	}
	else {
		$message = "<script>alert('".$langs["Confirm"]."');</script>";
		assign('confirm_msg', $message);
	}
}

assign('message', $message);

// Get language list
$r = mysqli_query($db, "SELECT * FROM `langs` ORDER BY `lang`, `id` DESC");
while($row = mysqli_fetch_assoc($r)) {
	$langslist[$row["lang"]][$row["var"]] = $row["value"];
}	

foreach ($langslist as $l => $arr) {
	foreach ($arr as $name => $value) {
		$row[$name][$l] = $value;
	}
}

assign('lang_row', $row);	
?>
<?php


$acts = isset($_GET["acts"]) ? $_GET["acts"] : "";
$act = isset($_POST["act"]) ? $_POST["act"] : "";

if ($acts == "logout") {
	unset($_SESSION["setting_user"]);
	header("Location: $baseUrl/setup/");
}
else
if (isset($_POST["setting_user"]) && isset($_POST["setting_password"])) {
	$setting_user = slashes($_POST["setting_user"]);
	$setting_password = slashes($_POST["setting_password"]);
	
	if($setting_user==$mysql_user && $setting_password==$mysql_password) {
		$_SESSION["setting_user"] = $setting_user;
		header("Location: $baseUrl/setup/");
	}
	else {
		$message = $langs["UserNotFound"];
	}
}
else 
if (isset($_SESSION["setting_user"])) {
	assign('act', $act);
	echo $act;
	if($act=="genkey") {
		$conf["cookieKey"] = md5($conf["mysql_user"].time()."abracadabra");
	}
		
	if($act=="save") {
		$user = $_POST["fld_mysql_user"];
		$password = $_POST["fld_mysql_password"];
		
		foreach($_POST as $key=>$value) {
			if($_POST[$key]=="") {
				$key = str_replace("fld_", "", $key);
				$fld_err[$key] = 1;
			}
		}
		
		if ($user && $password) {
			$fp = fopen($config_dir.'/'.$config_file, 'w');
			$text = "";
			foreach($_POST as $key=>$value) {
				$key = str_replace("fld_", "", $key);
				if(isset($conf[$key])) {
					$text .= $key." = '".$value."'\n";
					$conf[$key]=$value;
					$$key = $value;
				}
			}
			fwrite($fp, $text);
			fclose($fp);
			
			$message = $langs["Saved"];
		}
	}
	else
	if($act=="reset") {
		unset($_SESSION["setting_user"]);
		unlink($docRoot."/config.ini");
		
		header("Location: $baseUrl/setup/");
	}
	
	foreach($dbconf as $name=>$value) {
		if(!isset($input_type[$name])) $input_type[$name] = "text";
		$conflist[$name]["type"] = $input_type[$name];
		$conflist[$name]["err"] = isset($fld_err[$name]) ? 1 : 0;
		$conflist[$name]["name"] = $name;
		$conflist[$name]["desc"] = $langs["$name"];
		$conflist[$name]["text"] = $input_type[$name]!="password" ?  $value : "";
	}
	assign('conflist', $conflist);
	
	$check_confirm = check_confirm($mysql_password);
	assign('check_confirm', $check_confirm);
	assign('act', $act);
	
	$db = @mysqli_connect($mysql_host, $mysql_user, $mysql_password);
	$conn = mysqli_connect_errno($db);
	assign('conn', $conn);
	assign('mysql_db', $mysql_db);
	
	if(!$conn) {
		$base = mysqli_select_db($db, $mysql_db);
		if($base) {
			if($act=="dbadd") {
				mysqli_query($db, "create database ".$mysql_db);
				header("Location: $baseUrl/setup/#db");
			}			
		}
		else {
			if($act=="dbdelete") {
				if($check_confirm) {
					mysqli_query($db, "drop database ".$mysql_db);
					header("Location: $baseUrl/setup/#db");
				}
			}
			
			mysqli_query($db, "SET NAMES ".$charset);
		
		} 
		assign('base', $base);
	} 	
}

assign('message', $message);
				
/* ----- Function ----- */
function check_confirm($mysql_password) {
	return (isset($_POST["confirm_password"]) && $_POST["confirm_password"]==$mysql_password) ? 1 : 0;
}
?>
<?php
$message = $resetmessage = $dbmessage = "";

$act = isset($_POST["act"]) ? $_POST["act"] : "";
$acts = isset($_GET["acts"]) ? $_GET["acts"] : "";
	
if ($acts == "logout") {
	unset($_SESSION["setting_user"]);
	header("Location: $baseUrl/setup");
}
else
if (isset($_POST["setting_user"]) && isset($_POST["setting_password"])) {
	$setting_user = slashes($_POST["setting_user"]);
	$setting_password = slashes($_POST["setting_password"]);
	
	if($setting_user==$mysql_user && $setting_password==$mysql_password) {
		$_SESSION["setting_user"] = $setting_user;
		header("Location: $baseUrl/setup");
	}
	else {
		$message = $langs["UserNotFound"];
	}
}
else {
	if (isset($_SESSION["setting_user"])) {
		assign('act', $act);
		
		/* General setting */
		if($act=="genkey") {
			$conf["cookieKey"] = md5($conf["mysql_user"].time()."abracadabra");
		}
		else
		if($act=="save") {
			$user = $_POST["fld_mysql_user"];
			$password = $_POST["fld_mysql_password"];
			
			if (!$user) $errors[] = $langs["NotInputNick"];	
			if (!$password) $errors[] = $langs["NotInputPassword"];
			
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
			else {
				$message = $langs["NotInput"];
			}
		}
		else
		if($act=="reset") {
			//if(isset($_POST["comfirm"]) && $_POST["comfirm"]==1) {
			if($check_confirm = check_comfirm($mysql_password)) {
				unset($_SESSION["setting_user"]);
				
				header("Location: $baseUrl/setup");
			}
			else {
				$resetmessage = $langs["Confirm"];
			}
		}
		
		$input_type = row2col($conf_type);
		
		foreach($conf as $name=>$value) {
			if(!isset($input_type[$name])) $input_type[$name] = "text";
			$conflist[$name]["type"] = $input_type[$name];
			$conflist[$name]["err"] = isset($fld_err[$name]) ? 1 : 0;
			$conflist[$name]["name"] = "fld_".$name;
			$conflist[$name]["desc"] = $langs["$name"];
			$conflist[$name]["text"] = $input_type[$name]!="password" ?  $value : "";
		}
		assign('conflist', $conflist);
		
		/* Database */
		$check_confirm = check_comfirm($mysql_password);
		assign('check_confirm', $check_confirm);
		assign('act', $act);
		
		if($db = mysqli_connect($mysql_host, $mysql_user, $mysql_password)) {
			assign('comm', $db);
			assign('mysql_db', $mysql_db);
			
			$base = mysqli_select_db($db, $mysql_db);
			if(!$base) {
				if($act=="dbadd") {
					mysqli_query($db, "create database ".$mysql_db);
					header("Location: $baseUrl/setup#db");
				}			
			}
			else {
				if($act=="dbdelete") {
					if($check_confirm) {
						mysqli_query($db, "drop database ".$mysql_db);
						header("Location: $baseUrl/setup#db");
					}
					
				}
				
				mysqli_query($db, "SET NAMES ".$charset);
				
				$file = $config_dir.'/db_tables.sql';
				if($file_table = file_exists($file)) {
					if(!($tbl =  mysqli_fetch_assoc(mysqli_query($db, "show tables")))) {
						if($act=="tbladd") {
							$r = mysql_query_file($file);
							$r = mysql_query_file($file);
							if(isset($r))
								assign('dbmessage', $langs["Error"]);
							else
								header("Location: $baseUrl/setup");
							
						}
						assign('tbl', 0);
					}
					else {
						$tables = "";
						$file_data = 0;
						$file_data_lang = 0;
						
						if($act=="dataadd") {
							$file = $config_dir.'/db_data.sql';
							$file_data = mysql_query_file($file);
							
							$file_lang = $config_dir.'/db_data_lang.sql';
							$file_data_lang = mysql_query_file($file);
							if($file_data || $file_data_lang)
								$dbmessage = $langs["Error"];
							else
								header("Location: $baseUrl/setup");
						}

						assign('tables', $tables);
						assign('file_data', $file_data && $file_data_lang);						
						assign('tbl', 1);
					} // End
				} // End tables
				assign('file_table', $file_table);
			} //End db
			assign('db', $db);
		} // End conn	
				
	} // End setting
} // End login, logout

assign('message', $message);
assign('resetmessage', $resetmessage);
assign('dbmessage', $dbmessage);
				
/* ----- Function ----- */
function check_comfirm($mysql_password) {
	return (isset($_POST["confirm_password"]) && $_POST["confirm_password"]==$mysql_password) ? 1 : 0;
}
?>
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
	if (get_magic_quotes_gpc())
	{
		$setting_user = $_POST["setting_user"];
		$setting_password = $_POST["setting_password"];
	}
	else
	{
		$setting_user = addslashes($_POST["setting_user"]);
		$setting_password = addslashes($_POST["setting_password"]);
	}
	
	if($setting_user==$mysql_user && $setting_password==$mysql_password) {
		$_SESSION["setting_user"] = $setting_user;
		header("Location: $baseUrl/setup");
	}
	else {
		$message = $langs["langUserNotFound"];
	}
}
else {
	if (isset($_SESSION["setting_user"])) {
		$smarty->assign('act', $act);
		
		/* General setting */
		if($act=="genkey") {
			$conf["cookieKey"] = md5($conf["mysql_user"].time()."abracadabra");
		}
		else
		if($act=="save") {
			$user = $_POST["fld_mysql_user"];
			$password = $_POST["fld_mysql_password"];
			
			if (!$user) $errors[] = $langs["langNotInputNick"];	
			if (!$password) $errors[] = $langs["langNotInputPassword"];
			
			foreach($_POST as $key=>$value) {
				if($_POST[$key]=="") {
					$key = str_replace("fld_", "", $key);
					$fld_err[$key] = 1;
				}
			}
			
			if ($user && $password) {
				$fp = fopen($config_dir[0].'/'.$config_file, 'w');
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
				
				$message = $langs["langSaved"];
			}
			else {
				$message = $langs["langNotInput"];
			}
		}
		else
		if($act=="reset") {
			//if(isset($_POST["comfirm"]) && $_POST["comfirm"]==1) {
			if($check_confirm = check_comfirm($mysql_password)) {
				unset($_SESSION["setting_user"]);
				unlink($config_dir.'/'.$config_file);
				header("Location: $baseUrl/setup");
			}
			else {
				$resetmessage = $langs["langConfirm"];
			}
		}
		
		$input_type = row2col($conf_type);
		
		foreach($conf as $name=>$value) {
			if(!isset($input_type[$name])) $input_type[$name] = "text";
			$conflist[$name]["type"] = $input_type[$name];
			$conflist[$name]["err"] = isset($fld_err[$name]) ? 1 : 0;
			$conflist[$name]["name"] = "fld_".$name;
			$conflist[$name]["desc"] = $langs["lang_$name"];
			$conflist[$name]["text"] = $input_type[$name]!="password" ?  $value : "";
		}
		$smarty->assign('conflist', $conflist);
		
		/* Database */
		$check_confirm = check_comfirm($mysql_password);
		$smarty->assign('check_confirm', $check_confirm);
		$smarty->assign('act', $act);
		
		if($db = mysqli_connect($mysql_host, $mysql_user, $mysql_password)) {
			$smarty->assign('comm', $db);
			$smarty->assign('mysql_db', $mysql_db);
			
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
				
				$file = $config_dir[0].'/db_tables.sql';
				if($file_table = file_exists($file)) {
					if(!($tbl =  mysqli_fetch_assoc(mysqli_query($db, "show tables")))) {
						if($act=="tbladd") {
							$r = mysql_query_file($file);
							$r = mysql_query_file($file);
							if(isset($r))
								$smarty->assign('dbmessage', $langs["langError"]);
							else
								header("Location: $baseUrl/setup");
							
						}
						$smarty->assign('tbl', 0);
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
								$dbmessage = $langs["langError"];
							else
								header("Location: $baseUrl/setup");
						}

						$smarty->assign('tables', $tables);
						$smarty->assign('file_data', $file_data && $file_data_lang);						
						$smarty->assign('tbl', 1);
					} // End
				} // End tables
				$smarty->assign('file_table', $file_table);
			} //End db
			$smarty->assign('db', $db);
		} // End conn	
				
	} // End setting
} // End login, logout

$smarty->assign('message', $message);
$smarty->assign('resetmessage', $resetmessage);
$smarty->assign('dbmessage', $dbmessage);
				
/* ----- Function ----- */
function check_comfirm($mysql_password) {
	return (isset($_POST["confirm_password"]) && $_POST["confirm_password"]==$mysql_password) ? 1 : 0;
}
?>
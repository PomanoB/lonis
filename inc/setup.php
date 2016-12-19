<?php
$act = isset($_POST["act"]) ? $_POST["act"] : "";	
	
if (isset($_GET["logout"])) {
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
		$smarty->assign('message', $langs["langUserNotFound"]);
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
				
				$smarty->assign('message', $langs["langSaved"]);
			}
			else {
				$smarty->assign('message', $langs["langNotInput"]);
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
				$smarty->assign('resetmessage', $langs["langConfirm"]);
			}
		}
		
		$input_type = row2col($conf_type);
		
		foreach($conf as $name=>$value) {
			if(!isset($input_type[$name])) $input_type[$name] = "text";
			$conflist[$name]["type"] = $input_type[$name];
			$conflist[$name]["err"] = isset($fld_err[$name]) ? 1 : 0;
			$conflist[$name]["name"] = "fld_".$name;
			$conflist[$name]["desc"] = $langs["lang_$name"];
			if($input_type[$name]!="password")
				$conflist[$name]["text"] = $value;

		}
		$smarty->assign('conflist', $conflist);
		
		/* Database */
		$check_confirm = check_comfirm($mysql_password);
		$smarty->assign('check_confirm', $check_confirm);
		$smarty->assign('act', $act);
		
		if($comm = mysql_connect($mysql_host, $mysql_user, $mysql_password)) {
			$smarty->assign('comm', $comm);
			$smarty->assign('mysql_db', $mysql_db);
			
			$db = mysql_select_db($mysql_db);
			if(!$db) {
				if($act=="dbadd") {
					mysql_query("create database ".$mysql_db);
					header("Location: $baseUrl/setup#db");
				}			
			}
			else {
				if($act=="dbdelete") {
					if($check_confirm) {
						mysql_query("drop database ".$mysql_db);
						header("Location: $baseUrl/setup#db");
					}
					
				}
				
				mysql_query("SET NAMES ".$charset);
				
				$file = $config_dir.'/db_tables.sql';
				if($file_table = file_exists($file)) {
					if(!($tbl =  mysql_fetch_assoc(mysql_query("show tables")))) {
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
								$smarty->assign('dbmessage', $langs["langError"]);
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
		
		// Get language list		
		$all_langs = parse_ini_file("$config_dir/lang.ini", true);
		foreach ($all_langs as $l => $arr) {
			foreach ($arr as $name => $value) {
				$row[$name][$l] = $value;
			}
		}
		
		$smarty->assign('lang_row', $row);		
				
	} // End setting
} // End login, logout

/* ----- Function ----- */
function check_comfirm($mysql_password) {
	return (isset($_POST["confirm_password"]) && $_POST["confirm_password"]==$mysql_password) ? 1 : 0;
}
?>
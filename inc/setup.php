<?php
$act = isset($_POST['act']) ? $_POST['act'] : "";	
	
if (isset($_GET['logout'])) {
	unset($_SESSION['setting_user']);
	header("Location: $baseUrl/setup");
}
else
if (isset($_POST['setting_user']) && isset($_POST['setting_password'])) {
	if (get_magic_quotes_gpc())
	{
		$setting_user = $_POST['setting_user'];
		$setting_password = $_POST['setting_password'];
	}
	else
	{
		$setting_user = addslashes($_POST['setting_user']);
		$setting_password = addslashes($_POST['setting_password']);
	}
	
	if($setting_user==$mysql_user && $setting_password==$mysql_password) {
		$_SESSION['setting_user'] = $setting_user;
		header("Location: $baseUrl/setup");
	}
	else {
		$smarty->assign('message', $smarty->get_config_vars('langUserNotFound'));
	}
}
else {
	if (isset($_SESSION['setting_user'])) {
		$smarty->assign('act', $act);
		
		/* General setting */
		if($act=="save") {
			$user = $_POST["fld_mysql_user"];
			$password = $_POST["fld_mysql_password"];
			
			if (!$user) $errors[] = $smarty->get_config_vars('langNotInputNick');	
			if (!$password) $errors[] = $smarty->get_config_vars('langNotInputPassword');
			
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
				
				$smarty->assign('message', $smarty->get_config_vars('langSaved'));
			}
			else {
				$smarty->assign('message', $smarty->get_config_vars('langNotInput'));
			}
		}
		else
		if($act=="reset") {
			//if(isset($_POST['comfirm']) && $_POST['comfirm']==1) {
			if($check_confirm = check_comfirm($mysql_password)) {
				unset($_SESSION['setting_user']);
				unlink($config_dir.'/'.$config_file);
				header("Location: $baseUrl/setup");
			}
			else {
				$smarty->assign('resetmessage', $smarty->get_config_vars('langConfirm'));
			}
		}
		
		$input_type = row2col($conf_type);
		
		foreach($conf as $name=>$value) {
			if(!isset($input_type[$name])) $input_type[$name] = "text";
			$conflist[$name]['type'] = $input_type[$name];
			$conflist[$name]['err'] = isset($fld_err[$name]) ? 1 : 0;
			$conflist[$name]['name'] = "fld_".$name;
			$conflist[$name]['desc'] = $smarty->get_config_vars('lang_'.$name);
			if($input_type[$name]!="password")
				$conflist[$name]['text'] = $value;

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
				
				if($file_table = file_exists($config_dir.'/db_tables.sql')) {
					if(!($tbl =  mysql_fetch_assoc(mysql_query("show tables")))) {
						if($act=="tbladd") {
							if($file = file($config_dir.'/db_tables.sql')) {
								$q_table = explode(";", implode("",$file));
								foreach($q_table as $value) {
									mysql_query($value);
									header("Location: $baseUrl/setup#db");
								}
							}
						}
						$smarty->assign('tbl', 0);
					}
					else {
						$tables = "";
						//while($row = mysql_fetch_array(mysql_query("show tables"))) $tables .= $row['name'].", ";
						if($file_data = file_exists($config_dir.'/db_data.sql')) {
							if($act=="dataadd") {
								if($file = file($config_dir.'/db_data.sql')) {
									$q_data = explode(";", implode("",$file));
									foreach($q_data as $value) {
										mysql_query($value);
										header("Location: $baseUrl/setup#db");
									}
								}
							}
						}
						$smarty->assign('tables', $tables);
						$smarty->assign('file_data', $file_data);						
						$smarty->assign('tbl', 1);
					} // End
				} // End tables
				$smarty->assign('file_table', $file_table);
			} //End db
			$smarty->assign('db', $db);
		} // End conn
		
		/* Languge */
		$cvars = $smarty->get_config_vars();
		
		// Get language list
		foreach($cvars as $key=>$value) {
			if(stristr($key, "langLang_")) {
				$l = str_replace("langLang_", "", $key);
				$langs[] = $l;
				$langName[$l] = array();
			}
		}
		unset($cvars);

		//Get all languages name per language list
		if(isset($lang_custom)) {
			$langdata['lang.ini'] = parse_ini_file($config_dir."/lang.ini", true);

			foreach($allowedActions as $key=>$value) {
				if(file_exists($config_dir."/lang_$key.ini")) {
					$langfilename = "lang_$key.ini";
					$langdata[$langfilename] = parse_ini_file($config_dir."/".$langfilename, true);
				}
			}
		}
		else {
			$langdata = parse_ini_file($config_dir."/lang.ini", true);
		}
		
		foreach ($langdata as $key => $value) {
			if (!is_array($value)) {
				$lang_global[$key] = $value;
			}
			else {
				$lang_local[$key] = $langdata[$key];
			}
		}

		foreach ($lang_local as $l => $arr) {
			$lang_lang[$l] = $lang_global['langLang_'.$l];
			foreach ($arr as $name => $value) {
				$row[$name][$l] = $value;
			}
		}
		
		$smarty->assign('lang_lang', $lang_lang); 
		$smarty->assign('lang_local', $row);		
		$smarty->assign('lang_global', $lang_global);
		
		
		
	} // End setting
} // End login, logout

/* ----- Function ----- */
function check_comfirm($mysql_password) {
	return (isset($_POST['confirm_password']) && $_POST['confirm_password']==$mysql_password) ? 1 : 0;
}
?>
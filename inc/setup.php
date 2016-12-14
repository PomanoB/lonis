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
		
		if($act=="save") {
			$user = $_POST["fld_mysql_user"];
			$password = $_POST["fld_mysql_password"];
			
			if (!$user) $errors[] = $smarty->get_config_vars('langNotInputNick');	
			if (!$password) $errors[] = $smarty->get_config_vars('langNotInputPassword');
	
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
				$smarty->assign('message', $smarty->get_config_vars('langRegErrors') . implode('<br />', $errors));
			}
		}
		else
		if($act=="reset") {
			if(isset($_POST['comfirm']) && $_POST['comfirm']==1) {
				unset($_SESSION['setting_user']);
				unlink($config_dir.'/'.$config_file);
				header("Location: $baseUrl/setup");
			}
			else {
				$smarty->assign('message', $smarty->get_config_vars('langConfirm'));
			}
		}
		
		foreach($conf_type as $type=>$value) {
			foreach($value as $name) {
				$input_type[$name] = $type;
			}
		}

		foreach($conf as $name=>$value) {
			if(!isset($input_type[$name])) $input_type[$name] = "text";
			$conflist[$name]['type'] = $input_type[$name];
	
			$conflist[$name]['name'] = "fld_".$name;
			$conflist[$name]['desc'] = $smarty->get_config_vars('lang_'.$name);
			if($input_type[$name]!="password")
				$conflist[$name]['text'] = $value;

		}
		$smarty->assign('conflist', $conflist);
		
		$check_confirm = check_comfirm();
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
					}
				}
				$smarty->assign('file_table', $file_table);
			}
			$smarty->assign('db', $db);
		}
	}
}

$template = 'setup.tpl';

function check_comfirm() {
	global $conf;
	return (isset($_POST['confirm_password']) && $_POST['confirm_password']==$conf['mysql_password']) ? 1 : 0;
}
?>
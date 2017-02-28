<?
$config_path = $_SERVER['DOCUMENT_ROOT']."/lonis/config.ini";

if(file_exists($config_path)) {
	$dbconf = parse_ini_file($config_path);

	if(isset($dbconf['mysql_host'])) $mysql['host'] = $dbconf['mysql_host'];
	if(isset($dbconf['mysql_user'])) $mysql['user'] = $dbconf['mysql_user'];
	if(isset($dbconf['mysql_password'])) $mysql['pass']= $dbconf['mysql_password'];
	if(isset($dbconf['mysql_db'])) $mysql['db'] = $dbconf['mysql_db'];
}

if(isset($dbconf['admin_user']) && isset($dbconf['admin_password'])) {
	$adminx[$dbconf['admin_user']] = $dbconf['admin_password'];
	$admins = array_merge($admins, $adminx);
}
?>
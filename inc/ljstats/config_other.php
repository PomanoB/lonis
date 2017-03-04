<?
$config_path = $_SERVER['DOCUMENT_ROOT']."/lonis/config.ini";

if(file_exists($config_path)) {
	$dbconf = parse_ini_file($config_path);

	if(isset($dbconf['uq_mysql_host'])) $mysql['host'] = $dbconf['uq_mysql_host'];
	if(isset($dbconf['uq_mysql_user'])) $mysql['user'] = $dbconf['uq_mysql_user'];
	if(isset($dbconf['uq_mysql_password'])) $mysql['pass']= $dbconf['uq_mysql_password'];
	if(isset($dbconf['uq_mysql_db'])) $mysql['db'] = $dbconf['uq_mysql_db'];
}

if(isset($dbconf['uq_admin_user']) && isset($dbconf['uq_admin_password'])) {
	$adminx[$dbconf['uq_admin_user']] = $dbconf['uq_admin_password'];
	$admins = array_merge($admins, $adminx);
}
?>
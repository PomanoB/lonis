<?
$config_path = $_SERVER['DOCUMENT_ROOT']."/lonis/config.ini";

if(file_exists($config_path)) {
	$dbconf = parse_ini_file($config_path);

	if(isset($dbconf['mysql_host'])) $mysql['host'] = $dbconf['mysql_host'];
	if(isset($dbconf['mysql_user'])) $mysql['user'] = $dbconf['mysql_user'];
	if(isset($dbconf['mysql_password'])) $mysql['pass']= $dbconf['mysql_password'];
	if(isset($dbconf['mysql_db'])) $mysql['db'] = $dbconf['mysql_db'];
}

if(isset($dbconf['uq_admin']) && isset($dbconf['uq_admin']))
	$admins[$dbconf['uq_admin']] = $dbconf['uq_password'];
?>
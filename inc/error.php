<?php

/* Write to .htasses file
ErrorDocument 401 /error/401 
ErrorDocument 403 /error/403 
ErrorDocument 404 /error/404 
ErrorDocument 500 /error/500
RewriteRule ^error(/([0-9]+))?$ index.php?action=error&err=$2 [L]
*/

$error_msg["ru"] = array(
	"401" => "Пользователь не авторизован",
	"403" => "Доспуп запещен",
	"404" => "Страница не существует",
	"500" => "Внутренняя ошибка сервера"	
);

$error_msg["en"] = array(
	"401" => "Not autorised",
	"403" => "Access denied",
	"404" => "Pages Not Found",
	"500" => "Internal Server Error",	
);

if(isset($_GET["lang"])) {
	$lang = $_GET["lang"];
}

if(!isset($lang)) {
	if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
		$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
	else
		$lang = "en";
}

$err = isset($_GET["err"]) ? $_GET["err"] : "";

$message = isset($error_msg[$lang][$err]) ? $error_msg[$lang][$err] : "";

// For all
//echo "<h1>$message</h1>";

// For Smarty
$smarty->assign('message', $message);

?>
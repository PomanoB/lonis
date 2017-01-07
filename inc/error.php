<?php

$errs = array(
	"401" => "NotAutorised",
	"403" => "AccessDenied",
	"404" => "PagesNotFound",
	"500" => "InternalServerError",
);

$err = isset($_GET["err"]) ? $_GET["err"] : "";

$message = isset($langs[$errs[$err]]) ? $langs[$errs[$err]] : "";

assign('message', $message);

?>
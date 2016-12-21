<?php

$err = isset($_GET["err"]) ? $_GET["err"] : "";

$message = isset($langs["langError{$err}"]) ? $langs["langError{$err}"] : "";

$smarty->assign('message', $message);

?>
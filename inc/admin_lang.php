<?php
if (!(isset($_SESSION['user']) && $_SESSION['user']['webadmin'] == 1)) {
	header('Location: '.$baseUrl);
}

?>
<?php
if (isset($_SESSION['user']) && $_SESSION['user']['webadmin'] == 1)
{
	if (isset($_POST['update']))
	{
		if (get_magic_quotes_gpc())
		{
			$name = $_POST['name'];
			$descr = $_POST['descr'];
			$type = $_POST['email'];
		}
		else
		{
			$name = addslashes($_POST['name']);
			$descr = addslashes($_POST['descr']);
			$type = addslashes($_POST['type']);
		}
		
		$count = abs((int)$_POST['count']);
		if (!$count)
			$count = 1;
			
		$id = abs((int)$_POST['id']);
		if (!$id)
			$id = 1;
		
		if (strlen($name) > 0)
		{
			$q = "UPDATE `unr_achiev` 
			SET `name` = '$name', `description` = '$descr', `count` = $count, `type` = '$type'
			WHERE `id` = $id";
		}
		else
		{
			$q = "DELETE `unr_achiev`, `unr_players_achiev` FROM `unr_achiev`, `unr_players_achiev` WHERE `unr_achiev`.`id` = $id AND `unr_players_achiev`.`achievId` = $id";
		}
		mysql_query($q);
		header('Location: index.php?action=achiev_admin');
	}
	else
	if (isset($_POST['add']))
	{
		if (get_magic_quotes_gpc())
		{
			$name = $_POST['name'];
			$descr = $_POST['descr'];
			$type = $_POST['email'];
		}
		else
		{
			$name = addslashes($_POST['name']);
			$descr = addslashes($_POST['descr']);
			$type = addslashes($_POST['type']);
		}
		
		$count = abs((int)$_POST['count']);
		if (!$count)
			$count = 1;
		
		$q = "INSERT INTO `unr_achiev` (`name`, `description`, `count`, `type`) VALUES ('$name', '$descr', $count, '$type')";
		mysql_query($q);
		header('Location: index.php?action=achiev_admin');
	}
	else
	{
		$q = "SELECT * FROM `unr_achiev`";
		$r = mysql_query($q);
		
		$achievs = array();
		while($row = mysql_fetch_array($r))
		{
			$achievs[] = $row;
		}
		$smarty->assign('achievs', $achievs);
		$template = 'achiev_admin.tpl';
	}
}
else
	header('Location: index.php');
?>
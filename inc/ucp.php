<?php
	
if (isset($_SESSION['user']))
{
    if (isset($_POST['name']) && $_POST['name'] != '')
    {
        if (get_magic_quotes_gpc())
		{
				$nick = str_replace(array('"', "'"), array('', ''), trim($_POST['name']));
				if (!$_SESSION['user']['steam_id_64'])
				{
					$password = trim($_POST['password']);
					$ip = str_replace(array('"', "'"), array('', ''), trim($_POST['ip']));
					$steam_id = str_replace(array('"', "'"), array('', ''), trim($_POST['steam_id']));
				}
		}
		else
		{
				$nick =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST['name'])));
				if (!$_SESSION['user']['steam_id_64'])
				{
					$password =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST['password'])));
					$ip =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST['ip'])));
					$steam_id =  str_replace(array('"', "'"), array('', ''), addslashes(trim($_POST['steam_id'])));
				}
		}
		
		if (!$_SESSION['user']['steam_id_64'])
		{
			$flag = 0;
			
			if ($ip != '')
				$flag |= (1<<0);
			
			if ($steam_id != '')
				$flag |= (1<<1);  
			
			if ($password)
				$password = md5($password);
				
			$auth = abs((int)$_POST['authType']);
			if ($auth > 1)
				$auth = 0;
		}
		
        $addFlag = '';
		foreach($additional_flags as $key => $value)
		{
			if (isset($_POST[$key]))
			{
				$addFlag .= $value;
			}
		}
				
		$icq = abs((int)$_POST['icq']);
		
		$update_sql = "";
		if (!$_SESSION['user']['steam_id_64'])
		{
			$update_sql = "UPDATE `unr_players` SET `name` = '$nick'".
			($password ?  ", `password` = '$password'" : '').
			",`ip` = '$ip', `steam_id` = '$steam_id', `flags` = $flag, `amxx_flags` = '$addFlag', 
			`auth` = $auth, `icq` = {$icq}
			WHERE `id` = ". $_SESSION['user']['id'];
		}
		else
		{
			$update_sql = "UPDATE `unr_players`
				SET `name` = '$nick', 
				`amxx_flags` = '$addFlag', 
				`icq` = {$icq}
			WHERE `id` = ". $_SESSION['user']['id'];
		}
		if (mysql_query($update_sql))
			$smarty->assign('message', $smarty->get_config_vars('langDataUpdated'));
		else
			$smarty->assign('message', $smarty->get_config_vars('langAlreadyUsed'));
		$template = 'message.tpl';     
    }
    else
    {   
	
		$addFlags = array();
		$i = 0;
		foreach($additional_flags as $key => $value)
		{
			$addFlags[$i]['flag'] = $key;
			$addFlags[$i]['lang'] = $smarty->get_config_vars($key);
			$addFlags[$i]['checked'] = (strstr($_SESSION['user']['amxx_flags'], $value) == FALSE ? 0 : 1);
			$i++;
		}
		$smarty->assign('addFlags', $addFlags);
        $template = 'ucp.tpl';
	}
}
else
{
    $smarty->assign('message', $smarty->get_config_vars('langMustLogin'));
    $template = 'message.tpl';
}


?>
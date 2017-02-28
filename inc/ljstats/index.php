<?php
ob_start();
define("START_TIME", microtime(true));
ini_set('display_errors',0);
error_reporting(0);
include 'config.php';
if($config["config_other"]) include "config_other.php";
$data = copy_and_init();
require 'lang/'.$config['default_lang'].'.php';
session_start();
$admin = false;
if(isset($_SESSION['login']) && isset($_SESSION['password'])) {
	if(is_admin($_SESSION['login'],$_SESSION['password'])) $admin = true;
	else {
		session_destroy();
		error($lang['Error login title text'],$lang['Error login'],__FILE__ .':'. __LINE__);
	}
}

$form_admin = isset($_GET["form_admin"]) ? 1 : 0;

if(isset($_GET['login']) && isset($_GET['password'])) {
	if(is_admin($_GET['login'],$_GET['password'])) {
		$_SESSION['login'] = $_GET['login'];
		$_SESSION['password'] = $_GET['password'];
		header('Location: index.php');
	} else {
		error($lang['Error login title text'],$lang['Error login'],__FILE__ .':'. __LINE__);
	}
}

if(isset($_POST['login']) && isset($_POST['password'])) {
	if(is_admin($_POST['login'],$_POST['password'])) {
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['password'];
		header('Location: index.php');
	} else {
		error($lang['Error login title text'],$lang['Error login'],__FILE__ .':'. __LINE__);
	}
}

$from_game = '';
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $valid_orders)) ? $_GET['sort'] : 'distance';
$page = isset($_GET['p']) ? intval($_GET['p']) : 0;
$speed = (isset($_GET['speed']) && in_array($_GET['speed'],$speeds)) ? intval($_GET['speed']) : 250;
$subtype = (isset($_GET['subtype']) && $_GET['subtype'] == 'block') ? 'block' : 'regular';
if(isset($_GET['from_game']) && $_GET['from_game'] == 'true') {
	echo '.'; // bugfix for motd, it doesn't scroll without this symbol
	$from_game = '&amp;from_game=true';
}

if(($subtype == 'block') && ($sort != 'jumpoff' && $sort != 'block' && $sort != 'distance')) $sort = 'distance';
elseif(($subtype == 'regular') && ($sort == 'block' || $sort == 'jumpoff')) $sort = 'distance';

$jts = $navigation = array();
foreach($config['jt'] as $k=>$jt) {
	if(!strstr($jt,'block') && !in_array($k,$config['jt_order'])) $jts[] = $k; // insering into array keys if not *_block and not in jt_order
}

foreach($config['jt_order'] as $jtord) {
	$navigation[] = $jtord;
	array_unshift($jts, $jtord);
}

$type = (isset($_GET['type']) && in_array($_GET['type'], $jts)) ? $_GET['type'] : 'lj';
$jt_count_max = count($navigation);

if($jt_count_max >= 6)
	$jt_count_half = ceil($jt_count_max/2-1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo format_title($_GET) ?></title>
<link type="text/css" rel="stylesheet" href="style.css" />
<?php echo $data ?>
<script type="text/javascript">
function get_pos(e,type){var posx = 0;var posy = 0;if (!e) var e = window.event;if (e.pageX || e.pageY){posx = e.pageX;posy = e.pageY;}else if (e.clientX || e.clientY){posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;}if(type == 'x') return posx;else return posy;}
function showHint(e,desc){var div = document.getElementById('hintdiv');var html = desc;div.style.left=get_pos(e,'x');div.style.top=get_pos(e,'y');div.style.display = 'inline';div.style.visibility= 'visible';div.innerHTML = html;}
function hideHint(){var div = document.getElementById('hintdiv');div.style.display = 'none';div.style.visibility= 'hidden';}
</script>
</head>
<body onload="copy();">
<div id="hintdiv" class="jshintbox"></div>
<table width="50%" border="0" class="tbl_navig">
<tr>
<?php
if($jt_count_max >= 6) {
	for($i = 0; $i<=$jt_count_half; $i++)
		echo '<td><b><a href="index.php?type='.$navigation[$i].$from_game.'">'.$config['jt'][$navigation[$i]].'</a></b></td>';
} else {
	for($i=0;$i<$jt_count_max;$i++)
		echo '<td><b><a href="index.php?type='.$navigation[$i].$from_game.'">'.$config['jt'][$navigation[$i]].'</a></b></td>';
}
?>
</tr>
</table>
<p></p>
<?php

$db = new DBClass();
$db->connect($mysql);

if(!isset($_GET['player']) && !isset($_GET['search']) && !isset($_GET['act'])) {
	// count all entries
	$sql = $subtype == 'regular' ?
		$db->query('SELECT COUNT(pid) as count FROM `'.$mysql['jumps_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.';') :
		$db->query('SELECT COUNT(pid) as count FROM `'.$mysql['blocks_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.';');
	
	if(!$sql) {
		$errors = $db->error();
		error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
	} else {
		$entries = $db->fetch_assoc($sql);
		$sql_limit = ceil($entries['count']/$config['per_page']);
		
		if($page > $sql_limit) $page = $sql_limit;
		if($page < 0) $page = 0;
	}

	$sql = $subtype == 'regular' ?
		$db->query('SELECT `pid` FROM `'.$mysql['jumps_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.' ORDER BY `'.$sort.'` DESC LIMIT '.($page*$config['per_page']).','.$config['per_page']) :
		$db->query('SELECT `pid` FROM `'.$mysql['blocks_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.' ORDER BY `'.$sort.'` DESC LIMIT '.($page*$config['per_page']).','.$config['per_page']);

	if(!$sql) {
		$errors = $db->error();
		error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
	} else {
		$ids = array();
		while($row = $db->fetch_assoc($sql))
			$ids[] = $row['pid'];
			
		echo '<div class="center_bold">'.sprintf($lang['topn'],$config['per_page'],$config['jt'][$type]).'</div>'.
				'<form action="" method="get"><div class="center">';
				if(isset($_GET['from_game']) && $_GET['from_game'] == 'true') echo '<input type="hidden" name="from_game" value="true" />';
				echo '<input type="text" name="search" /> <noscript><div class="inline"><input type="submit" value="'.$lang['search'].'" /></div></noscript></div></form><p></p>';
		
		if(count($ids) > 0) {
			$sql = $db->query('SELECT `id`,`name` FROM `'.$mysql['players_table'].'` WHERE id in('.implode(',',$ids).')');
			if(!$sql) {
				$errors = $db->error();
				error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
			} else {
				$names = array();
				while($row = $db->fetch_assoc($sql))
					$names[$row['id']] = htmlspecialchars($row['name']);
			}
		} else
			echo '<table class="tbl_navig" width="50%" border="0"><tr><td>'.sprintf($lang['No jumps found']).'</td></tr></table><p></p>';
	}

	if(count($ids) > 0) {
		$sql = $subtype == 'regular' ?
			$db->query('SELECT * FROM `'.$mysql['jumps_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.' ORDER BY `'.$sort.'` DESC LIMIT '.($page*$config['per_page']).','.$config['per_page']):
			$db->query('SELECT * FROM `'.$mysql['blocks_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed.' ORDER BY `'.$sort.'` DESC LIMIT '.($page*$config['per_page']).','.$config['per_page']);
			
		foreach($valid_orders as $ord) {
			if($ord == 'strafes' || ($subtype == 'regular' && ($ord == 'block' || $ord == 'jumpoff')) || ($subtype == 'block' && ($ord == 'maxspeed' || $ord == 'prestrafe' || $ord == 'sync'))) continue;
			$sql2 = $subtype == 'regular' ?
				$db->query('SELECT MAX(`'.$ord.'`) as max_'.$ord.' FROM `'.$mysql['jumps_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed):
				$db->query('SELECT MAX(`'.$ord.'`) as max_'.$ord.' FROM `'.$mysql['blocks_table'].'` WHERE `type` LIKE '.$db->escape($type).' AND `pspeed`='.$speed);
				
			$record_id[$ord] = $db->fetch_assoc($sql2);
		}
		
		if(!$sql || !$sql2) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		} else {
			if($subtype == 'regular') {
			?>
			<table border="0" cellspacing="0" cellpadding="0" class="tbl" width="70%">
				<tr class="tr_colored">
					
					<td class="width_20">#</td>
					<td class="width_350"><?php echo $lang['name'] ?></td>
					
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=distance&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['distance'] ?></a></td>
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=maxspeed&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['maxspeed'] ?></a></td>
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=prestrafe&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['Prestrafe'] ?></a></td>
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=strafes&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['Strafes'] ?></a></td>
					<td align="right"><a href="index.php?type=<?php echo $type ?>&amp;sort=sync&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['Sync'] ?></a></td>
			<?php
			} else {
			?>
			<table border="0" cellspacing="0" cellpadding="0" class="tbl" width="70%">
				<tr class="tr_colored">
					
					<td class="width_20">#</td>
					<td class="width_350"><?php echo $lang['name'] ?></td>
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=distance&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['distance'] ?></a></td>
					<td align="center"><a href="index.php?type=<?php echo $type ?>&amp;sort=jumpoff&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['jumpoff'] ?></a></td>
					<td align="right"><a href="index.php?type=<?php echo $type ?>&amp;sort=block&amp;p=<?php echo $page ?>&amp;speed=<?php echo $speed ?>&amp;subtype=<?php echo $subtype.$from_game ?>"><?php echo $lang['block'] ?></a></td>
			<?php
			}
			if(($subtype == 'regular') && ($type=="mcj" || $type=="dropmcj" || $type=="mscj" || $type=="dropmscj")) echo '<td align="right">Ducks</td>';
			else if($subtype == 'regular' && $type=="multibhop") echo '<td align="right">Bhops</td>';
			?>
				</tr>
			<?php
			$i = 0;
			if($page == 0) $p = 0;
			else $p = $page * $config['per_page'];
			
			while($row = $db->fetch_assoc($sql)) {
				$p++;
				
				$distance = ($row['distance'] == $record_id['distance']['max_distance']) ? '<span class="red">'.sprintf('%01.2f',$row['distance']/1000000).'</span>' : sprintf('%01.2f',$row['distance']/1000000);
				$cheat = check_distance($row['distance']/1000000,$type,$row['pspeed']);
				
				$hint = '';
				if($cheat) $hint = ' <span onmouseover="showHint(event,\'Max is: '.($cheat[0]).'&lt;br/&gt;Diff from max: '.$cheat[1].'\')" onmouseout="hideHint()">[!]</span>';
				
				if($subtype == 'regular') {
					$maxspeed = ($row['maxspeed'] == $record_id['maxspeed']['max_maxspeed']) ? '<span class="red">'.sprintf('%01.2f',$row['maxspeed']/1000000).'</span>' : sprintf('%01.2f',$row['maxspeed']/1000000);
					$prestrafe = ($row['prestrafe'] == $record_id['prestrafe']['max_prestrafe']) ? '<span class="red">'.sprintf('%01.2f',$row['prestrafe']/1000000).'</span>' : sprintf('%01.2f',$row['prestrafe']/1000000);
					$sync = ($row['sync'] == $record_id['sync']['max_sync']) ? '<span class="red">'.$row['sync'].'</span>' : $row['sync'];
					
					echo '<tr class="row '.($i % 2 ? '' : 'nrow').'"><td class="width_20">'.$p.'</td><td><b>'.($admin == true ? '[<a href="index.php?act=del_rec&pid='.$row['pid'].'&jt='.$type.'&speed='.$speed.'&type='.$subtype.'">x</a>] ' : '').'<a href="index.php?player='.$row['pid'].'&amp;type='.$subtype.$from_game.'">'.$names[$row['pid']].'</a></b></td><td align="center">'.$distance.$hint.'</td><td align="center">'.$maxspeed.'</td><td align="center">'.$prestrafe.'</td><td align="center">'.$row['strafes'].'</td><td align="right">'.$sync.'%</td>';
						switch($type) {
							case 'mcj':
							case 'dropmcj':
							case 'mscj':
							case 'dropmscj':
							case 'multibhop':
								echo '<td align="right">'.$row['ddbh'].'</td>';
							break;
						}
					echo '</tr>';
				} else {
					echo '<tr class="row '.($i % 2 ? '' : 'nrow').'"><td class="width_20">'.$p.'</td><td><b>'.($admin == true ? '[<a href="index.php?act=del_rec&pid='.$row['pid'].'&jt='.$type.'&speed='.$speed.'&type='.$subtype.'">x</a>] ' : '').'<a href="index.php?player='.$row['pid'].'&amp;type='.$subtype.$from_game.'">'.$names[$row['pid']].'</a></b></td><td align="center">'.$distance.$hint.'</td><td align="center">'.sprintf('%01.2f',$row['jumpoff']/1000000).'</td><td align="right">'.$row['block'].'</td></tr>';
				}
				
				$i++;
			}
			?>
			</table>
			<p></p>
			<table width="650" border="0" class="tbl_navig">
			<tr>
				<td colspan="2">
					<?php
						$navig_speed = array();
						foreach($speeds as $local_speed)
							$navig_speed[] = $speed == $local_speed ? $speed : '<a href="index.php?type='.$type.'&amp;sort='.$sort.'&amp;p=0&amp;speed='.$local_speed.'&amp;subtype='.$subtype.$from_game.'">'.intval($local_speed).'</a>';
						
						echo implode($config['speed_delemeter'], $navig_speed);
					?>
				</td>
			</tr>
			<tr>
				<td class="width_350"><?php echo ((isset($_GET['subtype']) && $_GET['subtype'] == 'regular') || !isset($_GET['subtype'])) ? $lang['regulartop'] : '<a href="index.php?type='.$type.'&amp;sort='.$sort.'&amp;page=0&amp;subtype=regular&amp;speed='.$speed.$from_game.'">'.$lang['regulartop'].'</a>'; ?></td>
				<td><?php echo (isset($_GET['subtype']) && $_GET['subtype'] == 'block') ? $lang['blocktop'] : '<a href="index.php?type='.$type.'&amp;sort='.$sort.'&amp;page=0&amp;subtype=block&amp;speed='.$speed.$from_game.'">'.$lang['blocktop'].'</a>'; ?></td>
			</tr>
			</table>
			<?php
			echo '<div class="center">'.show_pages($entries['count'],$page,'index.php?type='.$type.'&amp;sort='.$sort.'&amp;subtype='.$subtype.'&amp;speed='.$speed.'&amp;p=',$config['per_page']).'</div>';
		}
	}
} elseif(isset($_GET['player']) && !isset($_GET['search']) && !isset($_GET['act'])) {
	$p = intval($_GET['player']);
	$sql = $db->query('SELECT COUNT(id) as count FROM `'.$mysql['players_table'].'` WHERE id='.$p);
	if(!$sql) {
		$errors = $db->error();
		error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
	} else {
		$exists = $db->fetch_assoc($sql);
		if(!$exists['count'])
			echo '<div class="center">'.$lang['Player not found'].'</div>';
		else {
			$sql = $db->query('SELECT name, authid, ip FROM `'.$mysql['players_table'].'` WHERE id='.$p);
			if(!$sql) {
				$errors = $db->error();
				error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
			}
			
			$exists = $db->fetch_assoc($sql);
			$name = $exists['name'];
			$authid = $exists['authid'];
			$ip = $exists['ip'];
			/****************** REGULAR ***************/
			$_GET['type'] = (isset($_GET['type']) && $_GET['type'] == 'block') ? 'block' : 'regular';
			$speed = (isset($_GET['speed']) && in_array($_GET['speed'],$speeds)) ? intval($_GET['speed']) : 250;
			
			switch($_GET['type']) {
				default:
				case 'regular':
					$sql = $db->query('SELECT COUNT(pid) as count FROM `'.$mysql['jumps_table'].'` WHERE pid='.$p.' AND `pspeed`='.$speed);
					if(!$sql) {
						$errors = $db->error();
						error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
					} else {
						$exists = $db->fetch_assoc($sql);
						if(!$exists['count'])
							echo '<div class="center">'.$lang['No stats found'].'</div>';
						else {
							$sql = $db->query('SELECT * FROM `'.$mysql['jumps_table'].'` WHERE pid='.$p.' AND `pspeed`='.$speed);
							if(!$sql) {
								$errors = $db->error();
								error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
							} else {
								echo sprintf($lang['stats for'], htmlspecialchars($name), $authid);
								if($admin)
									echo '<div class="center">Steam: <span class="orange"><b>'.$authid.'</b></span><br/>IP: <span class="orange"><b>'.$ip.'</b></span><br/><a href="index.php?act=del_player&pid='.intval($_GET['player']).'">'.$lang['Delete player'].'</div>';
								?>
								<p></p>
								<table border="0" cellspacing="0" cellpadding="0" class="tbl" width="80%">
								<tr class="tr_colored">
									<td class="width_200"><?php echo $lang['type'] ?></td>
									<td align="center"><?php echo $lang['distance'] ?></td>
									<td align="center"><?php echo $lang['maxspeed'] ?></td>
									<td align="center"><?php echo $lang['Prestrafe'] ?></td>
									<td align="center"><?php echo $lang['Strafes'] ?></td>
									<td align="center"><?php echo $lang['Sync'] ?></td>
									<td align="center"><?php echo $lang['Place'] ?></td>
									<td align="right"><?php echo $lang['wpn'] ?></td>
								</tr>
								<?php
								$i = 0;
								while($row=$db->fetch_assoc($sql)) {
									$sql2 = $db->query('SELECT pid FROM `'.$mysql['jumps_table'].'` WHERE type LIKE \''.$row['type'].'\' AND pspeed='.$speed.' ORDER BY distance DESC');
									if(!$sql2) {
										$errors = $db->error();
										error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
									} else {
										$place = 0;
										while($row2=$db->fetch_assoc($sql2)) {
											$place++;
											if($row2['pid'] == $p) break;
										}
										
										switch($place) {
											case 1:
												$place = '<span class="red_top">'.$place.'</span>';
											break;
											case 2:
												$place = '<span class="green_top">'.$place.'</span>';
											break;
											case 3:
												$place = '<span class="orange_top">'.$place.'</span>';
											break;
										}
									}
									
									echo '<tr class="row '.($i % 2 ? '' : 'nrow').'"><td class="jt_class">'.($admin == true ? '[<a href="index.php?act=del_rec&pid='.$row['pid'].'&jt='.$type.'&speed='.$speed.'&type='.$subtype.'">x</a>] ' : '').$config['jt'][$row['type']].'</td><td align="center">'.sprintf('%01.2f',$row['distance']/1000000).'</td><td align="center">'.sprintf('%01.2f',$row['maxspeed']/1000000).'</td><td align="center">'.sprintf('%01.2f',$row['prestrafe']/1000000).'</td><td align="center">'.$row['strafes'].'</td><td align="center">'.$row['sync'].'</td><td align="center">'.$place.'</td><td align="right">'.$row['wpn'].'</td></tr>';
									$i++;
								}
								?>
								</table>
								<p></p>
								<?php
							}
						}
					}
				break;
				case 'block':
					/*********************** BLOCK **************************/
					$sql = $db->query('SELECT COUNT(pid) as count FROM `'.$mysql['blocks_table'].'` WHERE pid='.$p.' AND `pspeed`='.$speed);
					if(!$sql) {
						$errors = $db->error();
						error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
					} else {
						$exists = $db->fetch_assoc($sql);
						if(!$exists['count'])
							echo '<div class="center">'.$lang['No block stats found'].'</div>';
						else {
							$sql = $db->query('SELECT * FROM `'.$mysql['blocks_table'].'` WHERE pid='.$p.' AND `pspeed`='.$speed);
							if(!$sql) {
								$errors = $db->error();
								error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
							} else {
								echo sprintf($lang['block stats for'], htmlspecialchars($name));
								if($admin)
									echo '<div class="center">Steam: <span class="orange"><b>'.$authid.'</b></span><br/>IP: <span class="orange"><b>'.$ip.'</b></span><br/><a href="index.php?act=del_player&pid='.intval($_GET['player']).'">'.$lang['Delete player'].'</div>';
								?>
								<p></p>
								<table border="0" cellspacing="0" cellpadding="0" class="tbl" width="80%">
								<tr class="tr_colored">
									<td class="width_20"><?php echo $lang['type'] ?></td>
									<td align="center"><?php echo $lang['distance'] ?></td>
									<td align="center"><?php echo $lang['jumpoff'] ?></td>
									<td align="center"><?php echo $lang['block'] ?></td>
									<td align="center"><?php echo $lang['Place'] ?></td>
									<td align="right"><?php echo $lang['wpn'] ?></td>
								</tr>
								<?php
								$i = 0;
								while($row=$db->fetch_assoc($sql)) {
									$sql2 = $db->query('SELECT pid FROM `'.$mysql['blocks_table'].'` WHERE type LIKE \''.$row['type'].'\' AND pspeed='.$speed.' ORDER BY distance DESC');
									if(!$sql2) {
										$errors = $db->error();
										error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
									} else {
										$place = 0;
										while($row2=$db->fetch_assoc($sql2)) {
											$place++;
											if($row2['pid'] == $p) break;
										}
									}
									
									if($row['type'] == 'hj') $config['jt']['hj'] = 'HighJump';
									
									switch($place) {
										case 1:
											$place = '<span class="red_top">'.$place.'</span>';
										break;
										case 2:
											$place = '<span class="green_top">'.$place.'</span>';
										break;
										case 3:
											$place = '<span class="orange_top">'.$place.'</span>';
										break;
									}
									
									echo '<tr class="row '.($i % 2 ? '' : 'nrow').'"><td class="jt_class">'.($admin == true ? '[<a href="index.php?act=del_rec&pid='.$row['pid'].'&jt='.$type.'&speed='.$speed.'&type='.$_GET['type'].'">x</a>] ' : '').$config['jt'][$row['type']].'</td><td align="center">'.sprintf('%01.2f',$row['distance']/1000000).'</td><td align="center">'.sprintf('%01.2f',$row['jumpoff']/1000000).'</td><td align="center">'.$row['block'].'</td><td align="center">'.$place.'</td><td align="right">'.$row['wpn'].'</td></tr>';
									$i++;
								}
								?>
								</table>
								<p></p>
								<?php
							}
						}
					}
			}
		}
	}
?>
<p></p>
<table width="50%" border="0" class="tbl_navig">
<tr>
	<td colspan="2">
		<?php
			$navig_speed = array();
			foreach($speeds as $local_speed)
				$navig_speed[] = $speed == $local_speed ? $speed : '<a href="index.php?player='.intval($_GET['player']).'&amp;type='.$_GET['type'].'&amp;speed='.intval($local_speed).$from_game.'">'.intval($local_speed).'</a>';
			
			echo implode($config['speed_delemeter'], $navig_speed);
		?>
	</td>
</tr>
<tr>
	<td  class="width_325"><?php echo ((isset($_GET['type']) && $_GET['type'] == 'regular') || !isset($_GET['type'])) ? $lang['regulartop'] : '<a href="index.php?player='.intval($_GET['player']).'&amp;type=regular&amp;speed='.$speed.$from_game.'">'.$lang['regulartop'].'</a>'; ?></td>
	<td><?php echo (isset($_GET['type']) && $_GET['type'] == 'block') ? $lang['blocktop'] : '<a href="index.php?player='.intval($_GET['player']).'&amp;type=block&amp;speed='.$speed.$from_game.'">'.$lang['blocktop'].'</a>'; ?></td>
</tr>
</table>
<?php
} elseif(isset($_GET['search']) && !isset($_GET['act'])) { // search
	?>
	<form action="" method="get"><div class="center">
	<?php if(isset($_GET['from_game']) && $_GET['from_game'] == 'true') echo '<input type="hidden" name="from_game" value="true" />'; ?>
	<input type="text" name="search" value="<?php echo (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') ?>" /><noscript><div class="inline"><input type="submit" value="<?php echo $lang['search'] ?>" /></div></noscript></div></form><p class="center"><?php echo $lang['Search how to'] ?></p>
	<?php
	$data = isset($_GET['search']) ? parse_search_str($_GET['search']) : null;
	if($data) {
		$sql = $db->query('SELECT COUNT(id) as count FROM `'.$mysql['players_table'].'` WHERE `'.$data['type'].'` LIKE '.$data['str'].' LIMIT 0,500;');
		if(!$sql) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		} else {
			$count = $db->fetch_assoc($sql);
			if($count['count'] <= 0) echo '<div class="center_bold">'.$lang['No players found'].'</div>';
			else {
				$sql = $db->query('SELECT id,name,lastseen FROM `'.$mysql['players_table'].'` WHERE `'.$data['type'].'` LIKE '.$data['str'].' LIMIT 0,500;');
				if(!$sql) {
					$errors = $db->error();
					error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
				} else {
					?>
					<p></p>
					<table border="0" cellspacing="0" cellpadding="0" class="tbl" width="50%">
					<tr class="tr_colored">
						<td align="center"><?php echo $lang['name'] ?></td>
						<td align="right"><?php echo $lang['last seen'] ?></td>
					</tr>
					<?php
					$i = 0;
					while($row = $db->fetch_assoc($sql)) {
						echo '<tr class="row '.($i % 2 ? '' : 'nrow').'"><td><a href="index.php?player='.$row['id'].'">'.htmlspecialchars($row['name']).'</a></td><td align="right">'.date($config['date_format'],$row['lastseen']).'</td></tr>';
						$i++;
					}
					?>
					</table><p></p>
					<?php
				}
			}
		}
	} else echo '<div class="center_bold">'.$lang['No search input'].'</div>';
} elseif($admin && isset($_GET['act']) && ($_GET['act'] == 'del_player' || $_GET['act'] == 'del_rec') && isset($_GET['pid'])) {
	if($_GET['act'] == 'del_player' && !isset($_GET['confirm'])) {
		$query = $db->query('SELECT `name`,`ip`,`authid` FROM '.$mysql['players_table'].' WHERE id='.intval($_GET['pid']));
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		} else {
			$result = $db->fetch_assoc($query);
			if(empty($result['name']))
				error($lang['Player not found'], $lang['Player not found']);
			printf($lang['Delete really'], htmlspecialchars($result['name']), $result['authid'], $result['ip'], $_GET['pid']);
		}
	} elseif($_GET['act'] == 'del_player' && isset($_GET['confirm'])) {
		$query = $db->query('DELETE FROM `'.$mysql['players_table'].'` WHERE id='.intval($_GET['pid']));
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		}
			
		$query = $db->query('DELETE FROM `'.$mysql['jumps_table'].'` WHERE pid='.intval($_GET['pid']));
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		}
			
		$query = $db->query('DELETE FROM `'.$mysql['blocks_table'].'` WHERE pid='.intval($_GET['pid']));
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		}
			
		echo '<div class="center">'.$lang['Player deleted'].'</div>';
	} elseif($_GET['act'] == 'del_rec' && !isset($_GET['confirm'])) {
		$query = $db->query('SELECT `name` FROM '.$mysql['players_table'].' WHERE id='.intval($_GET['pid']));
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		} else {
			$result = $db->fetch_assoc($query);
			if(empty($result['name']))
				error($lang['Player not found'], $lang['Player not found']);
				
			printf($lang['Delete really stat'], htmlspecialchars($result['name']), $config['jt'][$_GET['jt']], intval($_GET['pid']), htmlspecialchars($_GET['jt']), intval($_GET['speed']), $subtype);
		}
	} elseif($_GET['act'] == 'del_rec' && isset($_GET['confirm'])) {
		$query = $db->query('DELETE FROM `'.($_GET['type'] == 'regular' ? $mysql['jumps_table'] : $mysql['blocks_table']).'` WHERE pid='.intval($_GET['pid']).' AND `type` LIKE '.$db->escape($_GET['jt']).' AND pspeed='.intval($_GET['speed']).';');
		if(!$query) {
			$errors = $db->error();
			error($lang['SQL error title'], sprintf($lang['SQL error'], $db->num_queries, $errors['error_no'], $errors['error_msg']),__FILE__ .':'. __LINE__);
		}
		
		echo '<div class="center">'.$lang['Rec deleted'].'</div>';
	}
}
?>
<p></p>
<table width="50%" border="0" class="tbl_navig">
<tr>
<?php
if($jt_count_max >= 6) {
	for($i = $jt_count_half+1; $i<$jt_count_max; $i++)
		echo '<td><b><a href="index.php?type='.$navigation[$i].'&amp;sort='.$sort.'&amp;page='.$page.$from_game.'">'.$config['jt'][$navigation[$i]].'</a></b></td>';
}
?>
</tr>
</table>

<table width="50%" border="0" class="tbl_navig">
<tr>
<td>
<form action="index.php" method="get">
<div>
<?php echo (isset($_GET['from_game']) && $_GET['from_game'] == 'true') ? '<input type="hidden" name="from_game" value="true" />' : ''; ?>
<input type="hidden" name="sort" value="<?php echo (isset($_GET['sort']) && in_array($_GET['sort'], $valid_orders)) ? $_GET['sort'] : 'distance' ?>" />
<input type="hidden" name="p" value="0" />
<select name="type" onchange="this.form.submit()">
<option value=""> </option>
<?php
foreach($jts as $jt) {
	if($jt != $type)
		echo '<option value="'.$jt.'">'.$config['jt'][$jt].'</option>';
	else
		echo '<option value="'.$jt.'" class="selected_green">'.$config['jt'][$jt].'</option>';
}
?>
</select> <noscript><div class="inline"><input type="submit" value="<?php echo $lang['submit'] ?>" /></div></noscript>
</div>
</form>
</td>
</tr>
</table>
<?php
if(!isset($_GET['from_game']) && !$admin && $form_admin) {
?>
<p>
<div class="center"><form action="index.php" method="post">
	<div class="inline width_200"><?php echo $lang['Login'] ?>: </div><div class="inline"><input type="text" name="login" /></div><br/>
	<div class="inline width_200"><?php echo $lang['Password'] ?>: </div><div class="inline"><input type="password" name="password" /></div><br/>
	<div><input type="submit" value="<?php echo $lang['submit'] ?>" /></div>
</div>
</p><br/>
<?php
}
?>
<!-- 
<div style="text-align:center;margin:0 auto;font-weight:bold" id="copy"></div>
<noscript><div style="text-align:center;margin:0 auto;font-weight:bold">uq_jumpstats by BorJomi &amp; Light 2011<br/><a href="http://unique-kz.com/">unique-kz.com</a> <a href="http://epic-s.ru/">epic-s.ru</a></div></noscript> -->
<?php
echo '<!-- execute time: '.sprintf('%.2f',microtime(true)-START_TIME).'s; queries: '.$db->num_queries.' -->';
?>
</body>
</html>
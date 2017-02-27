<?php
$lang = array(
	'SQL error' => 'MySQL query #%d failed<br/>MySQL reported error #%d:<br/><b>%s</b>',
	'SQL error title' => 'MySQL Error',
	'title' => '%s top %d &#151; page %d',
	'title_player' => 'Player stats &#151; %s &#151; speed %d',
	'title_search' => 'Search &#151; %s',
	'title_delrec' => 'Delete record stats',
	'title_delplayer' => 'Delete player stats',
	'No jumps found' => 'No players found for this jump type',
	'topn' => 'Top%d <span class="orange">%s</span>',
	'name' => 'Name',
	'distance' => 'Distance',
	'maxspeed' => 'Max speed',
	'Prestrafe' => 'Prestrafe',
	'Strafes' => 'Strafes',
	'Sync' => 'Sync',
	'Player not found' => 'Player not found',
	'No stats found' => 'No stats found for regular jumps',
	'No block stats found' => 'No blockjump stats found',
	'stats for' => '<div class="center">Stats for player <span class="orange"><b>%s</b></span> (%s)</div>',
	'block stats for' => '<div class="center">Block stats for player <span class="orange"><b>%s</b></span></div>',
	'type' => 'Type',
	'Place' => 'Place in Top',
	'wpn' => 'Weapon',
	'block' => 'Block',
	'jumpoff' => 'Jumpoff',
	'submit' => 'OK',
	'regulartop' => 'Regular',
	'blocktop' => 'Block jumps',
	'search' => 'Search',
	'No search input' => 'Search string is empty or to sort',
	'No players found' => 'No players found',
	'last seen' => 'Last seen',
	'Search how to' => 'If you want to search by ip, type first two ip numbers like 12.21 or *12.32*<br/>If you want to search by steam, your search string must match num:num:num like STEAM_0:1:123 or *0:1:123*<br/>In other cases, search will lookup names',
	'Error login' => 'Username or password was incorrect. <a href="index.php">Try again.</a>',
	'Error login title' => 'Error - %s',
	'Error login title text' => 'Incorrect username or password',
	'Error occurred' => 'An error occurred',
	'Login' => 'Login',
	'Password' => 'Pass',
	'Delete player' => 'Delete player and all his stats from DB',
	'Delete really' => '<p><div class="center"><form action="index.php" method="get">You really want to delete player <span class="orange">%s</span>?'.
						'<br/>IP: <span class="orange">%s</span><br/>SteamID: <span class="orange">%s</span><br/>'.
						'<input type="hidden" name="pid" value="%d" /><input type="hidden" name="act" value="del_player" /><input type="submit" value="Ok" name="confirm" />'.
						'<input type="button" onclick="javascript:history.go(-1)" value="Cancel"></form></div></p>',
	'Player deleted' => 'Player has been deleted.',
	'Delete really stat' => '<p><div class="center"><form action="index.php" method="get">You really want to delete player\'s <span class="orange">%s</span> stat <span class="orange">%s</span>?<br/>'.
						'<input type="hidden" name="pid" value="%d" /><input type="hidden" name="act" value="del_rec" />'.
						'<input type="hidden" name="jt" value="%s" /><input type="hidden" name="speed" value="%d" /><input type="hidden" name="type" value="%s" />'.
						'<input type="submit" value="Ok" name="confirm" />'.
						'<input type="button" onclick="javascript:history.go(-1)" value="Cancel"></form></div></p>',
	'Rec deleted' => 'Stat has been deleted.<br/><a href="javascript:history.go(-2)">Back</a>',
);
?>
<?php
$lang = array(
	'SQL error' => 'Запрос MySQL #%d не был выполнен<br/>MySQL ошибка #%d:<br/><b>%s</b>',
	'SQL error title' => 'Ошибка MySQL',
	'title' => '%s топ %d &#151; страница %d',
	'title_player' => 'Статистика игрока &#151; %s &#151; скорость %d',
	'title_search' => 'Поиск &#151; %s',
	'title_delrec' => 'Удалить стату',
	'title_delplayer' => 'Удалить игрока из базы',
	'No jumps found' => 'Игроков не найдено',
	'topn' => 'Топ%d <span class="orange">%s</span>',
	'name' => 'Ник',
	'distance' => 'Длина',
	'maxspeed' => 'Макс. скор.',
	'Prestrafe' => 'Prestrafe',
	'Strafes' => 'Стрейфы',
	'Sync' => 'Синх.',
	'Player not found' => 'Игрок не найден',
	'No stats found' => 'Статистика обычных прыжков пуста',
	'No block stats found' => 'Статистика блокджампов пуста',
	'stats for' => '<div class="center">Статистика игрока <span class="orange"><b>%s</b></span> (%s)</div>',
	'block stats for' => '<div class="center">Статистика блокджампов игрока <span class="orange"><b>%s</b></span></div>',
	'type' => 'Тип',
	'Place' => 'Место в топе',
	'wpn' => 'Оружие',
	'block' => 'блок',
	'jumpoff' => 'jumpoff',
	'submit' => 'OK',
	'regulartop' => 'Обычные',
	'blocktop' => 'Блоки',
	'search' => 'Поиск',
	'No search input' => 'Строка поиска не задана или слишком коротка',
	'No players found' => 'Игроков не найдено',
	'last seen' => 'В игре был',
	'Search how to' => 'Чтобы искать по steam, строка должна выглядеть след. образом: STEAM_0:1:12341, шаблон: *0:1:1*<br/>Чтобы искать по ip, строка должна выглядеть след. образом: 12.12.12.12, шаблон: *12.12*.<br/>В остальных случаях поиск осуществляется по нику.',
	'Error login' => 'Логин или пароль были введены неправильно. <a href="index.php">Попробуйте еще раз.</a>',
	'Error login title' => 'Ошибка - %s',
	'Error login title text' => 'Неправильные имя или пароль',
	'Error occurred' => 'Произошла ошибка',
	'Login' => 'Логин',
	'Password' => 'Пароль',
	'Delete player' => 'Удалить игрока и все его статы из базы',
	'Delete really' => '<p><div class="center"><form action="index.php" method="get">Вы точно хотите удалить все данные игрока <span class="orange">%s</span>?'.
						'<br/>IP: <span class="orange">%s</span><br/>SteamID: <span class="orange">%s</span><br/>'.
						'<input type="hidden" name="pid" value="%d" /><input type="hidden" name="act" value="del_player" /><input type="submit" value="Ok" name="confirm" />'.
						'<input type="button" onclick="javascript:history.go(-1)" value="Отмена"></form></div></p>',
	'Player deleted' => 'Игрок был удален.',
	'Delete really stat' => '<p><div class="center"><form action="index.php" method="get">Вы действительно хотите удалить стату игрока <span class="orange">%s</span> - <span class="orange">%s</span>?<br/>'.
						'<input type="hidden" name="pid" value="%d" /><input type="hidden" name="act" value="del_rec" />'.
						'<input type="hidden" name="jt" value="%s" /><input type="hidden" name="speed" value="%d" /><input type="hidden" name="type" value="%s" />'.
						'<input type="submit" value="Ok" name="confirm" />'.
						'<input type="button" onclick="javascript:history.go(-1)" value="Отмена"></form></div></p>',
	'Rec deleted' => 'Стата была удалена.<br/><a href="javascript:history.go(-2)">Back</a>',
);
?>
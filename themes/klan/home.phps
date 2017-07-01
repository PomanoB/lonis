<p><div class="titles" align="center">
	<?=langs('Welcome')?>
	<div class="server_name" style="padding: 8px;">
		<i><?=$server_name?></i>
	</div>
</div><br>

<div id="games" class="tabs">
	<input type="radio" name="tab" checked="checked" id="tab1"/><label for="tab1"></label>
	<input type="radio" name="tab" id="tab2"/><label for="tab2">[K.lan] Classic</label> ::
	<input type="radio" name="tab" id="tab3"/><label for="tab3">[K.lan] CSDM</label> ::
	<input type="radio" name="tab" id="tab4"/><label for="tab4">[K.lan] Kreedz</label> ::
	<input type="radio" name="tab" id="tab5"/><label for="tab5">[K.lan] Zombie Plague</label>
	
	<div class="info">
		<p>У нас вы легко найдете сервер по душе!
		<p>Любите безостановочную стрельбу - добро пожаловать на CSDM.
		<p>Вы сторонник классичекой игры - вас всегда ждут на [K.lan] Classic.
		<p>Вам нравится атмосфера страха и ужаса - 
		<br>попробуйте спасти мир от полчищ зомби на нашем Zombie Plague-сервере!
	</div>
	<div>
		<img src="<?=$bTheme?>/img/home/cs.png">
		<text>Это классический сервер, без лишних плагинов,
		мешающих игре. На нашем сервере вас ничего не будет отвлекать,
		ничто не помешает вам убить врага как можно быстрей и эффективнее.
		<p><b>cs.klan-hub.ru:27016</b></text>
	</div>
	<div>
		<img src="<?=$bTheme?>/img/home/dm.png">
		<p>Неповторимость нашего DeathMatch'а в том,
		что на сервере стоит уникальный мод Adrenalin UT Style,
		что делает игру более динамичной, захватывающей и интересной.
		<p><b>cs.klan-hub.ru:27015</b>
	</div>
	<div>
		<img src="<?=$bTheme?>/img/home/kz.png">
		<p>Посоревнуйтес в быстроте прохождения карт 
		на нашем сервере Kreedz, может Вы сможете 
		установить новый Мировой Рекорд.
		<br>Всего на сервере более 4700 карт.
		<p><b>cs.klan-hub.ru:27017</b>
	</div>
	<div>
		<img src="<?=$bTheme?>/img/home/zm.png">
		<p>Zombie Plague с уникальной статистикой, с уникальными классами
		и неповторимым набором экстра-предметов. Все придает игре
		затягивающую атмосферу нашествия полчищ зомби, отсановить которых
		можешь лишь ты.
		<p><b>cs.klan-hub.ru:27018</b>
	</div> 
</div>
<br>
<hr>
<? include('news.phps'); ?>

<? if(isset($player['id'])): ?>

		<p><div class="titles"><?=langs('Player')?></div><br>

		<a href="<?=$bUrl?>/#"><img src="<?=$bTheme?>/img/players/avatarfull/<?=$player['id']?>.jpg?>" class="image_c" alt="<?=$player['name']?>" /></a>
		<p><div class=""><h2><?=$player['name']?></h2></div><br>
		<p><div>
			<div class="playerinfo">
				<div class="infoid"><?=langs('Country')?>:</div> 
				<div><div class="flags flag-<?=$player['country']?>">&nbsp;</div> <?=$player['countryName']?></div>
			</div>
			
			<div class="playerinfo">
				<div class="infoid"><?=langs('Fulfilled achievements')?>:</div> 
				<div><a href="<?=$bUrl?>/<?=$player['name_url']?>/achiev/" title="<?=langs('View')?>"><?=$player['achievCompleted']?></a></div>
			</div>

			<div class="playerinfo">
				<div class="infoid"><?=langs('Went KZ maps')?>:</div> 
				<div><a href="<?=$bUrl?>/<?=$player['name_url']?>/kreedz" title="<?=langs('View')?>"><?=$player['mapCompleted']?></a></div>
			</div>
		<? if(isset($player['steam_id'])): ?>
			<div class="playerinfo">
				<div class="infoid"><?=langs('Steam ID')?>:</div>
				<div><a href="http://steamcommunity.com/profiles/<?=$player['steam_id_64']?>/" target="_blank"><?=$player['steam_id']?></a></div>
			</div>
		<? endif; ?>
		<? if($player['icq']): ?>
			<div class="playerinfo">
				<div class="infoid"><?=langs('ICQ')?>:</div> <div><?=$player['icq']?></div>
			</div>
		<? endif; ?>
			<div class="playerinfo">
				<div class="infoid"><?=langs('Our Last Time')?>:</div> <div><?=$player['lastTime']?></div>
			</div>
			<div class="playerinfo">
				<div class="infoid"><?=langs('Shared Online')?>:</div> <div><?=$player['onlineTimes']?></div>
			</div>
		</div>

<? else: ?>
	<div class="wrapper">		
		<div class="titles left_block"><?=langs('Players')?></div>
		<div class=" right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	
	<? $pages['url'] = "{$bUrl}/players/{$order}-{$sort}/page%page%/{$search}"; ?>
	<? include("generate_page.phps"); ?>

	<div class="table list">
		<div class="tr title">
			<div>&nbsp;</div>
			<div><a href="<?=$bUrl?>/players/name/page<?=$pages['page']?>/<?=$search?>"><?=langs('Player')?></a></div>
			<div><a href="<?=$bUrl?>/players/country/page<?=$pages['page']?>/<?=$search?>"><?=langs('Country')?></a></div>
			<div><a href="<?=$bUrl?>/players/achiev-desc/page<?=$pages['page']?>/<?=$search?>"><?=langs('Fulfilled achievements')?></a></div>
			<div><a href="<?=$bUrl?>/"><?=langs('Went KZ maps')?></a></div>
		</div>
		
		<? foreach($players as $row): ?>
		<div class="tr row">
			<div>
				<a href="<?=$bUrl?>/<?=url_replace($row['name'])?>">
				<img src="<?=$bTheme?>/img/players/avatar/<?=$row['id']?>.jpg" width="<?=$row['avatar']['size']?>" class="image_c" alt="<?=$row['name']?>" /></a>
			</div>
			<div>
				<a href="<?=$bUrl?>/<?=url_replace($row['name'])?>"><?=$row['name']?></a>
			</div>
			<div style="width: 20%;">
				<i class="flags flag-<?=$row['country']?>" title="<?=$row['countryName']?>" alt="">&nbsp;</i>
				<?=$row['countryName']?>
			</div>
			<div>
				<a href="<?=$bUrl?>/<?=url_replace($row['name'])?>/achiev/"><?=$row['achiev']?></a>
			</div>
			<div>
				<a href="<?=$bUrl?>/<?=url_replace($row['name'])?>/kreedz"><?=$row['mapCompleted']?></a>
			</div>
		</div>
		
		<? endforeach; ?>
	</div>
<? endif; ?>
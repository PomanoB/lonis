<? if($act=="achievs"): ?>

	<div class="titles" align="center">
		<a href="<?=$bUrl?>/achiev/"><?=langs('Achievs')?></a>
		::
		<?=langs('Achievs players')?>
	</div>
	
	<div class="achiev_wrapper">
		<div style="margin: 10px;">
			<? $pages['url'] = "$bUrl/achievs/page%page%"; ?>
			<? include("generate_page.phps"); ?>
		</div>

	<? foreach($rows as $player): ?>
		<div class="achiev">
			<img src="<?=$bTheme?>/img/players/avatarmedium/<?=$player['plid']?>.jpg" width="50" height="50" class="image_c" alt="<?=$player['plname']?>" />
			<b><a href="<?=$bUrl?>/<?=$player['name']?>/achiev/"><?=$player['name']?></a></b>
			<br />
			<span><?=langs('Just completed the achievements:')?> <?=$player['achiev_total']?></span>
		</div>
	
	<? endforeach; ?>
	</div>
	
<? else: ?> 
	<? if($aname && $aname!=""): ?>

		<div class="achiev_wrapper">
			<div class="titles">
				<?=langs('Achievs')?>
			</div><br>
			
			<div class="achiev achiev_completed">
				<img src="<?=achievImg($achiev['id'])?>" />
				<b><?=$achiev['name']?></b>
				<br />
				<text><?=$achiev['desc']?></text>
			</div>
			
			<div style="margin: 10px;">
				<? $pages['url'] = "$bUrl/achiev/page%page%/$aname_url"; ?>
				<? include("generate_page.phps"); ?>
			</div>
			
		<? foreach($rows as $player): ?>
			<div class="achiev">
				<img src="<?=$bTheme?>/img/players/avatar/<?=$player['id']?>.jpg" class="image_c" alt="<?=$player['plname']?>" />
				<b><a href="<?=$bUrl?>/<?=$player['plname_url']?>/achiev/"><?=$player['plname']?></a></b>
				<br />
				<span><?=langs('Just completed the achievements:')?> <?=$player['achiev_total']?></span>
			</div>
		
		<? endforeach; ?>
		</div>
		
	<? elseif($name && $name!=""): ?>
		<div class="titles" align="center">
			<?=langs('Achievs')?> :: <i><?=$name?></i>
		</div><br>

		<? $pages['url'] = "{$bUrl}/{$name_url}/achiev/page%page%/"; ?>
					
		<div class="achiev_wrapper" align="center">	
		<? foreach($rows as $row): ?>
			<div class="achiev <? if($row['count']==$row['progress']): ?>achiev_completed<? endif; ?>">
				<img src="<?=achievImg($row['id'])?>" />
				<b><a href="<?=$bUrl?>/achiev/<?=$row['name']?>"><?=$row['name']?></a></b>
				<br>
				<text><?=$row['desc']?></text>
				<br>
			
			<? if(isset($row['width'])): ?>
				<div class="progress_background">
					<div class="progress_bar" style="width:<?=$row['width']?>%"></div>
				</div>
				<span class="progress_counter"><?=$row['progress']?>/<?=$row['count']?></span>
			<? elseif(isset($row['unlocked'])): ?>
				<div class="unlocekd_time">
					<?=langs('Unlocked')?><?=date_format($row['unlocked'], "%d.%m.%Y %H:%M")?>
				</div>
			<? endif; ?>
			</div>
		<? endforeach; ?>
		</div>
		
	<? else: ?>
	
		<div class="titles" align="center">
			<?=langs('Achievs')?> :: <a href="<?=$bUrl?>/achievs/"><?=langs('Achievs players')?></a>
		</div><br>
		
		<div style="margin: 10px;">
	
			<? $pages['url'] = 	"$bUrl/achiev/page%page%/"; ?>
			<? include("generate_page.phps"); ?>
		</div>
		
		<div class="achiev_wrapper">
		<? foreach($rows as $row): ?>
			<div class="achiev">
				<img src="<?=achievImg($row['aId'])?>"/>
				<b><a href="<?=$bUrl?>/achiev/<?=$row['name']?>"><?=$row['name']?></a></b>
				<br />
				<span style="width:450px;display: inline-block;"><?=$row['desc']?></span>
				
				<div class="progress_background">
					<div class="progress_bar" style="width:<?=$row['completed']?>%"></div>
				</div>
				<span class="progress_counter"><?=$row['completed']?>%</span>
			</div>
		<? endforeach; ?>
		</div>
		
	<? endif; ?>
<? endif; ?>
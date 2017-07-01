	<div class="wrapper">		
		<div class="titles left_block">
			<?=langs('Maps')?> (<?=$total?>)
		</div>
		<div class="right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	
	
<? if($rec=="norec"): ?>
	<div style="margin: 0 20px;">
		<b><?=langs('Not jumped')?></b> :: <a href="<?=$bUrl?>/kreedz/maps/<?=$type?>/<?=$search?>"><?=langs('Passed')?></a>
	</div>
	
	<? $pages['url'] = "$bUrl/kreedz/maps/$type/page%page%/$rec/$search"; ?>	
	<? include("generate_page.phps"); ?>
	
	<? if(!isset($style)): ?>
	<ul class='map-list'>
		<? foreach($maps as $key=>$row): ?>	
		<li class="map-list-item" title="<?=$row['mapname']?>">
				<? if(file_exists($bUrl.'/tpl/img/cstrike/'.$row['mapname'].'.jpg')): ?>
					<img class="icon icon-picture-o" src="<?=$bTheme?>/img/cstrike/<?=$row['mapname']?>.jpg" alt="" title="<?=$row['mapname']?>" oncontextmenu="return false;">
				<? else: ?>
					<i class="icon icon-image" style="font-size: 9em; color: grey;"></i><br>
				<? endif; ?>
				<?=$row['mapname']?>
		</li>

		<? endforeach; ?>
	</ul>
	<? else: ?>	
	<div>
		<div class="table list">
			<div class="tr title">
				<div><?=langs('Map')?></div>
			</div>
		<? foreach($maps as $key=>$row): ?>
			<div class="tr row">
				<div>
					<i class="icon icon-<?=$row['icon']?> diff-dot" style="color: <?=$row['dcolor']?>;" title="<?=$row['dname']?>"></i>
					<a href="<?=$bUrl?>/kreedz/<?=$row['mapname']?>"><?=$row['mapname']?></a>
				</div>
			</div>

		<? endforeach; ?>
		</div>
	</div>
	<? endif; ?>
	
<? else: ?>
	<div style="margin: 0 20px;">
		<a href="<?=$bUrl?>/kreedz/maps/pro/<?=$rec?>/<?=$search?>" <? if($type=="pro"): ?>style="font-weight:bold;"<? else: ?><? endif; ?>><?=langs('Pro')?></a>
		<a href="<?=$bUrl?>/kreedz/maps/noob/<?=$rec?>/<?=$search?>" <? if($type=="noob"): ?>style="font-weight:bold;"<? else: ?><? endif; ?>><?=langs('Noob')?></a>
		<a href="<?=$bUrl?>/kreedz/maps/all/<?=$rec?>/<?=$search?>" <? if($type=="all"): ?>style="font-weight:bold;"<? else: ?><? endif; ?>><?=langs('All')?></a>
		:: <a href="<?=$bUrl?>/kreedz/maps/<?=$type?>/norec/<?=$search?>"><?=langs('Not jumped')?></a>
	</div>

	<div class="err_message"><?=$message?></div>
	
	<? $pages['url'] = "$bUrl/kreedz/maps/$type/page%page%/$rec/$search"; ?>
	<? include("generate_page.phps"); ?>

	<div class="table list">
		<div class="tr title">
			<div><?=langs('Map')?></div>
			<div><?=langs('Player')?></div>
			<div><?=langs('Time')?></div>
			<div><?=langs('Checkpoints')?></div>
			<div><?=langs('Teleports')?></div>
			<div><?=langs('Weapon')?></div>
			<div></div>
		<? if($admin==1): ?>
			<div></div>
		<? endif; ?>
		</div>

	<? foreach($maps as $row): ?>
		<div class="tr row">
			<div>
				<i class="icon icon-<?=$row['icon']?> diff-dot" style="color: <?=$row['dcolor']?>;" title="<?=$row['dname']?>"></i>
				<a href="<?=$bUrl?>/kreedz/<?=$row['mapname']?>/"><?=$row['mapname']?></a>
			</div>
			<div><a href="<?=$bUrl?>/<?=url_replace($row['name'])?>/kreedz"><?=$row['name']?></a></div>
			<div><?=timed($row['time'], 2)?></div>
			<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['cp']?></div>
			<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['go_cp']?></div>
			<div class="<? if($row['wname'] != 'USP' && $row['wname'] != 'KNIFE'): ?>color_wpn<? endif; ?>">
				<div class="wpn wpn-<?=$row['weapon']?>">&nbsp;</div>
			</div>
			<div>
			<? if(isset($row['download'])): ?>
				<a class="icon icon-download" href="<?=$bUrl?>/<?=$row['download']?>" alt="<?=langs('Download')?> <?=$row['mapname']?>"></a>
			<? endif; ?>
			</div>
		<? if($admin==1): ?>
			<form action="" method="post">			
			<div>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
				<input name="delmap" type="hidden" value="<?=$row['map']?>" />
			</div>
			
			</form>
		<? endif; ?>			
		</div>

	<? endforeach; ?>
	</div>
	
<? endif; ?>
	
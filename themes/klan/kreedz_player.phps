	<div class="wrapper">
		<div class="titles left_block">
			<?=langs('Player')?> <? if(isset($name)): ?> :: <i><?=$name?></i><? endif; ?></i>
		</div>
		<div class="right_block" align="center">
			<a href="<?=$bUrl?>/<?=$name_url?>">
				<img src="<?=$bTheme?>/img/players/avatarfull/<?=$player['id']?>.jpg" width="140" height="120" oncontextmenu="return false;" onerror="this.src=''" class="image_c"/><br>
			</a>
			<p>
		</div>
	</div><br><br>

<? if($name): ?>
	<? if($rec!="norec"): ?>
	<div style="margin: 0 20px;">
		<a href="<?=$bUrl?>/<?=$name_url?>/kreedz/pro/<?=$rec?>/<?=$sort?>" <? if($type=="pro"): ?>style="font-weight:bold;"<? endif; ?>><?=langs('Pro')?></a>
		<a href="<?=$bUrl?>/<?=$name_url?>/kreedz/noob/<?=$rec?>/<?=$sort?>" <? if($type=="noob"): ?>style="font-weight:bold;"<? endif; ?>><?=langs('Noob')?></a>
		<a href="<?=$bUrl?>/<?=$name_url?>/kreedz/all/<?=$rec?>/<?=$sort?>" <? if($type=="all"): ?>style="font-weight:bold;"<? endif; ?>><?=langs('All')?></a>
		:: <a href="<?=$bUrl?>/<?=$name_url?>/kreedz/<?=$type?>/norec"><?=langs('Not jumped')?></a>
		
		<br><a href="<?=$bUrl?>/<?=$name_url?>/kreedz/all/<?=$rec?>/num" <? if($sort=="num"): ?>style="font-weight:bold;"<? endif; ?>><?=langs('Total')?>:</a> <?=$map_num?> 
		:: 
		<a href="<?=$bUrl?>/<?=$name_url?>/kreedz/all/<?=$rec?>/top1" <? if($sort=="top1"): ?>style="font-weight:bold;"<? endif; ?>><?=langs('First')?>:</a> <?=$map_top1?>
	</div>
	<? else: ?>
	<div style="margin: 0 20px;">
		<b><?=langs('Passed')?></b> :: <a href="<?=$bUrl?>/<?=$name_url?>/kreedz/<?=$type?>"><?=langs('Passed')?></a>
		
		<br><b><?=langs('Total')?></b>: <?=$map_norec?>
	</div>
	<? endif; ?>	
	
	<? $pages['url'] = "$bUrl/{$name_url}/kreedz/$type/page%page%/$rec/$sort"; ?>
	<? include("generate_page.phps"); ?>
	
	<br>
	<div class="table list">
		<div class="tr title">
			<div><?=langs('Map')?></div>
			<? if($rec=="norec"): ?><div><?=langs('Player')?></div><? endif; ?>
			<div><?=langs('Time')?></div>
			<div><?=langs('Checkpoints')?></div>
			<div><?=langs('Teleports')?></div>
			<div><?=langs('Weapon')?></div>
		</div>
	<? foreach($maps as $row): ?>
		<div class="tr row">
			<div>
				<i class="icon icon-<?=$row['icon']?> diff-dot" style="color: <?=$row['dcolor']?>;" title="<?=$row['dname']?>"></i>
				<a href="<?=$bUrl?>/kreedz/<?=$row['map']?>/"><?=$row['map']?></a>
			</div>
			<? if($rec=="norec"): ?><div><a href="<?=$bUrl?>/<?=$row['name_url']?>/kreedz"><?=$row['name']?></a></div><? endif; ?>
			<div><?=$row['time']?></div>
			<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['cp']?></div>
			<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['go_cp']?></div>
			<div class="<? if($row.wname != 'USP' && $row.wname != 'KNIFE'): ?>color_wpn<? endif; ?>">
				<div class="wpn wpn-<?=$row['weapon']?>">&nbsp;</div>
			</div>
		</div>

	<? endforeach; ?>
	</div>
<? endif; ?>
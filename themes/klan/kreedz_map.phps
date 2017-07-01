<div class="wrapper">
	<div class="titles left_block">
		<?=langs('Map')?> :: 
		<span class="tooltip down">
			<?=$map?>
			<span class="mapinfo"><? if(isset($mapinfo['type'])): ?> <?=$mapinfo['type']?> <? else: ?> <?=langs("Unknown type")?> <? endif; ?></span>
		</span>
		<span class="tooltip down">
			<i class="icon icon-<?=$mapinfo['icon']?>" style="color: <?=$mapinfo['dcolor']?>;"></i>
		<span class="mapinfo" style="color: <?=$mapinfo['dcolor']?>;"><?=$mapinfo['dname']?></span></span>
	</div>
	
	<div class="right_block" align="center">
		<div style="margin: 0 15px;">
			<div class="map_image" style="background-image: url(<?=$bTheme?>/img/cstrike/<?=$map?>.jpg);">&nbsp;</div>
			<i class="icon icon-image" style="font-size: 9em; color: grey; padding: 0 15px;"></i><br>
		</div>
		
	</div>
</div><br>

<? if(isset($maprec)): ?>
<div style="margin: 0 20px;"><br>
	<? foreach($maprec as $rec): ?>
		<div style="margin: 5px;" >
		<? if($rec['part']): ?>
			<b><a href="<?=$rec['url']?>" target="_blank"><?=$rec['fullname']?></a></b>:
		<? endif; ?>
		<b><?=$rec['mappath']?></b> <?=$rec['time']?> <i><?=$rec['player']?></i>&nbsp;
		<span class="flags flag-<?=$rec['country']?>" title="<?=$rec['country']?>" alt="">&nbsp;</span>
		</div>
	<? endforeach; ?>
</div><br>
<? endif; ?>

<div class="err_message"><?=$message?></div>

<div style="margin: 0 20px;">
	<a href="<?=$bUrl?>/kreedz/pro/<?=$map?>"  <?=($type=="pro" ? 'style="font-weight:bold;"' : '')?>><?=langs('Pro')?></a>
	<a href="<?=$bUrl?>/kreedz/noob/<?=$map?>" <?=($type=="noob" ? 'style="font-weight:bold;"' : '')?>><?=langs('Noob')?></a>
	<a href="<?=$bUrl?>/kreedz/all/<?=$map?>"  <?=($type=="all" ? 'style="font-weight:bold;"' : '')?>><?=langs('All')?></a>
</div>

<div align="center">
	<? $pages['url'] = "$bUrl/$actionS/$type/page%page%/$map"; ?>
	<? include("generate_page.phps"); ?>
</div>
		
<div class="table list">
	<div class="tr title" >
		<div width="30" align="center">№</div>
		<div><?=langs('Player')?></div>
		<div><?=langs('Time')?></div>
		<div><?=langs('Checkpoints')?></div>
		<div><?=langs('Teleports')?></div>
		<div><?=langs('Weapon')?></div>
	<? if($admin==1): ?>
		<div>#</div>
	<? endif; ?>
	</div>

<? $num = $pages['start']; ?>
<? foreach($maps as $row): ?>
	<div class="tr row">
		<div align="center">
			<? if(++$num<4): ?>
				<i class="icon icon-trophy" style="color: <?=$cup_color[$num]?>;" title="<?=$num?>" alt="<?=$num?>"></i>
			<? else: ?>
				<?=$num?>
			<? endif; ?>
		</div>	

		<div>
			<a href="<?=$bUrl?>/<?=url_replace($row['name'])?>/kreedz"><?=$row['name']?></a>
		</div>
		<div><?=timed($row['time'], 5)?></div>
		<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['cp']?></div>
		<div class="<? if($row['go_cp']==0): ?>color_nogc<? endif; ?>"><?=$row['go_cp']?></div>
		<div class="<? if($row['wname'] != 'USP' && $row['wname'] != 'KNIFE'): ?>color_wpn<? endif; ?>">
			<div class="wpn wpn-<?=$row['weapon']?>">&nbsp;</div>
		</div>
	<? if($admin==1): ?>
		<form action="" method="post">			
		<div>
			<input type="hidden" name="confirm" value="0">
			<input type="checkbox" name="confirm" value="1">
			<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
			<input name="id" type="hidden" value="<?=$row['id']?>" />
		</div>
		</form>
	<? endif; ?>
	</div>

<? endforeach; ?>

</div>
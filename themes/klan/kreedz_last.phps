	<div class="wrapper">
		<div class="titles left_block">
			<?=langs('Last Records')?>
		</div>
		<div class="right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	
	<div class="err_message"><?=$message?></div>

	<div style="margin: 0 20px;">
		<a href="<?=$bUrl?>/kreedz/last/pro/<?=$map?>"  <?=($type=="pro" ? 'style="font-weight:bold;"' : '')?>><?=langs('Pro')?></a>
		<a href="<?=$bUrl?>/kreedz/last/noob/<?=$map?>" <?=($type=="noob" ? 'style="font-weight:bold;"' : '')?>><?=langs('Noob')?></a>
		<a href="<?=$bUrl?>/kreedz/last/all/<?=$map?>"  <?=($type=="all" ? 'style="font-weight:bold;"' : '')?>><?=langs('All')?></a>
	</div>

	<div align="center">
		<? $pages['url'] = "$bUrl/$actionS/$type/page%page%/$map"; ?>
		<? include("generate_page.phps"); ?>
	</div>
			
	<div class="table list">
		<div class="tr title" >
			<div><?=langs('Map')?></div>
			<div><?=langs('Player')?></div>
			<div><?=langs('Time')?></div>
			<div><?=langs('Checkpoints')?></div>
			<div><?=langs('Teleports')?></div>
			<div><?=langs('Weapon')?></div>
		<? if($admin==1): ?>
			<div>#</div>
		<? endif; ?>
		</div>

	<? foreach($maps as $row): ?>
		<div class="tr row">
			<div>
				<i class="icon icon-<?=$row['icon']?> diff-dot" style="color: <?=$row['dcolor']?>;" title="<?=$row['dname']?>"></i>
				<a href="<?=$bUrl?>/kreedz/<?=$row['map']?>/"><?=$row['map']?></a>
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
				<input name="id" type="hidden" value="<?=$row.id?>" />
			</div>
			</form>
		<? endif; ?>
		</div>
	
	<? endforeach; ?>

	</div>
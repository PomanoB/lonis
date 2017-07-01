<div class="wrapper">		
	<div class="titles left_block">
		<?=langs('Records')?> (<?=$total?>)
	</div>
	<div class="right_block">
		<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
	</div>
</div><br><br>

<div class="err_message"><?=$message?></div>

<? $pages['url'] = "$bUrl/kreedz/records/page%page%/$search"; ?>
<? include("generate_page.phps"); ?>

<br>
<div class="table list">
	<div class="tr title">
		<div><?=langs('Map')?></div>
		<div><?=langs('World record')?></div>
		<div><?=langs('Russian record')?><img src="<?=$comm_countryImg?>" /></div>
		<div><?=langs('Server Record')?></div>
	<? if($admin==1): ?>
		<div>#</div>
	<? endif; ?>
	</div>

	<? foreach($maps as $map): ?>
	<div class="tr row">
		<div><a href="<?=$bUrl?>/kreedz/<?=$map['map']?>/"><?=$map['map']?><?=$map['mappath']?></a></div>
		<div><?=$map['wr_time']?> <i><?=$map['wr_player']?></i>
			<? if($map['wr_countryImg']): ?><img src="<?=$map['wr_countryImg']?>" /><? endif; ?>
		</div>
		<div><?=$map['comm_time']?> <i><?=$map['comm_player']?></i></div>
		<div><?=$map['top_time']?> <i><?=$map['top_player']?></i></div>
		
		<? if($admin==1): ?>
		<form action="" method="post">			
		<div>
			<input type="hidden" name="confirm" value="0">
			<input type="checkbox" name="confirm" value="1">
			<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
			<input name="delmap" type="hidden" value="<?=$map['map']?>" />
		</div>
		</form>
		<? endif; ?>			
	</div>

	<? endforeach; ?>
</div>
	<div class="wrapper">		
		<div class="titles left_block">
			<?=langs('Archive')?> (<?=$total?>) 
		</div>
		<div class="right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>

	<div class="err_message"><?=$message?></div>
	
	"$bUrl/kreedz/downloads/page%page%/$search"
	<?=$pages.output?>
	
	<br>
	<div class="table list">
		<div class="tr title">
			<div><?=langs('Map')?></div>
			<div><?=langs('Difficulty')?></div>
			<div><?=langs('Type')?></div>
			<div><?=langs('Authors')?></div>
			<div><?=langs('Date')?></div>
			<div></div>
<? if($admin==1): ?>
			<div>#</div>
<? endif; ?>
		</div>

<? foreach($maps as $map): ?>
		<div class="tr row">
			<div>
				<i class="icon icon-<?=$map['icon']?> diff-dot" style="color: <?=$map['dcolor']?>;" title="<?=$map['dname']?>"></i>
				<a href="<?=$bUrl?>/kreedz/<?=$map['mapname']?>/"><?=$map['mapname']?></a>
			</div>
			<div><?=$map.dname?></div>
			<div><?=$map.type?></div>
			<div><?=$map.authors?></div>
			<div><?=$map.date_old?></div>
			<div>
			<? if($map.download_url?>
				<a class="icon icon-download" href="<?=$bUrl?>/<?=$map['download_url']?>" alt="<?=langs('Download')?> <?=$map['mapname']?>"></a>
			<? endif; ?>
			</div>
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
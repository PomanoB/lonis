<div class="wrapper">
	<div class="titles left_block"><?=langs('Duels')?></div>
	<div class="right_block" align="center">
		<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
	</div>
</div><br><br>

<? $pages['url'] = "$bUrl/kreedz/duels/page%page%"; ?>	
<? include("generate_page.phps"); ?>

<div class="table list">
	<div class="tr title">
		<div><?=langs('Map')?></div>
		<div><?=langs('Winner')?></div>
		<div><?=langs('Looser')?></div>
		<div><?=langs('Winner Point')?></div>
		<div><?=langs('Looser Point')?></div>
	</div>
<? foreach($rows as $duel):?>
	<div class="tr row">
		<div>
			<a href="<?=$bUrl?>/kreedz/<?=$duel['map']?>/"><?=$duel['map']?></a>
		</div>
		<div>
			<a href="<?=$bUrl?>/<?=$duel['winnerName_url']?>/kreedz/"><?=$duel['winnerName']?></a>
		</div>
		<div>
			<a href="<?=$bUrl?>/<?=$duel['looserName_url']?>/kreedz/"><?=$duel['looserName']?></a>
		</div>
		<div class="th_numeric"><?=$duel['winnerPoints']?></div>
		<div class="th_numeric"><?=$duel['looserPoints']?></div>
	</div>
<? endforeach; ?>
</div>
	<div class="wrapper">		
		<div class="titles left_block"><?=langs('Top')?></div>
		<div class=" right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	
	<div style="margin: 0 20px;">
		<? $bold['pro']   = $type=="pro"   ? 'style="font-weight: bold;"' : ''; ?>
		<? $bold['noob']  = $type=="noob"  ? 'style="font-weight: bold;"' : ''; ?>
		<? $bold['all']   = $type=="all"   ? 'style="font-weight: bold;"' : ''; ?>
		<? $bold['total'] = $sort=="all"   ? 'style="font-weight: bold;"' : ''; ?>
		<? $bold['top1']  = $sort=="top1"  ? 'style="font-weight: bold;"' : ''; ?>
		
		<a href="<?=$bUrl?>/kreedz/players/pro/<?=$sort?>/<?=$search?>" <?=$bold['pro']?>> <?=langs('Pro')?></a>
		<a href="<?=$bUrl?>/kreedz/players/noob/<?=$sort?>/<?=$search?>" <?=$bold['noob']?>><?=langs('Noob')?></a>
		<a href="<?=$bUrl?>/kreedz/players/all/<?=$sort?>/<?=$search?>" <?=$bold['all']?>><?=langs('All')?></a>
		::
		<a href="<?=$bUrl?>/kreedz/players/<?=$type?>/all/<?=$search?>" <?=$bold['total']?>><?=langs('Total')?></a>
		<a href="<?=$bUrl?>/kreedz/players/<?=$type?>/top1/<?=$search?>" <?=$bold['top1']?>><?=langs('First')?></a>
	</div>
	<? $pages['url'] = "$bUrl/kreedz/players/$type/page%page%/$sort/$search"; ?>
	<? include("generate_page.phps"); ?>
	
	<div class="table list">
		<div class="tr title">
			<div style="width: 30px; text-align: center">№</div>
			<div><?=langs('Player')?></div>
			<div><?=($sort=="all" ? langs('Total') : langs('First'))?></div>
			<div><?=($sort=="all" ? langs('First') : langs('Total'))?></div>
		</div>
	<? $num = $pages['start']; ?>
	<? foreach($rows as $row): ?>
		<? $num=$num+1; ?>
		<div class="tr row">
			<div style="text-align: center">
				<? if($num<4): ?>
					<i class="icon icon-trophy" style="color: <?=$cup_color[$num]?>;" title="<?=$num?>" alt="<?=$num?>"></i>
				<? else: ?>
					<?=$num?>
				<? endif; ?>
			</div>
			<div><a href="<?=$bUrl?>/<?=url_replace($row['name'])?>/kreedz"><?=$row['name']?></a></div>
			<div><?= $sort=="all" ? $row['all'] : $row['top1'] ?></div>
			<div><?= $sort=="all" ? $row['top1'] : $row['all'] ?></div>
		</div>
	
	<? endforeach; ?>
	</div>
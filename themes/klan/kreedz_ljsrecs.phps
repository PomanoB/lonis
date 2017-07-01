	<div class="titles" align="center">
		<p>.: <?=langs('LJ Records')?> :. 
	</div>
	
	<div class="titles" align="center">:: 
	<? foreach($titles as $k=>$t): ?>
		<? $uline = $comm==$t['name'] ? 'style="text-decoration: underline;"' : '' ?>
		<a href="<?=$bUrl?>/kreedz/ljsrecs/<?=$t['name']?>" <?=$uline?>><?=$t['fullname']?></a> ::
	
	<? endforeach; ?>
	</div>
	
<? foreach($jumps as $j): ?>
	<? if($lasttype!=$j['type']): ?>
	<div class="titles" align="center">
		<p><i><?=$j['type_name']?></i>&nbsp;
		<i class="ljs" style="background-image:url('<?=$bTheme?>/img/ljs/ljs-<?=$j['type']?>.png');" 
			title="<?=$j['type']?>"></i></p>
	</div>
	<? endif; ?>
	
	<div class="table list" style="width: 75%">
	<? if($lasttype!=$j['type']): ?>
	<? $num=0; ?>
		<div class="tr title">
			<div>№</div>
			<div><?=langs('Name')?></div>
			<div><?=langs('Distance')?></div>
			<div><?=langs('Block')?></div>
			<div><?=langs('Prestrafe')?></div>
			<div><?=langs('Speed')?></div>
		</div>
	<? endif; ?>
	<? $lasttype = $j['type'] ?>
		<div class="tr row" align="left">
			<div style="width:5%;">
			<? if(++$num<4): ?>
				<i class="icon icon-trophy" style="color: <?=$cup_color[$num]?>;" title="<?=$num?>" alt="<?=$num?>"></i>
			<? else: ?>
				<?=$num?>
			<? endif; ?>
			</div>
			<div style="width:35%;"><?=$j['plname']?></div>
			<div style="width:15%;"><?=$j['distance']?></div>
			<div style="width:15%;"><?=$j['block']?></div>
			<div style="width:15%;"><?=$j['prestrafe']?></div>
			<div style="width:15%;"><?=$j['speed']?></div>	
		</div>
	</div>

<? endforeach; ?>
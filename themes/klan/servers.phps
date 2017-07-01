	<div class="wrapper">		
		<div class="titles left_block">
			<?=langs('Servers')?>
		</div>
		<div class="right_block">
			<div id="search">
				<form action="" method="post">
					<input type="text" name="addr" value="<? if(isset($addr)): ?><?=$addr?><? endif; ?>" placeholder="<?=langs('Check IP')?>" />
					<button title="<?=langs('Check IP')?>" alt="<?=langs('Check IP')?>"/>
				</form>
			</div>
		</div>
	</div><br><br>
	
<? if($addr && $addr!="vip"): ?>
	<p><div class="titles" align="center"><?=$addr?></div></p>
	<? if(isset($sconn)): ?>
		<p><div style="font-size: 2em; color: red;" align="center"><?=langs('Server Not Found')?></div>
	<? else: ?>
		<div style="margin: 0 40% 15px; ">
			<div class="map_image" style="background-image: url(<?=$bTheme?>/img/cstrike/<?=$info['map']?>.jpg);">&nbsp;</div>
			<i class="icon icon-image" style="font-size: 9em; color: grey; padding: 0 15px;"></i><br>
		</div>
		<div id="servers" class="table">
			<div class="tr">
			<div>
				<div class="table list">
					<div class="tr">
						<div class="title"><?=langs('IP')?></div><div><?=$info['ip']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Name')?></div><div><?=$info['name']?></div></div>
					<div class="tr">
						<div class="title"><?=langs('Map')?></div><div><?=$info['map']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Mod')?></div><div><?=$info['mod']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Descriptor')?></div><div><?=$info['descriptor']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Players')?></div><div><?=$info['players']?> / <?=$info['max_players']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Type')?></div><div><?=$info['type']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('OS')?></div><div><?=$info['os']?></div>
					</div>
					<div class="tr">
						<div class="title"><?=langs('Bots')?></div><div><?=$info['bots']?></div>
					</div>
				</div>
			</div>
			
			<div>
				<div class="table list">
					<div class="tr" >
						<div style="width: 200px"><b><?=langs('Player')?></b></div>
						<div><b><?=langs('Frags')?></b></div>
					</div>
			<? if($players): ?>
				<? foreach($players as $plr): ?>
					<div class="tr">
						<div><?=$plr['name']?></div>
						<div><?=$plr['frag']?></div>
					</div>
				<? endforeach; ?>
			<? endif; ?>
				</div>
			</div>
			</div>
		</server>
	<? endif; ?>
<? else: ?>
	<? $pages['url'] = "$bUrl/servers/$addr"; ?>
	<? include("generate_page.phps"); ?>
	
	<div class="table list">
		<div class="tr title">
			<div><?=langs('Name')?></div>
			<div><?=langs('Type')?></div>
			<div><?=langs('IP')?></div>
			<div><?=langs('Map')?></div>
			<div><?=langs('Players')?></div>
			<div><?=langs('Time')?></div>
		<? if($admin): ?>
			<div></div>
		<? endif; ?>
		</div>
	<? foreach($servers as $row): ?>
		<div class="tr row">
			<div><? if($row['vip']==1): ?><i class="icon icon-star" style="color: gold;" title="VIP" alt="VIP"/></i> <? endif; ?><?=$row['name']?></div>			
			<div><?=$row['modname']?></div>
			<div><a href='<?=$bUrl?>/servers/<?=$row['addres']?>'><b><?=$row['addres']?></b></a></div>
			<div><?=$row['map']?></div>			
			<div><? if($row['max_players']): ?><?=$row['players']?> / <?=$row['max_players']?><? endif; ?></div>
			<div><i><?=$row['updatef']?></i></div>
		</div>
	
	<? endforeach; ?>
	</div>
<? endif; ?>
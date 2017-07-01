<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block"><?=langs('Players')?></div>
		<div class=" right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	<? $pages['url'] = "$bUrl/admin/players/page%page%/$search"; ?>			
	<? include("generate_page.phps"); ?>
				
	<div class="error_message"><?=$message?></div>
	
	<div class="table list" id="admin_players">
		<form class="tr row" action="" method="post" name="achiev_admin">
			<div style="width: 20%"><input class="bigform" name="name" type="text" /></div>
			<div style="width: 20%"><input class="bigform" name="password" type="text" /></div>
			<div style="width: 20%"><input class="bigform" name="email" type="text" /></div>
			<div align="center"><input name="active" type="checkbox"/></div>
			<div align="center"><input name="webadmin" type="checkbox"/></div>
			<div align="center"><button class="icon icon-plus" name="act" value="add" title="<?=langs('Add')?>"></button></div>
		</form>
		<div class="tr title">
			<div><?=langs('Player')?></div>
			<div><?=langs('Password')?></div>
			<div><?=langs('E-mail')?></div>
			<div><?=langs('Active')?></div>
			<div><?=langs('Admin')?></div>
			<div>#</div>
		</div>
		
	<? foreach($players as $player): ?>
		<form class="tr row" action="" method="post" name="achiev_admin">
			<div><input class="bigform" name="name" type="text" value="<?=$player['name']?>"/></div>
			<div><input class="bigform" name="password" type="text" /></div>
			<div><input class="bigform" name="email" type="text" value="<?=$player['email']?>"/></div>
			<div align="center"><input name="active" type="checkbox" <? if($player['active']==1): ?>checked<? endif; ?>/></div>
			<div align="center"><input name="webadmin" type="checkbox" <? if($player['webadmin']==1): ?>checked<? endif; ?>/></div>
			
			<div align="center">
				<button class="icon icon-pencil2" name="act" value="edit" title="<?=langs('Update')?>"></button>
				<input type="hidden" name="confirm" value="0" />
				<input type="checkbox" name="confirm" value="1" />
				<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
				<input name="id" type="hidden" value="<?=$player['id']?>" />
			</div>
		</form>
	
	<? endforeach; ?>
	</div>
</div>
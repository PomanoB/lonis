<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block"><?=langs('Players')?></div>
		<div class=" right_block">
			<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
		</div>
	</div><br><br>
	<? $pages['url'] = "{$bUrl}/admin/langs/page%page%/{$search}"; ?>			
	<? include("generate_page.phps"); ?>
	
	<div class="error_message"><?=$message?></div>
		
	<div class="table list" id="admin_servers" width="80%">
		<form class="tr row" action="" method="post">
			<div>
				<select class="bigform" name="mod" class="mod">
				<? foreach($mod as $modd): ?>
					<option class="bigform" value="<?=$modd['mid']?>"><?=$modd['modname']?></option>
				<? endforeach; ?>
				</select>
			</div>
			<div><input class="bigform" name="addres" type="text" class="col_addres"/></div>
			<div><input class="bigform" name="name" type="text" class="col_addres"/></div>
			<div><button class="icon icon-plus" name="act" value="add" title="<?=langs('Add')?>"></button></div>
		</form>
		<div class="tr title">
			<div><?=langs('Type')?></div>
			<div><?=langs('IP')?></div>
			<div><?=langs('Name')?></div>
			<div></div>
		</div>
		
		<? foreach($servers as $server): ?>
		<form class="tr row" action="" method="post">
			<div>
				<select class="bigform" >
				<? foreach($mod as $modd): ?>
					<option class="bigform" value="<?=$modd['mid']?>" <? if($server['mod']==$modd['mid']): ?>selected<? endif; ?>><?=$modd['modname']?></option>
				<? endforeach; ?>
				</select>
			</div>
			<div><input class="bigform" value="<?=$server['addres']?>" name="addres" type="text" class="col_addres" /></div>
			<div><input class="bigform" value="<?=$server['name']?>" name="name" type="text" class="col_addres" /></div>
			<div>
				<button class="icon icon-pencil2" name="act" value="edit" title="<?=langs('Update')?>"></button>
				<input type="hidden" name="confirm" value="0" />
				<input type="checkbox" name="confirm" value="1" />
				<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
				<input name="id" type="hidden" value="<?=$server['id']?>" />
			</div>
		</form>
		<? endforeach; ?>
	</div>
</div>
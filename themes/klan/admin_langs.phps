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
			
	<div id="lang" class="table list" width="80%">
		<form class="tr row" action="#<?=langs('var')?>" method="post">	
			<div class="">
				<select class="bigform" name="langkey">
				<? foreach($lang_list as $l): ?>
					<option value="<?=$l?>"><?=$l?></option>
				<? endforeach; ?>
				</select>
			</div>
			<div><input class="bigform" name="var" type="text" /></div>
			<div><input class="bigform" name="value" type="text" /></div>
			<div><button class="icon icon-plus" name="act" value="add" title="<?=langs('Add')?>"></button></div>
		</form>
		
		<div class="tr title">
			<div><?=langs('Lang')?></div>
			<div><?=langs('Var')?></div>
			<div><?=langs('Value')?></div>
			<div></div>
		</div>		
		
		<? foreach($rows as $row): ?>
		<form class="tr row" action="" method="post">
			<div class="">
				<select class="bigform" name="langkey">
				<? foreach($lang_list as $l): ?>
					<option value="<?=$l?>" <? if($l==$row['lang']): ?>selected<? endif; ?>><?=$l?></option>
				<? endforeach; ?>
				</select>
			</div>
			<div><input class="bigform" name="var" type="text" value="<?=$row['var']?>"/></div>
			<div><input class="bigform" name="value" type="text" value="<?=$row['value']?>"/></div>
			<div>
				<button class="icon icon-pencil2" name="act" value="edit" title="<?=langs('Update')?>"></button>
				<input type="hidden" name="confirm" value="0" />
				<input type="checkbox" name="confirm" value="1" />
				<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
				<input name="id" type="hidden" value="<?=$row['id']?>" />
			</div>
		</form>
		<? endforeach; ?>
		
	</div>						
		</div>
	</div>
</div>





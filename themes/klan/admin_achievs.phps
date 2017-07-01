<div class="titles" align="center"><?=langs('Achievs')?></div>
<div class="error_message"><?=$message?></div>
	
<div class="tabs">
   <input type="radio" id="tab-1" name="tab-group-achiev" checked>
	<label for="tab-1"><strong><?=langs('Achievs')?></strong></label>
	::	
   <input type="radio" id="tab-2" name="tab-group-achiev">
	<label for="tab-2"><strong><?=langs('Language')?></strong></label>
	
	<div>
		<div class="table list" id="achiev_admin">
			<form class="tr row" action="" method="post">
				<div width="250px;"><input class="bigform" name="type" type="text" class="col_type"/></div>
				<div width="150px;"><input class="bigform" name="count" type="text" class="col_count"/></div>
				<div><button class="icon icon-plus" name="act" value="add" title="<?=langs('Add')?>"></button></div>
			</form>
		
			<div class="tr title">
				<div><?=langs('Var')?></div>
				<div><?=langs('Count')?></div>
				<div>#</div>
			</div>
			
			<? foreach($achievs as $achiev): ?>
			<form class="tr row" action="" method="post">
				<div><input class="bigform" value="<?=$achiev['type']?>" name="type" type="text" class="col_type" /></div>
				<div><input class="bigform" value="<?=$achiev['count']?>" name="count" type="text" class="col_count" /></div>
				<div >
					<button class="icon icon-pencil2" name="act" value="edit" title="<?=langs('Update')?>"></button>
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<button class="icon icon-bin" name="act" value="delete" title="<?=langs('Delete')?>"></button>
					<input name="id" type="hidden" value="<?=$achiev['id']?>" />
				</div>
			</form>
			<? endforeach; ?>
		
		</div>
	</div>
	
	<div>
		<div class="table list">
			<div class="tr title">
				<div><?=langs('Type')?></div>
				<div><?=langs('Description')?></div>
				<div><?=langs('Language')?></div>
				<div>#</div>
			</div>		
		
			<? foreach($achievs_lang as $alang): ?>
				<div><? if($alang['part']):?><? else: ?><?=$alang['type']?> (<?=$alang['count']?>)<? endif; ?></div>
				<form id="<?=$alang['type']?>" class="tr row" action="#<?=$alang.type?>" method="post">
					

					<div>
						
						<input class="bigform" value="<?=$alang['name']?>" name="name" type="text" class="col_name" />
					</div>
					<div>
						<input class="bigform" value="<?=$alang['desc']?>" name="desc" type="text" class="col_desc" />
					</div>
					<div><? if($alang['part2']): ?>&nbsp;<? else: ?><?=$alang['lang']?><? endif; ?></div>
					<div >
						<button class="icon icon-pencil2" name="act" value="edit" title="<?=langs('Update')?>"></button>
						<input name="lid" type="hidden" value="<?=$alang['lid']?>" />
					</div>
				</form>
			<? endforeach; ?>	
		
		</div>
	</div>
</div>
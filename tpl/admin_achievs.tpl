		<div class="titles" align="center">{langs('Achievs')}</div>
		<div class="error_message">{$message}</div>
			
		<div class="tabs">
		   <input type="radio" id="tab-1" name="tab-group-achiev" checked>
			<label for="tab-1"><strong>{langs('Achievs')}</strong></label>
			::	
		   <input type="radio" id="tab-2" name="tab-group-achiev">
			<label for="tab-2"><strong>{langs('Language')}</strong></label>
			
			<div>
				<div id="achiev_admin">
				<form action="" method="post">
					<div>
						<div width="250px;"><input class="bigform" name="type" type="text" class="col_type"/></div>
						<div width="150px;"><input class="bigform" name="count" type="text" class="col_count"/></div>
						<div><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></div>
					</div>
				</form>
				
					<div class="tr title">
						<div>{langs('Var')}</div>
						<div>{langs('Count')}</div>
						<div>#</div>
					</div>
					
{foreach from=$achievs item=achiev}
				<form action="" method="post">
					<div>
						<div><input class="bigform" value="{$achiev.type}" name="type" type="text" class="col_type" /></div>
						<div><input class="bigform" value="{$achiev.count}" name="count" type="text" class="col_count" /></div>
						<div >
							<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
							<input type="hidden" name="confirm" value="0" />
							<input type="checkbox" name="confirm" value="1" />
							<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
							<input name="id" type="hidden" value="{$achiev.id}" />
						</div>
					</div>
				</form>
{foreachelse}
{/foreach}
				</div>
			</div>
			
			<div>
				<div class="table list">
					<div class="tr title">
						<div width="200px">{langs('Name')}</div>
						<div>{langs('Language')}</div>
						<div>{langs('Type')}</div>
						<div>{langs('Description')}</div>
						<div>#</div>
					</div>		
{foreach from=$achievs_lang item=alang}
				<form action="#{$alang.type}" method="post">
					{if $alang.hr}<div><div colspan=5><hr></div></div>{/if}
					<div id="{$alang.type}">
						<div align="right">{if $alang.part}&nbsp;{else}{$alang.type} ({$alang.count}){/if}</div>
						<div>{if $alang.part2}&nbsp;{else}{$alang.lang}{/if}</div>
						<div>
							<input class="bigform" value="{$alang.name}" name="name" type="text" class="col_name" />
						</div>
						<div>
							<input class="bigform" value="{$alang.desc}" name="desc" type="text" class="col_desc" />
						</div>
						<div >
							<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
							<input name="lid" type="hidden" value="{$alang.lid}" />
						</div>
					</div>
				</form>
{foreachelse}
{/foreach}	
				</div>
			</div>
		</div>
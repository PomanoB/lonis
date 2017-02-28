		<div class="titles" align="center">{$langs.admin_achievs}</div>
		<div class="error_message">{$message}</div>
			
		<div class="tabs">
		   <input type="radio" id="tab-1" name="tab-group-achiev" checked>
			<label for="tab-1"><strong>{$langs.achievs}</strong></label>
			::	
		   <input type="radio" id="tab-2" name="tab-group-achiev">
			<label for="tab-2"><strong>{$langs.Language}</strong></label>
			
			<div>
				<table id="achiev_admin" width="50%">
				<form action="" method="post">
					<tr>
						<td><input class="bigform" name="type" type="text" class="col_type"/></td>
						<td><input class="bigform" name="count" type="text" class="col_count"/></td>

						<td>
							<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langs.Add}">
						</td>
					</tr>
				</form>
				
					<tr class="title">
						<td>{$langs.Var}</td>
						<td>{$langs.Count}</td>
						<td>#</td>
					</tr>
					
{foreach from=$achievs item=achiev}
				<form action="" method="post">
					<tr>
						<td><input class="bigform" value="{$achiev.type}" name="type" type="text" class="col_type" /></td>
						<td><input class="bigform" value="{$achiev.count}" name="count" type="text" class="col_count" /></td>
						<td >
							<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langs.Update}">
							<input type="hidden" name="confirm" value="0" />
							<input type="checkbox" name="confirm" value="1" />
							<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langs.Delete}">
							<input name="id" type="hidden" value="{$achiev.id}" />
						</td>
					</tr>
				</form>
{/foreach}
				</table>
			</div>
			
			<div>
				<table class="table-list">
					<tr class="title">
						<td width="200px">{$langs.Name}</td>
						<td>{$langs.Language}</td>
						<td>{$langs.Type}</td>
						<td>{$langs.Description}</td>
						<td>#</td>
					</tr>		
{foreach from=$achievs_lang item=alang}
				<form action="#{$alang.type}" method="post">
					{if $alang.hr}<tr><td colspan=5><hr></td></tr>{/if}
					<tr id="{$alang.type}">
						<td align="right">{if $alang.part}&nbsp;{else}{$alang.type} ({$alang.count}){/if}</td>
						<td>{if $alang.part2}&nbsp;{else}{$alang.lang}{/if}</td>
						<td>
							<input class="bigform" value="{$alang.name}" name="name" type="text" class="col_name" />
						</td>
						<td>
							<input class="bigform" value="{$alang.desc}" name="desc" type="text" class="col_desc" />
						</td>
						<td >
							<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="editlang" alt="{$langs.Update}">
							<input name="lid" type="hidden" value="{$alang.lid}" />
						</td>
					</tr>
				</form>
{/foreach}	
				</table>
			</div>
		</div>
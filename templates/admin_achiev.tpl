		<div class="title">{$lang_admin_achiev}</div>
		<div class="error_message">{$message}</div>
			
		<div class="tabs">
		   <input type="radio" id="tab-1" name="tab-group-achiev" checked>
			<label for="tab-1"><strong>{$lang_achiev}</strong></label>
			::
		   <input type="radio" id="tab-2" name="tab-group-achiev">
			<label for="tab-2"><strong>{$langLanguage}</strong></label>
			
			<div>
				<table id="achiev_admin">
				<form action="{$baseUrl}/admin/achiev/" method="post">
					<tr class="title">
						<td>{$langType}</td>
						<td>{$langCount}</td>
					</tr>
					<tr>
						<td><input name="type" type="text" class="col_type"/></td>
						<td><input name="count" type="text" class="col_count"/></td>

						<td>
							<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langAdd}">
						</td>
					</tr>
				</form>
				</table>
				<br>
				
				<table id="achiev_admin">
					<tr class="title">
						<td>{$langType}</td>
						<td>{$langCount}</td>
						<td>{$langName}</td>
						<td>{$langDescription}</td>
						<td>#</td>
					</tr>
{foreach from=$achievs item=achiev}
				<form action="{$baseUrl}/admin/achiev/" method="post">
					<tr>
						<td><input value="{$achiev.type}" name="type" type="text" class="col_type" /></td>
						<td><input value="{$achiev.count}" name="count" type="text" class="col_count" /></td>
						<td><input value="{$achiev.name}" name="name" type="text" class="col_name" disabled /></td>
						<td><input value="{$achiev.description}" name="descr" type="text" class="col_descr" disabled /></td>
						
						
						<td >
							<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langUpdate}">
							<input type="hidden" name="confirm" value="0" />
							<input type="checkbox" name="confirm" value="1" />
							<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langDelete}">
							<input name="id" type="hidden" value="{$achiev.id}" />
						</td>
					</tr>
				</form>
{/foreach}
				</table>
			</div>
			
			<div>
				<table id="admin_achiev_lang">
					<tr class="title">
						<td>{$langName}</td>
						<td>{$langLanguage}</td>
						<td>{$langType}</td>
						<td>{$langDescription}</td>
						<td>#</td>
					</tr>		
{foreach from=$achievs_lang item=alang}
				<form action="{$baseUrl}/admin/achiev/#{$alang.type}" method="post">
					{if $alang.hr}<tr><td colspan=5><hr></td></tr>{/if}
					<tr id="{$alang.type}">
						<td align="right">{if $alang.part}&nbsp;{else}{$alang.type} ({$alang.count}){/if}</td>
						<td>{if $alang.part2}&nbsp;{else}{$alang.lang}{/if}</td>
						<td align="right">{$alang.ltype}</td>
						<td><input value="{$alang.value}" name="value" type="text" class="col_desc" /></td>
						<td >
							<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="editlang" alt="{$langUpdate}">
							<input name="lid" type="hidden" value="{$alang.lid}" />
						</td>
					</tr>
				</form>
{/foreach}	
				</table>
			</div>
		</div>
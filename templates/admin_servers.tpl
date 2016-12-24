		<div class="title">{$lang_admin_servers}</div>
		<div class="error_message">{$message}</div>
			
		<table id="admin_servers">
		<form action="{$baseUrl}/admin_servers/" method="post">
			<tr>
				<td><input name="name" type="text" class="col_name"/></td>
				<td><input name="addres" type="text" class="col_addres"/></td>
				<td>
					<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langAdd}">
				</td>
			</tr>
		</form>
			<tr class="title">
				<td>{$langName}</td>
				<td>{$langIP}</td>
				<td>#</td>
			</tr>
{foreach from=$servers item=server}
		<form action="{$baseUrl}/admin_servers/" method="post">
			<tr>
				<td><input value="{$server.name}" name="name" type="text" class="col_name" /></td>
				<td><input value="{$server.addres}" name="addres" type="text" class="col_addres" /></td>
				<td >
					<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langUpdate}">
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langDelete}">
					<input name="id" type="hidden" value="{$server.id}" />
				</td>
			</tr>
		</form>
{/foreach}
		</table>
		<br>
		
		<table id="admin_servers">
			<tr class="title">
				<td>{$langName}</td>
				<td>{$langLanguage}</td>
				<td>{$langDescription}</td>
			</tr>		
{foreach from=$servers_lang item=slang}
		<form action="{$baseUrl}/admin_servers/" method="post">
			<tr>
				<td>{if $slang.part}&nbsp;{else}{$slang.name}{/if}</td>
				<td>{$slang.lang}</td>
				<td><input value="{$slang.desc}" name="desc" type="text" class="col_desc" /></td>
				<td >
					<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="editlang" alt="{$langUpdate}">
					<input name="lid" type="hidden" value="{$slang.lid}" />
				</td>
			</tr>
		</form>
{/foreach}	
		</table>
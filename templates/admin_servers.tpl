		<div class="titles" align="center">{$langs.admin_servers}</div>
		<div class="error_message">{$message}</div>
			
		<table id="admin_servers" width="80%">
		<form action="" method="post">
			<tr>
				<td>
					<select class="bigform" name="mod" class="mod">
					{foreach from=$mod item=modd}
						<option class="bigform" value="{$modd.mid}">{$modd.modname}</option>
					{/foreach}
					</select>
				</td>
				<td><input class="bigform" name="addres" type="text" class="col_addres"/></td>
				<td><input class="bigform" name="name" type="text" class="col_addres"/></td>
				<td align="center">
					<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langs.Add}">
				</td>
			</tr>
		</form>
			<tr class="title">
				<td>{$langs.Type}</td>
				<td>{$langs.IP}</td>
				<td>{$langs.Name}</td>
				<td>#</td>
			</tr>
{foreach from=$servers item=server}
		<form action="" method="post">
			<tr>
				<td>
					<select class="bigform" >
					{foreach from=$mod item=modd}
						<option class="bigform" value="{$modd.mid}" {if $server.mod==$modd.mid}selected{/if}>{$modd.modname}</option>
					{/foreach}
					</select>
				</td>
				<td><input class="bigform" value="{$server.addres}" name="addres" type="text" class="col_addres" /></td>
				<td><input class="bigform" value="{$server.name}" name="name" type="text" class="col_addres" /></td>
				<td align="center">
					<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langs.Update}">
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langs.Delete}">
					<input name="id" type="hidden" value="{$server.id}" />
				</td>
			</tr>
		</form>
{/foreach}
		</table>
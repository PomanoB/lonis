<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
			
	{$pages.output}
	
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
			<td><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></td>
		</tr>
	</form>
		<tr class="title">
			<td>{langs('Type')}</td>
			<td>{langs('IP')}</td>
			<td>{langs('Name')}</td>
			<td></td>
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
			<td>
				<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
				<input type="hidden" name="confirm" value="0" />
				<input type="checkbox" name="confirm" value="1" />
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="id" type="hidden" value="{$row.id}" />
			</td>
		</tr>
	</form>
{/foreach}
	</table>
</div>
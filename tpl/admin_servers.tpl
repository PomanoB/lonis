<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
			
	{$pages.output}
	
	<div class="error_message">{$message}</div>
		
	<div id="admin_servers" width="80%">
	<form action="" method="post">
		<div>
			<div>
				<select class="bigform" name="mod" class="mod">
				{foreach from=$mod item=modd}
					<option class="bigform" value="{$modd.mid}">{$modd.modname}</option>
				{/foreach}
				</select>
			</div>
			<div><input class="bigform" name="addres" type="text" class="col_addres"/></div>
			<div><input class="bigform" name="name" type="text" class="col_addres"/></div>
			<div><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></div>
		</div>
	</form>
		<div class="tr title">
			<div>{langs('Type')}</div>
			<div>{langs('IP')}</div>
			<div>{langs('Name')}</div>
			<div></div>
		</div>
{foreach from=$servers item=server}
	<form action="" method="post">
		<div>
			<div>
				<select class="bigform" >
				{foreach from=$mod item=modd}
					<option class="bigform" value="{$modd.mid}" {if $server.mod==$modd.mid}selected{/if}>{$modd.modname}</option>
				{/foreach}
				</select>
			</div>
			<div><input class="bigform" value="{$server.addres}" name="addres" type="text" class="col_addres" /></div>
			<div><input class="bigform" value="{$server.name}" name="name" type="text" class="col_addres" /></div>
			<div>
				<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
				<input type="hidden" name="confirm" value="0" />
				<input type="checkbox" name="confirm" value="1" />
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="id" type="hidden" value="{$row.id}" />
			</div>
		</div>
	</form>
{foreachelse}
{/foreach}
	</div>
</div>
<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
			
	{$pages.output}
				
	<div class="error_message">{$message}</div>
	
	<div>
		<table class="table-list" id="admin_players">
		<form action="" method="post" name="achiev_admin">
			<tr>
				<td><input class="bigform " name="name" type="text" /></td>
				<td><input class="bigform " name="password" type="text" /></td>
				<td><input class="bigform " name="email" type="text" /></td>
				<td align="center"><input name="active" type="checkbox"/></td>
				<td align="center"><input name="webadmin" type="checkbox"/></td>
				<td  align="center"><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></td>
			</tr>
		</form>
			<tr class="title">
				<td>{langs('Player')}</td>
				<td>{langs('Password')}</td>
				<td>{langs('E-mail')}</td>
				<td>{langs('Active')}</td>
				<td>{langs('Admin')}</td>
				<td>#</td>
			</tr>
		{foreach from=$players item=player}
			<form action="" method="post" name="achiev_admin">
			<tr class="list">
				<td><input class="bigform " name="name" type="text" value="{$player.name}"/></td>
				<td><input class="bigform " name="password" type="text" /></td>
				<td><input class="bigform " name="email" type="text" value="{$player.email}"/></td>
				<td align="center"><input name="active" type="checkbox" {if $player.active==1}checked{/if}/></td>
				<td align="center"><input name="webadmin" type="checkbox" {if $player.webadmin==1}checked{/if}/></td>
				
				<td align="center">
					<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
					<input name="id" type="hidden" value="{$player.id}" />
				</td>
			</tr>
			</form>
		{/foreach}
		</table>
	</div>
</div>
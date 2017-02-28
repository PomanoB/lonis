<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block">{$langs.players}</div>
{if !$cs}
		<div class=" right_block">
			{$form_search}
		</div>
{/if}
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
				
				<td align="center">
					<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langs.Add}">
				</td>
			</tr>
		</form>
			<tr class="title">
				<td>{$langs.player}</td>
				<td>{$langs.Password}</td>
				<td>{$langs.Email}</td>
				<td>{$langs.Active}</td>
				<td>{$langs.Admin}</td>
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
					<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langs.Update}">
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langs.Delete}">
					<input name="id" type="hidden" value="{$player.id}" />

				</td>
			</tr>
			</form>
		{/foreach}
		</table>
	</div>
</div>
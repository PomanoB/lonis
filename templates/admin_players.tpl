<div align="center">		
	<p><div class="titles">{$langs.players}</div></p>
{if !$cs}
	<div class="">
		<form action="" method="post">
			<input type="text" name="search" id="search" class="form" {if isset($search)}value="{$search}"{/if} placeholder="{$langs.Search}" />
			<input type="image" name="picture" src="{$baseUrl}/img/find.png" />
			&nbsp;
		</form>
	</div>
{/if}
	
	<p>&nbsp;{$pages.output}
				
	<div class="error_message">{$message}</div>
	
	<div>
		<table id="admin_players">
			<form action="" method="post" name="achiev_admin">
			<tr>
				<td><input name="name" type="text" class="col1" /></td>
				<td><input name="password" type="text" class="col2" /></td>
				<td><input name="email" type="text" class="col3" /></td>
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
				<td><input name="name" type="text" class="col1" value="{$player.name}"/></td>
				<td><input name="password" type="text" class="col2" /></td>
				<td><input name="email" type="text" class="col3" value="{$player.email}"/></td>
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
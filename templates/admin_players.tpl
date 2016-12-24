			<div class="wrapper">		
				<div class="titles left_block">{$lang_players}</div>
		{if !isset($cs)}
				<div class=" right_block">
					<form action="{$baseUrl}/admin_players/page{$page}" method="post">
						<input type="text" name="search" id="search" class="form" {if isset($search)}value="{$search}"{/if} placeholder="{$langSearch}" />
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" />
						&nbsp;
					</form>
				</div>
		{/if}
			</div><br>
			
			<p><center>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}</center>
						
			<p><div class="error_message">{$message}</div>
			
			<div>
				<table id="admin_players">
					<form action="{$baseUrl}/admin_players/page{$page}" method="post" name="achiev_admin">
					<tr>
						<td><input name="name" type="text" class="col1" /></td>
						<td><input name="password" type="text" class="col2" /></td>
						<td><input name="email" type="text" class="col3" /></td>
						<td align="center"><input name="active" type="checkbox"/></td>
						<td align="center"><input name="webadmin" type="checkbox"/></td>
						
						<td align="center">
							<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langAdd}">
						</td>
					</tr>
				</form>
					<tr class="title">
						<td>{$langPlayer}</td>
						<td>{$langPassword}</td>
						<td>{$langEmail}</td>
						<td>{$langActive}</td>
						<td>{$langAdmin}</td>
						<td>#</td>
					</tr>
				{foreach from=$players item=player}
					<form action="{$baseUrl}/admin_players/page{$page}" method="post" name="achiev_admin">
					<tr class="list">
						<td><input name="name" type="text" class="col1" value="{$player.name}"/></td>
						<td><input name="password" type="text" class="col2" /></td>
						<td><input name="email" type="text" class="col3" value="{$player.email}"/></td>
						<td align="center"><input name="active" type="checkbox" {if $player.active==1}checked{/if}/></td>
						<td align="center"><input name="webadmin" type="checkbox" {if $player.webadmin==1}checked{/if}/></td>
						
						<td align="center">
							<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langUpdate}">
							<input type="hidden" name="confirm" value="0" />
							<input type="checkbox" name="confirm" value="1" />
							<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langDelete}">
							<input name="id" type="hidden" value="{$player.id}" />

						</td>
					</tr>
					</form>
				{/foreach}
				</table>
			</div>
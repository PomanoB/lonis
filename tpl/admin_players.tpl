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
		<div class="table list" id="admin_players">
		<form action="" method="post" name="achiev_admin">
			<div>
				<div><input class="bigform " name="name" type="text" /></div>
				<div><input class="bigform " name="password" type="text" /></div>
				<div><input class="bigform " name="email" type="text" /></div>
				<div align="center"><input name="active" type="checkbox"/></div>
				<div align="center"><input name="webadmin" type="checkbox"/></div>
				<div  align="center"><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></div>
			</div>
		</form>
			<div class="tr title">
				<div>{langs('Player')}</div>
				<div>{langs('Password')}</div>
				<div>{langs('E-mail')}</div>
				<div>{langs('Active')}</div>
				<div>{langs('Admin')}</div>
				<div>#</div>
			</div>
		{foreach from=$players item=player}
			<form action="" method="post" name="achiev_admin">
			<div class="tr row">
				<div><input class="bigform " name="name" type="text" value="{$player.name}"/></div>
				<div><input class="bigform " name="password" type="text" /></div>
				<div><input class="bigform " name="email" type="text" value="{$player.email}"/></div>
				<div align="center"><input name="active" type="checkbox" {if $player.active==1}checked{/if}/></div>
				<div align="center"><input name="webadmin" type="checkbox" {if $player.webadmin==1}checked{/if}/></div>
				
				<div align="center">
					<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
					<input type="hidden" name="confirm" value="0" />
					<input type="checkbox" name="confirm" value="1" />
					<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
					<input name="id" type="hidden" value="{$player.id}" />
				</div>
			</div>
			</form>
		{foreachelse}
		{/foreach}
		</div>
	</div>
</div>
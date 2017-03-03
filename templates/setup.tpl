	<div class="title">
		{langs('Setting')} :: 
		{if isset($_SESSION.setting_user)}<a href="{$baseUrl}/setup/logout">{langs('Logout')}</a>{else}{langs('Login')}{/if} 
	</div>
	{if isset($message)}<div class="setup_message">{$message}</div>{/if}
		

{if isset($_SESSION.setting_user)}
	<div align="center">
		<div id="setup">
		  <form action="" method="post">
			<table class="form_login">
	{if isset($conflist)}
	{foreach from=$conflist item=conf}
				<tr>
					<td class="info">
						<label {if $conf.err}style="color: red;"{/if} for="{$conf.name}">{$conf.desc}</label>
					</td>
					<td>
						<input size="30" type="text" class="form_login" name="fld_{$conf.name}" id="{$conf.name}" value="{$conf.text}"/>
					</td>
				</tr>
	{/foreach}
	{/if}
			</table>
			
			<div id="">
				<button name="act" value="save">{langs('Save')}</button> <button name="act" value="reset">{langs('Reset to default')}</button>
			</div>
		  </form>		
		</div>

		<div id="db">	
		  <form action="#db" method="post">		
	{if $conn}
			<div class="message">{langs('Not connection to database')}</div>
	{else}
		{if !$base}
			<button name="act" value="dbadd">{langs('Create')}</button>
		{else}
			<div id="confirmed">
				<label for="confirm_password">{langs('Password')}</label>
				<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
			</div>
			
			<button name="act" value="dbdelete">{langs('Delete')}</button>
		{/if}
		  </form>
		 </div>
	{/if}
	</div>
</div>
{else}
	<div class="login">
	  <form action="" method="post">
		<table class="form_login">
			<tr>
				<td class="info"><label for="setting_user">{langs('Name')}</label></td>
				<td><input type="text" class="bigform" name="setting_user" id="setting_user" /></td>
			</tr>
			<tr>
				<td class="info"><label for="setting_password">{langs('Password')}</label></td>
				<td><input type="password" class="bigform" name="setting_password" id="setting_password" /></td>
			</tr>
		</table>
		<div class="login">
			<button name="acts" value="login">{langs('Login')}</button>
		</div>
		<p><a href="{$baseUrl}">{langs('Home')}</a>
	  </form>
	</div>
{/if}
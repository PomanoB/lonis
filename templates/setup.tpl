	<div class="title">
		{$langs.DbTitle} :: 
		{if isset($act)}<a href="{$baseUrl}/setup/logout">{$langs.logout}</a>{else}{$langs.login}{/if} 
	</div>
	{if isset($message.setting)}<div class="setup_message">{$message.setting}</div>{/if}
		
{if !isset($act)}
	<div class="login">
	  <form action="" method="post">
		<table class="form_login">
			<tr>
				<td class="info"><label for="setting_user">{$langs.Name}</label></td>
				<td><input type="text" class="bigform" name="setting_user" id="setting_user" /></td>
			</tr>
			<tr>
				<td class="info"><label for="setting_password">{$langs.Password}</label></td>
				<td><input type="password" class="bigform" name="setting_password" id="setting_password" /></td>
			</tr>
		</table>
		<div class="login">
			<button>{$langs.login}</button>
		</div>
	  </form>
	</div>
{else}
	<div align="center">
		<div id="setup">
		  <form action="" method="post">
			<table class="form_login">
	{foreach from=$conflist item=conf}
				<tr>
					<td class="info">
						<label {if $conf.err}style="color: red;"{/if} for="{$conf.name}">{$conf.desc}</label>
					</td>
					<td>
						<input size="40" type="text" class="form_login" name="fld_{$conf.name}" id="{$conf.name}" value="{$conf.text}"/>
					</td>
				</tr>
	{/foreach}
			</table>
			
			<div id="">
				<button name="act" value="save">{$langs.Save}</button> <button name="act" value="reset">{$langs.ResetDef}</button>
			</div>
		  </form>		
		</div>

		<div id="db">	
		  <form action="#db" method="post">		
{if $conn}
			<div class="message">{$langs.DbNotConnect}</div>
{else}
	{if isset($message.db)}<div class="setup_message">{$message.db}</div>{/if}
		
			{$langs.Base} :
	{if isset($base)}
			<button name="act" value="dbadd">{$langs.Create}</button>
	{else}
			<div id="confirmed">
				<label for="confirm_password">{$langs.Password}</label>
				<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
			</div>
			
			<button name="act" value="dbdelete">{$langs.Delete}</button>
	{/if}
		  </form>
		 </div>
{/if}
	</div>
</div>
{/if}
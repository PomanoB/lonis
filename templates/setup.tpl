	<div class="title">
		{$langs.setup} :: 
		{if isset($act)}<a href="{$baseUrl}/setup/logout">{$langs.logout}</a>{else}{$langs.login}{/if} 
	</div>
	{if isset($message.setting)}<div class="setup_message">{$message.setting}</div>{/if}
		
{capture name=act_login}
	<div class="login">
	  <form action="{$baseUrl}/setup/" method="post">
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
{/capture}

<form id="form_cookieKey" action="{$baseUrl}/setup/#cookieKey" method="post" style="display: inline;"></form>

{capture form_genkey_button assign=form_genkey_button}
	<button form="form_cookieKey" name="act" value="genkey">{$langs.Generate} {$langs.cookieKey}</button>
{/capture}

{capture form_genkey_image assign=form_genkey_image}
	<input form="form_cookieKey" id="cookieKey"  type="image" name="act" value="genkey" src="{$baseUrl}/img/key.png" 
		title="{$langs.Generate} {$langs.cookieKey}" alt="{$langs.Generate} {$langs.cookieKey}" />
{/capture}
			
{capture name=act_setting}
	<div class="tabs">
	   <input type="radio" id="tab-1" name="tab-group-1" checked>
		<label for="tab-1"><strong>{$langs.setupGeneral}</strong></label>
		::
	   <input type="radio" id="tab-2" name="tab-group-1">
		<label for="tab-2"><strong>{$langs.setupDb}</strong></label>
		::
	   <input type="radio" id="tab-3" name="tab-group-1">
		<label for="tab-3"><strong>Backup</strong></label>
		

		<div id="setup">
		  <form action="{$baseUrl}/setup/" method="post">
			<table class="form_login">
	{foreach from=$conflist item=conf}
				<tr>
					<td class="info">
						<label {if $conf.err}style="color: red;"{/if} for="{$conf.name}">{$conf.desc}</label>
					</td>
					<td>
						<input size="40" type="{$conf.type}" class="form_login" name="fld_{$conf.name}" id="{$conf.name}" value="{$conf.text}"/>
						{if $conf.name=="cookieKey"}{$form_genkey_image}{/if}
					</td>
				</tr>
	{/foreach}
			</table>
			
			<div id="">	
				<p>
					<label for="confirm_password">{$langs.Password}</label>
					<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
				</p>
				
				<button name="act" value="save">{$langs.Save}</button> <button name="act" value="reset">{$langs.ResetDef}</button>
			</div>
		  </form>		
		</div>

		<div id="db">	
		  <form action="{$baseUrl}/setup/#db" method="post">		
			<div class="title">{$langs.DbTitle}</div>
{if $conn}
			<div class="message">{$langs.DbNotConnect}</div>
{else}
	{if isset($message.db)}<div class="setup_message">{$message.db}</div>{/if}
		
			{$langs.Base} : <i>{$mysql_db}</i> ::
	{if isset($base)}
			<button class="dbbut" name="act" value="dbadd">{$langs.Create}</button>
	{else}
			<div id="confirmed">
				<label for="confirm_password">{$langs.Password}</label>
				<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
			</div>
			
			<button class="dbbut" name="act" value="dbdelete">{$langs.Delete}</button>
	{/if}
		  </form>
		 </div>
{/if}
	</div>
</div>
{/capture}

{if !isset($act)}
{$smarty.capture.act_login}
{else}
{$smarty.capture.act_setting}
{/if}




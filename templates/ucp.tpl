{if $user}
	<div align="center">
		<div class="titles">{$langs.TitleGameAcc} :: <a title="{$langs.logout}" href="{$baseUrl}/logout/">{$langs.logout}</a></div><br>
	{if $user.active == 0}
		<div class="message">{$langs.InActive}</div>
	{elseif $user.active == 2}
		<div class="message">{$langs.Banned}</div>
	{elseif $user.active == 1}
		{if isset($message.msg)}<div class="err_message">{$message.msg}</div>{/if}
		
		<form action="" method="post">
		<table cellpadding="5">
			<tr>
				<td align="right"><label for="name">{$langs.Name}</label>: </td>
				<td><input type="text" class="bigform" name="name" id="name" value="{$user.name|escape}" /></td>
			</tr>
			{if $user.steam_id_64}
			<tr>
				<td align="right"><label for="steam_id">{$langs.SteamID}</label>: </td>
				<td><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$user.steam_id}" placeholder="{$langs.SteamID}" readonly/></td>
			</tr>
			{else}
			<tr>
				<td align="right"><label for="password">{$langs.Password}</label>: </td>
				<td><input type="password" class="bigform" name="password" id="password" placeholder="{$langs.Password}" /></td>
			</tr>
			<tr>
				<td align="right"><label for="ip">{$langs.IP}</label>: </td>
				<td><input type="text" class="bigform" name="ip" id="ip" value="{$user.ip}" placeholder="{$langs.IP}" /></td>
			</tr>
			<tr>
				<td align="right"><label for="steam_id">{$langs.SteamID}</label>: </td>
				<td><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$user.steam_id}" placeholder="{$langs.SteamID}"/></td>
			</tr>
			{* // Choose auth
			<tr>
				<td align="right"><label for="authType">{$langs.AuthType}</label>: </td>
				<td>
					<select name="authType" id="authType" class="bigform" style="width: 225px;">
						<option value="0" style="">{$langs.AuthNickPassword}</option>
						<option value="1" {if $user.auth==1}selected="selected"{/if}>{$langs.AuthSteamId}</option>
						<option value="2" {if $user.auth==2}selected="selected"{/if}>{$langs.IP}</option>
					</select>
				</td>
			</tr>
			*}
			{/if}
		
		{foreach from=$addFlags item=flag}
			<tr>
				<td align="right"><label for="{$flag.flag}">{$flag.lang}</label></td>
				<td><input type="checkbox" name="{$flag.flag}" {if $flag.checked}checked="checked"{/if} /></td>
			</tr>
		{/foreach}
			<tr>
				<td align="center" colspan="2"><br><h2>{$langs.TitlePersonalData}</h2></td>
			</tr>
			<tr>
				<td align="right"><label for="icq">{$langs.ICQ}</label>: </td>
				<td><input type="text" class="bigform" name="icq" id="icq" value="{$user.icq}" placeholder="{$langs.ICQ}"></td>
			</tr>
		</table>
		
		<p><div><button>{$langs.Update}</button></div></p>
		</form>
	{/if}
	</div>
{else}
	<div align="center">	
		<div class="titles">
		{$langs.Authorization} :: <a href="{$baseUrl}/steam/"><img src='{$baseUrl}/img/sits_small_{$lang}.png'></a>
		</div><br>
		{if isset($message.msg)}<div style="padding: 5px; color: red;">{$message.msg}</div><br>{/if}
		<div align="center" style="">
			<div style="display: inline-block; vertical-align: top; background: #f5f5f5; padding: 10px; margin: 10px; border-radius: 20px;">
				<h2>{$langs.login}</h2>
				<p>
				<form action="" method="post">
					<table cellpadding="5">
						<tr>
							<td align="right"><label for="login_user">{$langs.player}</label>:</td>
							<td><input type="text" class="bigform" name="login_user" id="login_user" value="{if isset($info.login_user)}{$info.login_user}{/if}"
								placeholder=" {$langs.Name} / {$langs.Email}"/></td>
						</tr>
						{if isset($message.login_user)}<tr><td colspan="2" style="text-align: right; color: red;">{$message.login_user}</td></tr>{/if}
						<tr>
							<td align="right"><label for="login_password">{$langs.Password}</label>:</td>
							<td><input type="password" class="bigform" name="login_password" id="login_password" /></td>
						</tr>
						{if isset($message.login_password)}<tr><td colspan="2" style="text-align: right; color: red;">{$message.login_password}</td></tr>{/if}
					</table>
					{if isset($message.login)}<div style="padding: 5px; color: red;">{$message.login}</div>{/if}
					<div style="padding: 10px;">
						<button name="act" value="login">{$langs.login}</button>
					</div>
				</form>
			</div>
			
			<div style="display: inline-block; vertical-align: top; background: #f5f5f5; padding: 10px; margin: 10px; border-radius: 20px;">
				<h2>{$langs.regTitle}</h2>
				<p>
				<form action="" method="post">
					<table cellpadding="5">
						<tr>
							<td align="right"><label for="new_nick">{$langs.Name}</label>:</td>
							<td><input type="text" class="bigform" name="new_nick" id="new_nick" value="{if isset($info.new_nick)}{$info.new_nick}{/if}"/></td>
						</tr>
						{if isset($message.nick)}<tr><td colspan="2" style="text-align: right; color: red;">{$message.nick}</td></tr>{/if}
						<tr>
							<td align="right"><label for="new_email">{$langs.Email}</label>:</td>
							<td><input type="text" class="bigform" name="new_email" id="new_email" value="{if isset($info.new_email)}{$info.new_email}{/if}"
								placeholder=" name@site.com"/></td>
						</tr>
						{if isset($message.email)}<tr><td colspan="2" style="text-align: right; color: red;">{$message.email}</td></tr>{/if}
						<tr>
							<td align="right"><label for="new_password">{$langs.Password}</label>:</td>
							<td><input type="password" class="bigform" name="new_password" id="new_password" /></td>
						</tr>
						{if isset($message.password)}<tr><td colspan="2" style="text-align: right; color: red;">{$message.password}</td></tr>{/if}
					</table>
					{if isset($message.reg)}<div style="padding: 5px; color: red; word-break: break-all;">{$message.reg}</div>{/if}
					<div style="padding: 10px;">
						<button name="act" value="reg">{$langs.reg}</button>
						{*<button name="act" value="reset">{$langs.Reset} {$langs.Password}</button>*}
					</div>
				</form>
			</div>
		</div>
	</div>
{/if}
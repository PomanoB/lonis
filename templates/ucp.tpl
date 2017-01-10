{capture input_readonly assign=readonly}{if isset($user.steam_id_64)}readonly style="background-color: #dcdcdc;"{/if}{/capture}
{capture input_disabled assign=disabled}{if isset($user.steam_id_64)}disabled{/if}{/capture}

	<div align="center">
		<div class="titles">{$langs.TitleGameAcc}</div><br>
{if $user.active == 0}
		<div class="message">{$langs.InActive}</p>
{elseif $user.active == 2}
		<div class="message">{$langs.Banned}</p>
{elseif $user.active == 1}
		<div class="err_message">{$message}</div>
		
		<form action="{$baseUrl}/ucp/" method="post">
		<table cellpadding="5">
			<tr>
				<td align="right"><label for="name">{$langs.Name}</label>: </td>
				<td><input type="text" class="bigform" name="name" id="name" value="{$user.name|escape}" title="Required to proceed" /></td>
			</tr>			
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
				<td align="right"><label for="authType">{$langs.AuthType}</label>: </td>
				<td>
					<select name="authType" id="authType" class="bigform" style="width: 294px; text-align: center; text-align-last: center;">
						<option value="0" style="">{$langs.AuthNickPassword}</option>
						<option value="1" {if $user.auth}selected="selected"{/if}>{$langs.AuthSteamId}</option>
					</select>
				</td>
			</tr>

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
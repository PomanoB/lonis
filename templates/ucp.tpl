{capture input_readonly assign=readonly}{if isset($user.steam_id_64)}readonly style="background-color: #dcdcdc;"{/if}{/capture}
{capture input_disabled assign=disabled}{if isset($user.steam_id_64)}disabled{/if}{/capture}

	<center>
	<p><h2>{$langs.TitleGameAcc}</h2>
{if $user.active == 0}
	<p>{$langs.InActive}</p>
{elseif $user.active == 2}
	<p>{$langs.Banned}</p>
{elseif $user.active == 1}
	<div class="settingsPanel_off">
		<p><div class="message">{$message}</div><br>
		<table border="0">
			<form action="{$baseUrl}/ucp" method="post">
			<tr>
				<td class="info"><label for="name">{$langs.Name}</label></td>
				<td><input type="text" class="bigform" name="name" id="name" value="{$user.name|escape}" title="Required to proceed" /></td>
			</tr>			
			<tr>
				<td class="info"><label for="password">{$langs.Password}</label></td>
				<td><input type="password" class="bigform" name="password" id="password" placeholder="{$langs.Password}" /></td>
			</tr>
			<tr>
				<td class="info"><label for="ip">{$langs.IP}</label></td>
				<td><input type="text" class="bigform" name="ip" id="ip" value="{$user.ip}" placeholder="{$langs.IP}" /></td>
			</tr>
			<tr>
				<td class="info"><label for="steam_id">{$langs.SteamID}</label></td>
				<td><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$user.steam_id}" placeholder="{$langs.SteamID}"/></td>
			</tr>
				<td class="info"><label for="authType">{$langs.AuthType}</label></td>
				<td>
					<select name="authType" id="authType" class="bigform">
						<option value="0">{$langs.AuthNickPassword}</option>
						<option value="1" {if $user.auth}selected="selected"{/if}>{$langs.AuthSteamId}</option>
					</select>
				</td>
			</tr>

			{foreach from=$addFlags item=flag}
			<tr>
				<td class="info"><label for="{$flag.flag}">{$flag.lang}</label></td>
				<td><input type="checkbox" name="{$flag.flag}" {if $flag.checked}checked="checked"{/if} /></td>
			</tr>
			{/foreach}
		</table>

	</div>
	
	<p><div>
		<h2>{$langs.TitlePersonalData}</h2>
		<p><table border="0">
			<tr>
				<td class="info"><label for="icq">{$langs.ICQ}</label></td>
				<td><input type="text" class="bigform" name="icq" id="icq" value="{$user.icq}" placeholder="{$langs.ICQ}"></td>
			</tr>
		</table>
	</div>
			<p><div><button>{$langs.Update}</button></div><br>
		</form>
{/if}
	<!--		<p id="readme">{$langs.Readme}</p> -->
	</center>
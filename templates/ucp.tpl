				<center>
				<p><h2>{$langTitleGameAcc}</h2>
		{if $user.active == 0}
			<p>{$langInActive}</p>
		{elseif $user.active == 2}
			<p>{$langBanned}</p>
		{elseif $user.active == 1}
			<div class="settingsPanel_off">
				<p><div class="message">{$message}</div><br>
				<table border="0">
					<form action="{$baseUrl}/action/ucp" method="post">
					<tr>
						<td class="info"><label for="name">{$langName}</label></td>
						<td><input type="text" class="bigform" name="name" id="name" value="{$user.name|escape}" title="Required to proceed" /></td>
					</tr>
{if !$user.steam_id_64}				
					<tr>
						<td class="info"><label for="password">{$langPassword}</label></td>
						<td><input type="password" class="bigform" name="password" id="password" placeholder="{$langPassword}" /></td>
					</tr>
					<tr>
						<td class="info"><label for="ip">{$langIP}</label></td>
						<td><input type="text" class="bigform" name="ip" id="ip" value="{$user.ip}" placeholder="{$langIP}" /></td>
					</tr>
					<tr>
						<td class="info"><label for="steam_id">{$langSteamID}</label></td>
						<td><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$user.steam_id}" placeholder="{$langSteamID}" /></td>
					</tr>
						<td class="info"><label for="authType">{$langAuthType}</label></td>
						<td>
							<select name="authType" id="authType" class="bigform">
								<option value="0">{$langAuthNickPassword}</option>
								<option value="1" {if $user.auth}selected="selected"{/if}>{$langAuthSteamId}</option>
							</select>
						</td>
					</tr>
{else}
					<tr>
						<td class="info"><label for="steam_id">{$langSteamID}</label></td>
						<td>
							<span>{$user.steam_id}</span>
						</td>
					</tr>
{/if}
					{foreach from=$addFlags item=flag}
					<tr>
						<td class="info"><label for="{$flag.flag}">{$flag.lang}</label></td>
						<td><input type="checkbox" name="{$flag.flag}" {if $flag.checked}checked="checked"{/if} /></td>
					</tr>
					{/foreach}
				</table>

			</div>
			
			<p><div>
				<h2>{$langTitlePersonalData}</h2>
				<p><table border="0">
					<tr>
						<td class="info"><label for="icq">{$langICQ}</label></td>
						<td><input type="text" class="bigform" name="icq" id="icq" value="{$user.icq}" placeholder="{$langICQ}"></td>
					</tr>
				</table>
			</div>
					<p><div><button>{$langUpdate}</button></div><br>
				</form>
{/if}
			<!--		<p id="readme">{$langReadme}</p> -->
			</center>
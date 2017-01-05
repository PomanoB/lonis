<div align="center">
	<p><h2>{$lang_player}</h2><br>

{if !isset($info)}
	<p><h2>{$name|escape}</h2><br>
	<p><div class="err_message">{$message}</div></p>
{else}
	<img src="{$info.gravatar}" alt="{$info.name|escape}" />
	<p><h2>{$info.name|escape}</h2><br>
	<p><table>
		<tr class="playerinfo">
			<td class="infoid">{$lang_achievCompleted}</td> 
			<td><a href="{$baseUrl}/{$info.name_url}/achiev" title="{$langView}">{$info.achievCompleted}</a></td>
		</tr>

		<tr class="playerinfo">
			<td class="infoid">{$langMapCompleted}</td> 
			<td><a href="{$baseUrl}/{$info.name_url}/kreedz" title="{$langView}">{$info.mapCompleted}</a></td>
		</tr>
	{if $info.ipInfo.country_code}
		<tr class="playerinfo">
			<td class="infoid">{$langCountry}:</td> <td>{$info.ipInfo.country_name} <img src="img/country/{$info.ipInfo.country_code}.png" /></td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">{$langCity}:</td> <td>{$info.ipInfo.city}</td>
		</tr>
	{/if}
	{if $info.steam_id}
		<tr class="playerinfo">
			<td class="infoid">{$langSteamID}:</td> <td>{$info.steam_id}</td>
		</tr>
	{/if}
	{if $info.icq}
		<tr class="playerinfo">
			<td class="infoid">{$langICQ}:</td> <td>{$info.icq}</td>
		</tr>
	{/if}
		<tr class="playerinfo">
			<td class="infoid">Последний заход:</td> <td>{$info.lastTime}</td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">Общий онлайн:</td> <td>{$info.onlineTime}</td>
		</tr>
	</table>
{/if}
</div>
<div align="center">
	<p><h2>{$langs.player}</h2><br>

{if !isset($info)}
	<p><h2>{$player.name|escape}</h2><br>
	<p><div class="err_message">{$message}</div></p>
{else}
	<a href="{$info.avatarLink}" target="_blank"><img src="{$info.avatar}" alt="{$info.name|escape}" /></a>
	<p><h2>{$info.name|escape}</h2><br>
	<p><table>
		<tr class="playerinfo">
			<td class="infoid">{$langs.Country}:</td> 
			<td>{if $info.countryImg}<img src="{$baseUrl}/{$info.countryImg}" />{/if} {$info.countryName}</td>
		</tr>
		
		<tr class="playerinfo">
			<td class="infoid">{$langs.achievCompleted}:</td> 
			<td><a href="{$baseUrl}/{$info.name_url}/achiev" title="{$langs.View}">{$info.achievCompleted}</a></td>
		</tr>

		<tr class="playerinfo">
			<td class="infoid">{$langs.MapCompleted}:</td> 
			<td><a href="{$baseUrl}/{$info.name_url}/kreedz" title="{$langs.View}">{$info.mapCompleted}</a></td>
		</tr>
	{if isset($info.ipInfo.country_name)}
		<tr class="playerinfo">
			<td class="infoid">{$langs.Country}:</td> <td>{$info.ipInfo.country_name} <img src="img/country/{$info.ipInfo.country_code}.png" /></td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">{$langs.City}:</td> <td>{$info.ipInfo.city}</td>
		</tr>
	{/if}
	{if isset($info.steam_id)}
		<tr class="playerinfo">
			<td class="infoid">{$langs.SteamID}:</td>
			<td><a href="http://steamcommunity.com/profiles/{$info.steam_id_64}/" target="_blank">{$info.steam_id}</a></td>
		</tr>
	{/if}
	{if $info.icq}
		<tr class="playerinfo">
			<td class="infoid">{$langs.ICQ}:</td> <td>{$info.icq}</td>
		</tr>
	{/if}
		<tr class="playerinfo">
			<td class="infoid">{$langs.ourLastTime}:</td> <td>{$info.lastTime}</td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">{$langs.SharedOnline}:</td> <td>{$info.onlineTimes}</td>
		</tr>
	</table>
{/if}
</div>
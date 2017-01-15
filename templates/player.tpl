<div align="center">
	<p><h2>{$langs.player}</h2><br>

{if !isset($player)}
	<p><h2>{$player.name|escape}</h2><br>
	<p><div class="err_message">{$message}</div></p>
{else}
	<a href="{$player.avatarLink}" target="_blank"><img src="{$player.avatar}" alt="{$player.name|escape}" /></a>
	<p><h2>{$player.name|escape}</h2><br>
	<p><table>
		<tr class="playerinfo">
			<td class="infoid">{$langs.Country}:</td> 
			<td>{if $player.countryImg}<img src="{$baseUrl}/{$player.countryImg}" />{/if} {$player.countryName}</td>
		</tr>
		
		<tr class="playerinfo">
			<td class="infoid">{$langs.achievCompleted}:</td> 
			<td><a href="{$baseUrl}/{$player.name_url}/achiev" title="{$langs.View}">{$player.achievCompleted}</a></td>
		</tr>

		<tr class="playerinfo">
			<td class="infoid">{$langs.MapCompleted}:</td> 
			<td><a href="{$baseUrl}/{$player.name_url}/kreedz" title="{$langs.View}">{$player.mapCompleted}</a></td>
		</tr>
	{if isset($player.ipInfo.country_name)}
		<tr class="playerinfo">
			<td class="infoid">{$langs.Country}:</td> <td>{$player.ipInfo.country_name} <img src="img/country/{$player.ipInfo.country_code}.png" /></td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">{$langs.City}:</td> <td>{$player.ipInfo.city}</td>
		</tr>
	{/if}
	{if isset($player.steam_id)}
		<tr class="playerinfo">
			<td class="infoid">{$langs.SteamID}:</td>
			<td><a href="http://steamcommunity.com/profiles/{$player.steam_id_64}/" target="_blank">{$player.steam_id}</a></td>
		</tr>
	{/if}
	{if $player.icq}
		<tr class="playerinfo">
			<td class="infoid">{$langs.ICQ}:</td> <td>{$player.icq}</td>
		</tr>
	{/if}
		<tr class="playerinfo">
			<td class="infoid">{$langs.ourLastTime}:</td> <td>{$player.lastTime}</td>
		</tr>
		<tr class="playerinfo">
			<td class="infoid">{$langs.SharedOnline}:</td> <td>{$player.onlineTimes}</td>
		</tr>
	</table>
{/if}
</div>
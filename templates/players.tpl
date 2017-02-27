{if isset($player.id)}
	<div align="center">
		<p><h2>{$langs.player}</h2><br>

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
	</div>
{else}
	<div class="wrapper">		
		<div class="titles left_block">{$langs.players}</div>
	{if !$cs}
		<div class=" right_block">
			<form action="{$baseUrl}/players/" method="post">
				<input type="text" name="search" id="search" class="form" }value="{if isset($search)}{$search}{/if}" placeholder="{$langs.Search}" />
				<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langs.Search}"/>
				&nbsp;
			</form>
		</div>
	{/if}
	</div><br><br>

	<div class="table-list">&nbsp;{$pages.output}</div>
	
	<div style="padding:10px;">
		<table class="table-list">
			<tr class="title">
				<td>&nbsp;</td>
				<td><a href="{$baseUrl}/players/name/page{$pages.page}/{$search}">{$langs.player}</a></td>
				<td><a href="{$baseUrl}/players/country/page{$pages.page}/{$search}">{$langs.Country}</a></td>
				<td><a href="{$baseUrl}/players/achiev-desc/page{$pages.page}/{$search}">{$langs.achievCompleted}</a></td>
				<td>{$langs.MapCompleted}</td>
			</tr>
		{if isset($rows)}
		{foreach from=$rows item=player}
			<tr class="list">
				<td>
					<a href="{$player.avatarLink}" target="_blank"><img src="{$player.avatar}" alt="{$player.name|escape}" /></a>
				<td>
					<a href="{$baseUrl}/{$player.name_url}">{$player.name|escape}</a>
				</td>
				<td style="width: 20%;">
					{if $player.countryImg}
						<img src="{$baseUrl}/{$player.countryImg}" title="{$player.countryName}" alt="{$player.countryName}" />
					{/if}
					{$player.countryName}
				</td>
				<td>
					<a href="{$baseUrl}/{$player.name_url}/achiev">{$player.achiev}</a>
				</td>
				<td>
					<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.mapCompleted}</a>
				</td>
			</tr>
		{/foreach}
		{/if}
		</table>
	</div>
{/if}
{if isset($player.id)}
	<div align="center">
		<p><div class="titles">{langs('Player')}</div><br>

		<a href="#"><img src="{$player.avatar}" class="image_c" alt="{$player.name|escape}" /></a>
		<p><div class=""><h2>{$player.name|escape}</h2></div><br>
		<p><table>
			<tr class="playerinfo">
				<td class="infoid">{langs('Country')}:</td> 
				<td>{if $player.countryImg}<img src="{$baseUrl}/{$player.countryImg}" />{/if} {$player.countryName}</td>
			</tr>
			
			<tr class="playerinfo">
				<td class="infoid">{langs('Fulfilled achievements')}:</td> 
				<td><a href="{$baseUrl}/{$player.name_url}/achiev/" title="{langs('View')}">{$player.achievCompleted}</a></td>
			</tr>

			<tr class="playerinfo">
				<td class="infoid">{langs('Went KZ maps')}:</td> 
				<td><a href="{$baseUrl}/{$player.name_url}/kreedz" title="{langs('View')}">{$player.mapCompleted}</a></td>
			</tr>
		{if isset($player.ipInfo.country_name)}
			<tr class="playerinfo">
				<td class="infoid">{langs('Country')}:</td> <td>{$player.ipInfo.country_name} <img src="img/country/{$player.ipInfo.country_code}.png" /></td>
			</tr>
			<tr class="playerinfo">
				<td class="infoid">{langs('City')}:</td> <td>{$player.ipInfo.city}</td>
			</tr>
		{/if}
		{if isset($player.steam_id)}
			<tr class="playerinfo">
				<td class="infoid">{langs('Steam ID')}:</td>
				<td><a href="http://steamcommunity.com/profiles/{$player.steam_id_64}/" target="_blank">{$player.steam_id}</a></td>
			</tr>
		{/if}
		{if $player.icq}
			<tr class="playerinfo">
				<td class="infoid">{langs('ICQ')}:</td> <td>{$player.icq}</td>
			</tr>
		{/if}
			<tr class="playerinfo">
				<td class="infoid">{langs('Our Last Time')}:</td> <td>{$player.lastTime}</td>
			</tr>
			<tr class="playerinfo">
				<td class="infoid">{langs('Shared Online')}:</td> <td>{$player.onlineTimes}</td>
			</tr>
		</table>
	</div>
{else}
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>

	{$pages.output}

	<table class="table-list">
		<tr class="title">
			<td>&nbsp;</td>
			<td><a href="{$baseUrl}/players/name/page{$pages.page}/{$search}">{langs('Player')}</a></td>
			<td><a href="{$baseUrl}/players/country/page{$pages.page}/{$search}">{langs('Country')}</a></td>
			<td><a href="{$baseUrl}/players/achiev-desc/page{$pages.page}/{$search}">{langs('Fulfilled achievements')}</a></td>
			<td><a href="#">{langs('Went KZ maps')}</a></td>
		</tr>
	{foreach from=$rows item=player}
		<tr class="list">
			<td>
				<a href="{$baseUrl}/{$player.name_url}">
				<img src="{$player.avatar}" width="{$player.avatarSize}" height="{$player.avatarSize}" class="image_c" alt="{$player.name|escape}" /></a>
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
				<a href="{$baseUrl}/{$player.name_url}/achiev/">{$player.achiev}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.mapCompleted}</a>
			</td>
		</tr>
	{foreachelse}
	{/foreach}
	</table>
{/if}
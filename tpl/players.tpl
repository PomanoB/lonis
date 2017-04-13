{if isset($player.id)}
	<div align="center">
		<p><div class="titles">{langs('Player')}</div><br>

		<a href="#"><img src="{$player.avatar.img}" class="image_c" alt="{$player.name|escape}" /></a>
		<p><div class=""><h2>{$player.name|escape}</h2></div><br>
		<p><div>
			<div class="playerinfo">
				<div class="infoid">{langs('Country')}:</div> 
				<div><div class="flags flag-{strtolower($player.country)}">&nbsp;</div> {$player.countryName}</div>
			</div>
			
			<div class="playerinfo">
				<div class="infoid">{langs('Fulfilled achievements')}:</div> 
				<div><a href="{$baseUrl}/{$player.name_url}/achiev/" title="{langs('View')}">{$player.achievCompleted}</a></div>
			</div>

			<div class="playerinfo">
				<div class="infoid">{langs('Went KZ maps')}:</div> 
				<div><a href="{$baseUrl}/{$player.name_url}/kreedz" title="{langs('View')}">{$player.mapCompleted}</a></div>
			</div>
		{if isset($player.steam_id)}
			<div class="playerinfo">
				<div class="infoid">{langs('Steam ID')}:</div>
				<div><a href="http://steamcommunity.com/profiles/{$player.steam_id_64}/" target="_blank">{$player.steam_id}</a></div>
			</div>
		{/if}
		{if $player.icq}
			<div class="playerinfo">
				<div class="infoid">{langs('ICQ')}:</div> <div>{$player.icq}</div>
			</div>
		{/if}
			<div class="playerinfo">
				<div class="infoid">{langs('Our Last Time')}:</div> <div>{$player.lastTime}</div>
			</div>
			<div class="playerinfo">
				<div class="infoid">{langs('Shared Online')}:</div> <div>{$player.onlineTimes}</div>
			</div>
		</div>
	</div>
{else}
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>

	{$pages.output}

	<div class="table list">
		<div class="tr title">
			<div>&nbsp;</div>
			<div><a href="{$baseUrl}/players/name/page{$pages.page}/{$search}">{langs('Player')}</a></div>
			<div><a href="{$baseUrl}/players/country/page{$pages.page}/{$search}">{langs('Country')}</a></div>
			<div><a href="{$baseUrl}/players/achiev-desc/page{$pages.page}/{$search}">{langs('Fulfilled achievements')}</a></div>
			<div><a href="#">{langs('Went KZ maps')}</a></div>
		</div>
		
		{foreach from=$players item=row}
		<div class="tr row">
			<div>
				<a href="{$baseUrl}/{url_replace($row.name)}">
				<img src="{$row.avatar.img}" width="{$row.avatar.size}" class="image_c" alt="{$row.name|escape}" /></a>
			</div>
			<div>
				<a href="{$baseUrl}/{url_replace($row.name)}">{$row.name|escape}</a>
			</div>
			<div style="width: 20%;">
				<i class="flags flag-{strtolower($row.country)}" title="{$row.countryName}" alt="">&nbsp;</i>
				{$row.countryName}
			</div>
			<div>
				<a href="{$baseUrl}/{url_replace($row.name)}/achiev/">{$row.achiev}</a>
			</div>
			<div>
				<a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.mapCompleted}</a>
			</div>
		</div>
		{foreachelse}
		{/foreach}
	</div>
{/if}
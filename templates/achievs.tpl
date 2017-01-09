{* /achiev/%aname% *}

	<h2>{$langs.achiev}</h2>
	<div style="padding:10px;">
		<p>{$langs.achievsPlayers}</p>
		<div class="achiev achiev_completed">
			<b>{$achiev.name}</b>
			<br />
			<span>{$achiev.description}</span>
		</div>
		
		{$generate_page}
		
{foreach from=$players item=player}
		<div class="achiev">
			<b><a href="{$baseUrl}/{$player.plname_url}/achiev">{$player.plname|escape}</a></b>
			<br />
			<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
		</div>
{/foreach}
	</div>
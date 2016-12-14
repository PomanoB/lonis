			<p><h2>{#langAchievs#}</h2>
			<div style="padding:10px;">
				<span>{#langAchievsPlayers#}</span>
				<div class="achiev achiev_completed">
					<b>{$achiev.name}</b>
					<br />
					<span>{$achiev.description}</span>
				</div>
{foreach from=$players item=player}
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.plname|replace:' ':'_'}/achiev">{$player.plname}</a></b>
					<br />
					<span>{#langAchievPlayerTotal#} {$player.achiev_total}</span>
				</div>
{/foreach}</div>
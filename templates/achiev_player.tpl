			<p><h2>{#lang_achievs#}</h2>
			<div style="padding:10px;">
				<span>{#lang_achievsPlayers#}</span>
				<div class="achiev achiev_completed">
					<b>{$achiev.name}</b>
					<br />
					<span>{$achiev.description}</span>
				</div>
{foreach from=$players item=player}
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.name|replace:' ':'_'}/achiev">{$player.plname|escape}</a></b>
					<br />
					<span>{#lang_achievPlayerTotal#} {$player.achiev_total}</span>
				</div>
{/foreach}</div>
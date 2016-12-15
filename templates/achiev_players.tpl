			<p><h2>{#lang_players#}</h2>
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
{foreach from=$players item=player}
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.name|replace:' ':'_'}/achiev">{$player.name|escape}</a></b>
					<br />
					<span>{#lang_achievPlayerTotal#} {$player.achiev_total}</span>
				</div>
{/foreach}
			</div>
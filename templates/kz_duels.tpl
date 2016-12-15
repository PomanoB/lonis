			<p><h2>{#lang_kz_duels#}</h2>
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<th>{#langMap#}</th>
						<th>{#langWinner#}</th>
						<th>{#langLooser#}</th>
						<th>{#langWinnerPoint#}</th>
						<th>{#langLooserPoint#}</th>
					</tr>
{foreach from=$duels item=duel}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/kreedz/{$duel.map}">{$duel.map}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$duel.winnerName|replace:' ':'_'}">{$duel.winnerName|escape}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$duel.looserName|replace:' ':'_'}">{$duel.looserName|escape}</a>
						</td>
						<td class="th_numeric">{$duel.winnerPoints}</td>
						<td class="th_numeric">{$duel.looserPoints}</td>
					<tr>
{/foreach}
				</table>
			</div>
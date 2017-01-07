<p><h2>{$langs.kz_duels}</h2>

{$generate_page}

<div style="padding:10px;">
	<table class="table-list">
		<tr class="title">
			<td>{$langs.Map}</td>
			<td>{$langs.Winner}</td>
			<td>{$langs.Looser}</td>
			<td>{$langs.WinnerPoint}</td>
			<td>{$langs.LooserPoint}</td>
		</tr>
{foreach from=$duels item=duel}
		<tr class="list">
			<td>
				<a href="{$baseUrl}/kreedz/{$duel.map}">{$duel.map}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.winnerName_url}">{$duel.winnerName|escape}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.looserName_url}">{$duel.looserName|escape}</a>
			</td>
			<td class="th_numeric">{$duel.winnerPoints}</td>
			<td class="th_numeric">{$duel.looserPoints}</td>
		<tr>
{/foreach}
	</table>
</div>
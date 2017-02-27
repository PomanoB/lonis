<div class="wrapper">
	<div class="titles left_block">{$langs[$parent]} :: {$langs.kz_duels}</div>
	<div class="right_block" align="center">
	</div>
</div><br><br>
	
<div class="table-list">&nbsp;{$pages.output}</div>

<div style="padding:10px;">
	<table class="table-list">
		<tr class="title">
			<td>{$langs.Map}</td>
			<td>{$langs.Winner}</td>
			<td>{$langs.Looser}</td>
			<td>{$langs.WinnerPoint}</td>
			<td>{$langs.LooserPoint}</td>
		</tr>
{foreach from=$rows item=duel}
		<tr class="list">
			<td>
				<a href="{$baseUrl}/kreedz/{$duel.map}/">{$duel.map}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.winnerName_url}/kreedz/">{$duel.winnerName|escape}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.looserName_url}/kreedz/">{$duel.looserName|escape}</a>
			</td>
			<td class="th_numeric">{$duel.winnerPoints}</td>
			<td class="th_numeric">{$duel.looserPoints}</td>
		<tr>
{/foreach}
	</table>
</div>
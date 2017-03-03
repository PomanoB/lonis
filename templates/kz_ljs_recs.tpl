	<div class="titles" align="center">
		{! {$langs[$parent]} }
		<p>.: {langs('LJ Records')} :. 
	</div>
	
	<div>
		<p><div class="err_message">{$message}</div>
		
		<table class="" align="center" width="80%">
	{if isset($jumps)}
	
	{foreach from=$jumps item=j}
		{if $j.section0}
			<tr>
				<td class="titles" align="center" colspan="6">
					<hr><br>{$j.comm_name}
				</td>
			</tr>
		{/if}
		
		{if $j.section1}
		{$i=0}
			<tr>
				<td class="titles" align="center" colspan="6">
					<br><i>{$j.type_name}</i> <img src="{$baseUrl}/img/longjumps/{$j.type}.png"><br><br>
				</td>
			</tr>		
			<tr class="title">
				<td width="30" align="center">№</td>
				<td>{langs('Name')}</td>
				<td>{langs('Distance')}</td>
				<td>{langs('Block')}</td>
				<td>{langs('Prestrafe')}</td>
				<td>{langs('Speed')}</td>
			</tr>
		{/if}
		
			<tr class="list">
				<td align="center">
				{$i=$i+1}
				{if $i<4}
					<img src="{$baseUrl}/img/top{$i}.png" width="22" height="16" title="{$i}" alt="{$i}" />
				{else}
					{$i}
				{/if}
				</td>
				<td>{$j.plname}</td>
				<td>{$j.distance}</td>
				<td>{$j.block}</td>
				<td>{$j.prestrafe}</td>
				<td>{$j.speed}</td>	
			</tr>
	{/foreach}
	{/if}
		</table>
	</div>
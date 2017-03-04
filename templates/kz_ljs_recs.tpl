	<div class="titles" align="center">
		<p>.: {langs('LJ Records')} :. 
	</div>
	
	<div class="titles" align="center">:: 
	{foreach from=$titles key=k item=t}
		{$uline=""}{if $comm==$t.name}{$uline = 'style="text-decoration: underline;"'}{/if}
		<a href="{$baseUrl}/kreedz/records/ljs/{$t.name}" {$uline}>{$t.fullname}</a> ::
	{foreachelse}
	{/foreach}
	</div>
	
	<table class="" align="center" width="80%">
{foreach from=$jumps item=j}
	{if $lasttype!=$j.type}
	{$i=0}
		<tr>
			<td class="titles" align="center" colspan="6">
				<i>{$j.type_name}</i> <img src="{$baseUrl}/img/longjumps/{$j.type}.png"><br><br>
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
	{$lasttype = $j.type}
	
		<tr align="left">
			<td>
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
{foreachelse}
{/foreach}
	</table>
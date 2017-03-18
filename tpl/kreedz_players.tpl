	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
	
	<div class="table-list">
		<a href="{$baseUrl}/kreedz/players/pro/{$sort}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/kreedz/players/noob/{$sort}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/kreedz/players/all/{$sort}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
		::
		<a href="{$baseUrl}/kreedz/players/{$type}/all/{$search}" {if $sort == "all"}style="font-weight:bold;"{else}{/if}>{langs('Total')}</a>
		<a href="{$baseUrl}/kreedz/players/{$type}/top1/{$search}" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{langs('First')}</a>
	</div><br>
	
	{$pages.output}
	
	<table class="table-list">
		<tr class="title">
			<td width="30" align="center">№</td>
			<td>{langs('Player')}</td>
			<td>{if $sort=="all"} {langs('Total')} {else} {langs('First')} {/if}</td>
			<td>{if $sort=="all"} {langs('First')} {else} {langs('Total')} {/if}</td>
		</tr>
	{$num = $pages.start}
	{foreach from=$rows item=row}
		{$num=$num+1}
		<tr class="list">
			<td align="center">
				{if $num<4}
					<i class="fa fa-trophy" style="color: {$cup_color[$num]};" title="{$num}" alt="{$num}"></i>
				{else}
					{$num}
				{/if}
			</td>
			<td><a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a></td>
			<td>{if $sort=="all"} {$row.all} {else} {$row.top1} {/if}</td>
			<td>{if $sort=="all"} {$row.top1} {else} {$row.all} {/if}</td>
		<tr>
	{foreachelse}
	{/foreach}
	</table>
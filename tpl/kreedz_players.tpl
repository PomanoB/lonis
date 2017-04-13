	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
	
	<div style="margin: 0 20px;">
		<a href="{$baseUrl}/kreedz/players/pro/{$sort}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/kreedz/players/noob/{$sort}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/kreedz/players/all/{$sort}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
		::
		<a href="{$baseUrl}/kreedz/players/{$type}/all/{$search}" {if $sort == "all"}style="font-weight:bold;"{else}{/if}>{langs('Total')}</a>
		<a href="{$baseUrl}/kreedz/players/{$type}/top1/{$search}" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{langs('First')}</a>
	</div>
	
	{$pages_plr.output}
	
	<div class="table list">
		<div class="tr title">
			<div style="width: 30px; text-align: center">№</div>
			<div>{langs('Player')}</div>
			<div>{if $sort=="all"} {langs('Total')} {else} {langs('First')} {/if}</div>
			<div>{if $sort=="all"} {langs('First')} {else} {langs('Total')} {/if}</div>
		</div>
	{$num = $pages_plr.start}
	{foreach from=$rows item=row}
		{$num=$num+1}
		<div class="tr row">
			<div style="text-align: center">
				{if $num<4}
					<i class="fa fa-trophy" style="color: {$cup_color[$num]};" title="{$num}" alt="{$num}"></i>
				{else}
					{$num}
				{/if}
			</div>
			<div><a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a></div>
			<div>{if $sort=="all"} {$row.all} {else} {$row.top1} {/if}</div>
			<div>{if $sort=="all"} {$row.top1} {else} {$row.all} {/if}</div>
		</div>
	{foreachelse}
	{/foreach}
	</div>
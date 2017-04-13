	<div class="wrapper">
		<div class="titles left_block">
			{langs('Player')} {if isset($name)} :: <i>{$name}</i>{/if}</i>
			{if !$cs}<a href="{$baseUrl}/{$name_url}"><i class="menu menu-players"></i></a>{/if}
		</div>
		<div class="right_block" align="center">
			{if isset($avatar)}
				<a href="#" target="_blank">
					<img src="{$avatar.img}" width="{$avatar.size}" height="{$avatar.size}" oncontextmenu="return false;" /><br>
				</a>
			{/if}
			<p>
		</div>
	</div><br><br>

{if $name}
	{if $rec != "norec"}
	<div style="margin: 0 20px;">
		<a href="{$baseUrl}/{$name_url}/kreedz/pro/{$rec}/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/{$name_url}/kreedz/noob/{$rec}/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
		:: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}/norec">{langs('Not jumped')}</a>
		
		<br><a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{langs('Total')}:</a> {$map_num} 
		:: 
		<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{langs('First')}:</a> {$map_top1}
	</div>
	{else}
	<div style="margin: 0 20px;">
		<b>{langs('Passed')}</b> :: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}">{langs('Passed')}</a>
		
		<br><b>{langs('Total')}</b>: {$map_norec}
	</div>
	{/if}	
	
		{$pages.output}
		
		<br>
		<div class="table list">
			<div class="tr title">
				<div>{langs('Map')}</div>
				{if $rec=="norec"}<div>{langs('Player')}</div>{/if}
				<div>{langs('Time')}</div>
				<div>{langs('Checkpoints')}</div>
				<div>{langs('Teleports')}</div>
				<div>{langs('Weapon')}</div>
			</div>
	{foreach from=$maps item=row}
			<div class="tr row">
				<div>
					<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
					<a href="{$baseUrl}/kreedz/{$row.map}/">{$row.map}</a>
				</div>
				{if $rec=="norec"}<div><a href="{$baseUrl}/{$row.name_url}/kreedz">{$row.name|escape}</a></div>{/if}
				<div>{$row.time}</div>
				<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.cp}</div>
				<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.go_cp}</div>
				<div class="{if $row.wname != 'USP' && $row.wname != 'KNIFE'}color_wpn{/if}">
					<div class="wpn wpn-{$row.weapon}">&nbsp;</div>
				</div>
			</div>
	{foreachelse}
	{/foreach}
		</div>
{else}
	
{/if}
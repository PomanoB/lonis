	<div class="wrapper">		
		<div class="titles left_block">
			{langs('Maps')} ({$total})
		</div>
		<div class="right_block">
			{$form_search}
		</div>
	</div><br><br>
	
	<div>
{if $rec=="norec"}	
			<div class="table-list">
				<b>{langs('Not jumped')}</b> :: <a href="{$baseUrl}/kreedz/maps/{$type}/{$search}">{langs('Passed')}</a>
			</div>
			
			{$pages.output}
			
	{if !isset($style)}
			<ul class='map-list'>
		{foreach from=$maps key=key item=row}	
				<li class="map-list-item" title="{$row.mapname}">
						{if file_exists("img/cstrike/{$row.mapname}.jpg")}
							<img src="{$baseUrl}/img/cstrike/{$row.mapname}.jpg" alt="" title="{$row.mapname}" oncontextmenu="return false;">
						{else}
							<i class="fa fa-picture-o" style="font-size: 9em; color: grey;"></i><br>
						{/if}
						{$row.mapname}
				</li>
		{foreachelse}
		{/foreach}
			</ul>
	{else}	
			<div>
				<table class="table-list">
					<tr class="title">
						<td>{langs('Map')}</td>
					</tr>
		{foreach from=$maps key=key item=row}
					<tr class="list">
						<td>
							<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
							<a href="{$baseUrl}/kreedz/{$row.mapname}">{$row.mapname}</a>
						</td>
					</tr>
		{foreachelse}
		{/foreach}
				</table>
			</div>
	{/if}
{else}
		<div class="table-list">
			<a href="{$baseUrl}/kreedz/maps/pro/{$rec}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
			<a href="{$baseUrl}/kreedz/maps/noob/{$rec}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
			<a href="{$baseUrl}/kreedz/maps/all/{$rec}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
			:: <a href="{$baseUrl}/kreedz/maps/{$type}/norec/{$search}">{langs('Not jumped')}</a>
		</div><br>
		
		<div class="err_message">{$message}</div>
		
		{$pages.output}
		
		<table class="table-list">
			<tr class="title">
				<td>{langs('Map')}</td>
				<td>{langs('Player')}</td>
				<td>{langs('Time')}</td>
				<td>{langs('Checkpoints')}</td>
				<td>{langs('Teleports')}</td>
				<td>{langs('Weapon')}</td>
	{if $admin==1}
				<td	>#</td>
	{/if}
			</tr>

	{foreach from=$maps item=row}
			<tr class="list">
				<td>
					<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
					<a href="{$baseUrl}/kreedz/{$row.mapname}/">{$row.mapname}</a>
				</td>
				<td><a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a></td>
				<td>{timed($row.time, 2)}</td>
				<td class="{if $row.go_cp==0}color_nogc{/if}">{$row.cp}</td>
				<td class="{if $row.go_cp==0}color_nogc{/if}">{$row.go_cp}</td>
				<td class="{if $row.wname != 'USP' && $row.wname != 'KNIFE'}color_wpn{/if}">
					<div class="wpn wpn-{$row.weapon}">&nbsp;</div>
				</td>
	{if $admin==1}
				<form action="" method="post">			
				<td>
					<input type="hidden" name="confirm" value="0">
					<input type="checkbox" name="confirm" value="1">
					<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
					<input name="delmap" type="hidden" value="{$row.map}" />
				</td>
				</form>
	{/if}			
			</tr>
	{foreachelse}
	{/foreach}
		</table>
{/if}
	</div>
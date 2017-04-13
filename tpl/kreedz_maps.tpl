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
			<div style="margin: 0 20px;">
				<b>{langs('Not jumped')}</b> :: <a href="{$baseUrl}/kreedz/maps/{$type}/{$search}">{langs('Passed')}</a>
			</div>
			
			{$pages.output}
			
	{if !isset($style)}
			<ul class='map-list'>
		{foreach from=$maps key=key item=row}	
				<li class="map-list-item" title="{$row.mapname}">
						{if file_exists("$dimg/cstrike/{$row.mapname}.jpg")}
							<img src="{$dimg}/cstrike/{$row.mapname}.jpg" alt="" title="{$row.mapname}" oncontextmenu="return false;">
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
				<div class="table list">
					<div class="tr title">
						<div>{langs('Map')}</div>
					</div>
		{foreach from=$maps key=key item=row}
					<div class="tr row">
						<div>
							<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
							<a href="{$baseUrl}/kreedz/{$row.mapname}">{$row.mapname}</a>
						</div>
					</div>
		{foreachelse}
		{/foreach}
				</div>
			</div>
	{/if}
{else}
		<div style="margin: 0 20px;">
			<a href="{$baseUrl}/kreedz/maps/pro/{$rec}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
			<a href="{$baseUrl}/kreedz/maps/noob/{$rec}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
			<a href="{$baseUrl}/kreedz/maps/all/{$rec}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
			:: <a href="{$baseUrl}/kreedz/maps/{$type}/norec/{$search}">{langs('Not jumped')}</a>
		</div>
		
		<div class="err_message">{$message}</div>
		
		{$pages.output}
		
		<div class="table list">
			<div class="tr title">
				<div>{langs('Map')}</div>
				<div>{langs('Player')}</div>
				<div>{langs('Time')}</div>
				<div>{langs('Checkpoints')}</div>
				<div>{langs('Teleports')}</div>
				<div>{langs('Weapon')}</div>
				<div></div>
	{if $admin==1}
				<div></div>
	{/if}
			</div>

	{foreach from=$maps item=row}
			<div class="tr row">
				<div>
					<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
					<a href="{$baseUrl}/kreedz/{$row.mapname}/">{$row.mapname}</a>
				</div>
				<div><a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a></div>
				<div>{timed($row.time, 2)}</div>
				<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.cp}</div>
				<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.go_cp}</div>
				<div class="{if $row.wname != 'USP' && $row.wname != 'KNIFE'}color_wpn{/if}">
					<div class="wpn wpn-{$row.weapon}">&nbsp;</div>
				</div>
				<div>
				{if isset($row.download)}
					<a class="fa fa-download" href="{$row.download}" alt="{langs('Download')} {$row.mapname}"></a>
				{/if}
				</div>
	{if $admin==1}
				<form action="" method="post">			
				<div>
					<input type="hidden" name="confirm" value="0">
					<input type="checkbox" name="confirm" value="1">
					<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
					<input name="delmap" type="hidden" value="{$row.map}" />
				</div>
				
				</form>
	{/if}			
			</div>
	{foreachelse}
	{/foreach}
		</div>
{/if}
	</div>
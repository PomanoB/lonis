	<div class="wrapper">		
		<div class="titles left_block">
			{langs('Servers')} {if $addr} :: <i>{$addr}</i>{/if}
		</div>
		<div class="right_block">
			<div id="search">
				<form action="" method="post">
					<input type="text" name="addr" value="{if isset($addr)}{$addr}{/if}" placeholder="{langs('Check IP')}" />
					<button title="{langs('Check IP')}" alt="{langs('Check IP')}"/>
				</form>
			</div>
		</div>
	</div><br><br>
	
{if $addr && $addr!="vip"}
	{if $message}
		<p><div class="err_message">{$message}</div>
	{else}
		<div id="servers">
			<div style="float: left;">
				{if isset($info.img)}
					<img class="map_image" src="{$info.img}" id="mapimg" oncontextmenu="return false;" >
				{else}
					<i class="fa fa-picture-o" style="font-size: 9em; color: grey;"></i>
				{/if}
				<div class="table servers">
					<div class="tr"><div class="title">{langs('IP')}</div><div>{$info.ip}</div></div>
					<div class="tr"><div class="title">{langs('Name')}</div><div>{$info.name}</div></div>
					<div class="tr"><div class="title">{langs('Map')}</div><div>{$info.map}</div></div>
					<div class="tr"><div class="title">{langs('Mod')}</div><div>{$info.mod}</div></div>
					<div class="tr"><div class="title">{langs('Descriptor')}</div><div>{$info.descriptor}</div></div>
					<div class="tr"><div class="title">{langs('Players')}</div><div>{$info.players} / {$info.max_players}</div></div>
					<div class="tr"><div class="title">{langs('Type')}</div><div>{$info.type}</div></div>
					<div class="tr"><div class="title">{langs('OS')}</div><div>{$info.os}</div></div>
					<div class="tr"><div class="title">{langs('Bots')}</div><div>{$info.bots}</div></div>
				</div>
			</div>
			
			<div style="float: left;">
				<div class="table servers">
					<div class="tr" >
						<div style="width: 200px"><b>{langs('Player')}</b></div>
						<div><b>{langs('Frags')}</b></div>
					</div>
			{if $players}
				{foreach from=$players item=plr}
					<div class="tr">
						<div>{$plr.name}</div>
						<div>{$plr.frag}</div>
					</div>
				{/foreach}
			{else}
				<div class="tr"><div colspan="2">{langs('Error')}</div><div>...</div></div>
			{/if}
				</div>
			</div>
		</server>
	{/if}
{else}
	{$pagess.output}
	
	<div class="table list">
		<div class="tr title">
			<div>{langs('Name')}</div>
			<div>{langs('Type')}</div>
			<div>{langs('IP')}</div>
			<div>{langs('Map')}</div>
			<div>{langs('Players')}</div>
			<div>{langs('Time')}</div>
		{if $admin}
			<div></div>
		{/if}
		</div>
	{foreach from=$servers item=row}
		<div class="tr row">
			<div>{if $row.vip==1}<i class="fa fa-star" style="color: gold;" title="VIP" alt="VIP"/></i> {/if}{$row.name}</div>			
			<div>{$row.modname}</div>
			<div><a href='{$baseUrl}/servers/{$row.addres}'><b>{$row.addres}</b></a></div>
			<div>{$row.map}</div>			
			<div>{if $row.max_players}{$row.players} / {$row.max_players}{/if}</div>
			<div><i>{$row.updatef}</i></div>
		</div>
	{foreachelse}
	{/foreach}
	</div>
{/if}
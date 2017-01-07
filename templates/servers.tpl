	<center>
{if $addr}
	<p><h2>{$langs.servers} :: <i>{$addr}</i></h2>
	{if $message}
		<p><div class="error_message">{$message}</div>
	{else}
	<p><table id="servers">
		<tr style="vertical-align: top;">
			<td width="400" align="center">	
				{if isset($info.img)}<img src="{$info.img}" id="mapimg" oncontextmenu="return false;" >{/if}
				<table class="sinfo" align="center">
					<tr><td class="th" width="100">{$langs.IP}</td><td>{$info.ip}</td></tr>
					<tr><td class="th">{$langs.Name}</td><td>{$info.name}</td>
					<tr><td class="th">{$langs.Map}</td><td>{$info.map}</td>
					<tr><td class="th">{$langs.Mod}</td><td>{$info.mod}</td>
					<tr><td class="th">{$langs.Descriptor}</td><td>{$info.descriptor}</td>
					<tr><td class="th">{$langs.players}</td><td>{$info.players} / {$info.max_players}</td>
					<tr><td class="th">{$langs.Type}</td><td>{$info.type}</td>
					<tr><td class="th">{$langs.OS}</td><td>{$info.os}</td>
					<tr><td class="th">{$langs.Bots}</td><td>{$info.bots}</td>
				</table>
			</td>
			<td>
				<table class="splayers">
					<tr>
						<td width=200><b>{$langs.player}</b></td>
						<td><b>{$langs.Frags}</b></td>
					</tr>	
				{foreach from=$players item=plr}
					<tr>
						<td>{$plr.name}</td>
						<td>{$plr.frag}</td>
					</tr>
				{/foreach}
				</table>
			</td>
		</tr>
	</table>
	{/if}
{else}
	<p><h2>{$langs.Welcome}<br><i>{$server_name}</i></h2>
	
	<p><table class="table-list">
		<tr class="title">
			<td>#</td>
			<td>{$langs.IP}</td>
			<td>{$langs.Type}</td>
			<td>{$langs.Name}</td>
			<td>{$langs.Map}</td>
			<td>{$langs.players}</td>
			<td>{$langs.Time}</td>
		</tr>
	{foreach from=$servers key=key item=serv}
		<tr class="list">
			<td>{$key+1}</td>
			<td><a href='{$baseUrl}/servers/{$serv.addres}'><b>{$serv.addres}</b></a></td>
			<td>{$serv.modname}</td>
			<td>{$serv.name}</td>
			<td>{$serv.map}</td>			
			<td>{$serv.players} / {$serv.max_players}</td>
			<td><i>{$serv.update}</i></td>
		</tr>
	{/foreach}
	</table>
	
	<form action="{$baseUrl}/servers/" method="post">
	<p><div align="center"><input type="text" name="addr" />&nbsp;<button class="but">{$langs.Check} {$langs.IP}</button></div>
	</form>
{/if}
	</center>


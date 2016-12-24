	<center>
{if $addr}
	<p><h2>{$lang_servers}</h2>
	{if $message}
		<p><div class="error_message">{$message}</div>
	{else}
	<p><table id="servers">
		<tr style="vertical-align: top;">
			<td width="400" align="center">	
				<img src="{$info.img}" id='mapimg'>
				<table class="sinfo" align="center">
					<tr><td></td></td>
					<tr><td class="th" width="100">{$langIP}</td><td>{$addr}</td></tr>
					<tr><td class="th">{$langName}</td><td>{$info.name}</td>
					<tr><td class="th">{$langIP}</td><td>{$info.map}</td>
					<tr><td class="th">{$langMod}</td><td>{$info.mod}</td>
					<tr><td class="th">{$langDescriptor}</td><td>{$info.descriptor}</td>
					<tr><td class="th">{$lang_players}</td><td>{$info.players} / {$info.max_players}</td>
					<tr><td class="th">{$langType}</td><td>{$info.type}</td>
					<tr><td class="th">{$langOS}</td><td>{$info.os}</td>
					<tr><td class="th">{$langBots}</td><td>{$info.bots}</td>
				</table>
			</td>
			<td>
				<table class="splayers">
					<tr>
						<td width=200><b>{$langPlayer}</b></td>
						<td><b>{$langFrags}</b></td>
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
	<p><div>{$langWelcome} <b>{$server_name}</b></div>
	
	<p><table>
	{foreach from=$servers item=serv}
		<tr>
			<td align="right"><p>{$serv.desc}</td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td>&nbsp;</td>
			<td><a href='{$baseUrl}/servers/"{$serv.addres}"'><b>{$serv.name}</b> (<i>{$serv.addres}</i>)</a></td>
		</tr>
	{/foreach}
	</table>
	<br>
	
	<form action="{$baseUrl}/servers" method="post">
	<p><div><input type="text" name="addr" /><br><button class="but">{$langCheck} {$langIP}</button></div>
	</form>
{/if}
	</center>


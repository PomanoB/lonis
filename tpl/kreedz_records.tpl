	<div class="wrapper">		
		<div class="titles left_block">
			{langs('Records')} ({$total})
		</div>
{if !$cs}
		<div class="right_block">
			{$form_search}
		</div>
{/if}
	</div><br><br>
	
	<div>
		<div class="err_message">{$message}</div>
		
		{$pages.output}
		
		<br>
		<table class="table-list">
			<tr class="title">
				<td>{langs('Map')}</td>
				<td>{langs('World record')}</td>
				<td>{langs('Russian record')} {if $comm_countryImg}<img src="{$baseUrl}/{$comm_countryImg}" />{/if}</td>
				<td>{langs('Server Record')}</td>
	{if $admin==1}
				<td	>#</td>
	{/if}
			</tr>

	{foreach from=$maps item=map}
			<tr class="list">
				<td><a href="{$baseUrl}/kreedz/{$map.map}/">{$map.map}{$map.mappath}</a></td>
				<td>{$map.wr_time} <i>{$map.wr_player}</i> {if $map.wr_countryImg}<img src="{$baseUrl}/{$map.wr_countryImg}" />{/if}</td>
				<td>{$map.comm_time} <i>{$map.comm_player}</i></td>
				<td>{$map.top_time} <i>{$map.top_player}</i></td>
	{if $admin==1}
				<form action="" method="post">			
				<td>
					<input type="hidden" name="confirm" value="0">
					<input type="checkbox" name="confirm" value="1">
					<button class="but" name="act" value="delete">
						<img src="{$dimg}/delete.png" border=0 alt="{langs('Delete')}">
					</button>
					<input name="delmap" type="hidden" value="{$map.map}" />
				</td>
				</form>
	{/if}			
			</tr>
	{foreachelse}
	{/foreach}
		</table>
	</div>
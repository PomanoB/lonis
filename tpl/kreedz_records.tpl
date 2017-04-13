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
		<div class="table list">
			<div class="tr title">
				<div>{langs('Map')}</div>
				<div>{langs('World record')}</div>
				<div>{langs('Russian record')} {if $comm_countryImg}<img src="{$baseUrl}/{$comm_countryImg}" />{/if}</div>
				<div>{langs('Server Record')}</div>
	{if $admin==1}
				<div	>#</div>
	{/if}
			</div>

	{foreach from=$maps item=map}
			<div class="tr row">
				<div><a href="{$baseUrl}/kreedz/{$map.map}/">{$map.map}{$map.mappath}</a></div>
				<div>{$map.wr_time} <i>{$map.wr_player}</i> {if $map.wr_countryImg}<img src="{$baseUrl}/{$map.wr_countryImg}" />{/if}</div>
				<div>{$map.comm_time} <i>{$map.comm_player}</i></div>
				<div>{$map.top_time} <i>{$map.top_player}</i></div>
	{if $admin==1}
				<form action="" method="post">			
				<div>
					<input type="hidden" name="confirm" value="0">
					<input type="checkbox" name="confirm" value="1">
					<button class="but" name="act" value="delete">
						<img src="{$dimg}/delete.png" border=0 alt="{langs('Delete')}">
					</button>
					<input name="delmap" type="hidden" value="{$map.map}" />
				</div>
				</form>
	{/if}			
			</div>
	{foreachelse}
	{/foreach}
		</div>
	</div>
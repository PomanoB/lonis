	<div class="wrapper">		
		<div class="titles left_block">
			{langs('Archive')} ({$total}) 
		</div>
		<div class="right_block">
			{$form_search}
		</div>
	</div><br><br>

	<div class="err_message">{$message}</div>
	
	{$pages.output}
	
	<br>
	<table class="table-list">
		<tr class="title">
			<td>{langs('Map')}</td>
			<td>{langs('Difficulty')}</td>
			<td>{langs('Type')}</td>
			<td>{langs('Authors')}</td>
			<td>{langs('Date')}</td>
			<td></td>
{if $admin==1}
			<td	>#</td>
{/if}
		</tr>

{foreach from=$maps item=map}
		<tr class="list">
			<td>
				<i class="fa fa-circle diff-dot" style="color: {$map.dcolor};" title="{$map.dname}"></i>
				<a href="{$baseUrl}/kreedz/{$map.mapname}/">{$map.mapname}</a>
			</td>
			<td>{$map.dname}</td>
			<td>{$map.type}</td>
			<td>{$map.authors}</td>
			<td>{$map.date_old}</td>
			<td>
			{if $map.download_url}
				<a class="fa fa-download" href="{$map.download_url}" alt="{langs('Download')} {$map.mapname}"></a>
			{/if}
			</td>
{if $admin==1}
			<form action="" method="post">			
			<td>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="delmap" type="hidden" value="{$map.map}" />
			</td>
			</form>
{/if}			
		</tr>
{foreachelse}
{/foreach}
	</table>
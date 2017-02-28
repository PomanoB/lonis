	<div class="wrapper">		
		<div class="titles left_block">
			{$langs[$parent]} :: {$langs.kz_downloads} ({$total}) 
		</div>
{if !$cs}
		<div class="right_block">
			{$form_search}
		</div>
{/if}
	</div><br><br>

	<div class="err_message">{$message}</div>
	
	{$pages.output}
	
	<br>
	<table class="table-list">
		<tr class="title">
			<td>{$langs.Map}</td>
			<td>{$langs.difficulty}</td>
			<td>{$langs.Type}</td>
			<td>{$langs.authors}</td>
			<td>{$langs.Date}</td>
			<td></td>
{if $admin==1}
			<td	>#</td>
{/if}
		</tr>

{if isset($maps)}
{foreach from=$maps item=map}
		<tr class="list">
			<td><a href="{$baseUrl}/kreedz/{$map.mapname}/">{$map.mapname}</a></td>
			<td>{$map.diff_name}</td>
			<td>{$map.type}</td>
			<td>{$map.authors}</td>
			<td>{$map.date_old}</td>
			<td>
				{if $map.download_url}
				<a href="{$map.download_url}" alt="{$langs.Download} {$map}">
				&nbsp;<img src="{$baseUrl}/img/download.png" title="{$langs.Download}" alt="{$langs.Download}">
				</a>
				{/if}
			</td>
{if $admin==1}
			<form action="" method="post">			
			<td>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="but" name="act" value="delete">
					<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langs.Delete}">
				</button>
				<input name="delmap" type="hidden" value="{$map.map}" />
			</td>
			</form>
{/if}			
		</tr>
{/foreach}
{/if}
	</table>
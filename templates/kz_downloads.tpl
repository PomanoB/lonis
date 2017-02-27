
	<div class="wrapper">		
		<div class="titles left_block">
			{$langs.kz_downloads} ({$langs.kznum}: {$total}) 
		</div>
{if !$cs}
		<div class="right_block">
			<form action="" method="post" id="search_map_form">
				<input type="text" name="search" id="search" value="{if isset($search)}{$search}{/if}" placeholder="{$langs.Search}"/>
				<input type="image" name="picture" src="{$baseUrl}/img/find.png" title="{$langs.Search}" alt="{$langs.Search}" />
				&nbsp;
			</form>
		</div>
{/if}
	</div><br>
	
	<div>

	<p><div class="err_message">{$message}</div>
	
	<p>&nbsp;{$pages.output}
	
	<table class="table-list">
		<tr class="title">
			<td>{$langs.Map}</td>
			<td>Сложность *</td>
			<td>Тип *</td>
			<td>Автор *</td>
			<td>Дата *</td>
			<td>Скачать *</td>
{if $admin==1}
			<td	>#</td>
{/if}
		</tr>

{if isset($maps)}
{foreach from=$maps item=map}
		<tr class="list">
			<td><a href="{$baseUrl}/kreedz/{$map.mapname}/">{$map.mapname}</a></td>
			<td>{$diff[$map.diff]}</td>
			<td>{$map.type}</td>
			<td>{$map.authors}</td>
			<td>{$map.date_old}</td>
			<td>
				{if $map.download_url}
				<a href="{$map.download_url}" alt="{$langs.Download} {$map}">
				&nbsp;<img src="{$baseUrl}/img/download_map.png" title="{$langs.Download}" alt="{$langs.Download}">
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
	</div>
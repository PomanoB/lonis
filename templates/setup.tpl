				<center>
				<p><h2>{#langSetup#} :: {if isset($act)}<a href="{$baseUrl}/setup/logout">{#langLogOut#}</a>{else}{#langLogin#}{/if}</h2>
				<p><div style="color: red;">{$message}</div>
{if !isset($act)}
				<form action="{$baseUrl}/setup" method="post">
					<p><table border="0" style="width: 400px;" cellpadding=2 >
						<tr>
							<td class="info">
								<label for="setting_user">{#langName#}</label>
							</td>
							<td>
								<input type="text" class="bigform" name="setting_user" id="setting_user" />
							</td>
						</tr>
						<tr>
							<td class="info">
								<label for="setting_password">{#langPassword#}</label>
							</td>
							<td>
								<input type="password" class="bigform" name="setting_password" id="setting_password" />
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><br><button>{#langLogin#}</button></td> 
					</table>
				</form>
{else}
				<p><table border="0" style="width: 400px;" cellpadding=2>
				<tbody>
					<form action="{$baseUrl}/setup/save" method="post">
	{foreach from=$conflist item=conf}
					<tr>
						<td class="info"><label for="{$conf.name}">{$conf.desc}</label></td>
						<td><input size=25 type="{$conf.type}" class="form" name="{$conf.name}" id="{$conf.name}" value="{$conf.text}"/></td>
					</tr>
	{/foreach}

					<tr>
						<td colspan="2" align="center" style="padding: 20px;"><button onclick="javascript: ">{#langSave#}</button></td> 
					</tr>
					</form>
					<tr>
						<td colspan="2" align="center" style="padding: 20px;">
							<form action="{$baseUrl}/setup/reset" method="post">
							<input type="hidden" name="comfirm" value="0">
							<input type="checkbox" name="comfirm" value="1"><button>{#langReset#}</button></td>
							</form>
						</td>
					</tr>
				</tbody>
				</table>
				
				<p><h2>{#langDbTitle#}</h2>
	{if !$comm}
					<p><div style="color: red;">{#langDbNotConnect#}</div>
	{else}
				<div id="db">
					<p>:: {#langBase#} : {$mysql_db} ::
		{if !$db}
						<a href="{$baseUrl}/setup/db/add">{#langCreate#}</a>
		{else}
						<a href="{$baseUrl}/setup/db/delete">{#langDelete#}</a>
					<p>:: {#langTables#} ::
			{if !$file_table}
						<div style="color: red;">{#langDbNotTablesFile#}</div>
			{else}
				{if !$tbl}
						<a href="{$baseUrl}/setup/db/tbl/add">{#langAdd#}</a>
				{else}
						{$tables}
						{*<a href="{$baseUrl}/setup/db/tbl/save">{#langSave#}</a>*}
					<p>:: {#langData#} ::
					{if !$file_table}
						<div style="color: red;">{#langDbNotDataFile#}</div>
					{else}
						<a href="{$baseUrl}/setup/db/data/add">{#langUpdate#}</a>
						{*<a href="{$baseUrl}/setup/db/data/save">{#langSave#}</a>*}
					{/if}
				{/if}
			{/if}
		{/if}
				</div>
	{/if}
				</center>
{/if}
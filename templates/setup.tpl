			<div class="title">
				{$langs.setup} :: 
				{if isset($act)}<a href="{$baseUrl}/setup/logout">{$langs.logout}</a>{else}{$langs.login}{/if}
			</div>
			<div class="setup_message">{$message}</div>
				
{capture name=act_login}
			<div class="login">
			  <form action="{$baseUrl}/setup" method="post">
				<table class="form_login">
					<tr>
						<td class="info"><label for="setting_user">{$langs.Name}</label></td>
						<td><input type="text" class="bigform" name="setting_user" id="setting_user" /></td>
					</tr>
					<tr>
						<td class="info"><label for="setting_password">{$langs.Password}</label></td>
						<td><input type="password" class="bigform" name="setting_password" id="setting_password" /></td>
					</tr>
				</table>
				<div class="login">
					<button>{$langs.login}</button>
				</div>
			  </form>
			</div>
{/capture}

{capture name=act_setting}
			<div class="tabs">
			   <input type="radio" id="tab-1" name="tab-group-1" checked>
				<label for="tab-1"><strong>{$langs.setupGeneral}</strong></label>
				::
			   <input type="radio" id="tab-2" name="tab-group-1">
				<label for="tab-2"><strong>{$langs.setupDb}</strong></label>
				::
			   <input type="radio" id="tab-3" name="tab-group-1">
				<label for="tab-3"><strong>{$langs.setupLang}</strong></label>
				

				<div id="setup">
					<form action="{$baseUrl}/setup" method="post">
					<table class="form_login">
		{foreach from=$conflist item=conf}
						<tr>
							<td class="info">
								<label {if $conf.err}style="color: red;"{/if} for="{$conf.name}">{$conf.desc}</label>
							</td>
							<td><input size=40 type="{$conf.type}" class="form_login" name="{$conf.name}" id="{$conf.name}" value="{$conf.text}"/></td>
						</tr>
		{/foreach}
					</table>
					
					{* Save general setting *}
					<button name="act" value="save">{$langs.Save}</button>
					</form>
					
					<form action="{$baseUrl}/setup" method="post" style="display: inline;">
						<button name="act" value="genkey">{$langs.Generate} {$langs.cookieKey}</button>
					</form>

					{* Reset to default *}					
					<div id="reset">
						<div class="message">{$resetmessage}</div>
						
					  <form name="confirmed" action="{$baseUrl}/setup#reset" method="post">
						<label for="confirm_password">{$langs.Password}</label>
						<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
					
						{*<input type="hidden" name="comfirm" value="0">
						<input type="checkbox" name="comfirm" value="1">*}
						<button name="act" value="reset">{$langs.ResetDef}</button>

					  </form>
					</div>
				
				</div>

				<div id="db">				
					<div class="title">{$langs.DbTitle}</div>
		{if !$comm}
					<div class="message">{$langs.DbNotConnect}</div>
		{else}
			{if !$check_confirm && $act}
					<div class="message">{$langs.Confirm}</div>
			{/if}
					<form name="confirmed" action="{$baseUrl}/setup" method="post">
			{if $db}		
					<p><div id="confirmed">
						<label for="confirm_password">{$langs.Password}</label>
						<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
					</div>
			{/if}
				
					<p>{$langs.Base} : <i>{$mysql_db}</i> ::
			{if !$db}
					<p><button class="dbbut" name="act" value="dbadd">{$langs.Create}</button>
			{else}
					<button class="dbbut" name="act" value="dbdelete">{$langs.Delete}</button>
					<p>{$langs.Tables} ::
				{if !$file_table}
					<div style="color: red;">{$langs.DbNotTablesFile}</div>
				{else}
					{if !$tbl}
					<button class="dbbut" name="act" value="tbladd">{$langs.Add}</button>
					{else}
							{$tables}
					<button class="dbbut" name="act" value="tblsave">{$langs.Save}</button>
					<p>{$langs.Data} ::
						{if !$file_table}
					<div style="color: red;">{$langs.DbNotDataFile}</div>
						{else}
					<button class="dbbut" name="act" value="dataadd">{$langs.Update}</a>
					<button class="dbbut" name="act" value="datasave">{$langs.Save}</a>
						{/if}
					{/if}
				{/if}
			{/if}
				 </div>
		{/if}


			</div>
		</div>
{/capture}

{if !isset($act)}
	{$smarty.capture.act_login}
{else}
	{$smarty.capture.act_setting}
{/if}




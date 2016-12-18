			<div class="title">{#lang_setup#} :: {if isset($act)}
				<a href="{$baseUrl}/setup/logout">{#lang_logout#}</a>{else}{#lang_login#}{/if}
			</div>
			<div class="setup_message">{$message}</div>
			
{* -------------------------------------------------------------------------------------------------------------------- *)
(*    Login form																										*)		
(* -------------------------------------------------------------------------------------------------------------------- *}			
{capture name=act_login}
			<div class="login">
			  <form action="{$baseUrl}/setup" method="post">
				<table class="form_login">
					<tr>
						<td class="info"><label for="setting_user">{#langName#}</label></td>
						<td><input type="text" class="bigform" name="setting_user" id="setting_user" /></td>
					</tr>
					<tr>
						<td class="info"><label for="setting_password">{#langPassword#}</label></td>
						<td><input type="password" class="bigform" name="setting_password" id="setting_password" /></td>
					</tr>
				</table>
				<div class="login">
					<button>{#lang_login#}</button>
				</div>
			  </form>
			</div>
{/capture}

{capture name=act_setting}
			<div class="tabs">
			   <input type="radio" id="tab-1" name="tab-group-1" checked>
				<label for="tab-1"><strong>{#lang_setupGeneral#}</strong></label>
				::
			   <input type="radio" id="tab-2" name="tab-group-1">
				<label for="tab-2"><strong>{#lang_setupDb#}</strong></label>
				::
			   <input type="radio" id="tab-3" name="tab-group-1">
				<label for="tab-3"><strong>{#lang_setupLang#}</strong></label>
				
{* -------------------------------------------------------------------------------------------------------------------- *)
(*    General Setting																									*)		
(* -------------------------------------------------------------------------------------------------------------------- *}
				<div id="setup">
					<table class="form_login">
						<form action="{$baseUrl}/setup" method="post">
		{foreach from=$conflist item=conf}
						<tr>
							<td class="info">
								<label {if $conf.err}style="color: red;"{/if} for="{$conf.name}">{$conf.desc}</label>
							</td>
							<td><input size=25 type="{$conf.type}" class="form_login" name="{$conf.name}" id="{$conf.name}" value="{$conf.text}"/></td>
						</tr>
		{/foreach}
					</table>
					
					{* Save general setting *}
					<div class="save">
						<button name="act" value="save">{#langSave#}</button>
					</div>
					</form>
					
					{* Reset to default *}					
					<div id="reset">
						<div class="message">{$resetmessage}</div>
						
					  <form name="confirmed" action="{$baseUrl}/setup#reset" method="post">
						<label for="confirm_password">{#langPassword#}</label>
						<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
					
						{*<input type="hidden" name="comfirm" value="0">
						<input type="checkbox" name="comfirm" value="1">*}
						<button name="act" value="reset">{#langResetDef#}</button>
					  </form>
					</div>
				
				</div>

{* -------------------------------------------------------------------------------------------------------------------- *)
(*    Database																											*)		
(* -------------------------------------------------------------------------------------------------------------------- *}
				<div id="db">				
					<div class="title">{#langDbTitle#}</div>
		{if !$comm}
					<div class="message">{#langDbNotConnect#}</div>
		{else}
			{if !$check_confirm && $act}
					<div class="message">{#langConfirm#}</div>
			{/if}
					<form name="confirmed" action="{$baseUrl}/setup" method="post">
			{if $db}		
					<p><div id="confirmed">
						<label for="confirm_password">{#langPassword#}</label>
						<input type="password" class="form_login" name="confirm_password" id="confirm_password" />
					</div>
			{/if}
				
					<p>{#langBase#} : <i>{$mysql_db}</i> ::
			{if !$db}
					<p><button class="dbbut" name="act" value="dbadd">{#langCreate#}</button>
			{else}
					<button class="dbbut" name="act" value="dbdelete">{#langDelete#}</button>
					<p>{#langTables#} ::
				{if !$file_table}
					<div style="color: red;">{#langDbNotTablesFile#}</div>
				{else}
					{if !$tbl}
					<button class="dbbut" name="act" value="tbladd">{#langAdd#}</button>
					{else}
							{$tables}
					<button class="dbbut" name="act" value="tblsave">{#langSave#}</button>
					<p>{#langData#} ::
						{if !$file_table}
					<div style="color: red;">{#langDbNotDataFile#}</div>
						{else}
					<button class="dbbut" name="act" value="dataadd">{#langUpdate#}</a>
					<button class="dbbut" name="act" value="datasave">{#langSave#}</a>
						{/if}
					{/if}
				{/if}
			{/if}
				 </div>
		{/if}
								
{* -------------------------------------------------------------------------------------------------------------------- *)
(*    Language																											*)		
(* -------------------------------------------------------------------------------------------------------------------- *}
   
				<div id="lang">
					<form action="{$baseUrl}/setup" method="post">	
					<div class="tabs_lang">
					   <input type="radio" id="tab_lang-1" name="tab-group-2" checked>
						<label for="tab_lang-1"><strong>{#langGlobal#}</strong></label>
						::
					   <input type="radio" id="tab_lang-2" name="tab-group-2">
						<label for="tab_lang-2"><strong>{#langLocal#}</strong></label>
						
						{* --- Global --- *}
						<div>
							<table class="form_login">					
				{foreach from=$lang_global key=k item=i}
								<tr>
									<td class="info">
										<label for="{$k}">{$k}</label>
									</td>
									<td>
										<input size="40" type="text" class="form_login" name="{$k}" id="{$k}" value="{$i|escape}"/>
									</td>
								</tr>
				{/foreach}
							</table>
						
							{* --- Save general setting --- *}
							<p>
								<button name="act" value="lang_save">{#langEdit#}</button>
								<button name="act" value="lang_reset">{#langReset#}</button>
							</p>
						</div>
						
						{* --- Local --- *}						
						<div>
							<table class="form_login">	
								<tr>
									<td></td>
									<td>
				{foreach name=lang from=$lang_lang key=l item=i}
										<span class="col">{$i}</span>
				{/foreach}
									</td>
								</tr>
				{foreach name=lang from=$lang_local key=l item=i}
								<tr>
									<td class="info">
										<label>{$l}</label>
									</td>
									<td>
					{foreach from=$i key=n item=t}
				<input size="30" type="text" class="form_login" name="{$l}_{$n}" id="{$l}_{$n}" value="{$t|escape}"/>
					{/foreach}																					
									</td>
								</tr>
				{/foreach}
							</table>
							
							{* --- Save local setting --- *}
							<p>
								<button name="act" value="lang_save">{#langEdit#}</button>
								<button name="act" value="lang_reset">{#langReset#}</button>
							</p>							
						</div>
						
					</div>
					</form>
				</div>
			</div>
{* -------------------------------------------------------------------------------------------------------------------- *}	
{/capture}

{if !isset($act)}
	{$smarty.capture.act_login}
{else}
	{$smarty.capture.act_setting}
{/if}




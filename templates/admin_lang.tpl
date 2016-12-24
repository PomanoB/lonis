			<div class="title">{$lang_admin_lang}</div>
			<div class="error_message">{$message}</div>
			
			<div id="lang">				
					<form action="{$baseUrl}/admin_lang#{$langvar}" method="post">	
					<table class="form_login">
						<tr class="title">
							<td>{$lang_setupLang}</td>
							<td>{$lang_Var}</td>
							<td>{$lang_Value}</td>
						</tr>
						<tr>
							<td class="other">
								{*<input name="langa" type="text"/>*}
								<select name="langx">
								<option value="" selected></option>
								{foreach from=$lang_list item=lang}
									<option value="{$lang}">{$lang}</option>
								{/foreach}
								</select>
							</td>
							<td>
								<input size="25" name="var" type="text" />
							</td>
							<td>
								<input size="40" name="value" type="text" />
							</td>
							<td colspan="4">
								<input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langAdd}">
							</td>
						</tr>
					</table>
					</form>
					<br>
					<table class="form_login">
		{foreach name=lang from=$lang_row key=l item=i}
						<form action="{$baseUrl}/admin_lang#{$l}" method="post">
						<tr id="{$l}">
							<td class="info">
								<label>{$l}:</label>
							</td>
							<td>
			{foreach from=$i key=n item=t}
								{$n} <input size="30" type="text" class="form_login" name="{$l}_{$n}" id="{$l}_{$n}" value="{$t|escape}"/>
			{/foreach}																					
							</td>
							<td>
								<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langUpdate}">
								<input type="hidden" name="confirm" value="0" />
								<input type="checkbox" name="confirm" value="1" />
								<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langDelete}">
								<input name="var" type="hidden" value="{$l}" />
							</td>
						</tr>
						</form>
		{/foreach}
					</table>						
				</div>
			</div>
			
			{$confirm_msg}





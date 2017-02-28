			<center>
			<div class="titles">{$langs.admin_langs}</div>
			<div class="error_message">{$message}</div>
			
			<div id="lang">				
					<form action="#{$langs.var}" method="post">	
					<table class="" width="80%">
						<tr class="title">
							<td>{$langs.setupLang}</td>
							<td>{$langs.Var}</td>
							<td>{$langs.Value}</td>
							<td></td>
						</tr>
						<tr>
							<td class="">
								<select class="bigform" name="langx">
								<option class="bigform" value="" selected></option>
								{foreach from=$lang_list item=lang}
									<option value="{$lang}">{$lang}</option>
								{/foreach}
								</select>
							</td>
							<td><input class="bigform" name="var" type="text" /></td>
							<td><input class="bigform" name="value" type="text" /></td>
							<td align="center"><input type="image" src="{$baseUrl}/img/add.png" name="act" value="add" alt="{$langs.Add}"></td>
						</tr>
					</table>
					</form>
					<br>
					
					<table class="table-list form_login">
						<tr class="title">
							<td>{$langs.Var}</td>
							<td>{$langs.Value}</td>
							<td></td>
						</tr>
		{foreach name=lang from=$lang_row key=l item=i}
						<form action="#{$l}" method="post">
						<tr id="{$l}">
							<td class="info">
								<label>{$l}:</label>
							</td>
							<td width="80%" align="center">
			{foreach from=$i key=n item=t}
								<b>{$n}</b> <input class="bigform2" size="45" type="text" name="{$l}_{$n}" id="{$l}_{$n}" value="{$t|escape}"/>
			{/foreach}																					
							</td>
							<td>
								<input type="image" src="{$baseUrl}/img/edit.png" name="act" value="edit" alt="{$langs.Update}">
								<input type="hidden" name="confirm" value="0" />
								<input type="checkbox" name="confirm" value="1" />
								<input type="image" src="{$baseUrl}/img/delete.png" name="act" value="delete" alt="{$langs.Delete}">
								<input name="var" type="hidden" value="{$l}" />
							</td>
						</tr>
						</form>
		{/foreach}
					</table>						
				</div>
			</div>
			</center>





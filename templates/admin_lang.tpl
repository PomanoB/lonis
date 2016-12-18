<h1>В СТАДИИ РАЗРАБОТКИ</h1>

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
					
					<p>
						<button name="act" value="lang_save">{#langEdit#}</button>
						<button name="act" value="lang_reset">{#langReset#}</button>
					</p>							
				</div>





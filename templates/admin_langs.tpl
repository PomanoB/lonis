<div align="center">		
	<div class="wrapper">		
		<div class="titles left_block">{langs('Players')}</div>
		<div class=" right_block">
			{$form_search}
		</div>
	</div><br><br>
			
	{$pages.output}
	
	<div class="error_message">{$message}</div>

	<div id="lang">				
			<table class="" width="80%">
				<form action="#{langs('var')}" method="post">	
				<tr>
					<td class="">
						<select class="bigform" name="langkey">
						{foreach from=$lang_list item=l}
							<option value="{$l}">{$l}</option>
						{/foreach}
						</select>
					</td>
					<td><input class="bigform" name="var" type="text" /></td>
					<td><input class="bigform" name="value" type="text" /></td>
					<td><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></td>
				</tr>
				</form>
				<tr class="title">
					<td>{langs('Lang')}</td>
					<td>{langs('Var')}</td>
					<td>{langs('Value')}</td>
					<td></td>
				</tr>		
	{foreach name=lang from=$rows item=row}
				<form action="" method="post">
				<tr>
					<td class="">
						<select class="bigform" name="langkey">
						{foreach from=$lang_list item=l}
							<option value="{$l}" {if $l==$row.lang}selected{/if}>{$l}</option>
						{/foreach}
						</select>
					</td>
					<td><input class="bigform" name="var" type="text" value="{$row.var}"/></td>
					<td><input class="bigform" name="value" type="text" value="{$row.value}"/></td>
					<td>
						<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
						<input type="hidden" name="confirm" value="0" />
						<input type="checkbox" name="confirm" value="1" />
						<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
						<input name="id" type="hidden" value="{$row.id}" />
					</td>
				</tr>
				</form>
	{/foreach}
			</table>						
		</div>
	</div>
</div>





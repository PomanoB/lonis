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
			<div class="" width="80%">
				<form action="#{langs('var')}" method="post">	
				<div>
					<div class="">
						<select class="bigform" name="langkey">
						{foreach from=$lang_list item=l}
							<option value="{$l}">{$l}</option>
						{/foreach}
						</select>
					</div>
					<div><input class="bigform" name="var" type="text" /></div>
					<div><input class="bigform" name="value" type="text" /></div>
					<div><button class="fa fa-plus" name="act" value="add" title="{langs('Add')}"></button></div>
				</div>
				</form>
				<div class="tr title">
					<div>{langs('Lang')}</div>
					<div>{langs('Var')}</div>
					<div>{langs('Value')}</div>
					<div></div>
				</div>		
	{foreach name=lang from=$rows item=row}
				<form action="" method="post">
				<div>
					<div class="">
						<select class="bigform" name="langkey">
						{foreach from=$lang_list item=l}
							<option value="{$l}" {if $l==$row.lang}selected{/if}>{$l}</option>
						{/foreach}
						</select>
					</div>
					<div><input class="bigform" name="var" type="text" value="{$row.var}"/></div>
					<div><input class="bigform" name="value" type="text" value="{$row.value}"/></div>
					<div>
						<button class="fa fa-pencil-square-o" name="act" value="edit" title="{langs('Update')}"></button>
						<input type="hidden" name="confirm" value="0" />
						<input type="checkbox" name="confirm" value="1" />
						<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
						<input name="id" type="hidden" value="{$row.id}" />
					</div>
				</div>
				</form>
	{foreachelse}
	{/foreach}
			</div>						
		</div>
	</div>
</div>





			<div class="title">{$lang_admin_achiev}</div>
			<div class="error_message">{$message}</div>
			
			<div class="">
				<form action="{$baseUrl}/admin_achiev/" method="post" name="achiev_admin">
					<table id="achiev_admin">
						<tr>
							<td>
								<input name="name" type="text" class="col1"/>
							</td>
							<td>
								<input name="descr" type="text" class="col2"/>
							</td>
							<td>
								<input name="count" type="text" class="col3"/>
							</td>
							<td>
								<input name="type" type="text" class="col4"/>
							</td>
							<td colspan="4" style="text-align:left;">
								<button class="but" name="act" value="add">
									<img src="{$baseUrl}/img/add.png" border=0 alt="{$langAdd}">
								</button>
							</td>
						</tr>
						<tr class="title">
							<td>{$langName}</td>
							<td>{$langDescription}</td>
							<td>{$langCount}</td>
							<td>{$langType}</td>
						</tr>
				</form>
{foreach from=$achievs item=achiev}
				<form action="{$baseUrl}/admin_achiev/" method="post">
						<tr>
							<td>
								<input value="{$achiev.name}" name="name" type="text" class="col1" />
							</td>
							<td>
								<input value="{$achiev.description}" name="descr" type="text" class="col2" />
							</td>
							<td>
								<input value="{$achiev.count}" name="count" type="text" class="col3" />
							</td>
							<td>
								<input value="{$achiev.type}" name="type" type="text" class="col4" />
							</td>
							<td>
								<button class="but" name="act" value="edit">
									<img src="{$baseUrl}/img/edit.png" border=0 alt="{$langUpdate}">
								</button>
								<input type="hidden" name="confirm" value="0">
								<input type="checkbox" name="confirm" value="1">
								<button class="but" name="act" value="delete">
									<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langDelete}">
								</button>
								<input name="id" type="hidden" value="{$achiev.id}" />
							</td>
						</tr>
			</form>
{/foreach}
					</table>
			</div>
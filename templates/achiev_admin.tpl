			<h2>{#langAchievs#}</h2>
			<div style="padding:10px;">
				<form action="achiev_admin" method="post">
					<table>
						<tr>
							<th>{#langName#}</th>
							<th>{#langDescription#}</th>
							<th>{#langCount#}</th>
							<th>{#langType#}</th>
						</tr>
						<tr>
							<td>
								<input name="name" type="text" style="width:130px;" />
							</td>
							<td>
								<input name="descr" type="text" style="width:200px;" />
							</td>
							<td>
								<input name="count" type="text" style="width:50px;" />
							</td>
							<td>
								<input name="type" type="text" style="width:70px;" />
							</td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:left;">
								<input type="submit" value="{#langAdd#}" />
								<input name="add" type="hidden" value="add" />
							</td>
						</tr>
					</table>
				</form>
{foreach from=$achievs item=achiev}
				<form action="achiev_admin" method="post">
					<table>
						<tr>
							<td>
								<input value="{$achiev.name}" name="name" type="text" style="width:130px;" />
							</td>
							<td>
								<input value="{$achiev.description}" name="descr" type="text" style="width:200px;" />
							</td>
							<td>
								<input value="{$achiev.count}" name="count" type="text" style="width:50px;" />
							</td>
							<td>
								<input value="{$achiev.type}" name="type" type="text" style="width:70px;" />
							</td>
							<td>
								<input type="submit" value="{#langUpdate#}" />
								<input name="update" type="hidden" value="update" />
								<input name="id" type="hidden" value="{$achiev.id}" />
							</td>
						</tr>
					</table>
			</form>
{/foreach}
			</div>
			<h2>{#langAchievs#}</h2>
				<span>{#langAchievs#}</span><br />
				<table>
{foreach from=$achievs item=achiev}
					<tr>
						<td style="width:65px;">
{if file_exists($achiev.aId)}
							<img src="{$baseUrl}/img/achiev/{$achiev.aId}.png" />
{else}
							<img src="{$baseUrl}/img/achiev/dead_from_sky.png" />
{/if}
						</td>
						<td>
							<div class="achiev" style="padding: 0px;">
								<div style="background-color: #464647;width: {$achiev.completed}%;overflow: visible;">
									<div style="width: 550px;padding: 10px;">
										<span style="float:right;margin-top:10px;margin-right:20px">{$achiev.completed}%</span>
										<b><a href="{$baseUrl}/achiev/{$achiev.name|replace:' ':'_'}">{$achiev.name}</a></b>
										<br />
										<span style="width:450px;display: inline-block;">{$achiev.description}</span>
									</div>
								</div>
							</div>
						</td>
					</tr>
{/foreach}
				</table>
			</div>
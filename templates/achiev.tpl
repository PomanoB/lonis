			<h2>{#langAchievs#}</h2>
			<div style="padding:10px;">
				<span>{#langAchievsPlayer#} {$playerName}</span>
				{foreach from=$achievs item=achiev}
					<div class="achiev{if $achiev.count == $achiev.progress} achiev_completed{/if}">
						<a href="{$baseUrl}/achiev/{$achiev.name|replace:' ':'_'}">{$achiev.name}</a>
						<br />
						<span style="color: #dddddd">{$achiev.description}</span>
						{if isset($achiev.width)}
							<div>
								<div class="progress_background">
									<div class="progress_bar" style="width:{$achiev.width}%">
									</div>
								</div>
								<span class="progress_counter">{$achiev.progress}/{$achiev.count}</span>
							</div>
						{/if}
					</div>
				{/foreach}
				
			</div>
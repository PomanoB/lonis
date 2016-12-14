				<table width='100%' style=';margin-top:50px;'> 
					<tr> 
						<td valign='middle'> 
							<br /> 
							<div> 
								<div></div> 
							</div> 
						</td> 
					</tr> 
				</table>
				</div>
			</div>
		</div>
		<form method="post" id="themeForm" style="padding:2px 8px 0 0;margin:0;" action="">				
			<div align="right" style="margin-right: 60px;">

			{if !isset($cs)}
				<a href="#" style="margin-left:50px;" target="_blank">Gm# Staff</a>
				<a href="http://klan-hub.ru/index.php?page=feedback" style="margin-left:50px;" target="_blank">PomanoB</a>
				<a href="http://leopold-soft.narod.ru" style="margin-left:50px;" target="_blank">Jeronimo.</a>
				
				<select style="margin-left:50px;" id="theme" name="theme" onchange="document.getElementById('themeForm').submit();">
				{foreach from=$themeselect item=value}
					<option value="{$value.name}" {if $theme==$value.name}selected{/if}>{$value.desc}</option>
				{/foreach}
				</select>
			{else}
				<a href="#" style="margin-left:50px;" target="_blank">Gm# Staff</a>
				<a href="#" style="margin-left:50px;" target="_blank">PomanoB</a>
				<a href="#" style="margin-left:50px;" target="_blank">Jeronimo.</a>	
			{/if}	
			</div>
			<br>
		</form>
	</body>
</html>
$(document).ready(function(){
	$('#showPassword').click(function(){
		$('#reg_password').after('<input class="bigform" type="'+ 
			($(this).attr('value') == 'on' ? 'text' : 'password') +
			'" id="reg_password" value="'+ $('#reg_password').attr('value')+ '" />').remove();
	})
});
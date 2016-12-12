window.onload=function() {
	var aLinks = document.getElementsByTagName('a');
	for (var i = 0, count = aLinks.length; i < count; i ++) {
		aLinks[i].onclick = function() {
			document.form.cs.value='1';
			document.form.submit();			
		}
	}
	
	var selLinks = document.getElementsByTagName('option');
	for (var i = 0, count = selLinks.length; i < count; i ++) {
		selLinks[i].onclick = function() {
			document.form.cs.value='1';
			document.form.submit();			
		}
	}
}
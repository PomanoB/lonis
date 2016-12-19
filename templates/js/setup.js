window.onload=function() {
	var id = localStorage.checked1;
	if(id) document.getElementById(id).checked = true
	var input = document.getElementsByName('tab-group-1');
	 for (var i=0; i<input.length; i++)  {
	 input[i].onclick = function() {
	 localStorage.checked1 =  this.id ;
		
	} };
};

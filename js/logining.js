function goToPage(page){
	document.location.href = page;
}

function get_info(){
	var user_login = document.getElementById('user_email').value.toString();
	var user_password = document.getElementById('user_password').value.toString();
				
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.open("POST","/CourseWork/php/log_in.php", false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("login=" + user_login + "&password=" + user_password);

	var result = xmlhttp.responseText;
	alert(result);

	return result;
}
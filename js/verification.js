function verification(){
	var result = true;

	var fisrt = document.getElementById('password');
	var second = document.getElementById('submit_password');

	if(fisrt.value != second.value){
		alert('Sorry, you enter two different passwords! Try again.');
		result = false;
	}

	return result;
}
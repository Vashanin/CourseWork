function change_page(current_user){
	if(current_user != 'none'){
		var elements = document.getElementsByClassName('hide_this');

		for(var i=0; i<elements.length; i++)
			elements[i].style.display = 'none';

		var newA = document.createElement('a');
  		
		var page_name = 'Personal page';

		if (current_user == 'Admin') 
			page_name = 'Admin page';

  		newA.innerHTML = '<li> <span> Welcome to your </span> </br> ' + page_name + ' </li>';
  		newA.setAttribute('href', '/lab7/php/main.php?page=personal_page');
		menu_list.appendChild(newA);

  		newA = document.createElement('a');
  		newA.innerHTML = '<li> <span> Stay with us! </span> </br> Log out </li>';
  		newA.setAttribute('href', '/lab7/php/main.php?page=main&log_out=true');
  		
  		menu_list.appendChild(newA);
	}
}
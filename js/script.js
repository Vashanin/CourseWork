function add_comment_to(article, current_user){
	if(current_user != '' && current_user != 'none'){	
		var parent = document.getElementById(article);

		var newComment = document.createElement('div');

		newComment.classList.add('user_comment');

		var content = '<form action="/CourseWork/php/comments.php" method="POST"> <span> You loggined as </span>';
		content += '<p>'  + current_user + '</p>';
		content += '<hr><span> Leave a reply </span> <br> <textarea id = "_' + article + '" type="textarea" name="' + article + '"></textarea>';
		content += '<input type="submit" value="Send!"></form>';

		newComment.innerHTML = content;

		parent.appendChild(newComment);
	} else {
		alert("Sorry, you should log in before adding comments");
	}
}
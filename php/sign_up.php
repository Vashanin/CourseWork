<?php
	session_start(oid);

	function get_user_info_from($path_to_file){
		$file_with_database = fopen($path_to_file, 'r');

		if($file_with_database){
			while($line = fgets($file_with_database)){
				
				if($line[0] === '#'){

					$counter = 0;
					$user_email = explode('#', $line);

					$all_users[$user_email[1]] = array();
					$user = array(); 
				}
				
				if($line[0] !== '#' && $line[0]!==' '){

					if($counter < 11){
						$user_info = explode(' ', $line);

						$user[] = $user_info[1];
					}

					if($counter === 10){
						$all_users[$user_email[1]] = $user;
					}

					$counter++;
				}
			}
		}

		fclose($file_with_database);

		return $all_users;
	}

	function add_info_to_file($path_to_file, $info){
		$file = fopen($path_to_file, 'a');

		$content = PHP_EOL.' '.PHP_EOL.'#'.$info[1].'#'.PHP_EOL.'id '.$info[0].' '.PHP_EOL.'email '.$info[1].' '.PHP_EOL.'password '.$info[2].' '.PHP_EOL.'name '.$info[3].' '.PHP_EOL.'surname '.$info[4].' '.PHP_EOL;
		fwrite($file, $content);		

		$content = 'birth '.$info[5].' '.PHP_EOL.'gender '.$info[6].' '.PHP_EOL.'photo'.$info[7].' '.PHP_EOL.'phone '.$info[8].' '.PHP_EOL.'skype '.$info[9].' '.PHP_EOL.'viber '.$info[10].' ';
		fwrite($file, $content);
		
		fclose($file);
	}
	
	$database = get_user_info_from("z:/home/localhost/www/CourseWork/txt/users.txt");
	
	$user_info = array(count($database) + 1, $_POST['login'], $_POST['password1'], $_POST['first_name'], $_POST['second_name'], $_POST['day'], $_POST['gender'], $_POST['photo'], $_POST['phone'], $_POST['skype'], $_POST['viber']);

	$user_login = $_POST['login'];
	
	if(isset($database[$user_login])){
		$_SESSION['sign_up'] = 'canceled';
		echo "<script type='text/javascript'> document.location = 'http://www.localhost/CourseWork/php/main.php?page=sign_up'; alert('You cant sing up. This email has been already used.'); </script>";
	} else {
		$_SESSION['sign_up'] = 'merged';
		add_info_to_file("z:/home/localhost/www/CourseWork/txt/users.txt", $user_info);		
		echo "<script type='text/javascript'> document.location = 'http://www.localhost/CourseWork/php/main.php?page=sign_up'; alert('Registration completed!'); </script>";
	}

	exit();
?>
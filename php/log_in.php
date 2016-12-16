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

	function get_banned_users($path_to_file){
		$file_with_banned = fopen($path_to_file, 'r');
		
		if($file_with_banned){
			$line = fgets($file_with_banned);
			$banned = explode(' ', $line);
		}

		return $banned;
	}

	$database = get_user_info_from("z:/home/localhost/www/CourseWork/txt/users.txt");

	$login = $_POST['login'];
	$password = $_POST['password'];

	$banned = get_banned_users("z:/home/localhost/www/CourseWork/txt/banned.txt");

	if(isset($database[$login])){
		$this_user_is_banned = false;

		for($i = 0; $i<count($banned); $i++)
			if($banned[$i] === $login)
				$this_user_is_banned = true;
		
		if($this_user_is_banned){
			
			echo "You are banned!";
		
		}else if($password === $database[$login][2]){
			
			$_SESSION['current_user'] = $login;
			echo "Welcome!";
		
		} else {
			echo "Wrong password!";
		}
	} else {
		echo "Unknown user!";
	}
?>
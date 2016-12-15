<?php
	function get_banned_users($path_to_file){
		$file_with_banned = fopen($path_to_file, 'r');
			
		if($file_with_banned){
			$line = fgets($file_with_banned);
			$banned = explode(' ', $line);
		}

		fclose($file_with_banned);
		return $banned;
	}

	function set_banned_users($path_to_file, $banned){
		$file_with_banned = fopen($path_to_file, 'w');

		foreach ($banned as $key => $value)
			fwrite($file_with_banned, $value.' ');

		fclose($file_with_banned);
	}

	$banned = get_banned_users("z:/home/localhost/www/lab7/txt/banned.txt");
	
	if($_POST['ban'])
		$banned[] = $_POST['ban']; 
	

	if($_POST['unban'])
		unset($banned[array_search($_POST['unban'], $banned)]);

	
	set_banned_users("z:/home/localhost/www/lab7/txt/banned.txt", $banned);

	echo "<script type='text/javascript'> document.location = 'http://www.localhost/lab7/php/main.php?page=personal_page'; </script>";
?>
<?php
	session_start(oid);

	$page_with_info = "z:/home/localhost/www/lab7/txt/user_comments.txt";

	function get_headers_from($path_to_file){
		$file_with_comments = fopen($path_to_file, 'r');
		$line = fgets($file_with_comments);
		$headers = explode('+', $line);
		fclose($file_with_comments);

		return $headers;
	}

	function add_info_to_file($path_to_file, $info){
		$file = fopen($path_to_file, 'a');

		$content = PHP_EOL.'#'.$info[0].'#'.PHP_EOL;
		fwrite($file, $content);		

		$content = 'user|'.$info[1].'|'.PHP_EOL.'comment|'.$info[2].'|'.PHP_EOL.'date|'.$info[3].'|'.PHP_EOL.'status|moderating|'.PHP_EOL.' ';
		fwrite($file, $content);
		
		fclose($file);
	}
	
	$user = $_SESSION['current_user'];
	$headers = get_headers_from($page_with_info);
	$now = getdate();
	$date = $now['year'].'-'.$now['mon'].'-'.$now['mday'];

	foreach($headers as $key=>$value)
		if($_POST[$value]){
			$user_comment = $_POST[$value];
			$current_header = $value;
		}

	$content = array($current_header, $user, $user_comment, $date);

	add_info_to_file($page_with_info, $content);
	
	echo "<script type='text/javascript'> alert('Your comment will be added after moderating.');</script>";
	echo "<script type='text/javascript'> document.location = 'http://www.localhost/lab7/php/main.php?page=main'; </script>";
?>
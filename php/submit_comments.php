<?php

	function get_comments_from($document_with_comments){
		$file = fopen($document_with_comments, 'r');

		if($file){
			$all_comments = array();

			while($line = fgets($file)){
				if($line[0] === '#'){
					$one_comment = array();

					$content = explode('#', $line);
					$header = $content[1];

					$one_comment[] = $header;
				} else if($line[0]!=='-' && $line[0]!==' ') {
					$content = explode('|', $line);
					$one_comment[] = $content[1];
				}
				if($line[0] === ' '){
					$all_comments[] = $one_comment;
				}
			}	
		}

		return $all_comments;
	}


	function remake_comments_in($document_with_comments, $merged, $deleted){
		$file = fopen($document_with_comments, 'r');

		if($file){
			$all_comments = array();

			$amount = 0;

			while($line = fgets($file)){
				if($line[0] === '#'){
					$one_comment = array();

					$content = explode('#', $line);
					$header = $content[1];

					$one_comment[] = $header;
				} else if($line[0]!=='-' && $line[0]!==' ') {
					$content = explode('|', $line);
					$one_comment[] = $content[1];
				}
				if($line[0] === ' '){
					if(!in_array($amount, $deleted)){
						if(in_array($amount, $merged))
							$one_comment[4] = "merged";

						$all_comments[] = $one_comment;
					}
					
					$amount++;
				}
			}	
		}

		fclose($file);

		return $all_comments;
	}

	function add_info_to_file($path_to_file, $info){
		$file = fopen($path_to_file, 'a');

		$content = PHP_EOL.'#'.$info[0].'#'.PHP_EOL;
		fwrite($file, $content);		

		$content = 'user|'.$info[1].'|'.PHP_EOL.'comment|'.$info[2].'|'.PHP_EOL.'date|'.$info[3].'|'.PHP_EOL.'status|'.$info[4].'|'.PHP_EOL.' ';
		fwrite($file, $content);
		
		fclose($file);
	}

	$all_comments = get_comments_from("z:/home/localhost/www/CourseWork/txt/user_comments.txt");



	$for_deleting = array();
	$for_merging = array();

	foreach ($all_comments as $key => $value) {
		if($_POST['delete_'.$key])
			$for_deleting[] = $key;
		if($_POST['merge_'.$key])
			$for_merging[] = $key;
	}

	//print_r($for_deleting);
	//print_r($for_merging);

	$new_comments = remake_comments_in("z:/home/localhost/www/CourseWork/txt/user_comments.txt", $for_merging, $for_deleting);

	/*
	foreach ($new_comments as $key => $value) {
		echo '<br>'.$key;
		foreach ($value as $item => $content) {
			echo '<br>'.$item.' : '.$content;
		}
	}
	*/
	
	$file = fopen("z:/home/localhost/www/CourseWork/txt/user_comments.txt", "w");
	fwrite($file, "video_card+cpUnit+generations+memory_unit");
	fclose($file);

	foreach ($new_comments as $key => $value)
		add_info_to_file("z:/home/localhost/www/CourseWork/txt/user_comments.txt", $value);

	echo "<script type='text/javascript'> document.location = 'http://www.localhost/CourseWork/php/main.php?page=personal_page'; </script>";
?>
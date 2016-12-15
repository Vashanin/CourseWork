<?php
	if($_GET['page'] === 'main'){
		$document_with_comments = "z:/home/localhost/www/lab7/txt/user_comments.txt";
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

		foreach ($all_comments as $article => $comment) {
			if($comment[4] === "merged"){
				echo '<script type="text/javascript"> output_comment("'.$comment[0].'","'.$comment[1].'","'.$comment[2].'"); </script>';			
			}
		}
	}
?>
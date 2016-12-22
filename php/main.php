<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<title> Dive deeper </title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" href="/images/processor.png" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="/CourseWork/style/style.css"/>
		
		<script src="/CourseWork/js/jquery-3.1.1.js"></script>
		<script src="/CourseWork/js/slide_menu.js" type="text/javascript"></script>
		<script src="/CourseWork/js/script.js" type="text/javascript"></script>
		<script src="/CourseWork/js/changing_page.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			function output_comment(article, user, comment){
				var parent = document.getElementById(article);

				var newComment = document.createElement('div');
				newComment.classList.add('comment_output');
						
				newComment.innerHTML = '<h1>' + user + '</h1><hr><p>' + comment + '</p>';

				parent.appendChild(newComment);
			}

			function user_unban(key){
				var xmlhttp = new XMLHttpRequest();

				xmlhttp.open("POST","/CourseWork/php/deal_with_banned.php", false);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("unban=" + key);
			}
			function user_ban(key){
				var xmlhttp = new XMLHttpRequest();

				xmlhttp.open("POST","/CourseWork/php/deal_with_banned.php", false);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("ban=" + key);
			}
		</script>
	</head>

	<body id="main" onload="change_page(current_user);">

		<?php include("Z:/home/localhost/www/CourseWork/html/header.html");?>
		<?php include("Z:/home/localhost/www/CourseWork/html/slide_menu.html");?>
		
		<?php 
			if($_GET['log_out'] == true)
				$_SESSION['current_user'] = 'none';
		?>

		<script type="text/javascript">
			<?php echo "var current_user = '".$_SESSION['current_user']."';";?>
		</script>

		<?php		
			$page = $_GET['page'];
			include("Z:/home/localhost/www/CourseWork/html/".$page.".html");
			include("Z:/home/localhost/www/CourseWork/php/add_comments.php");
		?>

		<?php include("Z:/home/localhost/www/CourseWork/html/footer.html");?>
	</body>
</html>
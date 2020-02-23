<?php

	session_start();
	
	if(!isset($_SESSION['username'])){
		echo "
		
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body>
				<h1>Session Expired</h1>
			</body>
			</html>
		
		";
	}
	else{
		$file='C:\\xampp\\htdocs\\notes\\docs\\'.$_GET['doc'];
		header('Content-Type: '.mime_content_type($file));
		readfile($file);		
	}

?>
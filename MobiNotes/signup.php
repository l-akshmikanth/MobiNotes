<?php

if(isset($_POST['submitted'])==1){
	$id_st = 0;
	$pwd_st = 0;
	$email_st = 0;

	$id = $_POST['id'];
	$pwd = mysqli_real_escape_string($dbc, $_POST['pwd']);
	$re_pwd = mysqli_real_escape_string($dbc, $_POST['re-pwd']);
	$email = $_POST['email'];

	$q1 = "SELECT * FROM users WHERE email = '$email'";
	$q2 = "SELECT * FROM users WHERE id = '$id'";
	
	if($pwd == $re_pwd){
		$pwd_st = 1;		
		if(mysqli_num_rows(mysqli_query($dbc, $q1)) == 0){
			$email_st = 1;	
			if(mysqli_num_rows(mysqli_query($dbc, $q2)) == 0){
				$id_st = 1;
				$q = "INSERT INTO users (id, pwd, email) VALUES ('$id', SHA1('$pwd'), '$email')";
				
				$data = mysqli_query($dbc, $q);
				if($data){
					echo "<p class='alert alert-success'>Registration Succesful</p>";
				}
				else{
					echo "<p class='alert alert-danger'>Registration failed due to technical error. Please try again...</p>";
				}
			}
			else{
				echo "<p class='alert alert-danger'>Username not available</p>";
				$id_st = -1;
			}
		}
		else{
			echo "<p class='alert alert-danger'>The email address you have entered is already registered</p>";
			$email_st = -1;
		}
	}
	else{
		echo "<p class='alert alert-warning'>Passwords don't match. Please try again...</p>";
		$pwd_st = -1;
	}
}

?>

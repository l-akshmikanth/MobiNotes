<div class="container">
<br />

<?php

if(isset($_POST['saved'])==1){
	$pwd = mysqli_real_escape_string($dbc, $_POST['pwd']);

	$q = "SELECT * FROM users WHERE id='$_SESSION[username]' AND pwd=SHA1('$pwd')";

	if(mysqli_num_rows(mysqli_query($dbc, $q))==1){
		$name = mysqli_real_escape_string($dbc, $_POST['name']);
		$about = mysqli_real_escape_string($dbc, $_POST['about']);
		
		$q = "UPDATE users SET name='$name', about='$about' WHERE id='$_SESSION[username]'";
		$r = mysqli_query($dbc, $q);
	
		if($r){
			echo "<p class='alert alert-success'>Saved successfully</p>";
		}
		else{
			echo "<p class='alert alert-danger'>Saving failed due to technical error. Please try again...</p>";
		}
	}
	else{
		echo "<p class='alert alert-danger'>Incorrect Password</p>";		
	}
}

$q = "SELECT * FROM users WHERE id='$_SESSION[username]'";
$r = mysqli_fetch_assoc(mysqli_query($dbc, $q));

?>

	<form action="" method="post">
		<div class="form-group">
			<!-- <img src="" alt="avatar"> -->
		</div>
		<div class="form-group">
			<label for="id">UserID : </label>
			<input type="text" class="form-control" id="id" name="id" value="<?php echo $r['id']; ?>" disabled>
		</div>
		<div class="form-group">
			<label for="email">Email Address : </label>
			<input type="email" class="form-control" id="email" name="email" value="<?php echo $r['email']; ?>" disabled>
		</div>
		<div class="form-group">
			<label for="pwd">Password : </label>
			<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
		</div>
		<div class="form-group">
			<label for="name">Name : </label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $r['name']; ?>" placeholder="Full Name">
		</div>
		<div class="form-group">
			<label for="about">About : </label>
			<textarea type="text" class="form-control" id="about" name="about" rows="3"><?php echo $r['about']; ?></textarea>
		</div>
		<input type="submit" class="btn btn-primary" name="saved" value="Save">
	</form>
</div>

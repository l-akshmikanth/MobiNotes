<?php

include("connection.php");

if(!empty($_POST['id'])) {
	
  $q = "SELECT * FROM users WHERE id='$_POST[id]'";
  $r = mysqli_query($dbc, $q);
  
  if(mysqli_num_rows($r)>0) {
      echo "0";
  }else{
      echo "1";
  }

}
elseif(!empty($_POST['email'])){
	
  $q = "SELECT * FROM users WHERE email='$_POST[email]'";
  $r = mysqli_query($dbc, $q);
  
  if(mysqli_num_rows($r)>0) {
      echo "0";
  }else{
      echo "1";
  }
	
}

?>
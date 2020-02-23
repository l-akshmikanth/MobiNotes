<div class="container">
	<h2 class="form-heading">Download</h2>
	<br />
	<legend>Filter Search : </legend>
    <form action="" method="post" class="form-inline">
		<div class="form-group">
			
			<label for="filter_b">Branch : </label>
			<select class="form-control" id="filter_b" name="filter_b" required>
			  <option value="">Select Branch</option>
				  
				  <?php 
				  
				  	$q = "SELECT * FROM courses";
					$r = mysqli_query($dbc, $q);
					
				  	while($row = mysqli_fetch_array($r)){ 
				  
				  ?>			
				  
				  		<option value="<?php echo $row['code']; ?>"<?php if(isset($_POST['go'])){ if($_POST['filter_b']==$row['code']){ echo " selected"; } } ?>><?php echo $row['name']; ?></option>
				  
				  <?php } ?>
				
			</select>			
		</div> &nbsp;&nbsp;&nbsp;
		<div class="form-group">
			<label for="filter_s">Semester : </label>
			<select class="form-control" id="filter_s" name="filter_s" required>
			  <option value="">Select Sem</option>
				  
				  <?php for($i=1;$i<=10;$i++){ 
				  			if($i==1){
				  ?>			

				  		<option value="EASY"<?php if(isset($_POST['go'])){ if($_POST['filter_s']=='EASY'){ echo " selected"; } } ?>>EASY</option>

				  <?php } elseif($i==2){ ?>

				  		<option value="HARD"<?php if(isset($_POST['go'])){ if($_POST['filter_s']=='HARD'){ echo " selected"; } } ?>>HARD</option>

				  <?php } else{ ?>		
				  	
					  	<option value="<?php echo $i; ?>"<?php if(isset($_POST['go'])){ if($_POST['filter_s']==$i){ echo " selected"; } } ?>><?php echo $i; ?></option>
				  
				  <?php }} ?>
				
			</select>			
		</div> &nbsp;&nbsp;&nbsp;
		<input type="submit" class="btn btn-default" name="go" value="Go">
    </form>
	<br />
	<br />
    
	<?php
	
		if($_GET['page']==2 && isset($_GET['id'])==1){
			$doc_id = $_GET['id'];
		
			$q = "SELECT * FROM votes WHERE user_id='$_SESSION[username]' AND doc_id=$doc_id";
			$r = mysqli_query($dbc, $q);
			if(mysqli_num_rows($r)==0){
				
				$q = "INSERT INTO votes (user_id, doc_id, vote) VALUES ('$_SESSION[username]', $doc_id, 1)";
				mysqli_query($dbc, $q);

				$q = "UPDATE docs SET upvote=upvote+1 WHERE sl=$doc_id";
				mysqli_query($dbc, $q);

			}
			else{
				
				$get = mysqli_fetch_assoc($r);
				switch($get['vote']){
					case 0:
						$q = "UPDATE votes SET vote=1 WHERE user_id='$_SESSION[username]' AND doc_id=$doc_id";
						mysqli_query($dbc, $q);

						$q = "UPDATE docs SET upvote=upvote+1 WHERE sl=$doc_id";
						mysqli_query($dbc, $q);
					break;
					
					case 1:
						$q = "UPDATE votes SET vote=0 WHERE user_id='$_SESSION[username]' AND doc_id=$doc_id";
						mysqli_query($dbc, $q);

						$q = "UPDATE docs SET upvote=upvote-1 WHERE sl=$doc_id";
						mysqli_query($dbc, $q);
					break;
				}				
			}
		}
	
	?>
    
    <table class="table table-hover">
        <tr>
            <th class="likes"><i class="fa fa-thumbs-up" aria-hidden="true"></i></th>
            <th>#</th>
            <th>Filename</th>
            <th>Created</th>
            <th>Branch</th>
            <th>Sem</th>
            <th>By</th>
            <th>Description</th>
            <th>View</th>
        </tr>
        
        <?php

        if (isset($_POST['go'])==1) {
        	if($_POST['filter_b']=="ALL"){
				$q = "SELECT * FROM docs WHERE semester='$_POST[filter_s]' ORDER BY upvote, created";        		
        	}
			else{
				$q = "SELECT * FROM docs WHERE branch='$_POST[filter_b]' AND semester='$_POST[filter_s]' ORDER BY upvote, created";
			}
		}
		else{
			$q = "SELECT * FROM docs ORDER BY upvote DESC, created DESC";
        }
		
        $r = mysqli_query($dbc, $q);
		
        
        $i = 1;
        while($row = mysqli_fetch_array($r)) { 

			$q = "SELECT * FROM votes WHERE user_id='$_SESSION[username]' AND doc_id=$row[sl]";
			$get = mysqli_fetch_assoc(mysqli_query($dbc, $q));
        	
    	?>

        <tr>
            <td><a href="" id="like_<?php echo $row['sl']; ?>" class="btn btn-default btn-like<?php if($get['vote']==1){ echo ' active'; } ?>"><i class="fa fa-thumbs-up<?php if($get['vote']==1){ echo ' likes'; } ?>" aria-hidden="true"></i></a><br /><span class="likes"><?php echo $row['upvote']; ?></span></td>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['filename']; ?></td>
            <td><?php echo $row['created']; ?></td>
            <td><?php echo $row['branch']; ?></td>
            <td><?php echo $row['semester']; ?></td>
            
            <?php
            
            	$sql = "SELECT * FROM users WHERE id='$row[uploader]'";
				$user = mysqli_fetch_assoc(mysqli_query($dbc, $sql));
				$user['intro'] = $user['name']."\r\n".$user['about']."\r\n".$user['email'];
            
            ?>
            
            <td>@<i data-toggle="tooltip" data-placement="top" title="<?php echo $user['intro']; ?>"><?php echo $row['uploader']; ?></i></td>
            <td><?php echo $row['description']; ?></td>
            <td><a href="view_file.php?doc=<?php echo $row['filename']; ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a></td>
        </tr>
        <?php } ?>
    
    </table>
</div>
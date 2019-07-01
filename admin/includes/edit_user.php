<?php
                            

		if (isset($_GET['edit_user']))  {


		$user_id = escape($_GET['edit_user']);


		

		$query = "SELECT * FROM users WHERE user_id = $user_id";
		$select_user_by_id = mysqli_query($connection, $query); 
		while($row = mysqli_fetch_assoc($select_user_by_id)) {
		$user_id = $row['user_id'];
		$username = $row['username'];
		$password = $row['user_password'];
		$user_firstname = $row['user_firstname'];
		$user_lastname = $row['user_lastname'];
		$user_email = $row['user_email'];
		$user_image = $row['user_image'];
		$user_role = $row['user_role'];
}


		if(isset($_POST['update_user'])){

		$username = escape($_POST['username']);
		$user_firstname = $_POST['user_firstname'];
		$user_password = $_POST['user_password'];
		$user_lastname = $_POST['user_lastname'];
		$user_email = $_POST['user_email'];
		$user_role = $_POST['user_role'];
		$user_image = $_FILES['user_image']['name'];
		$user_image_temp = $_FILES['user_image']['tmp_name'];

		

		$query = "SELECT randSalt FROM users";
    	$select_randsalt_query = mysqli_query($connection, $query);

    	if(!$select_randsalt_query) {
        die("query failed" . mysqli_error($connection));
    	}

        $row = mysqli_fetch_array($select_randsalt_query);
        //$randSalt = $row['randSalt'];
        //$hashed_password = crypt($user_password, $randSalt);
		$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));


		if (empty($user_image)){

				$query = "SELECT * FROM users WHERE user_id = $user_id";

				$select_image = mysqli_query($connection, $query);
				confirm($query);

				while($row = mysqli_fetch_assoc($select_image)) {
					$user_image = $row['user_image'];
				}
			}
			move_uploaded_file($user_image_temp, "../images/$user_image");

$query = "UPDATE `users` SET `username` = '$username', `user_password` = '$user_password', `user_firstname` = '$user_firstname', ";
$query .= "`user_lastname` = '$user_lastname', `user_email` = '$user_email', ";
$query .= "`user_image` = '$user_image', `user_role` = '$user_role' WHERE `users`.`user_id` = $user_id";

			$query_update_user = mysqli_query($connection, $query);
			confirm($query);
			
			
		}

} else {
	header("location: index.php");
}
?>





<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="username">Username</label>
		<input value="<?php echo $username; ?>" type="text" name="username" class="form-control">
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>
	

	<div class="form-group">
		<select name="user_role" id="user_role">

			<?php if ($user_role == 'Admin'){
				echo "<option value='Admin'>Admin</option>";
				echo "<option value='Subscriber'>Subscriber</option>"; 
			} else {
				echo "<option value='Subscriber'>Subscriber</option>";
				echo "<option value='Admin'>Admin</option>"; 
			} ?>


			
		</select>
	</div>


	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="firstname">Lastname</label>
		<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
	</div>
<div class="form-group">
		<img src="../images/<?php echo $user_image ;?>" width="100px">
		<label for="user_image">Image</label>
		<input type="file"  name="user_image">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
	</div>

	

	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" class="btn btn-primary" name="update_user" value="Update user">
	</div>
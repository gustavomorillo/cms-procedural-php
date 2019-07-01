<?php 

if (isset($_POST['create_user'])) {

$username = escape($_POST['username']);
$user_password = escape($_POST['user_password']);
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];

$user_image = $_FILES['user_image']['name'];
$user_image_temp = $_FILES['user_image']['tmp_name'];

$user_email = escape($_POST['user_email']);
$user_role = $_POST['user_role'];

move_uploaded_file($user_image_temp, "../images/$user_image");


$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

$query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_image, user_email, user_role) ";


$query .= "VALUES('{$username}', '{$user_password}','{$user_firstname}','{$user_lastname}','{$user_image}','{$user_email}','{$user_role}') ";

$create_user_query = mysqli_query($connection, $query);

confirm($create_user_query);

echo "<h2>User created suscefully</h2>";



}






?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Username</label>
		<input type="text" name="username" class="form-control">
	</div>



</select>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>
<div class="form-group">
		<select name="user_role" id="user_role">
			<option value='Admin'>Admin</option>
			<option value='Subscriber'>Subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<label for="First Name">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="Last Name">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>
	<div class="form-group">
		<label for="user_image">Image</label>
		<input type="file"  name="user_image">
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	
	
	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" class="btn btn-primary" name="create_user" value="Create user">
	</div>

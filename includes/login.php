<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>

<?php if (isset($_POST['login'])){
	

	login_user2($_POST['username'], $_POST['password']);
}



if (isset($_POST['logout'])) {
		  $_SESSION['username'] = null;
		  $_SESSION['password'] = null;
		  $_SESSION['user_role'] = null;
		  header("Location: ../index.php");
}

?>

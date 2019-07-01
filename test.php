<?php include "includes/header.php"; ?>
   <?php include "includes/db.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 
loggedInUserId();


?>

<?php if (userLikedThisPost(65)){
	echo "bandido le gusto";
} else echo "No le gusto";
 ?>
</body>
</html>

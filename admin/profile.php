<?php include "includes/admin_header.php" ; ?>

 <?php if (isset($_SESSION['username'])){

  $username = $_SESSION['username'];

  } ?>




    <div id="wrapper">

        <!-- Navigation -->
       
<?php include "includes/admin_navegation.php" ; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to admin <?php echo $username; ?>
                            <small>Author</small>
                        </h1>
                       
                      
<?php

$query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_by_username = mysqli_query($connection, $query); 
    while($row = mysqli_fetch_assoc($select_user_by_username)) {
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $user_id = $row['user_id'];

}

  ?>



<?php 

    if(isset($_POST['update_profile'])){

    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_password = $_POST['user_password'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $_SESSION['username'] = $username;



    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    if (empty($user_image)){

        $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";

        $select_image = mysqli_query($connection, $query);
        confirm($query);

        while($row = mysqli_fetch_assoc($select_image)) {
          $user_image = $row['user_image'];
        }
      }
      move_uploaded_file($user_image_temp, "images/$user_image");

$query = "UPDATE `users` SET `username` = '$username', `user_password` = '$user_password', `user_firstname` = '$user_firstname', ";
$query .= "`user_lastname` = '$user_lastname', `user_email` = '$user_email', ";
$query .= "`user_image` = '$user_image', `user_role` = '$user_role' WHERE `users`.`user_id` = $user_id";

      $query_update_user = mysqli_query($connection, $query);
      confirm($query);
      
      header("Location: profile.php");
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
    
    <input class="btn btn-primary" type="submit" class="btn btn-primary" name="update_profile" value="Update profile">
  </div>
                      

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
     <?php include "includes/admin_footer.php"; ?>

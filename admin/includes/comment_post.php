
<?php ob_start(); ?>
<?php include "../../includes/db.php"; ?>
<?php include "../functions.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    

  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 

  
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <link href="../css/loader.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body>
<div id="wrapper">
   




 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="">Users online:<span class="usersonline"></span></a></li>
                <li><a href="../index.php">Home</a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    
                    <li >
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments </a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View all users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>






































   


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                           



<?php 

                       if (isset($_GET['delete'])){

                        $comment_post_id = $_GET['comment_post_id'];

                        $comment_id = $_GET['delete'];


                         $query = "DELETE FROM comments WHERE comment_id = '{$comment_id}'";
                         $delete_post_query = mysqli_query($connection, $query);
                         $row = mysqli_fetch_array($delete_post_query);

                        confirm($delete_post_query);


                        header("Location: comment_post.php?id={$comment_post_id}");

                       }

                       ?>

                        <?php 

                        if (isset($_GET['unapprove'])){ 
                        $comment_id = $_GET['unapprove'];
                        $query = "UPDATE comments set comment_status = 'unapproved' WHERE comment_id = $comment_id";
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                         //header("Location: comment_post.php");
                       }


                       if (isset($_GET['approve'])){ 
                        $comment_id = $_GET['approve'];
                        $query = "UPDATE comments set comment_status = 'approved' WHERE comment_id = $comment_id";
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                        // header("Location: comment_post.php");
                       }

                       ?>









<table class="table table-bordered table-hover">
                        <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Post author</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>


                                </tr>


                        </thead>
                        <tbody>
                            

                            <?php
                            if (isset($_GET['id'])){
                              $post_id = $_GET['id'];  

                            


                            $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                            $select_comments = mysqli_query($connection, $query); 
                            while($row = mysqli_fetch_assoc($select_comments)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];

                            echo "<tr>";
                            echo "<td>$comment_id</td>";
                            echo "<td>$comment_author</td>";
                            echo "<td>$comment_content</td>";


                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                            $select_posts = mysqli_query($connection, $query); 

                            $row = mysqli_fetch_assoc($select_posts);
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];



                            echo "<td>$comment_email</td>";
                            echo "<td>$comment_status</td>";
                            echo "<td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td>";
                            echo "<td>$post_author</td>";
                            echo "<td>$comment_date</td>";
                            echo "<td><a href='comment_post.php?approve=$comment_id'>Approve</a></td>";
                            echo "<td><a href='comment_post.php?unapprove=$comment_id'>Unapprove</a></td>";
                            echo "<td><a href='comment_post.php?delete=$comment_id&comment_post_id={$comment_post_id}'>Delete</a></td>";
                            echo "</tr>";

                        }
                        }
                             ?>
                        </tbody>


                       </table>









                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

         <?php include "admin_footer.php"; ?>
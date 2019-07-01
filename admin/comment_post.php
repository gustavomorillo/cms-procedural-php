<?php include "includes/admin_header.php" ; ?>


    <div id="wrapper">

        <!-- Navigation -->
       
<?php include "includes/admin_navegation.php" ; ?>

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

                        $comment_post_id = mysqli_real_escape_string($connection, $_GET['comment_post_id']);


                        $comment_id = mysqli_real_escape_string($connection, $_GET['delete']);


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
                        $comment_post_id = $_GET['comment_post_id'];
                        $query = "UPDATE comments set comment_status = 'unapproved' WHERE comment_id = $comment_id";
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                         header("Location: comment_post.php?id={$comment_post_id}");
                       }


                       if (isset($_GET['approve'])){ 
                        $comment_post_id = $_GET['comment_post_id'];
                        $comment_id = $_GET['approve'];
                        $query = "UPDATE comments set comment_status = 'approved' WHERE comment_id = $comment_id";
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                        header("Location: comment_post.php?id={$comment_post_id}");
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
echo "<td><a href='comment_post.php?approve=$comment_id&comment_post_id={$comment_post_id}'>Approve</a></td>";
echo "<td><a href='comment_post.php?unapprove=$comment_id&comment_post_id={$comment_post_id}'>Unapprove</a></td>";
echo "<td><a href='comment_post.php?delete=$comment_id&comment_post_id=" . $_GET['id'] . "'>Delete</a></td>";
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
     <?php include "includes/admin_footer.php"; ?>

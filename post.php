<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navegation.php"; ?>

<?php if(isset($_POST['liked'])) {
  
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];

$query = "SELECT * FROM posts WHERE post_id ='$post_id'";
$postResult = mysqli_query($connection, $query);
$post = mysqli_fetch_array($postResult);
$likes = $post['likes'];


mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");

mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES ($user_id, $post_id)");

}
?>

<?php if(isset($_POST['unliked'])) {
  
  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];

$query = "SELECT * FROM posts WHERE post_id ='$post_id'";
$postResult = mysqli_query($connection, $query);
$post = mysqli_fetch_array($postResult);
$likes = $post['likes'];


mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id AND user_id='{$user_id}'");

mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id='{$user_id}'");

}
?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                if (isset($_POST['create_comment'])){
                if ($_POST['comment_author'] == "" | $_POST['comment_email'] == "" | $_POST['comment_content'] == ""){
                    echo "This field can't no be empty";
                } else {


                if (isset($_POST['create_comment'])){
                  $post_id = $_GET['p_id']; 
                  $comment_author = $_POST['comment_author'];
                  $comment_email = $_POST['comment_email'];
                  $comment_content = $_POST['comment_content'];
                  $comment_status = "Unapproved";
          
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $select_all_posts = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($select_all_posts);
                $post_comment_count = $row['post_comment_count'];
                $post_comment_count++;

                //$query = "UPDATE `posts` SET `post_comment_count` = '{$post_comment_count}' WHERE `posts`.`post_id` = $post_id";

                //$post_comment_query = mysqli_query($connection, $query); 
                //if (!$post_comment_query) {
                //die('Query Failed' . mysqli_error($connection));
                // }                
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= "VALUES({$post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())"; 

                $create_comment_query = mysqli_query($connection, $query); 
                if (!$create_comment_query) {
                die('Query Failed' . mysqli_error($connection));
                 }
                }
                }
                }

                ?>
                 <?php if (isset($_GET['p_id'])){

                    $post_id = $_GET['p_id']; 
                    $query = "UPDATE `posts` SET `post_view_count` = post_view_count + 1 WHERE `posts`.`post_id` = {$post_id}";
                    $query_post_count = mysqli_query($connection, $query);
                    if (!$query_post_count) {
                        die('query failed' . mysqli_error($connection));
                    }

                 ?>


                    <?php 

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
                        $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    } else {
                        $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published'";
                        $select_all_posts2 = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($select_all_posts2);
                        

                        $select_all_posts2 = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($select_all_posts2);
                        if (empty($count)){
                            echo "No Posts";
                        }
                    }
                    $select_all_posts = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts)) {

                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                     ?>
                

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>


                    si el usuario actual en el post actual le gusto: mostrar unlike button
                    else: Mostrar like button
                   

                    <?php if (isLoggedIn()) {?>


                   <?php if (!userLikedThisPost($post_id)){
                    echo '<div class="row"><p class="pull-right"><a class="like" href="" data-toggle="tooltip" title="like this post"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a></p></div>';
                   } else {
                    echo '<div class="row">
                        <p class="pull-right"><a class="unlike" href="" data-toggle="tooltip" title="You already like this post"><span class="glyphicon glyphicon-thumbs-down"></span>unlike</a></p>
                    </div>';
                   }
                   ?> 

                    <? } else {  ?>

                    <div class="row">
                        <p class="pull-right">You need to log in to Like post: <a href="/cms/login.php">Log in</a></p>
                    </div> 
                    <?php } ?>
                    
                        
                    <div class="row">
                        
                        <p class="pull-right like">likes: <?php echo getPostlikes($post_id); ?> </p>

                    </div>

                    <style>
                    p.pull-right.like {
                        font-size: 25px;
                    }
                    </style>

                    




                    <div class="clearfix"></div>


                    <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <label for="Author">Author</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <label for="email">Email</label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <label for="content">Your comment</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>




                <?php 
                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if (!$select_comment_query) {
                die('Query Failed' . mysqli_error($connection));
                 }

                 while ($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                 
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small>August 25, <?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            <?php  } } ?>


                   <?php } else {
                    header("Location: index.php");
                   } ?>
                    
                

                <hr>

                <!-- Posted Comments -->




                
                <!-- Comment -->
            
                

            </div>

            <!-- Blog Sidebar Widgets Column -->

               <?php include "includes/sidebar.php"; ?>
           

        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php"; ?>

      <script>
            

            $(document).ready(function(){
                
                    $('[data-toggle="tooltip"]').tooltip();
                    var post_id = <?php echo $post_id; ?>;
                    var user_id = <?php echo loggedInUserId(); ?>
                    
                    $('.like').click(function(){
                    $.ajax({
                    url:"/cms/post.php?p_id=<?php echo $post_id; ?>",
                    type:'post',
                    data: {
                        'liked':1,
                        'post_id':post_id,
                        'user_id':user_id
                    }
                });    
            });



                    $('.unlike').click(function(){
                    $.ajax({
                    url:"/cms/post.php?p_id=<?php echo $post_id; ?>",
                    type:'post',
                    data: {
                        'unliked':1,
                        'post_id':post_id,
                        'user_id':user_id
                    }
                });    
            });
        });




      </script>
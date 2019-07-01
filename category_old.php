<?php include "includes/header.php"; ?>


    <!-- Navigation -->
<?php include "includes/navegation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">






                <?php 
                $per_page = 10;
                ?>
                 <?php 


                    if (isset($_GET['category'])) {

                        $cat_id = $_GET['category'];
                    }

                  
                ?>



                <?php 


                    if (isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] == 'Admin'){


                        $query = "SELECT * FROM posts WHERE post_category_id = '{$cat_id}'";



                        $select_all_posts = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($select_all_posts);
                        $count = ceil($count/$per_page); 
                        if (isset($_GET['page'])){
                            $page = $_GET['page'];
                        } else {
                            $page = "";
                        }
                        if ($page == "" | $page == 1){
                            $page_1 = 0;
                        } else {
                            $page_1 = ($page * $per_page) - $per_page;
                        }
                        $query = "SELECT * FROM posts WHERE post_category_id = '{$cat_id}' AND post_category_id = '{$cat_id}'  LIMIT $page_1, $per_page ";


                        } 
                        else {

                        $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '{$cat_id}'";


        

                        $select_all_posts = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($select_all_posts);
                        $count = ceil($count/$per_page); 
                        
                        if (isset($_GET['page'])){
                            $page = $_GET['page'];
                        } else {
                            $page = "";
                        }
                        if ($page == "" | $page == 1){
                            $page_1 = 0;
                        } else {
                            $page_1 = ($page * $per_page) - $per_page;
                        }
                           $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '{$cat_id}' LIMIT $page_1, $per_page";

                        }
                        
                        


                    } else { 
                        
                        $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '{$cat_id}' ";
                        $select_all_posts = mysqli_query($connection, $query);

                        $count = mysqli_num_rows($select_all_posts);
                    
                        $count = ceil($count/$per_page); 
                        
                        if (isset($_GET['page'])){
                            $page = $_GET['page'];
                        } else {
                            $page = "";
                        }
                        if ($page == "" | $page == 1){
                            $page_1 = 0;
                        } else {
                            $page_1 = ($page * $per_page) - $per_page;
                        }
                        $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '{$cat_id}'  LIMIT $page_1, $per_page";

                        }
                        
                        


                    $select_all_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_posts)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                        $post_status = $row['post_status'];

                        
                        ?>


                

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?author=<?php echo $post_author?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               <?php } 
                if (isset($post_id)) {echo "";} else { 
                    //header("location: index.php");

                    echo "<h1>No Posts</h1>"; }
                ?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->

               <?php include "includes/sidebar.php"; ?>
           

        </div>
        <!-- /.row -->

        <hr>
        
        <?php 
        
        
        if (!$count == 1){

            echo "<ul class='pagination'>
            <li class='page-item'><a class='page-link' href=''>Previous</a></li>";


        for($i = 1; $i<=$count; $i++) {

        if ($i == $page) {

         echo "<li class='page-item'><a class='page-link active-link' href='index.php?page={$i}'>{$i}</a></li>";

        } else {
            echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
        }


           echo "<li class='page-item'><a class='page-link' href='#''>Next</a></li>
        </ul>";
        } }
        ?>
        

   

      <?php include "includes/footer.php"; ?>
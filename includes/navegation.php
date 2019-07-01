   <?php include "includes/db.php"; ?>



  



    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   

                    <?php 



                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_categories_query)) {

                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        $active = "";

                        if (isset($_GET['category']) && $_GET['category'] == $cat_id){

                            $active = "active";
                        }

                        echo "<li class='$active'><a href='/category/$cat_id'>{$cat_title}</a></li>";
                    }



                    ?>

                    <li>
                        
                        <a href="/admin/">admin</a>
                    </li>
                    <?php 

                    $pageName = basename($_SERVER['PHP_SELF']);
                    $registration = 'registration.php';

                    if ($pageName == $registration){
                        $active2 = 'active';
                    } else {
                        $active2 = "";
                    }



                    ?>
                    <li class='<?php echo $active2 ?>'>
                        
                        <a href="/registration">Registration</a>
                    </li>
                    <?php 
                    $pageName = basename($_SERVER['PHP_SELF']);
                    $login = 'login.php';

                    if ($pageName == $login){
                        $active2 = 'active';
                    } else {
                        $active2 = "";
                    } ?>

                    <?php
                    if (!isLoggedIn()){

                        echo "<li class='$active2'><a href='/login.php'>Login</a></li>";
                    } else {
                        echo "<li class='$active2'><a href='/includes/logout.php'>Logout</a></li>";
                    }
                    ?>






<?php 

    if (isset($_SESSION['user_role'])){

        

        if (isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];

           echo "<li><a href='/admin/posts.php?source=edit_post&p_id={$post_id}'>Edit post</a></li>";

        }

        
    }

?>


                   


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
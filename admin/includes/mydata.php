
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>

<?php include "includes/admin_header.php" ; ?>



<?php 

    if (!isset($_SESSION['user_role'])){
    header("location: ../index.php");
}
    // } elseif ($_SESSION['user_role'] == "subscriber") {
    //      header("location: ../index.php");
    // }

?>
 <?php

                ?>




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
                            <small><?php echo $_SESSION['username']; ?></small>
                            <small><?php echo $_SESSION['user_role']; ?></small>
                        </h1>
                       
                        
                    </div>
                </div>
                <!-- /.row -->



        <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'>
                      
<?php 

echo $rows_number_posts = recordCount("posts");

?>
                  </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>
<?php 


echo $rows_number_comments = recordCount("comments");
    

?>


                     </div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'>




<?php 


echo $rows_number_users = recordCount("users");
    

?>


</div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            

<?php 


echo $rows_number_categories =  recordCount("categories");
    

?>








                        </div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

<?php 

$rows_published_posts = recordCount2("posts", "post_status", "published");
$rows_draft_posts = recordCount2("posts", "post_status", "draft");
$rows_unapproved_comments = recordCount2("comments", "comment_status", "unapproved");
$rows_subscriber_user = recordCount2("users", "user_role", "Subscriber");

?>
                <div class="row">
                    

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
['Data', 'Count'],

<?php 

 $elements = ['All posts', 'Active posts', 'Draft posts', 'comments', 'unapproved comments', 'users', 'Subscriber Users', 'categories'];
            $elements_values = [$rows_number_posts, $rows_published_posts, $rows_draft_posts, $rows_number_comments, $rows_unapproved_comments, $rows_number_users, $rows_subscriber_user, $rows_number_categories];




               for($i = 0; $i < 8; $i++){
                 echo "['$elements[$i]', $elements_values[$i]],";
               }

?>

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


 <div id="columnchart_material" style="width: auto; height: 500px;"></div>

  </div>

            </div>
            <!-- /.container-fluid -->

        </div>
     <?php include "includes/admin_footer.php"; ?>
     
     <script>


        $(document).ready(function(){


            var pusher = new Pusher('566a5838f65bc5cb375c', {
                cluster: 'us2',
                encrypted:true
            });

            var notificationChannel = pusher.subscribe('notifications');

                notificationChannel.bind('new_user', function(notification){
                    var message = notification.message;
                    console.log(message);



                });


        });

     </script>
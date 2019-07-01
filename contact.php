
 <?php include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php include "includes/navegation.php"; ?>
    
 

    <?php 

    if (isset($_POST['submit'])){

    $to = "gustavomorillo@gmail.com";
    $email = "From: " .$_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    mail($to, $subject, $content, $email);
    }
    ?>




    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>

                        <div class="form-group">  
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>

                         <div class="form-group">
                            <textarea class="form-control" rows="10" cols="30" name="content"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>

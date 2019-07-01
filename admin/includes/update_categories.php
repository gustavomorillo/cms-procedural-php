<?php 
                            if (isset($_POST['submit_edit'])){

                            $cat_title=    $_POST['cat_title'];

                            $query = "SELECT * FROM categories WHERE cat_title = $cat_title";
                            $select_categories = mysqli_query($connection, $query);

                            
                            $cat_id = $_GET['edit'];
                            $category = $_POST['cat_title'];



                            if ($category == "" || empty($category)) {
                                echo "You must write something";
                            } else {
                                 $stmt = mysqli_prepare($connection, "UPDATE categories set cat_title = ? WHERE cat_id = ? " );
                                 mysqli_stmt_bind_param($stmt, 'si', $cat_title, $cat_id );
                                 mysqli_stmt_execute($stmt);
                            }

                            if (!$stmt) {
                                die('Query Failed' . mysqli_error($connection));
                            }
                            mysqli_stmt_close($stmt);
                                header("location: categories.php");

                            }
                            
                         ?>

                         <form action="" method="POST">
 
                                <div class="form-group">
                                    <label for="cat_title">Edit</label>
                                    <?php $cat_title2 ="";
                            
                            

                            if (isset($_GET['edit'])) {

                            $cate_id = $_GET['edit'];

                            $query2 = "SELECT * FROM categories WHERE cat_id = $cate_id";
                            $select_categories2 = mysqli_query($connection, $query2); 

                            $row2 = mysqli_fetch_assoc($select_categories2);
                            $cat_title2 = $row2['cat_title'];

                            ?>  

                            <input type="text" class="form-control" name="cat_title" value="<?php if($cat_title2 !== "") {echo $cat_title2; } ?>">
                           
                            <?php } ?>


                                   </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit_edit" value="Update"> 
                                </div>

                             </form>
<?php include "delete_modal.php"; ?>
<?php
            if (isset($_POST['checkBoxArray'])){

                foreach ($_POST['checkBoxArray'] as $PostIdValue) {
                  $bulk_options = $_POST['bulk_options'];  

                  switch ($bulk_options) {
                      case 'publish':
                    $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $PostIdValue";
                    $publish_query = mysqli_query($connection, $query);

                    if (!$publish_query){
                        die('QUERY failed'. mysqli_error($connection)) ;
                    }

                          break;

                          case 'draft':
                    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $PostIdValue";
                    $draft_query = mysqli_query($connection, $query);

                    if (!$draft_query){
                        die('QUERY failed'. mysqli_error($connection)) ;
                    }
                              break;

                        case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = '{$PostIdValue}'";
                        $draft_query = mysqli_query($connection, $query);

                        if (!$draft_query){
                        die('QUERY failed'. mysqli_error($connection)) ;
                        }
                            break;


                        case 'clone':


                        $query = "SELECT * FROM posts WHERE post_id = '{$PostIdValue}'";
                        $clone_query = mysqli_query($connection, $query);

                        if (!$clone_query){
                        die('QUERY failed'. mysqli_error($connection)) ;
                        }

                        while($row = mysqli_fetch_assoc($clone_query)) {
                            $post_id = $row['post_id'];
                            $post_author = $row['post_author'];
                            $post_title = $row['post_title'];
                            $post_category_id = $row['post_category_id'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];
                            $post_date = $row['post_date'];

                        }

                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";


                        $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";
                      
                        $clone_post_query = mysqli_query($connection, $query);

                        if (!$clone_post_query){
                        die('QUERY failed'. mysqli_error($connection)) ;
                        }
                      default:
                          # code...
                          break;
                  }



                }

                }
            

?>



                    <?php 
                       if (isset($_POST['delete'])){
                        $post_id=$_POST['post_id'];
                        $query = "DELETE FROM posts WHERE post_id = '$post_id'";
                        $delete_post_query = mysqli_query($connection, $query);
                        confirm($delete_post_query);
                        header("Location: posts.php");
                       }

                       ?>

                       <?php 
                       if (isset($_GET['reset_view'])){
                        


                        $query = "UPDATE `posts` SET `post_view_count` = '0' WHERE `posts`.`post_id` =" . mysqli_real_escape_string($connection, $_GET['reset_view']);
                        $delete_post_query = mysqli_query($connection, $query);
                        confirm($delete_post_query);
                        header("Location: posts.php");
                       }

                       ?>









<form action="" method="post">

<table class="table table-bordered table-hover">



    <div id="tableX" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="publish">Publish</option>
        <option value="draft">Draft</option>
        <option value="clone">Clone</option>
        <option value="delete">Delete</option>
        </select>
    </div>
        
    <div class="col-xs-4">
        
        <input type="submit" name="submit" class="btn btn-success" value="Apply"><a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>


    </div>



                        <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Post view count</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>


                        </thead>
                        <tbody>
                            <?php
$query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_view_count, posts.post_date, categories.cat_id, categories.cat_id, categories.cat_title FROM posts LEFT join categories ON posts.post_category_id = categories.cat_id ORDER BY post_id DESC";



                            //$query = "SELECT * FROM posts ORDER BY post_id DESC";
                            $select_posts = mysqli_query($connection, $query); 
                            while($row = mysqli_fetch_assoc($select_posts)) {
                            $post_id =              $row['post_id'];
                            $post_author =          $row['post_author'];
                            $post_title =           $row['post_title'];
                            $post_category_id =     $row['post_category_id'];
                            $post_status =          $row['post_status'];
                            $post_image =           $row['post_image'];
                            $post_tags =            $row['post_tags'];
                            $post_comment_count =   $row['post_comment_count'];
                            $post_view_count =      $row['post_view_count'];
                            $post_date =            $row['post_date'];
                            $category_title =       $row['cat_title'];
                            $category_id =          $row['cat_id'];

                            echo "<tr>";
                            ?>

                            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>

                            <?php



                            echo "<td>$post_id</td>";
                            echo "<td>$post_author</td>";
                            echo "<td><a href='../index.php?p_id={$post_id}'>$post_title</a></td>";


                            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                            // $select_categories = mysqli_query($connection, $query); 

                            // $row = mysqli_fetch_assoc($select_categories);
                            // $cat_title = $row['cat_title'];



                            echo "<td>$category_title</td>";






                            echo "<td>$post_status</td>";
                            echo "<td><img src='../images/$post_image' width='60px'></td>";
                            echo "<td>$post_tags</td>";

                            $query2 = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                            $query_comments2 = mysqli_query($connection, $query2);
                            if(!$query_comments2){
                                die("query failed" . mysqli_error($connection));
                            }

                            $row = mysqli_fetch_array($query_comments2);
                            $comment_id = $row['comment_id'];
                            $count_comment = mysqli_num_rows($query_comments2);






                            echo "<td><a href='comment_post.php?id={$post_id}'>$count_comment</a></td>";



echo "<td><a href='posts.php?reset_view=$post_id' onClick =\" javascript:return confirm('Are you sure you want to reset view count?'); \">$post_view_count</a></td>";
echo "<td>$post_date</td>";
echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}' >View Post</a></td>";
echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>"; ?>


<form method="post">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

<?php
    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="delete"</td>'; 
    ?>
</form>

<?php



// echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
//echo "<td><a onClick =\" javascript:return confirm('Are you sure you want to delete?'); \" href='posts.php?delete=$post_id'>Delete</a></td>";
echo "</tr>";

                        }
                             ?>
                        </tbody>


                       </table>
                       </form>



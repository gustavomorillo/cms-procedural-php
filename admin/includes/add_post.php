<?php 

if (isset($_POST['create_post'])) {

$post_title = $_POST['title'];
$post_author = $_POST['author'];
$post_category_id = $_POST['post_category_id'];
$post_status = $_POST['post_status'];

$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];

$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');
$post_comment_count = 0;

move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";


$query .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";

$create_post_query = mysqli_query($connection, $query);

confirm($create_post_query);


$query2 = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 1";
$create_post_query2 = mysqli_query($connection, $query2);
confirm($create_post_query2);

$row = mysqli_fetch_assoc($create_post_query2); 
$post_id = $row['post_id'];


echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id={$post_id}'> View post</a> or <a href='posts.php?source=add_post'>Add More Posts</a></p>";

}








?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input class="form-control" type="text" name="title" class="form-control">
	</div>

	<div class="form-group">

	<select  class="form-control" name="post_category_id" id="post_category">

<?php


			    $query = "SELECT * FROM categories";
                            $select_categories= mysqli_query($connection, $query); 

			    confirm($select_categories);

                            while($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
				
			    echo "<option value='{$cat_id}'>$cat_title</option>";

 			}


?>

</select>
</div>

	<!-- <div class="form-group">
		<label for="Post Author">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div> -->



<div class="form-group">
	<label for="Author">Author</label>
<select  class="form-control" name="author" id="author">


<?php


			    $query = "SELECT * FROM users";
                $select_users= mysqli_query($connection, $query); 

			    confirm($select_users);

                while($row = mysqli_fetch_assoc($select_users)) {
                $username = $row['username'];
                $user_id = $row['user_id'];
				
			    echo "<option value='{$username}'>$username</option>";

 			}


?>
</select>
</div>










<div class="form-group">
	<label for="post_status">Post Status</label>
<select  class="form-control" name="post_status" class="form-control">
  <option value="draft">Draft</option>
  <option value="published">Published</option>

</select>
</div>

	<div class="custom-file">
		<label for="myfile" class="custom-file-label">Post Image</label>
		<input  class="custom-file-input" id="myfile" type="file"  name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input  class="form-control" type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>

<?php
                            

		if (isset($_GET['p_id']))  {


		$the_post_id = $_GET['p_id'];


		}

		$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
		$select_posts_by_id = mysqli_query($connection, $query); 
		while($row = mysqli_fetch_assoc($select_posts_by_id)) {
		$post_id = $row['post_id'];
		$post_author = $row['post_author'];
		$post_title = $row['post_title'];
		$post_category_id = $row['post_category_id'];
		$post_status = $row['post_status'];
		$post_image = $row['post_image'];
		$post_tags = $row['post_tags'];
		$post_content = $row['post_content'];
		$post_comment_count = $row['post_comment_count'];
		$post_date = $row['post_date'];
}



		if (isset($_POST['update_post'])) {

			$post_author = $_POST['post_author'];
			$post_title = $_POST['post_title'];
			$post_category_id = $_POST['post_category'];
			$post_status = $_POST['post_status'];
			$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];
			$post_content = $_POST['post_content'];
			$post_tags = $_POST['post_tags'];

			if (empty($post_image)){

				$query = "SELECT * FROM posts WHERE post_id = $the_post_id";

				$select_image = mysqli_query($connection, $query);
				confirm($query);

				while($row = mysqli_fetch_assoc($select_image)) {
					$post_image = $row['post_image'];
				}


			}

			move_uploaded_file($post_image_temp, "../images/$post_image");



$query = "UPDATE `posts` SET `post_category_id` = '$post_category_id', `post_title` = '$post_title', `post_author` = '$post_author', `post_date` = now(), `post_image` = '$post_image', `post_content` = '$post_content', `post_tags` = '$post_tags', `post_status` = '$post_status' WHERE `posts`.`post_id` = $the_post_id";



			$update_post = mysqli_query($connection, $query);
			confirm($update_post);

			echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id=$the_post_id'> View post</a> or <a href='posts.php'>Edit More Posts</a></p>";
		}
?>





<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" name="post_title" class="form-control">
	</div>

	<div class="form-group">

	<select name="post_category" id="post_category">

<?php
			

			   


 			$query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
 			$select_categories= mysqli_query($connection, $query);
 			confirm($select_categories);


 		$row = mysqli_fetch_assoc($select_categories);
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
				
			    echo "<option value='{$cat_id}'>$cat_title</option>";


			    

				 $query = "SELECT * FROM categories";
                            $select_categories= mysqli_query($connection, $query); 

			    confirm($select_categories);

                            while($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_title2 = $row['cat_title'];
                            


				if ($cat_title == $cat_title2){
					
				} else {
					echo "<option value='{$cat_id}'>$cat_title2</option>";
				}
			    

 			}


?>

</select>
</div>
	<!-- <div class="form-group">
		<label for="Post Author">Post Author</label>
		<input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
	</div> -->

	
<div class="form-group">
	<label for="Author">Author</label>
<select name="post_author" id="author">


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
	<label for="status">Status</label>
		<select name="post_status" id="post_status">

			<?php if ($post_status == 'published'){
				echo "<option value='published'>Publish</option>";
				echo "<option value='draft'>Draft</option>"; 
			} else {
				echo "<option value='draft'>Draft</option>";
				echo "<option value='published'>Publish</option>"; 
			} ?>


			
		</select>
	</div>












	<div class="form-group">
		<img src="../images/<?php echo $post_image ;?>" width="100px">
		<label for="post_image"></label>
		<input type="file"  name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="30"><?php echo $post_content; ?></textarea>
	</div>
	<div class="form-group">
		
		<input class="btn btn-primary" type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
	</div>
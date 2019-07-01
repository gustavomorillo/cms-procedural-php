<?php


function escape($string){
global $connection;
return mysqli_real_escape_string($connection, trim($string));
}


function redirect($location){
    header("location: " . $location);
    exit;
}

function query($query){
    global $connection;
    return mysqli_query($connection, $query);
}



function loggedInUserId(){
global $connection;
    if (isLoggedIn()){

            $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
            confirm($result);
            $user = mysqli_fetch_array($result);
            return mysqli_num_rows($result) >= 1 ? $user['user_id'] : "";

            }
        }


function userLikedThisPost($post_id = ""){
$result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id=$post_id");
confirm($result);
return mysqli_num_rows($result) >= 1 ? true : false;
}

function getPostlikes($post_id){
    $result=query("SELECT * FROM likes WHERE post_id=$post_id");
    confirm($result);
    return mysqli_num_rows($result);
 }




function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;


}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}




function confirm($result) {
	global $connection;
	if (!$result) {
	die("Query Failedx" . mysqli_error($connection));

}
}

function insert_categories(){

global $connection;

if (isset($_POST['submit'])){

$category = $_POST['cat_title'];

if ($category == "" || empty($category)) {
echo "You must write something";
} else 
{

$stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) " );
mysqli_stmt_bind_param($stmt, 's', $category);
mysqli_stmt_execute($stmt);

if (!$stmt) {
die('Query Failed' . mysqli_error($connection));
}


} 

}
}


function find_categories() {
global $connection;
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query); 
while($row = mysqli_fetch_assoc($select_categories)) {
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];
echo "<tr>";
echo "<td>  $cat_id </td>";
echo "<td>  $cat_title </td>";
echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";

}
}

function delete_categorie() {
global $connection;	
if (isset($_GET['delete'])) {

$get_delete = $_GET['delete'];
$query_delete = "DELETE FROM categories WHERE cat_id = $get_delete";
$delete_query = mysqli_query($connection, $query_delete); 
header("Location: categories.php");

}
}

function recordCount($table) {
global $connection;

$query = "SELECT * FROM " . $table;
$query_all_posts = mysqli_query($connection, $query);
$result = mysqli_num_rows($query_all_posts);
confirm($result);
return $result;
}




function recordCount2($value1, $value2, $value3){
global $connection;
$query = "SELECT * FROM $value1 WHERE $value2 = '$value3'";
$query_mysqli = mysqli_query($connection, $query);
return mysqli_num_rows($query_mysqli);    
}

function is_admin($username) {
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);

    $row = mysqli_fetch_array($result);

    if ($row['user_role'] == 'Admin'){
        return true;
    } else {
        return false;
    }
}


function username_exists($username) {
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    if (mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }

}

function email_exists($email) {
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    if (mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }

}






function users_online() {


				if (isset($_GET['onlineusers'])) {

				global $connection;

				if(!$connection){
					session_start();
					include("../includes/db.php");

					$session = session_id();
                	$time = time();
               	 	$time_out_in_seconds = 5;
                	$time_out = $time - $time_out_in_seconds;

                	$query = "SELECT * FROM users_online WHERE session = '{$session}'";

                	$send_query = mysqli_query($connection, $query);
                	$count = mysqli_num_rows($send_query);

                	if ($count == NULL) {
                    $query = "INSERT INTO users_online(session, time) VALUES('{$session}', '{$time}')";
                    $send_query = mysqli_query($connection, $query);
                    if (!$send_query) {
                        die('query failed' . mysqli_error($connection));
                    }
                	} else {
                    $query = "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}'";
                    $send_query = mysqli_query($connection, $query);
                    if (!$send_query) {
                        die('query failed' . mysqli_error($connection));
                    }
                	}   
                    $query = "SELECT * FROM users_online WHERE time > '{$time_out}'";
                    $users_online_query = mysqli_query($connection, $query);
                    if (!$send_query) {
                        die('query failed' . mysqli_error($connection));
                    }
                    $count_user = mysqli_num_rows($users_online_query);
                    echo $count_user;

					}


				}

	           
			}

function register_user($username, $email, $password){
    global $connection;
   
    
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}' , '{$email}', '{$password}' , 'subscriber' )";
        $register_user_query = mysqli_query($connection, $query);

        confirm($register_user_query);


}

     

    
function login_user($username, $password){

    global $connection;


    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);

    confirm($select_user_query);

    while($row = mysqli_fetch_assoc($select_user_query)){

        $user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    
    if (password_verify($password, $db_password)) {
        
          $_SESSION['username'] = $db_username;
          $_SESSION['password'] = $db_password;
          $_SESSION['user_role'] = $db_user_role;


        header("Location: /cms/admin");
    } else {
        header("Location: /cms/login.php");
        
    }
}

function login_user2($username, $password){

    global $connection;


    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);

    confirm($select_user_query);

    while($row = mysqli_fetch_assoc($select_user_query)){

        $user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    
    if (password_verify($password, $db_password)) {
        
          $_SESSION['username'] = $db_username;
          $_SESSION['password'] = $db_password;
          $_SESSION['user_role'] = $db_user_role;


        header("Location: /cms/admin");
    } else {
        header("Location: /cms/");
        
    }
}


users_online();
?>


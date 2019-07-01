<?php 


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = mysqli_connect($server, $username, $password, $db);


if($conn) {
	//echo "Connection succesfully";
} else {
	echo "Error";
}



// $db['db_host'] = "localhost";
// $db['db_user'] = "root";
// $db['db_pass'] = "root";
// $db['db_name'] = "cms";

// foreach ($db as $key => $value) {
// 	define(strtoupper($key), $value);
// }

// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($connection) {
// 	//echo "Connection succesfully";
// } else {
// 	echo "Error";
// }


?>



<?php 


$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$conn = mysqli_connect($hostname, $username, $password, $database);


if($conn) {
	//echo "Connection succesfully";
} else {
	echo "Error";
}


$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');



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



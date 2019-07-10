<?php 
$servername = "localhost";
$username = "root";
$pw = "";
$dbname = "ex4";

$conn = mysqli_connect($servername, $username, $pw);

if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
	echo "database created";
} else {
	echo "Error: " .mysqli_error($conn);
}
mysqli_close($conn);
?>
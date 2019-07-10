<?php 
$servername = "localhost";
$username = "root";
$pw = "";
$dbname = "ex4";

$conn = mysqli_connect($servername, $username, $pw, $dbname);

if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "CREATE TABLE Pokemon (
pkmn_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(20) NOT NULL,
type VARCHAR(20) NOT NULL,
reg_date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
   echo "Table Users created successfully"  . "\n";
} else {
   echo  "Error creating table: " . mysqli_error($conn) . "\n";
}
mysqli_close($conn);
?>
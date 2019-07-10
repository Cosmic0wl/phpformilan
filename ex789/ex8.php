<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$pw = ""; 
$dbname = "ex4";

$conn = mysqli_connect($servername, $username, $pw, $dbname);
if  (!$conn) {
   die("Connection failed: " . mysqli_connect_error() . "\n" );
}

$sql = "SELECT pkmn_id, name, type FROM Pokemon";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	printf("ID=%s %s (%s)<br>",
		$row["pkmn_id"],$row["name"],$row["type"]);
}
echo  "Fetched data successfully\n";
mysqli_free_result($result);
// Close connection
mysqli_close($conn);
?>
</body>
</html>
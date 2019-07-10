<?php 
$servername = "localhost";
$username = "root";
$pw = "";
$dbname = "ex4";

$conn = mysqli_connect($servername, $username, $pw, $dbname);

if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "INSERT INTO Pokemon (name, type)
VALUES 
('Dragonite', 'Dragon'),
('Clefairy', 'Fairy'),
('Lapras', 'Water')";

if (mysqli_query($conn, $sql)) {
    echo "New record created.\n";
} else {
   echo  "Record creation error for: " . $sql . "\n" . mysqli_error($conn);
}
mysqli_close($conn);

?>
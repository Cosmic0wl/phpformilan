
<?php
echo ("<html><body>");
$servername = "localhost" ;
$username = "root";
$pw = ""; 
$dbname = "ex4";

$conn = mysqli_connect($servername, $username, $pw, $dbname);
if  (!$conn) {
   die("Connection failed: " . mysqli_connect_error() . "\n" );
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$type = mysqli_real_escape_string($conn, $_POST[ 'type']);

$sql = "INSERT INTO Pokemon (name, type)
VALUES ('" .$name."', '".$type."')";
if (mysqli_query($conn, $sql)) {
    echo "<h1>New record created.<h1>";
} else {
    echo "<h1>Record creation error for: </h1>" . 
         "<p>"  . $sql . "</p>" . 
         mysqli_error($conn);
}
mysqli_close($conn);
echo  "</body></html>";
?>
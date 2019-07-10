<?php 
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "cr09_valentina_panetta_carrental";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if  (!$conn) {
   die("Connection failed: " . mysqli_connect_error() . "\n" );
}
$firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lastname = mysqli_real_escape_string($conn, $_POST[ 'last_name']);
$age = mysqli_real_escape_string($conn, $_POST[ 'age']);
$phonenumber = mysqli_real_escape_string($conn, $_POST[ 'phone_number']);
$address = mysqli_real_escape_string($conn, $_POST[ 'address']);
$email = mysqli_real_escape_string($conn, $_POST[ 'email']);
$driverslicense = mysqli_real_escape_string($conn, $_POST[ 'drivers_license_nr']);

$sql = "INSERT INTO customers (first_name, last_name, age, phone_number, address, email, drivers_license_nr)
VALUES ('" .$firstname."', '".$lastname."', ".$age.", ".$phonenumber.", '".$address."', '".$email."',".$driverslicense.")";
if (mysqli_query($conn, $sql)) {
    echo "<h1>New record created.<h1>";
} else {
    echo "<h1>Record creation error for: </h1>" . 
         "<p>"  . $sql . "</p>" . 
         mysqli_error($conn);
}
mysqli_close($conn);
?>
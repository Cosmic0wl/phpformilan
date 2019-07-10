<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<?php  
		echo "<div class='container-fluid p-3'> 
			<div class='jumbotron d-flex flex-column justify-content-center align-items-center'>
  			<h1 class='text-white font-weight-bold display-4'>Rent-A-Car</h1> 
  			<p class='h5 text-white'>Car Rental Service</p> 
			</div>
			<div class='row justify-content-center p-3'>"; 

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cr09_valentina_panetta_carrental";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT name, address, phone_number FROM agency_branches";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	echo "<div class='col-lg-3 col-md-3 col-sm-12 d-flex flex-column align-items-center justify-content-center m-1 p-4 pink'>";
		        echo "<p class='h5 green'>" . $row["name"]. "</p> <p><i class='fa fa-home green'></i> Address: " . $row["address"]. "</p> <p><i class='fa fa-phone-square green'></i> Phone Number: " . $row["phone_number"]. "</p>";
		        echo "</div>";
		    }
		} else {
		    echo "0 results";
		}
		$conn->close();

		echo "</div></div>";
	?>
<div class="container">
	<div class="row d-flex justify-content-center">
	<form action="form.php" method ="post">
	   <div class="col-10">
	       <label  for="first_name">First Name</label>
	       <input type="text" name="first_name" id="first_name">
	   </div>
	   <div class="col-10">
	       <label for ="last_name">Last Name</label>
	       <input  type="text" name="last_name"  id="last_name">
	   </div>
	   <div class="col-10">
	       <label for ="age">Age</label>
	       <input  type="text" name="age"  id="age">
	   </div>
	   <div class="col-10">
	       <label for ="phonenumber">Phone Number</label>
	       <input  type="text" name="phone_number"  id="phone_number">
	   </div>
	   <div class="col-10">
	       <label for ="address">Address</label>
	       <input  type="text" name="address"  id="address">
	   </p>
	   <div class="col-10">
	       <label for ="email">Email</label>
	       <input  type="text" name="email"  id="email">
	   </div>
	   <div class="col-10">
	       <label for ="drivers_license_nr">Drivers Licence</label>
	       <input  type="text" name="drivers_license_nr"  id="drivers_license_nr">
	   </div>
	   <input type= "submit" value="Submit">
	</div>
	</form>
</div>
</body>
</html>
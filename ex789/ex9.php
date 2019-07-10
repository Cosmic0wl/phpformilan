<?php 
$servername = "localhost";
$username = "root";
$pw = ""; 
$dbname = "ex4";

//connection

$conn = mysqli_connect($servername, $username, $pw, $dbname);
if  (!$conn) {
   die("Connection failed: " . mysqli_connect_error() . "\n" );
}
$sql = "SELECT pkmn_id, name, type FROM Pokemon";

$result = mysqli_query($conn, $sql);

// while ($row = mysqli_fetch_assoc($result)) {
// 	printf("ID= %s name= %s type= %s <button><a href='ex9.php?id=%s'>edit</a></button><br>",
// 		$row["pkmn_id"],$row["name"],$row["type"]);
// }
$rows = $result->fetch_all(MYSQLI_ASSOC);

foreach ($rows as $row ) {
	echo "ID:".$row["pkmn_id"]."<br>name:".$row["name"]."<br>type:".$row["type"]."<button><a href='ex9.php?id=".$row["pkmn_id"]."'>edit</a></button><br>";
}
mysqli_free_result($result);
if(isset($_POST["submit"])){
$name = mysqli_real_escape_string($conn, $_POST['name'], $_POST['type']);
$sql = "INSERT INTO Pokemon (name, type) 
VALUES('" .$name."', '".$type."')";
if (mysqli_query($conn, $sql)) {
    echo "<h1>New record created.<h1>";
} else {
    echo "<h1>Record creation error for: </h1>" . 
         "<p>"  . $sql . "</p>" . 
         mysqli_error($conn);
	}
}
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql = "SELECT * from `Pokemon` WHERE pkmn_id = $id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo "name :" . $row["name"];
	echo "type :" . $row["type"];
		}
?>

<form action="ex9.php" method="POST">
	<p>
	 <label for="name">Name:</label>
	 <?php 
	    echo'<input type="text" name="newname" id="name" value="'. $row['name'].'">';
	    echo'<input type="hidden" name="id" id="pkmn_id" value="'. $row['pkmn_id'].'">';
	    ?>
	   
	</p>
	<p>
	 <label for="type">Type:</label>
	 <?php 
	    echo'<input type="text" name="newtype" id="type" value="'. $row['type'].'">';
	    echo'<input type="hidden" name="id" id="pkmn_id" value="'. $row['pkmn_id'].'">';
	    ?>
	    <input type="submit" name="update" value="update">
	    <input type="submit" name="delete" value="delete">
	</p>
</form>

<?php
	if (isset($_POST["update"])){
		$id= $_POST["id"];
		$name = mysqli_real_escape_string($conn, $_POST['newname']);
		$type = mysqli_real_escape_string($conn, $_POST['newtype']);
		$sql = "UPDATE Pokemon SET name = '$name', type = '$type' WHERE pkmn_id = $id"; 
		if (mysqli_query($conn, $sql)) {
			   echo "<h1>record updated.<h1>";
			} else {
			   echo "<h1>Update error for: </h1>" . 
			         "<p>" . $sql . "</p>" . mysqli_error($conn);
			}	
		}
	if (isset($_POST["delete"])){
		$id = $_POST["id"];
		$sql = "DELETE FROM Pokemon WHERE pkmn_id = $id"; 
			if (mysqli_query($conn, $sql)) {
			   echo "<h1>record deleted.<h1>";
			} else {
			   echo "<h1>Update error for: </h1>" . 
			         "<p>" . $sql . "</p>" . mysqli_error($conn);
			}	
		}
	

	?>
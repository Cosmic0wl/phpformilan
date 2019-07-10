
<!DOCTYPE html>
<html>
<head>
       <title>PHP form example: POST</title>
</head>
<body >
<form action="ex2.php" method ="POST">
First Name: <input type="text"  name="firstname" />
Last Name: <input type ="text" name="lastname" />
<input  type="submit" name="submit"  />
</form>
<?php
if( isset($_POST['submit']))
{
if( $_POST["firstname" ] || $_POST["lastname"] )
{
echo "Welcome " . $_POST[ 'firstname']. " ". $_POST['lastname'] ;
}
else
{
	echo "please insert your name, or please insert your surname.";
}
}
?>
</ body>
</html>
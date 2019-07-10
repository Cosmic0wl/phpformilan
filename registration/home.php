<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) ) {
 header("Location: login.php");
 exit;
}
// select logged-in users details 
$res=mysqli_query($conn, "SELECT * FROM registrations WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
$imgBefore = $userRow['image'];
$repl = 'safe_prefix_secure_info';
$imgPath = substr_replace($imgBefore, $repl, 8, 0);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome -
        <?php echo $userRow['userName' ]; ?>
    </title>
</head>

<body>
    Hi
    <?php echo $userRow['userName' ]; ?>
     <?php echo "<img src=".$imgPath. ">"; ?>
    <a href="logout.php?logout">Sign Out</a>
</body>

</html>

<?php ob_end_flush(); ?>
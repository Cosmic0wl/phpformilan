<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])!="" ){
 header("Location: home.php" ); // redirects to home.php
}
include_once 'dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {
 $safeDir = __DIR__.DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR;
        $filename = basename($_FILES['file_to_upload']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);
        //check to see if upload parameter specified
        if(($_FILES["file_to_upload"]["error"]==UPLOAD_ERR_OK) && ($ext == "jpg") && ($_FILES["file_to_upload"]["type"] == "image/jpeg") && ($_FILES["file_to_upload"]["size"] < 70000000)){
            //check to make sure file uploaded by upload process
            if(is_uploaded_file($_FILES["file_to_upload"]["tmp_name"])){
                // capture filename and strip out any directory path info
                $fn = basename($_FILES["file_to_upload"]["name"]);
                //Build now filename with safty measures in place
                $copyfile = $safeDir."safe_prefix_secure_info".strip_tags($fn);
                //copy file to safe directory
                if(move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $copyfile)){
                    $message .= "<br>Successfully uploaded file $copyfile\n";
                } else {
                    // trap upload file handle errors
                    $message.="Unable to upload file ".$_FILES["file_to_upload"]["name"];
                }
            } else {
                $message .= "<br>File not uploaded";
            }
        }
 // sanitize user input to prevent sql injection
 $name = trim($_POST['name']);

  //trim - strips whitespace (or other characters) from the beginning and end of a string
  $name = strip_tags($name);

  // strip_tags — strips HTML and PHP tags from a string

  $name = htmlspecialchars($name);
 // htmlspecialchars converts special characters to HTML entities
 $email = trim($_POST[ 'email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);

 // image file
 $img = "uploads/".$_FILES["file_to_upload"]["name"];
 echo $img;

  // basic name validation
 if (empty($name)) {
  $error = true ;
  $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "Name must have at least 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true ;
  $nameError = "Name must contain alphabets and space.";
 }

 //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {
  // checks whether the email exists or not
  $query = "SELECT userEmail FROM registrations WHERE userEmail='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }
 // password validation
  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "Password must have atleast 6 characters." ;
 }

 // password hashing for security
$password = hash('sha256' , $pass);


 // if there's no error, continue to signup
 if( !$error ) {
  
  $query = "INSERT INTO registrations(userName,userEmail,userPass, image) VALUES('$name','$email','$password', '$img')";
  $res = mysqli_query($conn, $query);
  
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($name);
    unset($email);
   unset($pass);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..." ;
  }
  
 }

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login & Registration System</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>

<body>

<!-- serris code -->
    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <h2>Sign Up</h2>
        <hr />
        <?php
   if ( isset($errMSG) ) {
  
   ?>
        <div class="alert alert-<?php echo $errTyp ?>">
            <?php echo  $errMSG; ?>
        </div>
        <?php 
  }
  ?>
      <input type="file" size="50" maxlength="255" name="file_to_upload" value="" />
      <?php echo $img ?>
        <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
        <span class="text-danger">
            <?php   echo  $nameError; ?> </span>
        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
        <span class="text-danger">
            <?php   echo  $emailError; ?> </span>
        <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
        <span class="text-danger">
            <?php   echo  $passError; ?> </span>
        <hr />
        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
        <hr />
        <a href="login.php">Sign in Here...</a>
    </form>
</body>

</html>
<?php  ob_end_flush(); ?>
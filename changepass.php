<?php
session_start();
include('connection.php');
if(!isset($_SESSION['email'])){

  header("location: ../../index.php");
}
$email = $_SESSION['email'];
$branch = $_SESSION['branch'];
$em = $_SESSION['email'];
$ans= mysqli_query($connect, "Select * from Teachers where Email='$em'");
$result1=mysqli_fetch_assoc($ans);

  if($result1['SignedIn']==1)
    header("location:dash\pages\index.php");

		if(isset($_POST['submit'])){
			$password = $_POST['password'];
			$repassword = $_POST['repassword'];
      if ($password==$repassword){

          $quer = "UPDATE `Teachers` SET `Password`='$password',`SignedIn`=1 WHERE `Email`='$email'";
          $quer = mysqli_query($connect,$quer);
          if($quer){
            header("location:dash\pages\index.php");
          }
				}
				else {

						echo"<script> alert(\"Passwords do not match \");</script>";
				}
			}



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Sign In</title>

 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body background = "#fff">
		<img class = "img-responsive" src = "final.jpg">
    <div class="container">

      <form class="form-signin" method = "post">
        <h2 class="form-signin-heading" align ="center">Change Password</h2>
        <label for="inputEmail" class="sr-only">Passwords</label>
        <input type="password" name ="password" id="inputPassword" class="form-control" placeholder="Password" required>
<label for="inputPassword"  class="sr-only">Retype Password</label>
        <input type="password" name ="repassword" id="inputPassword" class="form-control" placeholder="Retype Password" required>

        <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>

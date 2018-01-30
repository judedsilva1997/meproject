<?php
		include('connection.php');
		session_start();
		if(isset($_SESSION['email'])){
			$em = $_SESSION['email'];
			$ans= mysqli_query($connect, "Select * from Teachers where Email='$em'");
			$result1=mysqli_fetch_assoc($ans);

				if($result1['SignedIn']==0)
					header("location:changepass.php");
				else
					header("location:dash\pages\index.php");

		}
		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

				$result= mysqli_query($connect, "Select * from Teachers where Email='$username'");
				if($result){
					if(mysqli_num_rows($result)==1){
						$result1=mysqli_fetch_assoc($result);
						if($password == $result1['Password'] )
						{

							$_SESSION['email']=$result1['Email'];
							$_SESSION['branch']=$result1['Branch'];
							if($result1['SignedIn']==0)
								header("location:changepass.php");
							else
								header("location:dash\pages\index.php");
						}
						else
							echo"<script> alert(\"Wrong Username / Password. Please Try Again \");</script>";

					}
					else {
						echo"<script> alert(\"Wrong Username / Password. Please Try Again \");</script>";
					}
				}


		}
?>
<html>
<head>
<title>Fr.C.R.I.T</title>
<meta charset="utf-8">
         <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Fr. C. Rodrigues Institute of Technology. In Pursuit of Excellence.">
        <title>Fr. C. Rodrigues Institute of Technology.</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="style.css">
	    <link rel="stylesheet" type="text/css" href="sstyle.css">
		<link rel="icon" href="favicon.ico" type="image/gif">
  	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Include js plugin -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
        <!--[if IE 9]>
       <link href="css/ie.css" rel="stylesheet">
    <![endif]-->
        <!--[if IE 10]>
           <link href="css/ie.css" rel="stylesheet">
        <![endif]-->
        <!--[if IE 11]>
           <link href="css/ie.css" rel="stylesheet">
        <![endif]-->
        <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="owl-carousel/owl.transitions.css">
        <script src="jquery-1.9.1.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="assets/owl-carousel/owl.carousel.js"></script>
		<?php include 'header.php';?>
<style>
form{
font-size: 16px;
padding: 9px;
height: auto;
font-family: 'Comfortaa';
}
input[type=text], input[type=password] {
border: 0.2vw solid #9bba6e;
border-radius: 0.5vw;
float: center;
padding: 1vw 1vw;
width: 70%;
 opacity: 1;
font-size: 20px;
}
input[type=submit]{
padding: 1vw;
color: white;
width: 40%;
font-size: 20px;
border-radius: 12px;
background-color: #9bba6e;
opacity: 1;
}
input[type=submit]:hover {
    background-color: #FFD133;
}

.footer {
  position: fixed;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 0;
  background-color: #424242;
  text-align: center;
  font-size: 1.3em;
}


.serif{
font-family: 'Comfortaa';
}
.error1{
font-family: 'Comfortaa';
color: red;
margin-left:30%;
}
li:hover{
    background-color: #FFD133;
}
 p	{
  	font-family: 'Comfortaa';
	}
a	{
font-color: #FFD133;
font-family: 'Comfortaa';
}
</style>

 </br></br>
 <div style="border: 0.5vw solid #9bba6e;opacity: 1; margin-left: 29vw; margin-right: 29vw;margin-top: 2vw; background-color: #F9F9F9;">
<div style="background-color: #9bba6e; opacity: 1; color: white">
<div style="font-size:30px; margin-left:44%; font-family: 'Comfortaa';">LOGIN</div></div>
<form name="login_form" method="post" >
</br></br>
<center>
<input type="text" name="username"   placeholder="Email id" required>
</br><br><br>
<input type="password" name="password" placeholder="Password" required><span id="pass"></span></br>

<center><input type="submit" value="Login" name = "submit"style="font-family: 'Comfortaa';float: center;"></center>
</form>
</div>
</br></br></br></br></br>
<div class="footer"  style="background: #9bba6e; padding-bottom: 10px;">
     <footer>
            <div class="row">
                <div class="col-lg-12">
                    <i><p style="color: #FFF;"> Developed and Maintained By : F.C.R.I.T- Department of Computer Engineering</p></i>
                </div>
            </div>
      </footer>
 </div>
</body>
</html>

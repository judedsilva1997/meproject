<?php
		session_start();
		include('../../connection.php');
		if(!isset($_SESSION['email'])){

			header("location: ../../index.php");
		}

		$email = $_SESSION['email'];
		$branch = $_SESSION['branch'];
		$re = mysqli_query($connect,"Select * from Role where Email = '$email' and TypeId = 1");
		if(mysqli_num_rows($re)==1)
				header("location: dean.php");
		$result = mysqli_query($connect,"Select * from Role where Email = '$email'");
		$state = mysqli_query($connect,"Select * from State");
		$state = mysqli_fetch_assoc($state);
		if($state['Allow']==0)
				header('location:index.php');
		$month = $state['CurrentMonth'];
		$year = $state['CurrentYear'];
    $year = $year-1;
		$studs = mysqli_query($connect,"Select * from Students where Branch = '$branch' and Batch = '$year' and MECoordinator = '$email' and RollNo not in (Select RollNo from MECoordinator where Month = '$month')");

		if(isset($_POST['submit'])){
			$rid = $_POST['submit'];
			$rm = $_POST['rm'];
			$out = mysqli_query($connect,"Insert into MECoordinator values('$rid','$rm','Yes','$month')");
			if($out)
				header("location: onestme.php");
		}
    if(isset($_POST['sub'])){
			$rid = $_POST['sub'];
			$rm = $_POST['rm'];
			$out = mysqli_query($connect,"Insert into MECoordinator values('$rid','$rm','No','$month')");
			if($out)
				header("location: onestme.php");

		}
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      
                                
                        
						<?php
						while ($result1 = mysqli_fetch_array($result)){
							if($result1['TypeId']==2)
								echo " <li><a href=\"teachers.php\"><i class=\"fa fa-table fa-fw\"></i> Teachers List</a></li><li><a href=\"students.php\"><i class=\"fa fa-table fa-fw\"></i> Students List</a></li>";
						}
						if($state['Allow']==1){
							//echo "  <li><a href=\"#\"><i class=\"fa fa-sitemap fa-fw\"></i>Attendance<span class=\"fa arrow\"></span></a>
                            //<ul class=\"nav nav-second-level\"> <li><a href=\"onest.php\"><i class=\"fa fa-table fa-fw\"></i> First Year</a></li><li><a href=\"twost.php\"><i class=\"fa fa-table fa-fw\"></i>Second Year</a></li></ul>";
							echo " <li><a href=\"guide.php\"><i class=\"fa fa-table fa-fw\"></i> Guide</a></li><li><a href=\"faculty.php\"><i class=\"fa fa-table fa-fw\"></i> Faculty</a></li>";
							echo "  <li><a href=\"#\"><i class=\"fa fa-sitemap fa-fw\"></i>ME Coordinator<span class=\"fa arrow\"></span></a>
                            <ul class=\"nav nav-second-level\"> <li><a href=\"onestme.php\"><i class=\"fa fa-table fa-fw\"></i> First Year</a></li><li><a href=\"twostme.php\"><i class=\"fa fa-table fa-fw\"></i>Second Year</a></li></ul>";
						}
						?>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             List Of Students



                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                                <tbody>
								<form method ="POST">
								<?php
                $no = mysqli_num_rows($studs);
								while($result2 = mysqli_fetch_array($studs)){
									 $l1=$result2['RollNo'];
                   $q= mysqli_query($connect,"Select * from Attendance where RollNo = '$l1' and Month = '$month'");
								   if(mysqli_num_rows($q)==1){
                     $q = mysqli_fetch_assoc($q);
                     $percent = $q['Percentage'];
                     $remarks = $q['Remarks'];
                     $app= $q['Approve'];
                     if($app==1)
                        $app = 'Yes';
                    else {
                        $app = 'No';
                    }
                  }else {
                    $percent = 'NA';
                    $remarks = 'NA';
                    $app = 'NA';
                  }
                  $q= mysqli_query($connect,"Select * from MECoordinator where RollNo = '$l1' and Month = '$month'");
                  if(mysqli_num_rows($q)==1){
                    $q = mysqli_fetch_assoc($q);

                    $meremarks = $q['RemarksME'];
                    $meapp= $q['Approve'];
                    if($meapp==1)
                       $meapp = 'Yes';
                   else {
                       $meapp = 'No';
                   }
                 }else {

                   $meremarks = 'NA';
                   $meapp = 'NA';
                 }
                 $q= mysqli_query($connect,"Select * from Faculty where RollNo = '$l1' and Month = '$month'");
                 if(mysqli_num_rows($q)==1){
                   $q = mysqli_fetch_assoc($q);

                   $fremarks = $q['Remarks'];
                   $fapp= $q['Approve'];
                   if($fapp==1)
                      $fapp = 'Yes';
                  else {
                      $fapp = 'No';
                  }
                }else {

                  $fremarks = 'NA';
                  $fapp = 'NA';
                }
                $q= mysqli_query($connect,"Select * from Guide where RollNo = '$l1' and Month = '$month'");
                if(mysqli_num_rows($q)==1){
                  $q = mysqli_fetch_assoc($q);

                  $g1remarks = $q['RemarksAttendance'];
                  $g2remarks = $q['RemarksWork'];
                  $gapp= $q['Approve'];
                  if($gapp==1)
                     $gapp = 'Yes';
                 else {
                     $gapp = 'No';
                 }
               }else {
                 $g2remarks = 'NA';
                 $g1remarks = 'NA';
                 $gapp = 'NA';
               }
									echo " <tr class=\"odd gradeX\">

                                        <th>Roll</td>
                                        <td>$l1  (1/$no)</td></tr>
                                        <tr class=\"odd gradeX\">
                                        <th>Attendance(%)</td>
                                        <td>$percent</td></tr>
                                        <tr></tr>
                                        <th>TA Faculty's Remarks</td>
                                        <td>$fremarks</td></tr>
                                        <tr class=\"odd gradeX\">
                                        <th>Approved By TA Faculty</td>
                                        <td>$fapp</td></tr>
                                        <tr></tr>
                                        <th>Guide's Remarks on Attendance</td>
                                        <td>$g1remarks</td></tr>
                                        <th>Guide's Remarks on Work</td>
                                        <td>$g2remarks</td></tr>
                                        <tr class=\"odd gradeX\">
                                        <th>Approved By Guide</td>
                                        <td>$gapp</td></tr>
                                        <tr></tr>
                                        <th>ME Coordinator's Remarks</td>
																				<td><input class=\"form-control\" name =\"rm\"></td></tr>

                                        <td><button type=\"submit\" class=\"btn btn-default\" value=\"$l1\" name =\"submit\">Approve</button><button type=\"submit\" class=\"btn btn-default\" value=\"$l1\" name =\"sub\">Decline</button></td>
                                    </tr>";
                                    break;
                  }
								?>
                                 </form>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

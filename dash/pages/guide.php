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
		$studs = mysqli_query($connect,"Select * from Students where Branch = '$branch' and Batch = '$year' and Guide = '$email' and RollNo not in (Select RollNo from Guide where Month = '$month')");

		if(isset($_POST['submit'])){
			$rid = $_POST['submit'];
			$n1 = $rid. "percent";
			$n2 = $rid . "remarks";
			$n1 = $_POST[$n1];
			$n2 = $_POST[$n2];
			$n3 = $rid . "approve";
			$n3 = $_POST[$n3];
			$out = mysqli_query($connect,"Insert into Guide values('$rid','$n1','$n2','$month','$n3')");
			if($out)
				header("location: guide.php");
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
                                <thead>
                                    <tr>
                                        <th width ="20px">Roll No.</th>
																				<th>Name </th>
																				<th>Att.(%) </th>
                                        <th>Remarks on attendance</th>
                                        <th>Remarks on work</th>
																				<th width ="25px">Recommended for stipend</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
								<form method ="POST">
								<?php
								 while ($result2 = mysqli_fetch_array($studs)){
									 $l1=$result2['RollNo'];
									 $nm = $result2['Name'];
									 $res = mysqli_query($connect,"Select * from Attendance where RollNo = '$l1'");
									 $res = mysqli_fetch_assoc($res);
									 $att = $res['Percentage'];
									 $name1=$l1. "percent";
									 $name2=$l1. "remarks";
									 $name3 = $l1. "approve";
									echo " <tr class=\"odd gradeX\">
                                        <td>$l1</td>
																				<td>$nm </td>
																				<td>$att %</td>
                                        <td><input class=\"form-control\" name =\"$name1\"></td>
                                        <td><input class=\"form-control\" name =\"$name2\"></td>
										<td><select class=\"form-control\" name =\"$name3\">
                                                <option>Yes</option>
                                                <option>NO</option>
                                            </select></td>
                                        <td><button type=\"submit\" class=\"btn btn-default\" value=\"$l1\" name =\"submit\">Submit</button></td>
                                    </tr>";
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

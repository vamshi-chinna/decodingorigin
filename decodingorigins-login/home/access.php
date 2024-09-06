<?php

session_start();
date_default_timezone_set('America/Toronto');
if(isset($_SESSION['user_id']) ){

require '../../database.php';

$records = $conn->prepare('SELECT id,email,password,fname,lname,security FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	}
else{
header("Location: ../../index.php");

	}

$bytes = openssl_random_pseudo_bytes(6);
$pwd = bin2hex($bytes);

if(!empty($_POST['email']) ){

	// Enter the new user in the database
	$sql = "INSERT INTO users (fname,lname, email, password, security) VALUES (:fname, :lname, :email, :password, :security)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':fname', $_POST['fname']);
	$stmt->bindParam(':lname', $_POST['lname']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', $pwd);
	$stmt->bindParam(':security',$_POST['security']);

	if( $stmt->execute() ){
		//Send email

	$name=$_POST['fname'];
	$from="do-not-reply@decodingorigins.org";
	$message="Dear ".$name.",\n\n".$results['fname']." ".$results['lname']." has granted you access to the Language of Marks web-portal. Please login with following details to complete your registration.\n\n
Username : ".$_POST['email']."
Password : ".$pwd."\n\n
The password is case sensitive. You can access the portal at : http://decodingorigins.org
Please let me know if you have any questions or face any technical difficulties. \n

Thank you,\n

Best regards,
Kartikay Chadha\n
	";
	$subject="[Language of Marks] Credentials";
	$to=$_POST['email'];
	$headers="MIME-VERSION: 1.0" . "\r\n";
	$headers="Content-type:text/html;charset=UTF-8"."\r\n";
	$headers="From:do-not-reply@decodingorigins.org \r\n";

	if(mail($to,$subject,$message,$headers))
	{
	$message = 'Successfully created new user';
	}
	else
	{
	$message = 'Oops! Did you try to create an already existing user? Perhaps Kartikay can help :P';
	}





		//End of send email
	}
	else{
		$message = 'Oops! Did you try to create an already existing user? Perhaps Kartikay can help :P';
	}

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/ocad_logo.png">
    <title>Language of Marks</title>
    <!-- Bootstrap Core CSS -->
    <link href="external/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="external/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="external/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="external/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
</head>



<?php session_start();


 ?>

<body class="fix-header">

    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.php">

                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is light logo text--><img src="images/lom.png" alt="home" class="light-logo" height=65px padding-left:20px !imporant/>
                     </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!--<li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>-->
                    <li>
                        <a class="profile-pic" href="#"> <img src="images/admin_logo.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $results['fname']; ?></b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">

                    <?php
		    require 'menu.php';
                   ?>

                </ul>
                <div class="center p-20">
                     <a href="../logout.php"  class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
                 </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->



     <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Grant Access <br>(PI / COLLABORATORS ONLY)</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="" "></a>
                        <ol class="breadcrumb">
                            <li><a href="#"></a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <?php if ($results['security']==0): ?>
                <!-- .row -->
                <div class="row">





                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">

<?php if(!empty($message)): ?>
		<p><font color=red><?= $message ?></p></font>
	<?php endif; ?>

                            <form class="form-horizontal form-material" action="access.php" method="post">


                                <div class="form-group">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-12">

                                        <input name="fname" type="text" placeholder= "John" class="form-control form-control-line" required> </div>

                                </div>
          <div class="form-group">
                                    <label class="col-md-12">Last name </label>
                                    <div class="col-md-12">

                                        <input name="lname" type="text" placeholder= "Doe" class="form-control form-control-line" required> </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-12">Email Address</label>
                                    <div class="col-md-12">

                                        <input name="email" type="text" placeholder= "JohnDoe@email.com" class="form-control form-control-line" required> </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-12">Access Level</label>
                                    <div class="col-md-12">
                                        <select name=security required>
  <option value=1 selected>Researcher</option>
  <option value=0>PI / Collaborator</option>

</select></div>

                                </div>





                                <div class="form-group">
                                    <div class="col-sm-12">
                                   <input type="submit" class="btn btn-success" value="Add User"></input>  <br><br><br>
                                     <P> </p>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">
                         <h3 class="box-title">Existing Users</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>


                                            <th>Name</th>
                                            <th>Email/Username</th>
                                            <th>Access Level</th>



                                        </tr>
                                    </thead>

                                    <tbody>

<?php

$record = $conn->prepare('SELECT * from users order by fname');

	$record->execute();
	while($record1 = $record->fetch(PDO::FETCH_ASSOC)){


echo "<tr>";
echo "<td width=30% ! important>" . $record1['fname'] ." ". $record1['lname']."</td>";
echo "<td width=20% ! important>" . $record1['email'] . "</td>";
if($record1['security']==1){
echo "<td width=20% ! important>Researcher</td>";}
if($record1['security']==0){
echo "<td width=20% ! important>PI/Collaborator</td>";}

                } ?>

                </tbody>
                                </table>
                            </div>


                        </div>
                        </div>
                </div>
                <!-- /.row -->
            </div>

            <?php endif; ?>

<?php if ($results['security']!=0): ?>
<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                          <a href="basic-table.html" class="waves-effect"><i class="fa fa-warning fa-fw" aria-hidden="true" color="red"></i>WARNING!</a>
                            <h4>You do not have access to this section. Sorry!</h4>
                         </div>
</div>
<?php endif; ?>


            <!-- /.container-fluid -->
            <footer class="footer text-center"> This website is created and maintained by Kartikay Chadha. </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="external/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="external/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="external/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="external/js/custom.min.js"></script>

</body>



</html>

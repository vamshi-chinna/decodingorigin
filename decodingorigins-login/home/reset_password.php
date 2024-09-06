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


if(!empty($_POST['new_password']) ){

if($_POST['new_password']!=$_POST['new_password1'])
{
 $message = 'The entries below do not match each other! Please try again.';
}
else{

$password=$_POST['new_password'];
	$sql = "UPDATE users SET password=:password WHERE email=:email";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':email',$results['email']);
	
	if( $stmt->execute() ):
		$message = 'Your passowrd is updated';
	else:
		$message = 'There was an error reported in updating your passowrd. Please contact Kartikay.';
	endif;
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
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/ocad_logo.png">
    <title>Language of Marks</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
</head>





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
                        <!--This is light logo text--><img src="../plugins/images/lom.png" alt="home" class="light-logo" height=65px padding-left:20px !imporant/>
                     </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!--<li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>-->
                    <li>
                        <a class="profile-pic" href="#"> <img src="../plugins/images/admin_logo.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $results['fname']; ?></b></a>
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
                        
                    </li>
                    <?php
		    require 'menu.php';
                   ?>
                    
                </ul>
                <div class="center p-20">
                     <a href="../../logout.php"  class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
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
                        <h4 class="page-title">Reset Password</h4> </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right">
                        <a href="index.php"  class="btn btn-danger waves-effect waves-light"><i class="fa   fa-arrow-left fa-fw" aria-hidden="true"></i>BACK</a>
                        <ol class="breadcrumb">
                            <li><a href="#"></a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
               
                <!-- .row -->
                <div class="row">
                    
                   
<?php

$record = $conn->prepare('SELECT * from data1 WHERE number = :number');
	$record->bindParam(':number', $_GET["number"]);
	$record->execute();
	$record1 = $record->fetch(PDO::FETCH_ASSOC); ?>



                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">

<?php if(!empty($message)): ?>
		<p><font color=red><?= $message ?></p></font>
	<?php endif; ?> 

                            <form class="form-horizontal form-material" action="reset_password.php" method="post">
                            

                                <div class="form-group">
                                    <label class="col-md-12">Enter New Password</label>
                                    <div class="col-md-12">

                                        <input name="new_password" type="password" placeholder= "Enter password" class="form-control form-control-line" required> </div>

                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12">Re-Enter New Password</label>
                                    <div class="col-md-12">

                                       
                                       <input name="new_password1" type="password" placeholder= "Re-enter password " class="form-control form-control-line" required>

                                </div>
                          
                                </div>
          
                                
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                   <input type="submit" class="btn btn-success" value="Update Password"></input>  <br><br><br>
                                      
                                    </div>
                                    
                                   <p>Administrators of this portal can access or edit your password/profile. The password you choose will not be encrypted.</p>
                                </div>
                                
                             
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            
           


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
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>

</body>



</html>

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
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):

require '../database_login.php';


$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

if($_SESSION['user_id']==$results['id']):

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
                    <li>
                        <form id="search" action="search.php" class="app-search hidden-sm hidden-xs m-r-12" method="get">


                           <!-- <input name="searchfor" type="text" placeholder="Type here..." class="form-control"><a href="javascript:$('form').submit()"><i class="fa fa-search"></i></a>--> </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="images/admin_logo.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $results['fname'];  ?></b></a>
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
                        <h4 class="page-title">CHOOSE PROJECT</h4> </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right">


                        <ol class="breadcrumb">
                            <li><a href="#"></a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->



                <!-- ============================================================== -->
                <!-- Project choose options -->
                <!-- ADD PROJECTS BELOW -->
                <!-- ============================================================== -->
                <div class="row">

        <!-- RELOADING DATABASE user -->
        <?php require '../database_login.php';


	$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	?>




               <!-- ADD NEW PROJECT HERE -->


                    <div class="col-md-12 col-lg-12 col-sm-12">

                    <!-- The Language of Marks -->

                    <div class="col-md-3 col-sm-3 col-xs-3 ">
                        <div class="white-box">

                            <center>

                            <b><h3>The Language of Marks</h3></b>


                            <img class="row" src=external/project_logos/LOM_logo.png width="100%" height="100%">
                            <br><br>

                            <?php if($results['LOM']==1) { ?>
                            <a href="../../languageofmarks"  class="btn btn-success wave-effect waves-light">SELECT</a><br><br>
                       	    <?php } if($results['LOM']==0) { ?>
                       	    <p><font color=red>You don't have access to this Project</font></p>
                       	    <?php } ?>

                       	    </center>

                         </div>
                     </div>


                     <!-- Scarificantion Sources -->

                    <div class="col-md-3 col-sm-3 col-xs-3 ">
                        <div class="white-box">

                             <center>
                            <b><h3>West African Research</h3></b>



                            <img class="row" src=external/project_logos/SS_logo.png width="100%" height="100%">
                            <br><br>

                            <?php if($results['SS']==1) { ?>
                            <a href="../../West-African-Research"  class="btn btn-success waves-effect waves-light">SELECT</a><br><br>
                       	    <?php } if($results['SS']==0) { ?>
                       	    <p><font color=red>You don't have access to this Project</font></p>
                       	    <?php } ?>

                       	    </center>



                         </div>
                     </div>


                     <!-- Freedom Narratives -->

                     <div class="col-md-3 col-sm-3 col-xs-3 ">
                        <div class="white-box">

                            <center>
                            <b><h3>Freedom Narratives<br><br></h3></b>

                            <img class="row" src=external/project_logos/FN_logo.png width="100%" height="100%">

                            <br><br>


                            <?php if($results['FN']==1) { ?>
                            <a href="../../FreedomNarratives"  class="btn btn-success waves-effect waves-light">SELECT</a><br><br>
                       	    <?php } if($results['FN']==0) { ?>
                       	    <p><font color=red>You don't have access to this Project</font></p>
                       	    <?php } ?>

                       	    </center>
                         </div>
                     </div>


                                          <!-- Equiano's World -->

                                          <div class="col-md-3 col-sm-3 col-xs-3 ">
                                             <div class="white-box">

                                                 <center>
                                                 <b><h3>Equiano's World<br><br></h3></b>

                                                 <img class="row" src="external/project_logos/EW_logo.jpg" width="100%" height="100%">

                                                 <br><br>


                                                 <?php if($results['EW']==1) { ?>
                                                 <a href="../../equianosworld-LOM"  class="btn btn-success waves-effect waves-light">SELECT</a><br><br>
                                               <?php } if($results['EW']==0) { ?>
                                            	    <p><font color=red>You don't have access to this Project</font></p>
                                            	    <?php } ?>

                                            	    </center>
                                              </div>
                                          </div>






                        </div>
                    </div>
                </div>



            <!-- /.container-fluid -->
            <footer class="footer text-center"> This website is created and maintained by Kartikay Chadha. </footer>
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

<?php  else:
header("Location: ../index.php");

	 endif;
	 endif;	  ?>

</html>

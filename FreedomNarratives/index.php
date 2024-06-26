<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
 ?>
 <!DOCTYPE html>
<html lang="en" manifest="catch.mf">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Decoding Origins - Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!--Load Men and Woment Info and passing to JS-->

</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar menu -->
  <?php require 'utilities/sidebar_menu.php'; ?>
  <!-- Sidebar menu End -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php require 'utilities/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Decoding Origins - Web Portal</h1>
              </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-6 col-md-6 mb-12 pb-5" >
              <div class="card" >
                  <div class="card-header">
                    Notifications
                  </div>
                  <div class="card-body overflow-auto" style="max-height: 500px !important;">
                    <h5 class="card-title">Messages from Administrator:</h5><br>
                    <?php
                    require 'utilities/database_RegID.php';
                    $dashboard="SELECT * FROM `Dashboard` ORDER BY `TimeStamp` DESC";
                    $dashboard_q = $conn_regid->query($dashboard);
                   while($dashboardData = $dashboard_q->fetch(PDO::FETCH_ASSOC)){
                     if(isset($results[$dashboardData['Project']]) && $results[$dashboardData['Project']]>0 || $dashboardData['Project']=="%"){ ?>

                      <?php if($dashboardData['Project']=="%")
                       {
                         $project_name="All Network Broadcast";
                       } else{
                         $project_name=$dashboardData['Project']."-Message-Posted";
                       }
                       ?>
                       <div class="card p-2">
                         <div class="card-body">

                           <?php if($dashboardData['new']==1){ ?>
                           <sup><img class="float-right" src="img/upcoming.gif" alt="upcoming"></sup><br>
                        <?php  }?>
                          <?php if($dashboardData['new']==2){ ?>
                          <sup><img class="float-right" src="img/new1.gif" alt="upcoming"></sup><br>
                        <?php }?>
                         <p> <?php echo $project_name." : ".$dashboardData['TimeStamp'];?>(EST)</p>
                           <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                            <b> <?php echo $dashboardData['Title'];?></b><br>
                             <span style="Color: #2F7BD0">
                               <?php echo $dashboardData['Message'];?>
                             </span>
                           </p>
                           <i>Posted by : <?php echo $dashboardData['PostedBy'];?></i>
                           </div>
                           </div>
                           <br>

                       <?php


                     }

                   }

                    ?>

                    <?php if($results['FN']>0){?>

                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 12-February-2020-10:00AM(EST)</p>
                        <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                          <b>Full Source Attachments:</b><br>
                          <span style="Color: #2F7BD0">
                            You should now be able to attach full source documents to your extracted PDFs. I am still working on bulk adding documents
                            to the server and will keep you posted on the progress.
                            Please email me any issues or concerns. Thanks, Kartikay. </spna></p>
                        </div>
                        </div>
                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 4-February-2020-10:26PM(EST)</p>
                        <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                          <b>Releasing New Feature:</b><br>
                          <span style="Color: #2F7BD0">
                            You can now re-order events under every person folder. Use the blue arrow buttons to use this function.
                            Please email me any issues - I am currently testing this functionality. Thanks, Kartikay. </spna></p>
                        </div>
                        </div>
                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 30-January-2020-9:02PM(EST)</p>
                        <p class="card-text" style="Color: green"><i class="fas fa-hand-point-right"></i>
                          Events list is now updated!<br>
                          The corresponding Google Doc File Link : <a href="https://docs.google.com/document/d/1jis7hBunXW6FPeBFkUyVh6CzR65kL7YE/edit" target="_blank">Click Here!</a> - KC
                          </p>
                        </div>
                        </div>
                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 22-January-2020-1:41PM(EST)</p>
                        <p class="card-text" style="Color: #2F7BD0"><i class="fas fa-hand-point-right"></i>
                          "Ethnonym/Meta-Ethnic" field is now added in Person Data. <br>
                          A new controlled vocabulary for this field is also now available for editing. - KC
                          </p>
                        </div>
                        </div>
                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 16-January-2020-6:56PM(EST)</p>
                        <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                          We are currently experiencing techincal difficulties in adding relationships for events in Type | Name category.
                          I am working on resolving the issue as soon as possible. -KC<br>
                          <span style="Color: green">(FN-Message-Posted: 17-January-2020-5:11PM(EST)) This issue is now resolved. Please email me if you are still facing difficulties in recording Type | Name Relationships. -KC</span>
                        </p>
                        </div>
                        </div>
                        <br>
                      <?php } ?>
                    <?php if($results['FN']>0){?>
                    <div class="card">
                      <div class="card-body">
                        <p>FN-Message-Posted: 23-December-2019-4:41PM(EST)</p>
                        <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                          Due to recent updates in controlled vocabularies some fields including
                          Region of Origin, Region of Desination and Occupation may be set to default values.
                          Data re-check or re-entry may be required.
                        </p>
                  </div>
                  </div>
                  <br>
                <?php } ?>



                    <p class="card-text"><i class="fas fa-hand-point-right"></i> You are currently working with Decoding Origins V2.0. Release Date: 08-09-2019 for Internal Testing.</p>
                    <p class="card-text"><i class="fas fa-hand-point-right"></i> Please record any functionality or techincal issues and email them directly to <a href="mailto:kartikay.chadha2011@gmail.com">kartikay.chadha2011@gmail.com</a></p>
                    <p class="card-text" style="Color: green"><i class="fas fa-hand-point-right"></i> As a test I have introducted Google API for translation of the entire web portal.
                      Please choose the lanuguage you wish to work with:
                    <div id="google_translate_element"></div>

                    Discussion on the placemenent poisiton and permanent implimentation of this feature is pending.
                  </p><br>




                  </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-12">


                <div class="card">
                    <div class="card-header">
                      Your Projects / Tasks
                    </div>
                    <div class="card-body">
                    <div class="row">
                      <?php require 'utilities/menu_cards.php'; ?>
                    </div>
                  </div>
            </div>

          </div>

          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>This website is created and maintaied by <a href="http://kartikaychadha.com" target="_blank">Kartikay Chadha</a>.</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../decodingorigins-login/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php else:
header("Location: ../decodingorigins-login/index.php");

	 endif; ?>

</html>

<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
 ?>
 <!DOCTYPE html>
<html lang="en">

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
          <div class="card bg-warning text-white shadow" style="margin-bottom: 5%;">
            <div class="card-body">
                <div class="text-white-50 small">
                  <h3><i class="fas fa-user-plus"></i> Create New Entry (Person)</h3>

                </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-6 col-md-6 mb-12">
              <div class="card">

                  <div class="card-body">
                    <form method="POST" action="utilities/commands_external/add_person.php">
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Person Name</label>
                        <input name="Name" class="form-control" id="exampleFormControlInput1" placeholder="Type Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Project</label>
                        <select name="project" class="form-control" id="exampleFormControlSelect1">
                          <?php
                          require '../decodingorigins-login/database_login.php';
                          $q1="SELECT * FROM `Project`";
                          $query = $conn->query($q1);
                          while($projects= $query->fetch(PDO::FETCH_ASSOC)){
                            if($results[$projects['ProjectID']]>0){
                              echo "<option value=\"".$projects['ProjectID']."\">".$projects['ProjectName']."</option>";
                            }
                          }
                          require 'utilities/database_SS.php';
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Form Type</label>
                        <select name="doctype" class="form-control" id="exampleFormControlSelect1">
                          <?php

                          $q1_doctype="SELECT * FROM `document_type` WHERE `Sheet` LIKE 'person'";

                          $query_doctype = $conn->query($q1_doctype);
                          while($type= $query_doctype->fetch(PDO::FETCH_ASSOC)){

                              echo "<option value=\"".$type['Type']."\">".$type['Display']."</option>";

                          }

                          ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-user-plus"></i> Create New Person</button>
                    </form>
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
<?php
$message=$_GET['message'];
  # Error Message Box
  if ($message == 2) :
    require 'utilities/modals/error.php';
    endif;
    ?>

</body>

</html>
<?php else:
header("Location: ../decodingorigins-login/index.php");

	 endif; ?>

</html>

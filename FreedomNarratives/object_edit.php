<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$personID = $_GET['personID'];
$objectID = $_GET['objectID'];
$RA = $results['fname']." ".$results['lname'];
$field="";
$current_URL=$_SERVER['REQUEST_URI'];
//Loading doctype
if(isset($_GET['doctype'])){
$doctype=$_GET['doctype'];}
else{
  $doctype="NoSelection";
}
//Loading Message
if(isset($_GET['message'])){
$message=$_GET['message'];}
else{
$message=0;
}

//Loading object data
$q2="SELECT * FROM `object` WHERE `objectID` LIKE '".$objectID."'";
$query2 = $conn->query($q2);
$object_data= $query2->fetch(PDO::FETCH_ASSOC);

//Loading person data
$q2="SELECT * FROM `person` WHERE `personID` LIKE '".$personID."'";
$query2 = $conn->query($q2);
$person_data= $query2->fetch(PDO::FETCH_ASSOC);


$doctype=$object_data['doctype'];

require 'utilities/commands/object_update.php';

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
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!--Load Men and Woment Info and passing to JS-->



</head>


<body id="page_m-top" onload="Onload_Rules()">

  <!-- page_m Wrapper -->
  <div id="wrapper">

<!-- Sidebar menu -->
  <?php require 'utilities/sidebar_menu.php'; ?>
  <!-- Sidebar menu End -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php require 'utilities/topbar.php'; ?>

        <!-- Begin page_m Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <?php

          $q1="SELECT * FROM `object` WHERE `objectID` LIKE '".$objectID."'";
          $query = $conn->query($q1);
          $object_data = $query->fetch(PDO::FETCH_ASSOC);

             ?>
          <div class="row">

            <!--object Menu -->
            <div class="col-xl-3 col-md-12 mb-12">
                <?php require('utilities/person-menu.php'); ?>

            </div>

            <!--Editing Form -->
            <div class="col-xl-6 col-md-12 mb-12">

                <!--Display object Information-->


                      <div class="card bg-danger text-white shadow" style="margin-bottom: 5%;">
                        <div class="card-body">
                            <div class="text-white-50 small">
                              <h3><i class="fas fa-file"></i> Source Meta-Data</h3>

                            </div>
                        </div>
                      </div>




                  <?php
                  if($doctype!="NoSelection")
                  {
                    $doctype=$object_data['doctype'];

                    require 'utilities/sections/object-form.php';

                  }
                  else{
                    ?>
                    <br>



                  <?php
                  }
                  ?>




                  <br><br>

            </div>


            <!--Doctype Update-->

            <div class="col-xl-3 col-md-12 mb-12">
              <!--Options-->
                <div class="row float-right">

               <div class="col-xl-12 col-md-12 mb-12">
                    <a  class="btn btn-md btn-danger" href="objects_person.php?personID=<?php echo $_GET['personID'];?>"> <i class="fas fa-long-arrow-alt-left"></i>  Back</a>
                </div>
             </div><br><br>
             <hr>

                  <h5> Form Type </h5>
                  <div class="row">
                    <div class="col-xl-10 col-md-10 mb-10">
                      <form action="utilities/commands/object-doctype_update.php" method="POST">
                        <input name="objectID" value=<?php echo $_GET['objectID']; ?> type=hidden>
                        <input name="action" value="doc" type=hidden>


                        <select class="form-control" name="doctype">
                          <?php

                          $q1="SELECT * FROM `document_type` WHERE `sheet` LIKE 'object'";
                          $query = $conn->query($q1);



                           while($doc = $query->fetch(PDO::FETCH_ASSOC)){

                               if($doc['Type']==$doctype){

                                 echo "<option value=\"\" selected disabled hidden>".$doc['Display']."</option>";
                                 echo "<option value=\"".$doc['Type']."\">".$doc['Display']."</option>";
                               }
                               else {
                                 echo "<option value=\"".$doc['Type']."\">".$doc['Display']."</option>";
                               }


                           }


                             ?>

                        </select>
                      </div>
                        <div class="col-xl-2 col-md-2 mb-2">
                        <?php if($results['security']>=0){ ?>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i></button>
                        <?php } ?>
                          </form>
                        </div>

                      </div>


                      <h5 style="margin-top:4%"> File Attachment</h5>
                      <?php
                      $current_URL=$_SERVER['REQUEST_URI'];
                      if($object_data['Adminupload']==0){?>
                        <div class="row">
                          <div class="col-xl-10 col-md-1 mb-1">
                              <form action="utilities/commands_external/upload_object.php" method="POST" class="form-group" enctype="multipart/form-data">
                                <input type="hidden" name="objectID" value="<?php echo $objectID;?>">
                                <input type="hidden" name="personUI" value="<?php echo $person_data['UI'];?>">
                                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                          </div>
                          <div class="col-xl-2 col-md-2 mb-2">
                                <?php if($results['security']>=0){ ?>
                                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-upload"></i></button>
                                <?php } ?>
                              </form>
                          </div>
                        </div>
                    <?php }
                    if($object_data['File']!='0'){?>
                      <div class="row">
                        <div class="col-xl-12 col-md-1 mb-1">
                          <h4>
                            <?php $newfilename=$person_data['UI']."_".$object_data['Field1'].".".$object_data['Format'];
                            if($object_data['Format']=="PDF" or $object_data['Format']=="pdf"){ ?>
                            <a download="<?php echo $newfilename; ?>" class="btn btn-warning col-xl-12 col-md-1 mb-1" href="<?php echo explode("?", $current_URL)[0].$object_data['File'];?>" onclick="window.open('<?php echo explode("?", $current_URL)[0].$object_data['File'];?>',
                                            'newwindow',
                                      'width=500,height=500');
                                return false;" target="_blank"><i class="far fa-file"></i></i>  View File</a>
                              <?php } else { ?>
                                <a download="<?php echo $newfilename; ?>" class="btn btn-warning col-xl-12 col-md-1 mb-1" href="<?php echo explode("?", $current_URL)[0].$object_data['File'];?>" ><i class="far fa-file"></i></i> Downlaod File</a>

                              <?php }?>
                          </h4>
                        </div>
                      </div>
                  <?php } ?>


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
  <!-- End of page_m Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page_m-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Message</h5>
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

    <script src="select2/dist/js/select2.min.js"></script>

  <script>
  $(document).ready(function(){

    function formatProjectConnector(pconn){
      if(!pconn.id || pconn.id == null || pconn.title==""){
        return pconn.text;
      }
      var recordurl = pconn.title;
      var $option = $('<span class="opt"></span>');
      var $option_text = $('<span class="pull_left"></span>');
      var $option_link = $('<span class="pull_right"></span>');
      var $preview = $('<a target="_blank" class="btn proj-connect-link">View Record</a>');
      $preview.prop("href",recordurl);
      $preview.on('mouseup',function(evt){
        // Select2 will remove the dropdown on `mouseup`, which will prevent any `click` events from being triggered
        // So we need to block the propagation of the `mouseup` event
        evt.stopPropagation();
      }); 

      $option_text.text(pconn.text);
      $option_link.append($preview);

      $option.append($option_text);
      $option.append($option_link);

      return $option;
    }

    // Initialize select2
    $(".searchdropdown").select2();

    $(".project-connect").select2({
      templateResult: formatProjectConnector
    });

    /* Handle resetting to zero when selections are cleared */
    $(".searchdropdown").change(function(){
      var selections = $(this).val().length;

      if(selections==0){
        $(this).val("0"); // Update the value
        $(this).trigger('change'); // Notify other JS on change
      }
    });
    
    $(".project-connect").change(function(){
      var selections = $(this).val().length;

      if(selections==0){
        $(this).val("0"); // Update the value
        $(this).trigger('change'); // Notify other JS on change
      }
    });

  });

  </script>

  <!--Success Message Display-->
  <?php
  # Success Message box
  if ($message == 1) :
    require 'utilities/modals/success.php';
    endif;


  # Error Message Box
  if ($message == 2) :
  require 'utilities/modals/error.php';
   endif;



  # object Relationship (Kinship) Message box
   if ($message == 3) :
   require 'utilities/modals/relationship_kinship_edit.php';
   endif;

   # Control Vocaublary Submission Box
   if ($message == 5) :
     require 'utilities/modals/add_CV.php';
     endif;
     # Load Place
     if ($message == 6) :
       require 'utilities/modals/place_data.php';
       endif;
       # Load Place
       if ($message == 7) :
         require 'utilities/modals/duplicate_CV.php';
         endif;





 ?>





</body>

</html>
<?php else:
header("Location: ../decodingorigins-login/index.php");

	 endif; ?>

</html>

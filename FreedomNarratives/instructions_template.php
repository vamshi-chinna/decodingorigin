<?php session_start();
date_default_timezone_set('America/Toronto');
$server = '';
$username = '';
$password = '';
$database = '';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}

$type=$_GET['type'];
$fieldID=$_GET['fieldID'];
//Loading Instructions data
$q2="SELECT * FROM `".$type."` WHERE `id` LIKE '".$fieldID."'";
$query2 = $conn->query($q2);
$info= $query2->fetch(PDO::FETCH_ASSOC);


 ?>
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Decoding Origins - Help</title>

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


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content"><br>


        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 mb-12">
            <h2><i class="fas fa-info-circle"></i></hr> Instructions</h2>
            <br>
            <div class="card" >

              <div class="card-body">
                <p class="card-text"><b>Form Type:</b>  <?php echo $type;?></p>
                <p class="card-text"><b>Group Name:</b> <?php echo $info['SectionDisplay'];?> </p>
                <p class="card-text"><b>Data Field:</b> <?php echo $info['display'];?> </p>
              </div>
            </div>
            <br>
            <b>Definitions:</b><br>
            <?php echo $info['Definitions'];?>
            <br><br>

            <b>Techincal Instructions:</b><br>
            <?php echo $info['Technical'];?>
            <br><br>

            <b>Controlled Vocabularies:</b><br>
            <?php
            if(fnmatch("*CV*",$info['Options'])){
              //Connect with Portal Server
              $server = 'decodingorigins.org';
              $username = 'visitor';
              $password = 'OCADVAL2019';
              $database = 'FreedomNarratives-v2';

              try{
              	$conn_CV = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
              } catch(PDOException $e){
              	die( "Connection failed: " . $e->getMessage());
              }
              $q1="SELECT * FROM `".$info['Options']."` WHERE `status` LIKE '1'";
              $query1 = $conn_CV->query($q1);
              while($CV_terms= $query1->fetch(PDO::FETCH_ASSOC)){
                echo htmlspecialchars_decode($CV_terms['Name'])."<br>";
              }


           } else{
              echo "N/A";
            }?>
            <br><br>

          </div>
          </div>






        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->



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


</html>

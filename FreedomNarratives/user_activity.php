<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';

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
          <div class="card bg-warning text-white shadow mb-3">
            <div class="card-body">
                <div class="text-white-50 small">
                  <h3><i class="fas fa-users"></i> Users Activities</h3>

                </div>
            </div>
          </div>

          <!-- Content Row -->


            <div class="row mb-3">
               <div class="col-xl-12 col-md-6 mb-12">
                  <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select User
                    </button>
                    <div class="dropdown-menu overflow-auto" aria-labelledby="dropdownMenuButton" style="height:400px;">
                <?php
                          require 'utilities/database_login.php';
                           $sql = "SELECT * FROM users where `security` < ".$results['security']." AND `FN` LIKE '1' order by `fname`";
                           $query = $conn_login->query($sql);
                           $default_table="";
                           while($row = $query->fetch(PDO::FETCH_ASSOC)){
                             echo '<a class="dropdown-item" href="user_activity.php?id='. $row['id'].'">'. $row['fname']. '  ' . $row['lname'] .'</a>';
                             $id=$_GET['id'];
                           }?>

                  </div>
                </div>
              </div>
              </div>

              <div class="row mb-4">
                <div class="col-xl-2 col-md-2 mb-12 p-2" id="notBarEnds1">
                  <div class="card" >
                      <?php  $sql = "SELECT * FROM users where id='$id'";
                             $query = $conn_login->query($sql);

                             $row1 = $query->fetch(PDO::FETCH_ASSOC);?>
                             <div class="dispimg">
                             <?php if(!empty($row1['img'])){ ?>

                             <img class="img-fluid img-thumbnail" src="img/user/<?php echo $row1['img'];?>" alt="Example" >
                               <?php } else {?>
                             <img class="img-fluid img-thumbnail" src="img/user/notfound.png" alt="No Image Available">

                              <?php }?>
                            </div>
                    </div>

                      <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                          <small id="emailHelp" class="form-text text-white">Access Level:</small>
                          <?php if($row1['security']==0){ ?>
                          <p class="card-title">Researcher</p>
                          <?php } if($row1['security']==1){?>
                            <p class="card-title">Project Director</p>
                            <?php } if($row1['security']==2){?>
                            <p class="card-title">Administrator</p>
                            <?php }?>

                          </div>
                    </div>

                  </div>

                <div class="col-xl-4 col-md-4 mb-12 p-2" id="notBarEnds2">
                  <div class="card">
                    <div class="card-body" >
                      <?php $fname=$row1['fname'];
                        $lname=$row1['lname'];
                        $username= $fname . ' ' . $lname;?>
                        <b>Name:</b><br><h6 class="text-info pb-1"><?php echo $lname . ', ' . $fname;?></h5>
                        <b>Affiliation:<br></b><h6 class="text-info pb-1"><?php echo $row1['Organization']?></h5>
                        <b>Username/Email:</b><br><h6 class="text-info pb-1"><?php echo $row1['email']?></h5>
                        <?php $q2="SELECT MAX(`TimeDate`) AS `TimeDate` FROM `login_dump` where `Username`='".$row1['email']."'";
                        $query2 = $conn_login->query($q2);
                        $log_last = $query2->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <?php $q2="SELECT count(*) AS assignedto FROM `person` where `assignedto`='".$row1['email']."'";
                        $query2 = $conn->query($q2);
                        $count = $query2->fetch(PDO::FETCH_ASSOC);
                        ?>
                       <b>Last Login:</b><br><h6 class="text-info pb-1"><?php echo $log_last['TimeDate'];?> EST</h5>
                        <b>Currently Assigned Enteries:</b><h6 class="text-info pb-1"><?php echo $count['assignedto'];?></h5>
                    </div>
                  </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-12 p-2" id="notBarEnds3">
                  <div class="card">
                    <div class="card-header"><h5>Assignments</h5></div>
                        <div class="card-body overflow-auto" style="height: 14.7rem;">


                          <?php

                            $q3="SELECT * FROM `person` where `assignedto`='".$row1['email']."'";
                            $query2 = $conn->query($q3);
                            $uilist = $query2->fetch(PDO::FETCH_ASSOC);
                            if (empty($uilist)){
                              echo "No Records Found.";

                            }else{ ?>
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <tbody>
                                <?php
                            while ($uilist = $query2->fetch(PDO::FETCH_ASSOC)) {
                              echo "<tr>";
                              echo "<td width=\"100\" ! important>" . nl2br($uilist['Name']) ."<br>(". $uilist['UI']. ")</td>";
                              if($uilist['online']==1){
                                echo "<td class=\"text-success\" width=\"100\" ! important>ONLINE</td>";
                              }else{
                                echo "<td class=\"text-danger\" width=\"100\" ! important>NOT PUBLISHED</td>";
                              }
                              echo "<td width=\"100\" ! important><a href=\"person_edit.php?personID=".$uilist['personID']."\"><button class=\"btn btn-secondary\">View</button></a></td>";
                              echo "</tr>";

                            }}
                          ?>
                          </tbody>
                          </table>

                      </div>
                    </div>
                </div>
            </div>



           <!-- Content Row -->
            <div class="row">

                            <div class="col-xl-6 col-md-6 mb-12 p-2" id="notBarEnds5">
                              <?php

                              $sql1 ="SELECT COUNT(1) AS entries, DATE(TimeDate) as date
                              FROM log
                              WHERE RA='$username'
                              GROUP BY DATE(TimeDate) DESC
                              LIMIT 0 , 7 ";

                               $query1 = $conn->query($sql1);
                               $dataPoints=array();
                               while($row=$query1->fetch(PDO::FETCH_ASSOC)) {
                                  array_push($dataPoints, array("x"=> $row["date"], "y"=> $row["entries"]));
                                  $date[]  = $row['date']  ;
                                  $entries[] = $row['entries'];
                               }

                              ?>
                              <div class="card">
                                 <div class="card-header"><h5>Activities Over Last One Week</h5></div>
                                 <div class="card-body overflow-auto" style="height: 20rem;">
                                    <div style="text-align:center">
                                       <canvas  id="chartjs_bar"></canvas>
                                    </div>
                                  </div>
                                </div>


                            </div>
                <div class="col-xl-6 col-md-6 mb-12 p-2" id="notBarEnds4">
                   <div class="card">
                      <div class="card-header"><h5>Activity Log</h5></div>
                      <div class="card-body overflow-auto" style="height: 20rem;">

                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Section</th>
                            <th>Section ID</th>
                            <th>Field Details</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                            $q2="SELECT * FROM `log` WHERE `RA` LIKE '".$username."' ORDER BY `TimeDate` DESC LIMIT 20";
                            $query2 = $conn->query($q2);

                            while ($datas = $query2->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td width=\"100\" ! important>" . $datas['TimeDate'] . "</td>";
                            echo "<td width=\"154\" ! important>" . $datas['type'] . "</td>";
                            echo "<td width=\"154\" ! important>" . $datas['ID'] . "</td>";
                            echo "<td width=\"154\" ! important>" . $datas['field'] . "</td>";
                            echo "<td width=\"200\" ! important>" . $datas['action'] . "</td>";
                            echo "</tr>";
                            }
                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>


                </div>

            <!-- /.container-fluid -->
         </div></br></br></br>

        <!-- javascript -->
        <script src="//regid.ca/other-scripts/JQuery-1-9-1.js"></script>
        <script src="//regid.ca/other-scripts/cloudflare_chart_dec2020.js"></script>
        <script type="text/javascript">
          var ctx = document.getElementById("chartjs_bar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                            data: {
                            labels:<?php echo json_encode($date); ?>,
                            datasets: [{
                                backgroundColor: [
                                   "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e"
                                ],
                                data:<?php echo json_encode($entries); ?>,

                            }]
                        },
                        options: {
                              legend: {
                                 display: false,
                                 position: 'bottom',

                                 labels: {
                                   fontColor: '#71748d',
                                   fontFamily: 'Circular Std Book',
                                   fontSize: 14,
                                 }
                              },
                              title: {
                                display: false,
                                fontSize: 15,
                                padding: 10,
                                text: 'Activities over last week\n\n\n'
                              },
                              scales: {
                                yAxes: [{
                                   ticks: {
                                      beginAtZero: true,
                                      min: 0
                                   }
                                }]
                              }
                        }
          });
    </script>



    <script type="text/javascript">
    var pattern = /[?]id=/;
    var URL = location.search;

    if(pattern.test(URL))
    {

    }else{
       document.getElementById('notBarEnds1').style.display = 'none';
       document.getElementById('notBarEnds2').style.display = 'none';
       document.getElementById('notBarEnds3').style.display = 'none';
       document.getElementById('notBarEnds4').style.display = 'none';
       document.getElementById('notBarEnds5').style.display = 'none';
       document.getElementById('notBarEnds6').style.display = 'none';
    }
    </script>


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

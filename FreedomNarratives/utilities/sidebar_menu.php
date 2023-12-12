<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-database"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Decoding&nbsp;origins<br><sup>Web Portal</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">



  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="advanced_search.php">
      <i class="fas fa-search"></i>
      <span>Advanced Search</span></a>
  </li>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="mytask.php">
      <i class="fas fa-tasks"></i>
      <span>My Tasks</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
  Projects
</div>
<!-- Nav Item - Dashboard -->
<?php if($results['EW']>0){?>
<li class="nav-item active">
  <a class="nav-link" href="../equianosworld-LOM">
    <i class="fas fa-fw fa-database"></i>
    <span>Equianos World</span></a>

</li>
  <?php } ?>
  <?php if($results['FN-index']>0){?>
  <li class="nav-item active">
    <a class="nav-link" href="../FN-index-DOWP">
      <i class="fas fa-fw fa-database"></i>
      <span>FN Index</span></a>

  </li>
    <?php } ?>
<?php
require '../decodingorigins-login/database_login.php';
$q_projectselect="SELECT * FROM `Project`";
$query_projectselect = $conn->query($q_projectselect);

while ($projectselect= $query_projectselect->fetch(PDO::FETCH_ASSOC)){


if(isset($results[$projectselect['ProjectID']]) && $results[$projectselect['ProjectID']]==1){
?>
  <!-- Nav Item - Dashboard -->

  <li class="nav-item active">
    <a class="nav-link" href="person.php?projectID=<?php echo $projectselect['ProjectID'];?>">
      <i class="fas fa-fw fa-database"></i>
      <span><?php echo $projectselect['ProjectName'];?></span></a>

  </li>


<?php } }
require 'utilities/database_SS.php';?>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
  Project Controls
</div>
<!-- Nav Item - Dashboard -->

<li class="nav-item active">
  <a class="nav-link" href="new_entry.php">
    <i class="fas fa-user-plus"></i>
    <span>New Person</span></a>

</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link" href="Full_source_list.php">
    <i class="fas fa-file"> </i>
    <span> Full Sources</span></a>

</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-edit"></i>
    <span>Controlled Vocabularies</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <?php if($results['security']>0){?>
      <a class="collapse-item" href="CV_approval.php">Approve Requests</a>
    <?php } ?>
      <a class="collapse-item" href="CV_tables.php">Edit/Update</a>

    </div>
  </div>
</li>
<!-- Nav Item - Dashboard -->
<?php if($results['security']>0){?>
<li class="nav-item active">
  <a class="nav-link" href="user_activity.php">
    <i class="fas fa-users"></i>
    <span>Users Activities</span></a>

</li>
  <?php } ?>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="help.php">
    <i class="fas fa-question-circle"></i>
    <span>Help</span></a>

</li>
<?php if($results['FN']>0){?>
<li class="nav-item active">
  <a class="nav-link" target="_blank" href="https://tickets.regeneratedidentities.org">
    <i class="fas fa-clipboard-list"></i>
    <span>RegID Tickets</span></a>

</li>
  <?php } ?>
<!-- Divider -->
<hr class="sidebar-divider">




  <!-- Nav Item - Charts -->
  <!--<li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>-->

  <!-- Nav Item - Tables -->
  <!--<li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li>-->

  <!-- Divider -->
  <!--<hr class="sidebar-divider d-none d-md-block">-->

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

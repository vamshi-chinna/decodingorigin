<div class="card bg-secondary text-white shadow">
  <div class="card-body">
      <div class="text-white-50 small" >
        <h5 style="color: white;">Person Folder: </h5><h6 style="color: white;"><?php echo $person_data['UI'];?> (<?php echo $person_data['Name'];?>)</h6><br>
        <?php if($person_data['online']>0){ ?>
          <p style="color: #C9E79B; font-size:16px;"><i class="fas fa-signal"></i> Auto-Publication Queued</p>
        <?php } else { ?>
          <p style=" font-size:16px;"><i class="fas fa-globe-americas"></i> You are editing offline</p>
        <?php }?>
      </div>
  </div>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><center>Menu</h6>
  </div>
  <div class="card-body" style="text-align: center !important;">
      <a style="width: 160px !important;"  class="btn btn-sm btn-secondary shadow-sm" href="mytask.php"><i class="fas fa-arrow-left"></i> My Tasks</a><br><br>
      <a style="width: 160px !important;"  class="btn btn-sm btn-info shadow-sm" href="person_edit.php?personID=<?php echo $person_data['personID'];?>"><i class="fas fa-user-edit"></i> Person Data</a><br><br>
      <a style="width: 160px !important;"  class="btn btn-sm btn-warning shadow-sm" href="events_person.php?personID=<?php echo $person_data['personID'];?>"> <i class="fa fa-calendar"></i> Events</a><br><br>

      <a style="width: 160px !important;"  class="btn btn-sm btn-danger shadow-sm" href="objects_person.php?personID=<?php echo $person_data['personID'];?>"> <i class="fas fa-file"></i> Sources</a><br><br>

      <?php if($results['security']>=0 & $person_data['project']=='FN' & $summary_generator_FN==1){ ?>
      <a style="width: 160px !important; background-color: #B833FF; border-color: #B833FF;"  class="btn btn-sm text-white shadow-sm" href="#" data-toggle="modal" data-target="#summary_generator_FN"><i class="far fa-edit"></i> Generate Summary</a><br><br>
        <?php } ?>
      <?php if($results['security']>0 ){
        if($person_data['online']>0){?>
          <a style="width: 160px !important;"  class="btn btn-sm  shadow-sm" href="#" data-toggle="modal" data-target="#unpublish_confirm"><i class="fas fa-globe"></i> Unpublish</a><br><br>
      <?php } else { ?>
        <a style="width: 160px !important;"  class="btn btn-sm btn-success shadow-sm" href="#" data-toggle="modal" data-target="#publish_confirm"><i class="fas fa-globe"></i> Publish</a><br><br>
    <?php }} ?>

        <?php

        if($results['security']>0 & $person_data['project']=='FN' & (int)$person_data['Complete']>50){ ?>
        <a target="_blank" href="https://dev2.freedomnarratives.org/recordview.php?ID=<?php echo $person_data['UI']?>" style="width: 160px !important; background-color: #FF5733 ;border-color: #FF5733 ;"  class="btn btn-sm text-white shadow-sm"><i class="fas fa-eye"></i> Preview</a><br><br>
          <?php } ?>
          <a style="width: 160px !important;"  class="btn btn-sm btn-secondary shadow-sm" href="forward.php?personID=<?php echo $person_data['personID'];?>"></i> <i class="fas fa-share"></i> Forward Task</a><br><br>
          <a style="width: 160px !important;"  class="btn btn-sm btn-secondary shadow-sm" href="log_person.php?personID=<?php echo $person_data['personID'];?>"></i> <i class="fas fa-file"></i> Person Log</a><br><br>

      <?php if(isset($_GET['objectID'])){ ?>
      <a style="width: 160px !important;"  class="btn btn-sm btn-secondary shadow-sm" href="log_object.php?objectID=<?php echo $_GET['objectID'];?>"><i class="fas fa-file"></i> Object Log</a><br><br>
    <?php } ?>
    <?php if(isset($_GET['eventID'])){ ?>
    <a style="width: 160px !important;"  class="btn btn-sm btn-secondary shadow-sm" href="log_event.php?eventID=<?php echo $_GET['eventID'];?>"><i class="fas fa-file"></i> Event Log</a><br><br>
  <?php } ?>
      </center>
  </div>
</div>
<?php require 'utilities/modals/global.php';?>

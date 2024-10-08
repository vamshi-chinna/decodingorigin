<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Modal Message-->
<div class="modal fade" id="Message" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-plus"></i>&nbsp;&nbsp; Add Relationships or Connections for Events</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Type | ID</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Type | Name</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#per" role="tab" aria-controls="per"
                aria-selected="false">Type | Person (Connections)</a>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <form action="utilities/commands_external/person_event_addID.php" method="POST">
                <input type="hidden" name="personID" value=<?php echo $_GET['personID'];?>>
                <input type="hidden" name="eventID" value=<?php echo $_GET['eventID'];?>>
                <div class="form-group">
                <label for="exampleInputEmail1">Type</label>
                <?php

                // Loading Controlled Vocaublary
                $q1="SELECT `ID`,`Name` FROM `Relationship_event_Type` WHERE `Status` = '1'";

                $query_CL = $conn->query($q1);


                ?>

                 <select class="form-control searchdropdown" style="width:100%" name="Type">



                   <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){


                       echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

                   } ?>

                 </select>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Select Person ID</label>
                    <?php

                    // Loading Controlled Vocaublary
                    $q1="SELECT `personID`,`UI`,`Name`,`project` FROM `person` where `personID` != ".$_GET['personID'];

                    $query_CL = $conn->query($q1);


                    ?>

                     <select class="form-control searchdropdown" style="width:100%" name="personID_related">



                       <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                         if($results[$selected_word['project']]>0){
                           echo "<option value=\"".$selected_word['personID']."\">".$selected_word['UI']." - ".$selected_word['Name']."</option>";
                         }
                       } ?>

                     </select>

                  </div>
                  <div class="modal-footer">
                    <?php if($results['security']>=0){ ?>
                      <button class="btn btn-primary" type="submit" >Add Entry</button>
                    <?php } ?>
                    
                    </form>

                  </div>


              </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form action="utilities/commands_external/person_event_addName.php" method="POST">
                <input type="hidden" name="personID" value=<?php echo $_GET['personID'];?>>
                <input type="hidden" name="eventID" value=<?php echo $_GET['eventID'];?>>
              <div class="form-group">
              <label for="exampleInputEmail1">Type</label>
              <?php

              // Loading Controlled Vocaublary
              $q1="SELECT `ID`,`Name` FROM `Relationship_event_Type_external`";

              $query_CL = $conn->query($q1);


              ?>

               <select class="form-control searchdropdown" style="width:100%" name="Type">


                 <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){


                     echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

                 } ?>

               </select>

                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Enter Name</label>
                  <input type="text" class="form-control" id="Name" placeholder="Type Name" name="Name">
                </div>
                <div class="modal-footer">
                  <?php if($results['security']>=0){ ?>
                  <button class="btn btn-primary" type="submit" >Add Entry</button>
                  <?php } ?>
                  </form>

                </div>

              </div>
              <div class="tab-pane fade" id="per" role="tabpanel" aria-labelledby="home-tab">
                <form action="utilities/commands_external/person_event_addID.php" method="POST">
                  <input type="hidden" name="personID" value=<?php echo $_GET['personID'];?>>
                  <input type="hidden" name="eventID" value=<?php echo $_GET['eventID'];?>>
                  <div class="form-group">
                  <!--<label for="exampleInputEmail1">Type</label>

                   <select class="form-control" name="" disabled>-->



                     <?php
                        // echo "<option value=\"".$event_data['Event_Type']."\" selected>".$event_data['Event_Type']."</option>";

                      ?>
                      <input type="hidden" name="Type" value="<?php echo $event_data['Event_Type']." (Connection Only)";?>">

                   <!--</select>-->

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select Person ID</label>
                      <?php

                      // Loading Controlled Vocaublary
                      $q1="SELECT `personID`,`UI`,`Name`,`project` FROM `person` where `personID` != ".$_GET['personID'];

                      $query_CL = $conn->query($q1);


                      ?>

                       <select class="form-control searchdropdown" style="width:100%" name="personID_related">



                         <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                           if($results[$selected_word['project']]>0){
                             echo "<option value=\"".$selected_word['personID']."\">".$selected_word['UI']." - ".$selected_word['Name']."</option>";
                           }
                         } ?>

                       </select>

                    </div>
                    <div class="modal-footer">
                      <?php if($results['security']>=0){ ?>
                        <button class="btn btn-primary" type="submit" >Add Entry</button>
                        <?php } ?>
                      </form>

                    </div>


                </div>

          </div>


       </div>

    </div>
  </div>
</div>

<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade bd-example-modal-lg" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-file"></i>&nbsp;&nbsp; Add Source</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Create New</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pre-Existing Source</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="modal-body">

                  <form action="utilities/commands_external/create_new_object.php" method="POST">
                    <input type="hidden" name="personID" value=<?php echo $_GET['personID'];?>>
                    <input type="hidden" name="RA" value="<?php echo $results['fname']." ".$results['lname'];?>">
                    <input type="hidden" name="project" value="<?php echo $person_data['project']?>">

                  <div class="form-group">
                  <label for="exampleInputEmail1">Select the Type of Form</label>
                  <?php

                  // Loading Controlled Vocaublary
                  $q1="SELECT DISTINCT * FROM `document_type` WHERE `Sheet` LIKE 'object'";

                  $query_CL = $conn->query($q1);


                  ?>

                   <select class="form-control" name="doctype" >


                     <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){


                         echo "<option value=\"".$selected_word['Type']."\">".$selected_word['Display']."</option>";

                     } ?>

                   </select>

                    </div><br>




                  <div class="modal-footer">
                    <button class="btn btn-success" type="submit" >Create</button>
                </form>
                  <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
              </div>

            </div>
              </div>
              <?php
              require '../decodingorigins-login/database_login.php';
              $authorized_projects="";
              //Loading All Projects
              $q_projects="SELECT * FROM `Project`";
              $query_projects = $conn->query($q_projects);
              while($project = $query_projects->fetch(PDO::FETCH_ASSOC)){

                if($results[$project['ProjectID']]==1)
                {
                  $authorized_projects=$authorized_projects." `project` LIKE '".$project['ProjectID']."' OR";
                }
              }
              $authorized_projects=substr($authorized_projects,0,-2);


              require 'utilities/database_SS.php';
              ?>

              <!--Attaching Pre-existing objects-->
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="modal-body">


                      <div class="form-group">
                      <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Project ID, Object ID or Titles..">
                      <br>
                      <?php

                      // Loading Controlled Vocaublary
                      $q1="SELECT DISTINCT * FROM `object` WHERE (".$authorized_projects.") AND `Adminupload` < 2 ";
                      
                      $query_CL = $conn->query($q1);


                      ?>

                      <div class="table-responsive" style="height:200px !important;">
                         <table class="table table-hover" id="myTable">
                              <thead>
                                <tr>
                                  <th style="width:10% !important">Project</th>
                                  <th style="width:20% !important">Object ID</th>
                                  <th style="width:30% !important">Title</th>
                                  <th style="width:20% !important"></th>
                                  <th style="width:20% !important"></th>
                                </tr>
                              </thead>
                              <tbody>

                         <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                             ?>

                                    <tr>

                                      <td><?php echo $selected_word['project'];?></td>
                                      <td><?php echo $selected_word['UI'];?></td>
                                      <td><?php echo $selected_word['Field1'];?></td>
                                      <?php if($selected_word['File']!='0') {
                                        $current_URL=$_SERVER['REQUEST_URI'];?>
                                      <td><a href="<?php echo explode("?", $current_URL)[0].$selected_word['File'];?>" onclick="window.open('<?php echo explode("?", $current_URL)[0].$selected_word['File'];?>',
                                                      'newwindow',
                                                'width=500,height=500');
                                          return false;" target="_blank"><button class="btn btn-primary" type="submit" ><i class="fas fa-eye"></i> View</button></a></td>
                                    <?php }else { ?>
                                      <td>File not Available</td>

                                      <?php } ?>
                                      <td><a href="utilities/commands_external/attach_object.php?objectID=<?php echo $selected_word['objectID'];?>&personID=<?php echo $person_data['personID'];?>"><button class="btn btn-success" type="submit" ><i class="fas fa-plus"></i> Add</button></a></td>
                                    </tr>

                         <?php } ?>

                       </tbody>
                     </table>
                   </div>

                        </div><br>






                      <div class="modal-footer">

                      <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                  </div>

                </div>
                  </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
function myFunction() {

  // Declare variables
  var input = document.getElementById("myInput");
  var filter = input.value.toUpperCase();
  var table = document.getElementById("myTable");
  var trs = table.tBodies[0].getElementsByTagName("tr");

  // Loop through first tbody's rows
  for (var i = 0; i < trs.length; i++) {

    // define the row's cells
    var tds = trs[i].getElementsByTagName("td");

    // hide the row
    trs[i].style.display = "none";

    // loop through row cells
    for (var i2 = 0; i2 < tds.length; i2++) {

      // if there's a match
      if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {

        // show the row
        trs[i].style.display = "";

        // skip to the next row
        continue;

      }
    }
  }

}
</script>


<script type="text/javascript">
function S_Load(str) {
  var e = document.getElementById("autofill_toggle");
  var x = e.options[e.selectedIndex].value;
  if (x=="No"){
    document.getElementById("full_alert").style.display = "none";
    document.getElementById("full_alert_undo").style.display = "none";
    document.getElementById("autofill_diabled").style.display = "block";
  }
  if(x == "Yes"){
    document.getElementById("autofill_diabled").style.display = "none";
  //document.getElementById("Field10").value = "0";
  var field_name=[];
  flag="Field";

  for(let n=1;n<21;n++){
    k=flag.concat(n);
    field_name.push(k);
  }


  if(str != 0){
    document.getElementById("full_alert").style.display = "block";
    document.getElementById("full_alert_undo").style.display = "none";
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var myarray=JSON.parse(this.responseText);
    for(let i=0;i<field_name.length;i++){

    var abc = myarray[field_name[i]];
    if(abc=='0' || abc===""){
      abc="Unknown";
    }
    //document.getElementById(field_name[i]).disabled = true;
    document.getElementById(field_name[i]).placeholder = "Enter Here";
    document.getElementById(field_name[i]).value =  abc;
    }


    }
  };
  xhttp.open("GET", "utilities/commands_external/load_object_data.php?id="+str, true);
  xhttp.send();

} else {
document.getElementById("full_alert").style.display = "none";
document.getElementById("full_alert_undo").style.display = "block";
for(let i=0;i<field_name.length;i++){
  document.getElementById(field_name[i]).disabled = false;
  document.getElementById(field_name[i]).value = "";
}

}


}}

</script>


<form action="?personID=<?php echo $personID; ?>&objectID=<?php echo $objectID; ?>" method="POST">
  <input type="hidden" name="action" value="Update">
  <?php if((isset($_GET['doctype']) && $_GET['doctype']!="NoSelection") || $doctype!="NoSelection"):?>
  <div class="col-xl-3 col-md-3 mb-3">
  <?php if($results['security']>=0){ ?>
    <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
  <?php } ?>
  </div>
<?php endif;?>

  <?php

  $q1="SELECT DISTINCT `section`,`SectionDisplay` FROM `".$doctype."`";
  $query = $conn->query($q1);



   while($section = $query->fetch(PDO::FETCH_ASSOC)){


     ?>
     <!-- Collapsable Section -->
     <div class="card shadow mb-4">
       <!-- Card Header - Accordion -->
       <a href="#collapseCardExample<?php echo $section['section'];?>" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" >
         <h6 class="m-0 font-weight-bold text-primary"><?php echo $section['SectionDisplay']; ?></h6>
       </a>
       <!-- Card Content - Collapse -->
       <div class="collapse" id="collapseCardExample<?php echo $section['section'];?>">
         <div class="card-body">
           <?php

           $q1="SELECT * FROM `".$doctype."` WHERE `section` LIKE '".$section['section']."'";
           $query1 = $conn->query($q1);
           while($columns= $query1->fetch(PDO::FETCH_ASSOC)){

             //For Text boxes
             if($columns['FieldType']=="text"){
             ?>
            <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php if($object_data[$columns['ColumnName']]=="0" || empty($object_data[$columns['ColumnName']])){$text="placeholder=\"Type here\"";}else{$text="value=\"".$object_data[$columns['ColumnName']]."\"";}?>
              <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

            </div>
             <?php
                 }

            //For Text boxes
            if($columns['FieldType']=="link-external"){ ?>
              <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
                <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500');return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                <?php 
                if($object_data[$columns['ColumnName']]=="0" || $object_data[$columns['ColumnName']]==""){
                  $text='placeholder="Full link here..."'; ?>
                    <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>
                <?php
                } else { 
                  $text='value="'.$object_data[$columns['ColumnName']].'"';?>
                  <div class="row">
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>
                    </div>
                    <div class="col-md-3 text-right mt-1 mt-md-0">
                      <a href="<?php echo $object_data[$columns['ColumnName']]; ?>" class="btn view-source" target="blank">View Source</a>
                    </div>
                  </div>
                <?php 
                } ?>
              </div>
            <?php
            }

            // For dates
            if($columns['FieldType']=="date"){
             ?>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
            <?php

            $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
            <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                     'newwindow',
                               'width=500,height=500');
                         return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                         <?php if($object_data[$columns['ColumnName']]=="0" || empty($object_data[$columns['ColumnName']])){$text="Placeholder=\"YYYY-MM-DD\"";}else{$text="value=\"".$object_data[$columns['ColumnName']]."\"";}?>
                         <input pattern="0|[0-9]{4}|[0-9]{4}-[0-9]{2}|[0-9]{4}-[0-9]{2}-[0-9]{2}" type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

            </div>
            <?php
             }

             //For Text Area - Para entries
             if($columns['FieldType']=="textarea"){
              ?>
             <div class="form-group">
             <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
             <?php

             $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
             <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                      'newwindow',
                                'width=500,height=500');
                          return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
            
            <?php if($object_data[$columns['ColumnName']]=="0"){$text="0";}else{$text=$object_data[$columns['ColumnName']];}?>
            <textarea rows="8" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" placeholder="Type Here" <?php if($columns['status']==0){echo "Disabled";}?>><?php echo $text !='0' ? $text : '';?></textarea>


             </div>
             <?php
              }

           // For Dropdown Menu - Defined Values
           if($columns['FieldType']=="dropdown" & $columns['Options']!="Researcher"){
            ?>
           <div class="form-group">
           <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
           <?php

           $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
           <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                    'newwindow',
                              'width=500,height=500');
                        return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
           <?php
           $words = explode(";", $columns['Options']);
           $selected_word = $object_data[$columns['ColumnName']];
           ?>

            <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

              <option value="0">Not Known</option>
              <?php for ($x = 0; $x < sizeof($words); $x++) {

                if($words[$x]==$selected_word){

                  echo "<option value=\"\" selected disabled hidden>".$words[$x]."</option>";
                  echo "<option value=\"".$words[$x]."\">".$words[$x]."</option>";
                }
                else {
                  echo "<option value=\"".$words[$x]."\">".$words[$x]."</option>";
                }
              } ?>

                </select>

             </div>
           <?php
              }

              // For RADIO BUTTON
              if($columns['FieldType']=="radio"){
               ?>
              <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php
              $words = explode(";", $columns['Options']);
              $selected_word = $object_data[$columns['ColumnName']];

              ?>

              <div class="form-group">
                 <?php for ($x = 0; $x < sizeof($words); $x++) {

                   if($words[$x]==$selected_word){
                     ?>

                       <label class="radio-inline"><input type="radio" value="<?php echo $words[$x];?>" name="<?php echo $columns['ColumnName'];?>" checked><?php echo $words[$x];?></label>


                   <?php }
                   else{ ?>

                       <label class="radio-inline"><input type="radio" name="<?php echo $columns['ColumnName'];?>" value="<?php echo $words[$x];?>"><?php echo $words[$x];?></label>


                   <?php }
                 } ?>
               </div>

                </div>
              <?php
                 }

              // For Dropdown Menu - Controlled Vocaublary from Tables
              if($columns['FieldType']=="dropdown-CV"){
               ?>
              <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
              <?php if($columns['Options']=="CV_Place" & $object_data[$columns['ColumnName']]!=0){ ?>
                <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $object_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>

              <?php } ?>
              <?php


                    //Loading Value for Key in Person Table
                    $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `ID`=".$object_data[$columns['ColumnName']];
                    $query_CL = $conn->query($q1);
                    $selected_id_Name = $query_CL->fetch(PDO::FETCH_ASSOC);
                    $selected_Name=$selected_id_Name['Name'];


                    // Loading Controlled Vocaublary
                    $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
                    $query_CL = $conn->query($q1);

              ?>

               <select class="form-control " id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>


                 <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                   if($object_data[$columns['ColumnName']]==$selected_word['ID']){

                    echo "<option value=\"".$selected_word['ID']."\" selected hidden>".$selected_word['Name']."</option>";
                    

                   }
                   else {
                      echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   }
                 } ?>

                   </select>

                </div>
              <?php
                 }

          // For Dropdown Menu - Related Projects
          if($columns['FieldType']=="project-connect"){ ?>
                  
            <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?>
                <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
                <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500');return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              </label>
              <?php
                // Loading Value for Key in Person Table 
                $selectedoptions = $object_data[$columns['ColumnName']];
                $selectedoptions_Array = explode(';',$selectedoptions);

                // Loading List from External Project
                $q1="SELECT `Host`,`username`,`password`,`database_name`,`url` FROM `DB_CONN` WHERE `db_id` LIKE '".$columns['Options']."'";
                $query_CL = $conn->query($q1);
                $project_db = $query_CL->fetch(PDO::FETCH_ASSOC);

                $server = $project_db['Host'];
                $username = $project_db['username'];
                $password = $project_db['password'];
                $database = $project_db['database_name'];
                $project_conn_link = $project_db['url'];
              
                try{
                  $conn_project_ext = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
                } catch(PDOException $e){
                  die( "Connection failed: " . $e->getMessage());
                }
              
                $q_project_list="SELECT `personID`,`UI` as `ID`,`Name` FROM `person` WHERE `online`='1'";
                $project_person_list = $conn_project_ext->query($q_project_list);
              ?>

              <select onchange="slection_made()" class="form-control project-connect" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
                <?php while($selected_word = $project_person_list->fetch(PDO::FETCH_ASSOC)){
                  $disable_flag = "";
                  $url_conn = $project_conn_link.$selected_word['personID'];
                  foreach($selectedoptions_Array as $opt_selected){
                    if($opt_selected==$selected_word['ID']){
                      $disable_flag="selected";
                    }
                  }
                  echo '<option value="'.$selected_word['ID'].'" '.$disable_flag.' title="'.$url_conn.'">'.$selected_word['ID'].' - '.$selected_word['Name'].'</option>';

                } ?>
              </select>

            </div>
          <?php
          }

          // For Dropdown Menu - Load Researchers
          if($columns['FieldType']=="dropdown" & $columns['Options']=="Researcher"){ ?>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
            <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
            <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500'); return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
            <?php require '../decodingorigins-login/database_login.php';
              $q_user="SELECT * FROM `users` WHERE `".$object_data['project']."`=1 order by `lname` ASC";
              $query_user = $conn->query($q_user);

              //Loading Value for Key in Events Table
              $selectedoptions=$object_data[$columns['ColumnName']];
              $selectedoptions_Array = explode(';', $selectedoptions);
            ?>

            <select onchange="slection_made()" class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
              <?php 
                $notknown_flag = "";
                foreach($selectedoptions_Array as $opt_selected){
                  if($opt_selected="0"){
                    $notknown_flag="selected";
                  }
                }
                echo '<option value="0" '.$notknown_flag.'>Not Known</option>';
              ?>
              <?php while($user = $query_user->fetch(PDO::FETCH_ASSOC)){
                $disable_flag = "";
                foreach($selectedoptions_Array as $opt_selected){
                  if($opt_selected==$user['email']){
                    $disable_flag="selected";
                  }
                }
                echo '<option value="'.$user['email'].'" '.$disable_flag.'>'.$user['fname'].' '.$user['lname'].'</option>';
              } ?>
            </select>
          </div>
        <?php
        require 'utilities/database_SS.php';
        }

        // For Dropdown Menu - Controlled Vocaublary from Tables -multiselct box
        if($columns['FieldType']=="dropdown-CV-multi"){ ?>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
            <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id']; ?>
            <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500');return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
            <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
            <?php if($columns['Options']=="CV_Place" & $object_data[$columns['ColumnName']]!=0){ ?>
              <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $object_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>
            <?php } ?>
            <?php
              //Loading Value for Key in Events Table
              $selectedoptions=$object_data[$columns['ColumnName']];
              $selectedoptions_Array = explode(';', $selectedoptions);

              // Loading Controlled Vocaublary
              $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CL = $conn->query($q1);
            ?>

            <select onchange="slection_made()" class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
              <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
                $disable_flag = "";
                foreach($selectedoptions_Array as $opt_selected){
                  if($opt_selected==$selected_word['ID']){
                    $disable_flag="selected";
                  }
                }
                echo '<option value="'.$selected_word['ID'].'" '.$disable_flag.'>'.$selected_word['Name'].'</option>';

              } ?>
            </select>
          </div>
        <?php
        }

         // For Dropdown Menu - Load ALL Attached Sources
           if($columns['FieldType']=="dropdown-Objects"){

          ?>
         <div class="form-group">
           <label class="form-check-label" for="exampleCheck1">Enable Autofill for this form?</label>
           <select class="form-control"  style="width:100%"  id="autofill_toggle">
             <option value="Yes">Yes</option>
             <option value="No">No</option>
           </select>

           <br>
         <label for="exampleInputEmail1"><?php echo $columns['display']?></label>
         <?php

         $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
         <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                  'newwindow',
                            'width=500,height=500');
                      return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
         <?php
         require '../decodingorigins-login/database_login.php';
         $authorized_projects="";
         //Loading All Projects
         $q_projects="SELECT * FROM `Project`";
         $query_projects = $conn->query($q_projects);
         while($project = $query_projects->fetch(PDO::FETCH_ASSOC)){

           if(isset($results[$project['ProjectID']]) && $results[$project['ProjectID']]==1)
           {
             $authorized_projects=$authorized_projects." `project` LIKE '".$project['ProjectID']."' OR";
           }
         }
         $authorized_projects=substr($authorized_projects,0,-2);


         require 'utilities/database_SS.php';

         // Loading Objects
         $q_s="SELECT DISTINCT * FROM `object` WHERE (".$authorized_projects.") AND `Adminupload` >= 2 ";

         $query_s = $conn->query($q_s);



         ?>




          <select class="form-control searchdropdown" onchange="S_Load(this.value)" style="width:100%" name="<?php echo $columns['ColumnName'];?>" id="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

            <option value="0">No Attachments</option>
            <?php while($query_objects_attached = $query_s->fetch(PDO::FETCH_ASSOC)){



                if($query_objects_attached['objectID']==$object_data[$columns['ColumnName']]){
                echo "<option value=\"\" selected disabled hidden>".$query_objects_attached['Field1']."</option>";
                echo "<option value=\"".$query_objects_attached['objectID']."\">".$query_objects_attached['CollectionName']." - ".$query_objects_attached['Field1']."</option>";

              }
              else {
                echo "<option value=\"".$query_objects_attached['objectID']."\">".$query_objects_attached['CollectionName']." - ".$query_objects_attached['Field1']."</option>";
              }

            }?>

          </select>
          <div id="full_alert" style="display:none; color: green;"><br><i class="fas fa-check-circle"></i> All Meta-Fields below are now updated and reflects the data from the full source you selected! Review carefully, edit and then save the data!</div>
          <div id="full_alert_undo" style="display:none; color: red;"><br><i class="fas fa-check-circle"></i> All Meta-Fields are now set to default values. Please enter new data below!</div>
          <div id="autofill_diabled" style="display:none; color: red;"><br><i class="fas fa-check-circle"></i> Autofill is currently disabled. No values were changed!</div>

       </div>
     <?php
     require 'utilities/database_SS.php';
        }


          ?>


         <?php
          }
        ?>

         </div>
       </div>
     </div>


     <?php


   }

   ?>

    <div class="row">
      <?php if((isset($_GET['doctype']) && $_GET['doctype']!="NoSelection") || $doctype!="NoSelection"):?>
      <div class="col-xl-3 col-md-3 mb-3">
      <?php if($results['security']>=0){ ?>
        <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
      <?php } ?>
      </div>
    <?php endif;?>
        </form>
      </div>

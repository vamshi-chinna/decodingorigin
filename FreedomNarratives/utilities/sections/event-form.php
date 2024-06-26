
  <form action="event_edit.php?personID=<?php echo $personID; ?>&eventID=<?php echo $eventID; ?>" method="POST">
  <input type="hidden" name="action" value="Update">
  <div class="row">
    <?php if($doctype!="NoSelection"):?>
    <div class="col-xl-3 col-md-3 mb-3">
    <?php if($results['security']>=0){ ?>
    <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
    <?php } ?>
    </div>
  <?php endif;?>
</div>
<div class="clearfix"></div>
 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


  <?php

  $q1="SELECT DISTINCT `section`,`SectionDisplay` FROM `".$doctype."`";
  $query = $conn->query($q1);


   while($section = $query->fetch(PDO::FETCH_ASSOC)){


     ?>
     <!-- Collapsable Section -->
     <div class="panel panel-default">


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
             <?php if($event_data[$columns['ColumnName']]=="0" || empty($event_data[$columns['ColumnName']])){$text="placeholder=\"Type here\"";}else{$text="value=\"".$event_data[$columns['ColumnName']]."\"";}?>
             <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

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
                         <?php if($event_data[$columns['ColumnName']]=="0" || empty($event_data[$columns['ColumnName']])){$text="Placeholder=\"YYYY-MM-DD\"";}else{$text="value=\"".$event_data[$columns['ColumnName']]."\"";}?>
                         <input pattern="0|[0-9]{4}|[0-9]{4}-[0-9]{2}|[0-9]{4}-[0-9]{2}-[0-9]{2}|NA" type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

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
            <?php if($event_data[$columns['ColumnName']]=="0" || empty($event_data[$columns['ColumnName']])){$text="0";}else{$text=$event_data[$columns['ColumnName']];}?>
            <textarea rows="8" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" placeholder="Type here" <?php if($columns['status']==0){echo "Disabled";}?>><?php echo $text !='0' ? $text : '';?></textarea>

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
           $selected_word = $event_data[$columns['ColumnName']];
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
              $selected_word = $event_data[$columns['ColumnName']];
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

                 // For MULTIPLE SELECT
                 if($columns['FieldType']=="multi"){
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

                 <?php

                 // Loading Controlled Vocaublary
                 $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
                 $query_CL = $conn->query($q1);


                 ?>

                 <div class="form-group">
                   <div class="row">
                   <div class="col-lg-6">
                   <select id="demoSel" size="5" multiple style="width:100%;">
                     <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                          echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

                     } ?>

                    </select>
                    <small id="emailHelp" class="form-text text-muted">Press Control/Command and select multiple entries</small>

                  </div>
                  <div class="col-lg-6">
                    <?php
                    if($event_data[$columns['ColumnName']]=="0")
                    {
                      $event_data_select="None Specified";
                    }
                    else{
                      $event_data_select=$event_data[$columns['ColumnName']];
                    }
                    ?>

                    <textarea style="width:100%;" name="<?php echo $columns['ColumnName'];?>" id="display" placeholder="<?php echo $event_data_select;?>" cols="20" rows="4" readonly></textarea>
                  </div>
                </div>
                  </div>

                   </div>

                   <script>
                   // arguments: reference to select list, callback function (optional)
             function getSelectedOptions(sel, fn) {
                 var opts = [], opt;

                 // loop through options in select list
                 for (var i=0, len=sel.options.length; i<len; i++) {
                     opt = sel.options[i];

                     // check if selected
                     if ( opt.selected ) {
                         // add to array of option elements to return from this function
                         opts.push(opt);

                         // invoke optional callback function if provided
                         if (fn) {
                             fn(opt);
                         }
                     }
                 }

                 // return array containing references to selected option elements
                 return opts;
             }
             // example callback function (selected options passed one by one)

             function callback(opt) {
                 // display in textarea for this example
                 var display = document.getElementById('display');
                 display.innerHTML = display.innerHTML + opt.text + ';';

                 // can access properties of opt, such as...
                 //alert( opt.value )
                 //alert( opt.text )
                 //alert( opt.form )
             }
             // anonymous function onchange for select list with id demoSel
             document.getElementById('demoSel').onchange = function(e) {
                 // get reference to display textarea
                 var display = document.getElementById('display');
                 display.innerHTML = ''; // reset

                 // callback fn handles selected options
                 getSelectedOptions(this, callback);

                 // remove ', ' at end of string
                 var str = display.innerHTML.slice(0, -1);
                 display.innerHTML = str;
             };

             document.getElementById('demoForm').onsubmit = function(e) {
                 // reference to select list using this keyword and form elements collection
                 // no callback function used this time
                 var opts = getSelectedOptions( this.elements['demoSel[]'] );

                 alert( 'The number of options selected is: ' + opts.length ); //  number of selected options

                 return false; // don't return online form
             };
             </script>
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
              <?php if($columns['Options']=="CV_Place" & $event_data[$columns['ColumnName']]!=0){ ?>
                <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $event_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>

              <?php } ?>
              <?php

                        //Loading Value for Key in Events Table
                        $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `ID`=".$event_data[$columns['ColumnName']];

                        $query_CL = $conn->query($q1);
                        $selected_Name = $query_CL->fetch(PDO::FETCH_ASSOC);



                        // Loading Controlled Vocaublary
                        //ONLY For Geo details - pending entries will also show up for data entry
                        if($columns['Options']=="CV_Geographic_Details"){
                        $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` ORDER BY `listorder`";
                          }else{
                        $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
                          }
                        $query_CL = $conn->query($q1);


              ?>

               <select class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>


                 <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
                   //echo $event_data[$columns['ColumnName']]."=".$selected_word['ID'];

                   if($event_data[$columns['ColumnName']]==$selected_word['ID']){

                     // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                      $text_display=htmlspecialchars_decode($selected_Name['Name']);
                      echo "<option value=\"".$selected_word['ID']."\" selected hidden>".$text_display."</option>";

                   }
                   else {
                     $text_display=htmlspecialchars_decode($selected_word['Name']);
                      echo "<option value=\"".$selected_word['ID']."\">".$text_display."</option>";
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
                $selectedoptions = $event_data[$columns['ColumnName']];
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
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500');return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php require '../decodingorigins-login/database_login.php'; 
                $q_user="SELECT * FROM `users` WHERE `".$event_data['project']."`=1 order by `lname` ASC";
                $query_user = $conn->query($q_user);

                //Loading Value for Key in Events Table
                $selectedoptions=$event_data[$columns['ColumnName']];
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


                           // For Dropdown Menu - Load ALL Attached Sources
                             if($columns['FieldType']=="dropdown-Objects"){
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

                           $q_s="SELECT * FROM `objects_person` WHERE `personID` LIKE '".$personID."'";
                           $query_s = $conn->query($q_s);



                           ?>

                            <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                              <option value="0">No Attachments</option>
                              <?php while($query_objects_attached = $query_s->fetch(PDO::FETCH_ASSOC)){

                                $q3="SELECT * FROM `object` WHERE `objectID` LIKE '".$query_objects_attached['objectID']."'";
                                echo $q3;
                                $query3 = $conn->query($q3);
                                $query_object_data = $query3->fetch(PDO::FETCH_ASSOC);

                                $q2="SELECT * FROM `event` WHERE `eventID` LIKE '".$eventID."'";
                                echo $q2;
                                $query2 = $conn->query($q2);
                                $query_data = $query2->fetch(PDO::FETCH_ASSOC);

                                if($query_object_data['Field1']=="0")
                                {
                                  $query_data_title="ObjectID: ".$query_object_data['objectID'];
                                }else{
                                  $query_data_title=$query_object_data['Field1'];
                                }


                                  if($query_objects_attached['objectID']==$query_data['Sources']){
                                  echo "<option value=\"\" selected disabled hidden>".$query_data_title."</option>";
                                  echo "<option value=\"".$query_object_data['objectID']."\">".$query_object_data['objectID']." - ".$query_data_title."</option>";

                                }
                                else {
                                  echo "<option value=\"".$query_object_data['objectID']."\">".$query_object_data['objectID']." - ".$query_data_title."</option>";
                                }

                              }?>

                            </select>

                         </div>
        <?php
        require 'utilities/database_SS.php';
        }

        // For Dropdown Menu - Controlled Vocaublary from Tables -multiselct box
        if($columns['FieldType']=="dropdown-CV-multi"){ ?>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
            <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
            <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500'); return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
            <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
            <?php if($columns['Options']=="CV_Place" & $event_data[$columns['ColumnName']]!=0){ ?>
              <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $event_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>
            <?php } ?>
            <?php
              //Loading Value for Key in Events Table
              $selectedoptions=$event_data[$columns['ColumnName']];
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
        } ?>

         <?php
          }?>

         </div>
       </div>
     </div>
      </div>




     <?php


   }

   ?>


</div>

    <div class="row">
      <?php if($doctype!="NoSelection"):?>
      <div class="col-xl-3 col-md-3 mb-3">
      <?php if($results['security']>=0){ ?>
        <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
      <?php } ?>
      </div>
    <?php endif;?>

        </form>
      </div>

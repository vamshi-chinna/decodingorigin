  <form action="person_edit.php?personID=<?php echo $personID; ?>" method="POST">
  <input type="hidden" name="action" value="Update">
  <?php if($doctype!="NoSelection"):?>
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
             <?php if($person_data[$columns['ColumnName']]=="0"){$text="placeholder=\"Type here\"";}else{$text="value=\"".$person_data[$columns['ColumnName']]."\"";}?>
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
                if($person_data[$columns['ColumnName']]=="0" || $person_data[$columns['ColumnName']]==""){
                  $text='placeholder="Full link here..."'; ?>
                    <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>
                <?php
                } else { 
                  $text='value="'.$person_data[$columns['ColumnName']].'"';?>
                  <div class="row">
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>
                    </div>
                    <div class="col-md-3 text-right mt-1 mt-md-0">
                      <a href="<?php echo $person_data[$columns['ColumnName']]; ?>" class="btn view-source" target="blank">View Source</a>
                    </div>
                  </div>
                <?php 
                } ?>
              </div>
            <?php
            }

                //For Text boxes
                if($columns['FieldType']=="text-dependent"){
                ?>
               <div class="form-group">
                 <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                 <?php

                 $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];
                 $CV_details="CV_details.php?type=".$columns['Options'];?>
                 <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                          'newwindow',
                                    'width=500,height=500');
                              return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                 <a href="<?php echo $CV_details;?>.php" onclick="window.open('<?php echo $CV_details;?>',
                              'newwindow',
                              'width=500,height=500');
                              return false;" target="_blank"><i class="fas fa-list-alt"></i></a>
                 <?php if($person_data[$columns['ColumnName']]=="0"){$text="placeholder=\"Type here\"";}else{$text="value=\"".$person_data[$columns['ColumnName']]."\"";}?>
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
            <?php if($person_data[$columns['ColumnName']]=="0" || empty($person_data[$columns['ColumnName']])){$text="placeholder=\"Type here\"";}else{$text="value=\"".$person_data[$columns['ColumnName']]."\"";}?>
            <input type="date" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

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

            <?php if($person_data[$columns['ColumnName']]=="0" || empty($person_data[$columns['ColumnName']])){$text="0";}else{$text=$person_data[$columns['ColumnName']];}?>
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
           $selected_word = $person_data[$columns['ColumnName']];
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
                         $selected_word = $person_data[$columns['ColumnName']];
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
                               if($person_data[$columns['ColumnName']]=="0")
                               {
                                 $person_data_select="None Specified";
                               }
                               else{
                                 $person_data_select=$person_data[$columns['ColumnName']];
                               }
                               ?>

                               <textarea style="width:100%;" name="<?php echo $columns['ColumnName'];?>" id="display" placeholder="<?php echo $person_data_select;?>" cols="20" rows="4" readonly></textarea>
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
                <label for="exampleInputEmail1"><?php echo $columns['display'];?>
                  <?php

                  $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
                  <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                          'newwindow',
                                    'width=500,height=500');
                              return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                  <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
                  <?php if($columns['Options']=="CV_Place" & $person_data[$columns['ColumnName']]!=0){ ?>
                    <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $person_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>

                  <?php } ?>
                </label>
                <?php

                //Loading Value for Key in Person Table
                $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `ID`=".$person_data[$columns['ColumnName']];
                $query_CL = $conn->query($q1);
                $selected_Name = $query_CL->fetch(PDO::FETCH_ASSOC);

                // Loading Controlled Vocaublary
                $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
                $query_CL = $conn->query($q1);

                ?>

                <select  class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                 <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                   if($person_data[$columns['ColumnName']]==$selected_word['ID']){
                    // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                     echo "<option value=\"".$selected_word['ID']."\" selected hidden>".$selected_Name['Name']."</option>";
                   } else {
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
                    $selectedoptions = $person_data[$columns['ColumnName']];
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
                  
                    //$q_project_list="SELECT `personID`,`UI` as `ID`,`Name` FROM `person` WHERE `online`='1'";
                    $q_project_list="SELECT `personID`,`UI` as `ID`,`Name` FROM `person` ";
                    $project_person_list = $conn_project_ext->query($q_project_list);
                  ?>

                  <select class="form-control project-connect" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
                    <?php if(in_array("0",$selectedoptions_Array)){
                      $noentry_flag = "selected";
                    } else {
                      $noentry_flag = "";
                    }?>
                    <option value="0" <?php echo $noentry_flag;?>>No Connections</option>
                    <?php while($selected_word = $project_person_list->fetch(PDO::FETCH_ASSOC)){
                      $disable_flag = "";
                      $url_conn = $project_conn_link . $selected_word['personID'];
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
              <?php $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id']; ?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>','newwindow','width=500,height=500');return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php require '../decodingorigins-login/database_login.php';
                $q_user="SELECT * FROM `users` WHERE `".$person_data['project']."`=1 order by `lname` ASC";
                $query_user = $conn->query($q_user);

                //Loading Value for Key in Events Table
                $selectedoptions=$person_data[$columns['ColumnName']];
                $selectedoptions_Array = explode(';', $selectedoptions);
              ?>

              <select  class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
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
            <?php if($columns['Options']=="CV_Place" & $person_data[$columns['ColumnName']]!=0){ ?>
              <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $person_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>
            <?php } ?>
            <?php
              //Loading Value for Key in Events Table
              $selectedoptions=$person_data[$columns['ColumnName']];
              $selectedoptions_Array = explode(';', $selectedoptions);

              // Loading Controlled Vocaublary
              $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CL = $conn->query($q1);
            ?>

            <select  class="form-control searchdropdown" style="width:100%" name="<?php echo $columns['ColumnName'];?>[]" <?php if($columns['status']==0){echo "Disabled";}?> multiple>
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
          ?>


         <?php
          }?>

         </div>
       </div>
     </div>



     <?php


   }

   ?>

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

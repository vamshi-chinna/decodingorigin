<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
      <div class="modal-header">

        <?php

        $table_name_readable=str_replace("_", " ", $_GET['table']);
        $table_name_readable=explode("CV",$table_name_readable )[1];
        if($table_name_readable=="")
        {
          $table_name_readable=str_replace("_", " ", $_GET['table']);
        }
        ?>

        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-plus-square"></i>&nbsp;&nbsp;<?php echo $table_name_readable;?></h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="utilities/commands_external/submit_CV.php" method="post">
        <?php
        //Extracting table name from submission Form (GET function)
        $table_name=$_GET['table'];

        //Extract Column Names

        $q1="DESCRIBE `".$table_name."`";
        $query_CL = $conn->query($q1);

        while($Available_Names = $query_CL->fetch(PDO::FETCH_ASSOC)){
          if($Available_Names['Field']=="Location" || $Available_Names['Field']=="Place_Type" || $Available_Names['Field']=="ID" || $Available_Names['Field']=="Status" ||$Available_Names['Field']=="Message" ||$Available_Names['Field']=="Submitby" |$Available_Names['Field']=="listorder"){
            //Place Type Controlled Vocaublary Load
            if($Available_Names['Field']=="Place_Type" ){


              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Place_Type` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" >
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

            }   ?>

            </select>
            </div>
            <?php
          }
          //LOCATION Type Controlled Vocaublary Load
            if($Available_Names['Field']=="Location" ){

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Location` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" >
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

              } ?>

            </select>
            </div>
            <?php
            }
            }else{
          ?>
          <div class="form-group">
          <label for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
          <input type="text" class="form-control"  name="<?php echo $Available_Names['Field'];?>" placeholder="Enter new entry here">

        </div>



      <?php  }
    }
        ?>
        <div class="form-group">
          <label for="exampleInputEmail1">Message</label>
          <textarea rows="8" class="form-control" name="Message"  placeholder="Type Message or Comment here" ></textarea>


        </div>
        <?php if($results['security']>0){ ?>
          <input type="hidden" name="Status" value="1">
        <?php }else{ ?>
          <input type="hidden" name="Status" value="0">
        <?php } ?>
        <input type="hidden" name="Submitby" value="<?php echo $RA;?>">
          <input type="hidden" name="table" value="<?php echo $table_name;?>">





       </div>
      <div class="modal-footer">
        <?php if($results['security']>0){ ?>
          <button class="btn btn-success" type="submit" >Add to List</button>
        <?php }else{ ?>

        <button class="btn btn-warning" type="submit" >Submit for Approval</button>
        <?php } ?>

          </form>


      </div>
    </div>
  </div>
</div>

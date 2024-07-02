<?php

//Loading values
if(isset($_POST['action']) && $_POST['action']=="Update"){
$type="event";
$field="";
$field_log="";

foreach ($_POST as $name => $val)
{
  if($name !="action"){
    $CV_flag=0;
    $multi_flag=0;
    $q1_fieldName="SELECT `display` FROM `".$event_data['doctype']."` WHERE `ColumnName` LIKE '".$name."'";
    $query_fieldName = $conn->query($q1_fieldName);
    $Display_name = $query_fieldName->fetch(PDO::FETCH_ASSOC);

    //Loading Value for Key in Event Table
    $q1="SELECT * FROM ".$event_data['doctype'];
    $query_CL = $conn->query($q1);
    while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC))
    {
      if($CV_identifer['FieldType']=="dropdown-CV" & $CV_identifer['ColumnName']==$name)
      {
        $CV_flag=1;
        $CV_table_name=$CV_identifer['Options'];

      }
      if($CV_identifer['FieldType']=="dropdown-CV-multi" & $CV_identifer['ColumnName']==$name)
      {
        $CV_table_name=$CV_identifer['Options'];

      }
      if($CV_identifer['FieldType']=="dropdown" & $CV_identifer['Options']=="Researcher")
      {
        $CV_flag=2;
        $CV_table_name='users';
      }
    }

    if($name !="eventID" && $name!="Sources" && !empty($val) && $val!=$event_data[$name] && $CV_flag==0){
      if(is_array($val)){
        $val_string = implode(";",$val);
        $field=$field.htmlspecialchars($name . ': ' . $val_string) . " <br> ";
      } else {
        $field=$field.htmlspecialchars($name . ': ' . $val) . " <br> ";
      }

      if(is_array($_POST[$name])){
        $column_opt="";
        $column_opt_id="";
        foreach($_POST[$name] as $option){
          $q1="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$option;
          $query_q1 = $conn->query($q1);
          $CV_value_data = $query_q1->fetch(PDO::FETCH_ASSOC);
          $CV_value=$CV_value_data['Name'];
          $column_opt=$column_opt.$CV_value.";";
          $column_opt_id=$column_opt_id.$option.";";
        }
        if($event_data[$name]!=$column_opt_id){
          $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $column_opt,ENT_QUOTES) . " <br> ";
        }
      } else {
        $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $val,ENT_QUOTES) . " <br> ";
      }
    }
    //Getting Names for selected controlled Vocaublary
    if($CV_flag==1)
    {
      $q1="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$val;

      $query_q1 = $conn->query($q1);
      $CV_value = $query_q1->fetch(PDO::FETCH_ASSOC);
      $field=$field.htmlspecialchars($name . ': ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";


      $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";
    }
    if($CV_flag==2)
    {
      if(is_array($val)){
        $val_values = implode(";",$val);
        $field=$field.htmlspecialchars($name . ': ' . $val_values, ENT_QUOTES) . " <br> ";
      } else {
        $field=$field.htmlspecialchars($name . ': ' . $val, ENT_QUOTES) . " <br> ";
      }
      if(is_array($_POST[$name])){
        $column_opt="";
        $column_opt_id="";
        foreach($_POST[$name] as $option){
          $column_opt=$column_opt.$option.";";
          $column_opt_id=$column_opt_id.$option.";";
        }
        if(isset($event_data[$name]) && $event_data[$name]!=$column_opt_id){
          $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $column_opt, ENT_QUOTES) . " <br> ";
        }
      } else {
        $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $val, ENT_QUOTES) . " <br> ";
      }
    }
    
    //Getting Source Name for secleted Controlled Vocaublary
    if($Display_name['display']=="Sources")
    {
      if($val=="0")
      {
        $field=$field.htmlspecialchars($Display_name['display'] . ': No Selection', ENT_QUOTES) . " <br> ";
      } else {
        $q1="SELECT * FROM `object` WHERE `objectID` LIKE '".$val."'";
        $query_q1 = $conn->query($q1);
        $Object_sourceID = $query_q1->fetch(PDO::FETCH_ASSOC);
        if($Object_sourceID['Title']=="0")
        {
          $Object_source_Title="No Title Assigned";
        } else {
          $Object_source_Title=$Object_sourceID['Title'];
        }

        $field=$field.htmlspecialchars($Display_name['display']. ': Object ID- ' . $Object_sourceID['objectID'], ENT_QUOTES) . " <br> ";
        $field=$field.htmlspecialchars('Object Title- ' . $Object_source_Title, ENT_QUOTES) . " <br> ";
      }
    }
  }
}

if($field!=""){

  foreach ($_POST as $name => $val){

    if($_POST[$name]!="on" || $_POST[$name]=="0" ){
      if(is_array($val)){
        $val_string = implode(";",$val);
        $column = htmlspecialchars($val_string, ENT_QUOTES);
      } else {
        $column = htmlspecialchars($val, ENT_QUOTES);
      }
    
      $q1_fieldtype="SELECT `FieldType`,`Options` FROM `".$event_data['doctype']."` WHERE `ColumnName`LIKE '".$name."'";
      $query_fieldtype = $conn->query($q1_fieldtype);
      $fieldtype_data = $query_fieldtype->fetch(PDO::FETCH_ASSOC);
      if($fieldtype_data){
        $fieldtype=$fieldtype_data['FieldType'];
        $researcher_flag = $fieldtype_data['Options'];

        if($fieldtype=="dropdown-CV-multi" || ($fieldtype=="dropdown" & $researcher_flag=="Researcher")){
          $column="";
          foreach($_POST[$name] as $option){
            $column=$column.$option.";";
          }
      
          //Update entry
          $sql = "UPDATE `event` SET `".$name."`=\"".$column."\" WHERE `eventID` = \"".$eventID."\"";
          $stmt = $conn->prepare($sql);
      
          if( $stmt->execute() ):
            $message = 1;
      
          else:
            $message = 2;
          endif;
      
        } else{
          //Update entry
          $sql = "UPDATE `event` SET `".$name."`=\"".$column."\" WHERE `eventID` = \"".$eventID."\"";
          $stmt = $conn->prepare($sql);
      
          if( $stmt->execute() ):
            $message = 1;
      
          else:
            $message = 2;
          endif;
      
      }
    }
  }
}

    //Update Log
    $action="Updated";
    $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$eventID."','".$type."','".$TimeDate."','".$RA."','".$field_log."','".$action."')";
    $stmt = $conn->prepare($sql);
    if( $stmt->execute() ):
      $message = 1;

    else:
      $message = 2;
    endif;
  } else {
    $message=2;
  }
}
?>

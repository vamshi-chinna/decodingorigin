<?php

//Loading values
if($_POST['action']=="Update"){
$type="person";
$field="";
$field_log="";


foreach ($_POST as $name => $val)
{
  if($name !="action"){
    $CV_flag=0;
    $multi_flag=0;
    $q1_fieldName="SELECT `display` FROM `".$person_data['doctype']."` WHERE `ColumnName`LIKE '".$name."'";
    $query_fieldName = $conn->query($q1_fieldName);
    $Display_name = $query_fieldName->fetch(PDO::FETCH_ASSOC);

    //Loading Value for Key in Person Table
    $q1="SELECT * FROM ".$person_data['doctype'];
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



    }


     if($name !="personID" && !empty($val) && $val!=$person_data[$name] & $CV_flag==0 ){
     $field=$field.htmlspecialchars($name . ': ' . $val, ENT_QUOTES) . " <br> ";

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
       $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $column_opt, ENT_QUOTES) . " <br> ";
     }

     }else{
     $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $val, ENT_QUOTES) . " <br> ";
     }


     }
     if($CV_flag==1)
     {
       $q1="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$val;
       $query_q1 = $conn->query($q1);
       $CV_value = $query_q1->fetch(PDO::FETCH_ASSOC);
       $field=$field.htmlspecialchars($name . ': ' . $CV_value['Name']) . " <br> ";


       $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";


     }



   }
}

if($field!=""){

  foreach ($_POST as $name => $val){

if($_POST[$name]!="on" || $_POST[$name]=="0" ){
$column = htmlspecialchars($val, ENT_QUOTES);


$q1_fieldtype="SELECT `FieldType` FROM `".$person_data['doctype']."` WHERE `ColumnName`LIKE '".$name."'";
$query_fieldtype = $conn->query($q1_fieldtype);
$fieldtype_data = $query_fieldtype->fetch(PDO::FETCH_ASSOC);
$fieldtype=$fieldtype_data['FieldType'];
if($fieldtype=="dropdown-CV-multi"){
  $column="";
  foreach($_POST[$name] as $option){
    $column=$column.$option.";";
  }

  //Update entry
  	$sql = "UPDATE `person` SET `".$name."`=\"".$column."\" WHERE `personID` = \"".$personID."\"";
  	$stmt = $conn->prepare($sql);

  	if( $stmt->execute() ):
  		$message = 1;

  	else:
  		$message = 2;
  	endif;

}else{


//Update entry

	$sql = "UPDATE `person` SET `".$name."`=\"".$column."\" WHERE `personID` = \"".$personID."\"";
	$stmt = $conn->prepare($sql);

	if( $stmt->execute() ):
		$message = 1;

	else:
		$message = 2;
	endif;



}
}
}

//Update Log
$action="Updated";

    $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','".$type."','".$TimeDate."','".$RA."','".$field_log."','".$action."')";
    $stmt = $conn->prepare($sql);
    if( $stmt->execute() ):
  		$message = 1;

  	else:
  		$message = 2;
  	endif;
}

else{
  $message=2;
}
}
 ?>

<?php

//Loading values
if($_POST['action']=="Update"){
$type="object";
$field="";
foreach ($_POST as $name => $val)
{
  if($name !="action"){
    $CV_flag=0;
    $q1_fieldName="SELECT `display` FROM `".$object_data['doctype']."` WHERE `ColumnName`LIKE '".$name."'";
    $query_fieldName = $conn->query($q1_fieldName);
    $Display_name = $query_fieldName->fetch(PDO::FETCH_ASSOC);


    //Loading Value for Key in Object Table
    $q1="SELECT * FROM ".$object_data['doctype'];
    $query_CL = $conn->query($q1);
    while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC))
    {
      if($CV_identifer['FieldType']=="dropdown-CV" & $CV_identifer['ColumnName']==$name)
      {
        $CV_flag=1;
        $CV_table_name=$CV_identifer['Options'];
      }


    }

     if($name !="objectID" && !empty($val) && $val!=$object_data[$name] & $CV_flag==0){
     $field=$field.htmlspecialchars($name . ': ' . $val, ENT_QUOTES) . " <br> ";


     $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $val, ENT_QUOTES) . " <br> ";


     }
     if($CV_flag==1)
     {
       $q1="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$val;
       $query_q1 = $conn->query($q1);
       $CV_value = $query_q1->fetch(PDO::FETCH_ASSOC);
       $field=$field.htmlspecialchars($name . ': ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";


       $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";

     }
     if($name =="FullSource"){
       $q2="SELECT * FROM `object` WHERE `objectID`=".$val;
       $query_q2 = $conn->query($q2);
       $Object_data_attach = $query_q2->fetch(PDO::FETCH_ASSOC);

       $field_log=$field_log." - Attached ObjectUI :".$Object_data_attach['UI']."<br> - Attached Source Title: ".$Object_data_attach['Field1']." <br> ";
     }


}
}
if($field!=""){

  foreach ($_POST as $name => $val){

if($_POST[$name]!="on" || $_POST[$name]=="0" ){
$column = htmlspecialchars($val, ENT_QUOTES);

//Update entry
	$sql = "UPDATE `object` SET `".$name."`=\"".$column."\" WHERE `objectID` = \"".$objectID."\"";
	$stmt = $conn->prepare($sql);

	if( $stmt->execute() ):
		$message = 1;

	else:
		$message = 2;
	endif;



}
}

//Update Log
$action="Updated";
    $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$objectID."','".$type."','".$TimeDate."','".$RA."','".$field_log."','".$action."')";
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

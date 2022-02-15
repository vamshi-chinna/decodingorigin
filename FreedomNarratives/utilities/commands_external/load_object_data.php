<?php
require '../user-check-utilities-subfolders.php';
$ID=$_GET['id'];

$q_CV_value="SELECT * FROM `object` where `objectID` = '".$ID."'";
$query_CV_value = $conn->query($q_CV_value);
$CV_values = $query_CV_value->fetch(PDO::FETCH_ASSOC);

$response = json_encode($CV_values);
echo $response;

?>

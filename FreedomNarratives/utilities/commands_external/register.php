<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../../../decodingorigins-login/database_login.php';

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $Organization=$_POST['Organization'];
    $security=0;
    $chat=1;
    $FN="1";


    $url=explode("?message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."?message=1";
    $url_success=$url."?message=2";


    $sql = "INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`Organization`,`security`,`chat`,`FN`) VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$Organization."',".$security.",".$chat.",'".$FN."')";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){
        header( 'location: '.$url_success);
      }
      else{
    header( 'location: '.$url_error);
      }



?>

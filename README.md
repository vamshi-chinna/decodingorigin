# decodingoriginswebportal.org
The Decoding Origins Web Portal

Set-Up Requirements

##Create the following files and copy the required code in the **four** files:
**database_login.php** and **FreedomNarratives/utilities/database_SS.php** and **FreedomNarratives/utilities/database_RegID.php** and **FreedomNarratives/utilities/database_login.php**

<?php
$server = '';
$username = '';
$password = '';
$database = '';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
?>

##FreedomNarratives/instructions.php

Add your credentials to instructions_template.php make a copy of the template(**don't delete the template**) rename it [the copy] to instructions.php

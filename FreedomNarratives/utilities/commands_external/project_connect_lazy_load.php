<?php 
require '../database_SS.php';
/* Lazy Load Implementation of Select2 to fetch remote data based on user's search term rather than loading the entire dataset which causes UI to break */ 
/* If user doesn't type anything in the Select2 box, do nothing */ 
if(isset($_GET['search'])){
    $search_term = $_GET['search'];
    $search_term = preg_replace('/\s+/', '%', $search_term); // Handle spaces
    $db_field = $_GET['db']; // Comes from 'Option' column in map table e.g DB_LA

    // Use the $db_field to get the database code needed for DB_CONN 
    // Loading List from External Project
    $q1="SELECT `Host`,`username`,`password`,`database_name`,`url` FROM `DB_CONN` WHERE `db_id` LIKE '".$db_field."'";
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

    // Select2 requires array keys 'id' for the value and 'text' for the text displayed in the option tag
    $q_project_list="SELECT concat('".$project_conn_link."',`personID`) as 'title',`UI` as 'id', concat(`UI`,' - ',`Name`) as 'text' FROM `person` WHERE `Name` LIKE '%".$search_term."%' OR `UI` LIKE '%".$search_term."%'";

    $project_person_list = $conn_project_ext->query($q_project_list);
    $results = $project_person_list->fetchAll(PDO::FETCH_ASSOC);

    // Select2 requires the array's main key to be 'results'
    echo json_encode(array("results"=>$results));
}
?>
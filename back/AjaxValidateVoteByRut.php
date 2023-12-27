<?php

require_once("../config/database.php");

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    
    $dbCon = new DbConnector();
    $dbCon = $dbCon->GetConnection();
    

    $rut = mysqli_real_escape_string( $dbCon, $_POST['rut'] );
    
    $text = "SELECT id FROM `votaciones` where rut = '$rut' ORDER BY id ASC";
    $result = mysqli_query($dbCon, $text);
    if(mysqli_num_rows($result) == 0){
       echo 2;
    }else{
       echo 1;
    }
}

?>


<?php


require_once("../config/database.php");

if($_SERVER["REQUEST_METHOD"] == 'POST'){

    if(!$_POST['arg']) die;

    $id = $_POST['arg'];
    $dbCon = new DbConnector();
    $dbCon = $dbCon->GetConnection();
    
    
    $text = "SELECT id, nombre FROM `comunas` where idregion = ".$id." ORDER BY id ASC";
    $query = $dbCon->query($text);
    $result = $query->fetch_all();
    echo json_encode($result);
    mysqli_close($dbCon);

}
    


<?php

require_once("../config/database.php");

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    
    $dbCon = new DbConnector();
    $dbCon = $dbCon->GetConnection();
    
    $nombre = mysqli_real_escape_string( $dbCon, $_POST['input_name'] );
    $alias = mysqli_real_escape_string( $dbCon, $_POST['input_alias'] );
    $rut = mysqli_real_escape_string( $dbCon, $_POST['input_rut'] );
    $email = mysqli_real_escape_string( $dbCon, $_POST['input_email'] );
    $idregion = mysqli_real_escape_string( $dbCon, $_POST['select_region'] );
    $idcomuna = mysqli_real_escape_string( $dbCon, $_POST['select_comuna'] );
    $idcandidato = mysqli_real_escape_string( $dbCon, $_POST['select_candidato'] );
    $comoseentero = mysqli_real_escape_string( $dbCon, json_encode( $_POST['comoseentero'] ) );

    $query = "INSERT INTO `votaciones`(`nombre`,`alias`,`rut`,`correo`,`idregion`,`idcomuna`, `idcandidato`, `como_se_entero`) 
    VALUES('$nombre', '$alias', '$rut', '$email', $idregion, $idcomuna, $idcandidato, '$comoseentero')";
    $result = $dbCon->query($query);
    mysqli_close($dbCon);
    $msj = '';
    if($result){
        $msj = 'Se ha registrado el voto correctamente.';
    }else{
        var_dump($query);
        $msj = 'Error interno';
    }
    echo $msj;
}

?>


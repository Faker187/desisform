<?php

class DbConnector
{
	function GetConnection(){
		$host = "localhost";
		$db = "formdesis";
		$user = "root"; 
		$pass = "";
		$conection = mysqli_connect($host, $user, $pass,$db);
		if(!$conection){
			echo "ERROR DE CONEXION A SERVIDOR $host"; die();
		}
		if(!mysqli_select_db($conection, $db)){
			echo "ERROR DE SELECCION DE BASE DE DATOS xxx " . $db . mysqli_error($conection); die();
		}
		return $conection;
	}
}

?>
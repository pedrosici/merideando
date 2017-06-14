<?php
require_once('conexion.php'); 

// Guardamos los datos de las variables pasadas en el AJAX

$anuncioId = $_POST['anuncioId']; // Get media Id
$userId = $_POST['userId']; // Get user Id
$value = $_POST['value']; // Get the value: 0 or 1


if($_POST) {
	
	if ($value == 0){
        $sql = "DELETE FROM favoritos WHERE anuncio_id = :anuncio_id AND usuario_id = :usuario_id";
        $query = $con->prepare($sql);
        $query->bindParam(':anuncio_id', $anuncioId, PDO::PARAM_INT); 
        $query->bindParam(':usuario_id', $userId, PDO::PARAM_INT);
        $query->execute();
    } elseif ($value == 1){
         $sql = "INSERT INTO favoritos (anuncio_id, usuario_id) VALUES (:anuncio_id, :usuario_id)";
        $query = $con->prepare($sql);
        $query->bindParam(':anuncio_id', $anuncioId, PDO::PARAM_INT); 
        $query->bindParam(':usuario_id', $userId, PDO::PARAM_INT);
        $query->execute();
    }
}



?>
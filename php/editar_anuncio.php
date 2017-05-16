<?php

// crear_anuncio.php 

include('conexion.php');

session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
} else{
    $id_usuario = $_SESSION['user_id'];
}

$id = $_POST['id'];

// Obtenemos los datos del anuncio
// Actualizamos los registros de nuestra BD

 $sql = "SELECT * FROM anuncios WHERE id_anuncio = ? ";
 $query = $con->prepare($sql);
 $query->execute(array($id));
 $resultado = $query->fetch(PDO::FETCH_ASSOC);


    $anuncio = array (
        0 => $resultado['razon_soc'],
        1 => $resultado['cif'],
        2 => $resultado['direccion'],
        3 => $resultado['telefono'],
        4 => $resultado['email'],
        5 => $resultado['descripcion'],
        6 => $resultado['web'],
        7 => $resultado['id_anuncio'],
        8 => $resultado['twitter'],
        9 => $resultado['instagram'],
        10 => $resultado['facebook'],
        11 => $resultado['imagen'],
        12 => $resultado['categoria_id'],
    );

echo json_encode($anuncio);

?>
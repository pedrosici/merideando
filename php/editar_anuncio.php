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

 $sql = "SELECT * FROM anuncios WHERE id_anuncio = '$id'";
 $query = $con->query($sql);
 $resultado = $query->fetch_array();

$anuncio = array (
    0 => $resultado['razon_soc'],
    1 => $resultado['cif'],
    2 => $resultado['direccion'],
    3 => $resultado['telefono'],
    4 => $resultado['email'],
    5 => $resultado['descripcion'],
    7 => $resultado['id_anuncio'],
 //   7 => $resultado['categoria']
    );

echo json_encode($anuncio);


?>
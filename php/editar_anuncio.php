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
    "razon_soc" => $resultado['razon_soc'],
    "cif"       => $resultado['cif'],
    "direccion" => $resultado['direccion'],
    "telefono" => $resultado['telefono'],
    "email"     => $resultado['email'],
    "descripcion" => $resultado['descripcion'],
    "imagen" => $resultado['imagen'],
    "categoria_id" => $resultado['categoria'],
    );

echo json_encode($anuncio);


?>
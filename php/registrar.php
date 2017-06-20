<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
include "conexion.php";
sleep(3);

$jsondata = array();

if(!empty($_POST)){
    //Los usuarios de tipo 1 no tienen privilegios
    //Los usuarios de tipo 2 son administradores
    $tipo_usuario = 1;
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    //Encriptamos la contraseña a SHA1
    $password = $_POST['password'];
    $sha1_pass = sha1($password);
    $enc=false;
    
    
    $query = $con->prepare('SELECT COUNT(*) usuario, email FROM usuarios WHERE email = :email OR usuario = :usuario');
    $query->execute(array('email'=>$email, 'usuario'=>$usuario));
    $num_filas = $query->fetchColumn();
   
    
    if ($num_filas > 0){
        $jsondata['success'] = false;
        echo json_encode($jsondata);
        
    } else if ($num_filas == 0){
        //Insertamos el registro del nuevo usuario
        $query = $con->prepare('INSERT INTO usuarios (nombre, usuario, email, password, fecha_creacion) VALUES (:nombre, :usuario, :email, :password, NOW())');
        $query->execute(array('nombre'=>$nombre, 'usuario'=>$usuario, 'email'=>$email, 'password'=>$sha1_pass));
        
        $jsondata['success'] = true;
        echo json_encode($jsondata);
        
    }
    
    
    
}




?>
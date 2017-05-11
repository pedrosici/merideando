<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
include "conexion.php";

if(!empty($_POST)){
    
    $sha1_pass = sha1($_POST['password']);
    
	if(isset($_POST["usuario"]) && isset($sha1_pass)){
		if($_POST["usuario"] != "" && $sha1_pass != ""){
			
			$user_id = null;
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            
			$sql= "SELECT * FROM usuarios WHERE (usuario = ? or email = ?) and password=\"$sha1_pass\" ";
            
			$query = $con->prepare($sql);
			$query->execute(array($usuario, $email));
            // Comprobamos existencia del anuncio
            
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
				$user_id = $resultado["id"];
                $nombre = $resultado["nombre"];
                $tipo_usr = $resultado["tipo_usuario"];
				break;
			}
			if($user_id == null){
				print "<script>alert(\"Acceso invalido.\");window.location='../login.php';</script>";
			}else{
				session_start();
				$_SESSION["user_id"] = $user_id;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["tipo"] = $tipo_usr;
				print "<script>window.location='../panel_usuario.php';</script>";				
			}
		}
	}
}



?>
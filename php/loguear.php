<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
include "conexion.php";

sleep(2);

if(!empty($_POST)){
    
    $sha1_pass = sha1($_POST['password']);
    $user_id = null;
    
	if(isset($_POST["usuario"]) && isset($sha1_pass)){
		if($_POST["usuario"] != "" && $sha1_pass != ""){
			
            $usuario = $_POST['usuario'];
			$sql= "SELECT * FROM usuarios WHERE usuario = ?  and password = ? ";
			$query = $con->prepare($sql);
			$query->execute(array($usuario, $sha1_pass));
            if ($resultado = $query->rowCount() == 1):
                session_start();
                $resultado = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user_id"] = $resultado["id"];
                $_SESSION["nombre"] = $resultado["nombre"];
                echo json_encode(array('error' => false));
			     
            else:
                echo json_encode(array('error' => true));
            endif;
        }
        
	}
}



?>
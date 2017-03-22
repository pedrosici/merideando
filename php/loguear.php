<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

if(!empty($_POST)){
    
    $sha1_pass = sha1($_POST['password']);
    
	if(isset($_POST["usuario"]) &&isset($sha1_pass)){
		if($_POST["usuario"]!=""&&$sha1_pass!=""){
			include "conexion.php";
			
			$user_id=null;
			$sql1= "select * from usuarios where (usuario=\"$_POST[usuario]\" or email=\"$_POST[email]\") and password=\"$sha1_pass\" ";
			$query = $con->query($sql1);
			while ($r=$query->fetch_array()) {
				$user_id = $r["id"];
                $nombre = $r["nombre"];
                $tipo_usr = $r["tipo_usuario"];
				break;
			}
			if($user_id==null){
				print "<script>alert(\"Acceso invalido.\");window.location='../login.php';</script>";
			}else{
				session_start();
				$_SESSION["user_id"]=$user_id;
                $_SESSION["nombre"]=$nombre;
                $_SESSION["tipo"]=$tipo_usr;
				print "<script>window.location='../panel_usuario.php';</script>";				
			}
		}
	}
}



?>
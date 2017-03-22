<?php

 //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);

if(!empty($_POST)){
	if(isset($_POST["usuario"]) &&isset($_POST["nombre"]) &&isset($_POST["email"]) &&isset($_POST["password"]) &&isset($_POST["confirm_password"])){
		if($_POST["usuario"]!=""&& $_POST["nombre"]!=""&&$_POST["email"]!=""&&$_POST["password"]!=""&&$_POST["password"]==$_POST["confirm_password"]){
			include "conexion.php";
            //Los usuarios de tipo 1 no tienen privilegios
            //Los usuarios de tipo 2 son administradores
			$tipo_usuario = 1;
            //Encriptamos la contraseña a SHA1
            $password = $_POST['password'];
            $sha1_pass = sha1($password);
			$enc=false;
			$sql1= "SELECT * FROM usuarios WHERE usuario=\"$_POST[usuario]\" or email=\"$_POST[email]\"";
			$query = $con->query($sql1);
			while ($r=$query->fetch_array()) {
				$enc=true;
				break;
			}
			if($enc){
				print "<script>alert(\"Nombre de usuario o email ya estan registrados.\");window.location='../registro.php';</script>";
			}
			$sql = "INSERT into usuarios(usuario,nombre,email,password,tipo_usuario,fecha_creacion) VALUE (\"$_POST[usuario]\",\"$_POST[nombre]\",\"$_POST[email]\",\"$sha1_pass\",\"$tipo_usuario\",NOW())";
			$query = $con->query($sql);
			if($query!=null){
				print "<script>alert(\"Registro exitoso. Proceda a logearse\");window.location='../login.php';</script>";
			}
		}
	}
}



?>
<?php
// ARCHIVO DE CONEXION A LA BASE DE DATOS

try {
    $con = new PDO('mysql:host=localhost;dbname=merideando','root','');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("SET CHARACTER SET utf8");
    
} catch(PDOException $e){
    die('Error conectando a la BD: ' . $e->getMessage());
}

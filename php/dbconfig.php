<?php
 
 $DBhost = "localhost";
 $DBuser = "root";
 $DBpass = "";
 $DBname = "merideando";
 
 try {
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
 } catch(PDOException $e){
  die('Error: ' . $e->getMessage());
 }
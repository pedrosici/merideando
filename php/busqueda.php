<?php

 require_once 'conexion.php';

 // Eliminamos espacios en blanco u otros caracteres del inicio y final de la cadena de la búsqueda del usuario
 $busqueda = trim($_REQUEST['term']);

 $sugg_json = array();    // Mostramos datos de un JSON como una sugerencia de búsqueda
 $json_row = array();     // Mostramos los resultados de MYSQL como un string de JSON
 

 $busqueda = preg_replace('/\s+/', ' ', $busqueda); // Reemplaza los espacios del input

// Consultamos los datos necesarios del anuncio en la BD
 $query = 'SELECT * FROM anuncios WHERE razon_soc LIKE :term'; 
 
 $stmt = $con->prepare($query);
 $stmt->execute(array(':term'=>"%$busqueda%"));
 
 if ( $stmt->rowCount()>0 ) {
  
  while($recResult = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $json_row["id"] = $recResult['id_anuncio'];
      $json_row["value"] = $recResult['razon_soc'];
      $json_row["telefono"] = $recResult['telefono'];
      array_push($sugg_json, $json_row);
  }
  
 } else {
     $json_row["id"] = "#";
     $json_row["value"] = "";
     $json_row["label"] = "Nothing Found!";
     array_push($sugg_json, $json_row);
 }
 
 $jsonOutput = json_encode($sugg_json, JSON_UNESCAPED_SLASHES); 
 print $jsonOutput;
?>
<?php

/**
* Buscador con autocompletado
*
* El buscador muestra resultados comúnes a lo que el usuario vaya 
* escribiendo en el campo input del formulario de la página index.php
* 
*/

// Archivo de conexión con la BD
 require_once 'conexion.php';

 // Eliminamos espacios en blanco u otros caracteres del inicio y final de la cadena de la búsqueda del usuario
 $busqueda = trim($_REQUEST['term']);

 $sugg_json = array();    // Mostramos datos de un JSON como una sugerencia de búsqueda
 $json_row = array();     // Mostramos los resultados de MYSQL como un string de JSON
 
 $busqueda = preg_replace('/\s+/', ' ', $busqueda); // Reemplaza los espacios del input

// Realizamos la consulta sacando todos los datos de los anuncios relacionados
 $query = 'SELECT * FROM anuncios WHERE razon_soc LIKE :term'; 
 
 $stmt = $con->prepare($query);
 $stmt->execute(array(':term'=>"%$busqueda%"));
 
 if ( $stmt->rowCount()>0 ) {
  
  while($recResult = $stmt->fetch(PDO::FETCH_ASSOC)) {
      //Guardamos en un array los datos que consideremos necesarios para mostrar en el desplegable
      $json_row["id"] = $recResult['id_anuncio'];
      $json_row["value"] = $recResult['razon_soc'];
      $json_row["telefono"] = $recResult['telefono'];
      array_push($sugg_json, $json_row);
  }
  // En caso contrario, mostramos mensaje de error
 } else {
     $json_row["id"] = "#";
     $json_row["value"] = "";
     $json_row["label"] = "¡No se encontraron anuncios relacionados!";
     array_push($sugg_json, $json_row);
 }
 //Devolvemos al index.php los resultados obtenidos
 $jsonOutput = json_encode($sugg_json, JSON_UNESCAPED_SLASHES); 
 print $jsonOutput;
?>
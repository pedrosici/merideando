<?php
require("conexion.php");

function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    
return $xmlStr;
}

// Select all the rows in the markers table
$sql = "SELECT a.id_anuncio, a.razon_soc, a.direccion, a.latitud, a.longitud,
        CASE c.id_categoria
        WHEN 2 THEN 'motor'
        WHEN 3 THEN 'profyemp'
        WHEN 4 THEN 'depyocio' 
        WHEN 5 THEN 'formacion'
        WHEN 7 THEN 'comybeb'
        WHEN 8 THEN 'salybel' 
        WHEN 9 THEN 'comercio'
        WHEN 10 THEN 'eventos'
        WHEN 11 THEN 'turismo'
        END as nombre_cat
        FROM anuncios a, categorias c
        WHERE a.categoria_id = c.id_categoria";
$query = $con->prepare($sql);
$query->execute();


if (!$query) {
  die('Invalid query');
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, adding XML nodes for each
while ($row = $query->fetch(PDO::FETCH_ASSOC)){
  echo '<marker ';
  echo 'name="' . parseToXML($row['razon_soc']) . '" ';
  echo 'address="' . parseToXML($row['direccion']) . '" ';
  echo 'lat="' . $row['latitud'] . '" ';
  echo 'lng="' . $row['longitud'] . '" ';
  echo 'type="' . $row['nombre_cat'] . '" ';
  echo 'enlace="anuncio.php?id='. $row['id_anuncio'].'"';
  echo '/>';
}

// End XML file
echo '</markers>';
?>
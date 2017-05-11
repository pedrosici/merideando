<?php
// crear_anuncio.php 

include('conexion.php');

session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}

//Recibimos datos de la imagen

if (isset($_FILES['logo']['type'])){
    //Comprobamos si la extension de la imagen es válida
    $valido = array("jpeg", "jpg", "png");
    $cadena = explode(".", $_FILES['logo']['name']);
    $extension = end($cadena);
    
    if (($_FILES['logo']['type'] == "image/png") || ($_FILES['logo']['type'] == "image/jpg") || ($_FILES['logo']['type'] == "image/jpg") && ($_FILES['logo']['size'] < 100000) && in_array($extension, $valido)){
        
        $ruta = $_FILES['logo']['tmp_name'];
    //  Ruta de la carpeta donde se guarda la imagen
        $target = $_SERVER['DOCUMENT_ROOT'].'/merideando/images/'.$_FILES['logo']['name'];
    //  Movemos imagen de la carpeta temporal a la carpeta especificada en destino
        move_uploaded_file($ruta, $target);
    }
}

// Variables genéricas recogidas del formulario

$nombre = $_SESSION['nombre'];
$id_usuario = $_SESSION['user_id'];
$razon = $_POST['razon'];
$telefono = $_POST['telefono'];
$cif = $_POST['cif'];
$email = $_POST['email'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['categoria'];
$imagen = $_FILES['logo']['name'];
$web = $_POST['web'];
$twitter = $_POST['twitter'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];



if (isset($_POST['direccion'])){
    $direccion = $_POST['direccion'];
    $maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=06800". urlencode($direccion) ."&key=AIzaSyCeJfZoJVH1ATfo04SXDIl7j765fGCvhRA";
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    $lat = $maps_array["results"][0]["geometry"]["location"]["lat"];
    $lng = $maps_array["results"][0]["geometry"]["location"]["lng"];
}

//Verificamos el modo en el que estamos, si es creación o edición de un anuncio

$sql = "INSERT into ANUNCIOS (razon_soc, cif, direccion, latitud, longitud, telefono, email, descripcion, web, twitter, instagram, facebook, imagen, fecha, usuario_id, categoria_id) VALUE (':razon', ':cif', ':direccion', ':lat', ':lng', ':telefono', ':email', ':descripcion',':web',':twitter',':instagram',':facebook',':imagen', NOW(), ':id_usuario', ':id_categoria')";
$query = $con->prepare($sql);
$query->execute(array(":razon"=>$razon,":cif"=>$cif,":direccion"=>$direccion,":latitud"=>$lat,":longitud"=>$lng,":telefono"=>$telefono,":email"=>$email,":descripcion"=>$descripcion,":web"=>$web,":twitter"=>$twitter,":instagram"=>$instagram,":facebook"=>$facebook,":imagen"=>$imagen,"usuario_id"=>$id_usuario,"categoria_id"=>$id_categoria));
       
        
    
//$sql = "UPDATE ANUNCIOS set razon_soc = '$razon', cif = '$cif', direccion = '$direccion', telefono = '$telefono', email = '$email', descripcion = '$descripcion', imagen = '$imagen', fecha = NOW(), categoria_id = '$id_categoria' WHERE id_anuncio = '$id'";
//$query = $con->query($sql);


//Actualizamos los registros de nuestra BD

 $sql1 = "SELECT a.id_anuncio, a.razon_soc, a.email, a.imagen, a.likes, c.nombre_cat FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.usuario_id = '$id_usuario'";
 $query = $con->query($sql1);

//Creamos la vista y la devolvemos al AJAX

if ($query->rowCount() > 0 ){
    while ($resultado = $query->fetch_array()){
                                
                                    echo '<table class="table table-striped table-condensed table-hover">
                                    <tr>
                                        <th width="150">Razón social</th>
                                        <th width="50">Logo</th>
                                        <th width="50">Categoría</th>
                                        <th width="50">Votos</th>
                                        <th width="50">Enlace</th>
                                        <th width="50">Acción</th>
                                    </tr>
                                    <tr>
                                        <td>'.$resultado['razon_soc'].'</td>
                                        <td><img src="images/'.$resultado['imagen'].'" height="50"/></td>
                                        <td>'.$resultado['nombre_cat'].'</td>
                                        <td>'.$resultado['likes'].'</td>
                                        <td><a href="anuncio.php?id='.$resultado['id_anuncio'].'" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a>
                                        <td><a href="#editar-anuncio" class="fa fa-pencil fa-2x" data-toggle="modal" onClick="editarAnuncio('.$resultado['id_anuncio'].');" title="Editar Anuncio"></a> <a href="#" onClick="eliminarAnuncio('.$resultado['id_anuncio'].');" class="fa fa-trash fa-2x" title="Eliminar anuncio"></a></td>
                                     </tr>
                                     </table>';    
                               }  
} else {  
    echo '<div class="slider_text text-center"><h3>No tienes ningún anuncio creado todavía</h3></div>';
}

?>
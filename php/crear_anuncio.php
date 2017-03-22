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



$nombre = $_SESSION['nombre'];
$id_usuario = $_SESSION['user_id'];

$razon = $_POST['razon'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$cif = $_POST['cif'];
$email = $_POST['email'];
$descripcion = $_POST['descripcion'];
$id_categoria = $_POST['categoria'];
$imagen = $_FILES['logo']['name'];





$sql = "INSERT into ANUNCIOS (razon_soc, cif, direccion, telefono, email, descripcion, imagen, fecha, usuario_id, categoria_id) VALUE ('$razon', '$cif', '$direccion', '$telefono', '$email', '$descripcion','$imagen', NOW(), '$id_usuario', '$id_categoria')";
        
$query = $con->query($sql);



//Actualizamos los registros de nuestra BD

 $sql1 = "SELECT * FROM anuncios WHERE usuario_id = '$id_usuario'";
 $query = $con->query($sql1);

//Creamos la vista y la devolvemos al AJAX

if ($query->num_rows > 0 ){
    while ($resultado = $query->fetch_array()){
                                
                                    echo '<table class="table table-striped table-condensed table-hover">
                                    <tr>
                                        <th width="150">Razón social</th>
                                        <th width="50">Logo</th>
                                        <th width="50">Categoría</th>
                                        <th width="50">Descripción</th>
                                        <th width="50">Contacto</th>
                                        <th width="50">Enlace</th>
                                        <th width="50">Acción</th>
                                    </tr>
                                    <tr>
                                        <td>'.$resultado['razon_soc'].'</td>
                                        <td><img src="images/'.$resultado['imagen'].'" height="50"/></td>
                                        <td></td>
                                        <td><a data-container="body" data-toggle="popover" data-placement="bottom" data-content="'.$resultado['descripcion'].'"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                                        </td>
                                        
                                        <td><a data-container="body" data-toggle="popover" data-placement="bottom" data-content="<ul><li>Dirección: '.$resultado['direccion'].'</li>
                                                     <li>Telefono: '.$resultado['telefono'].'</li>
                                                     <li>Email: '.$resultado['email'].'</li>
                                                 </ul>"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
                                        </td>
                                        <td><a href="anuncio.php?id='.$resultado['id_anuncio'].'" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a>
                                        
                                        
                                        <td><a href="#editar-anuncio" class="fa fa-pencil fa-2x" data-toggle="modal" onClick="editarAnuncio('.$resultado['id_anuncio'].');"></a> <a href="#" onClick="eliminarAnuncio('.$resultado['id_anuncio'].');" class="fa fa-trash fa-2x"></a></td>
                                     </tr>
                                     </table>';    
                               }  
} else {  
    echo '<div class="slider_text text-center"><h3>No tienes ningún anuncio creado todavía</h3></div>';
}

?>
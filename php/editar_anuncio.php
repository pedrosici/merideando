<?php
error_reporting(E_ALL ^ E_NOTICE);

// crear_anuncio.php 

include('conexion.php');

session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
} else{
    $id_usuario = $_SESSION['user_id'];
}


if (isset($_POST['id'])){
    $id = (int)$_POST['id'];
    // Obtenemos los datos del anuncio
    // Actualizamos los registros de nuestra BD
     $sql = "SELECT * FROM anuncios WHERE id_anuncio = ? ";
     $query = $con->prepare($sql);
     $query->execute(array($id));
    
    if ($query->rowCount() > 0 ){
         $resultado = $query->fetch(PDO::FETCH_ASSOC);
        //Array con los datos a recargar en el editor de anuncios
        $anuncio = array (
            0 => $resultado['razon_soc'],
            1 => $resultado['cif'],
            2 => $resultado['direccion'],
            3 => $resultado['telefono'],
            4 => $resultado['email'],
            5 => $resultado['descripcion'],
            6 => $resultado['web'],
            7 => $resultado['id_anuncio'],
            8 => $resultado['twitter'],
            9 => $resultado['instagram'],
            10 => $resultado['facebook'],
            11 => $resultado['imagen'],
            12 => $resultado['categoria_id'],
            13 => $resultado['subcategoria_id'],
        );
        $response_array['status'] = 'success';    
        echo json_encode($anuncio);
    } else {
        $response_array['status'] = 'error';    
    }
}

if (isset($_POST['razon'])){
   
    $id_anuncio = $_POST['anuncio'];
    if (isset($_FILES['logonuevo']['type'])){
    //Comprobamos si la extension de la imagen es válida
    $valido = array("jpeg", "jpg", "png");
    $cadena = explode(".", $_FILES['logonuevo']['name']);
    $extension = end($cadena);
    
    if (($_FILES['logonuevo']['type'] == "image/png") || ($_FILES['logonuevo']['type'] == "image/jpg") || ($_FILES['logonuevo']['type'] == "image/jpeg") && ($_FILES['logonuevo']['size'] < 100000) && in_array($extension, $valido)){
        
        $ruta = $_FILES['logonuevo']['tmp_name'];
        
    //  Ruta de la carpeta donde se guarda la imagen
        $target = $_SERVER['DOCUMENT_ROOT'].'/merideando/images/'.$_FILES['logonuevo']['name'];
    //  Movemos imagen de la carpeta temporal a la carpeta especificada en destino
       
        move_uploaded_file($ruta, $target);
    }
    }
    
    $razon = $_POST['razon'];
    $telefono = $_POST['telefono'];
    $cif = $_POST['cif'];
    $email = $_POST['email'];
    $descripcion = $_POST['descripcion'];
    $id_categoria = $_POST['categoria'];
    $imagen = $_FILES['logonuevo']['name'];
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
    
     $sql = "UPDATE anuncios SET razon_soc = :razon_soc , cif = :cif, direccion = :direccion, latitud = :latitud, longitud = :longitud, telefono = :telefono, email = :email, descripcion = :descripcion, categoria_id = :categoria_id, web = :web, instagram = :instagram ,twitter = :twitter, facebook = :facebook, imagen = :imagen WHERE id_anuncio = :id_anuncio";
    $query = $con->prepare($sql);
    $query->execute(array(":razon_soc"=>$razon, ":cif"=>$cif, ":direccion"=>$direccion, ":latitud"=>$lat, ":longitud"=>$lng, ":telefono"=>$telefono, ":email"=>$email, ":descripcion"=>$descripcion,":categoria_id"=>$id_categoria, ":web"=>$web, ":twitter"=>$twitter, ":instagram"=>$instagram, ":facebook"=>$facebook, ":imagen"=>$imagen, ":id_anuncio"=>$id_anuncio));
    
   header('Content-type: application/json');
    if ($query != null){
            $mensaje = "<div class='alert alert-success alert-dismissible mg-bt-40 text-center'><i class='fa fa-check'></i> ¡Enhorabuena! El anuncio ha sido editado correctamente</div>";
            echo json_encode($mensaje);

        }
        else{
            $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> Ocurrió un error en la edición del anuncio. Por favor, inténtelo de nuevo.</div>";
            echo json_encode($mensaje);

        }

}




?>
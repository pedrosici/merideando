<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

// crear_anuncio.php 
header('Content-type: application/json');
include('conexion.php');

session_start();

$nombre = $_SESSION['nombre'];
$id_usuario = $_SESSION['user_id'];



if (isset($_POST)){
    
    //Recibimos datos de la imagen

    if (isset($_FILES['logo']['type'])){
        //Comprobamos si la extension de la imagen es válida
        $valido = array("jpeg", "jpg", "png");
        $cadena = explode(".", $_FILES['logo']['name']);
        $extension = end($cadena);

        if (($_FILES['logo']['type'] == "image/png") || ($_FILES['logo']['type'] == "image/jpg") || ($_FILES['logo']['type'] == "image/jpeg") && ($_FILES['logo']['size'] < 100000) && in_array($extension, $valido)){ 

            $ruta = $_FILES['logo']['tmp_name'];
        //  Ruta de la carpeta donde se guarda la imagen
            $target = $_SERVER['DOCUMENT_ROOT'].'/merideando/images/anuncios/'.$_FILES['logo']['name'];
        //  Movemos imagen de la carpeta temporal a la carpeta especificada en destino
            move_uploaded_file($ruta, $target);
            $imagen = $_FILES['logo']['name'];
            
        }
    } else {
        $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> Ocurrió un error al subir la imagen. Por favor, revise el formato y tamaño de la misma.</div>";
        echo json_encode($mensaje);
        
    }

    // Variables genéricas recogidas del formulario

    if (isset($_POST['razon']) && isset($_POST['telefono']) && isset($_POST['cif']) && isset($_POST['email']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['subcategoria'])){
        $razon = $_POST['razon'];
        $telefono = $_POST['telefono'];
        $cif = $_POST['cif'];
        $email = $_POST['email'];
        $descripcion = $_POST['descripcion'];
        $id_categoria = $_POST['categoria'];
        $id_subcat = $_POST['subcategoria'];

        $web = $_POST['web'];
        $twitter = $_POST['twitter'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $fecha = date("Y-m-d");
    } else {
        
        $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> Ocurrió un error al crear el anuncio. Posiblemente tenga campos sin rellenar. Revíselo e inténtelo de nuevo.</div>";
        echo json_encode($mensaje);
       
    }
    


    if (isset($_POST['direccion'])){
        $direccion = $_POST['direccion'];
        $maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=06800". urlencode($direccion) ."&key=AIzaSyCeJfZoJVH1ATfo04SXDIl7j765fGCvhRA";
        $maps_json = file_get_contents($maps_url);
        $maps_array = json_decode($maps_json, true);
        $lat = $maps_array["results"][0]["geometry"]["location"]["lat"];
        $lng = $maps_array["results"][0]["geometry"]["location"]["lng"];
        if ($lat == 0 && $lng == 0){
            $lat = 0.000000;
            $lng = 0.000000;
            $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> La dirección postal indicada no parece correcta. Recuerde que el formato debe ser: John Lennon, 36.</div>";
            echo json_encode($mensaje);
        }
    } 

    //Consultamos los datos recibidos para no insertar dos anuncios iguales
    $sql = "SELECT COUNT(*) razon_soc FROM anuncios WHERE razon_soc = ?";
    $query = $con->prepare($sql);
    $query->execute(array($razon));
    $num_filas = $query->fetchColumn();
    //Mostramos mensaje de error si ya existe el anuncio
    if ($num_filas > 0){
        $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> El anuncio que intenta crear ya existe. No puede haber dos anuncios iguales.</div>";
        echo json_encode($mensaje);
    }
    else {
        //Insertamos si no encontramos otro anuncio con el mismo nombre.
        $sql = "INSERT into ANUNCIOS (razon_soc, cif, direccion, latitud, longitud, telefono, email, descripcion, web, twitter, instagram, facebook, imagen, fecha, usuario_id, categoria_id, subcategoria_id) VALUE (:razon, :cif, :direccion, :lat, :lng, :telefono, :email, :descripcion ,:web, :twitter, :instagram ,:facebook, :imagen , :fecha, :usuario_id, :categoria_id, :subcategoria_id)";
        $query = $con->prepare($sql);
        $query->execute(array(":razon"=>$razon,":cif"=>$cif,":direccion"=>$direccion,":lat"=>$lat,":lng"=>$lng,":telefono"=>$telefono,":email"=>$email,":descripcion"=>$descripcion,":web"=>$web,":twitter"=>$twitter,":instagram"=>$instagram,":facebook"=>$facebook,":imagen"=>$imagen,":fecha"=>$fecha,"usuario_id"=>$id_usuario,"categoria_id"=>$id_categoria, "subcategoria_id"=>$id_subcat));

        if ($query != null){
            $mensaje = "<div class='alert alert-success alert-dismissible mg-bt-40 text-center'><i class='fa fa-check'></i> ¡Enhorabuena! El anuncio ha sido creado correctamente</div>";
            echo json_encode($mensaje);

        }
        else{
            $mensaje = "<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> Ocurrió un error en la inserción del anuncio. Por favor, inténtelo de nuevo.</div>";
            echo json_encode($mensaje);

        }
    }

}



?>
<?php

require_once('conexion.php');

    if ($_POST) :
        $autor_id = $_POST['autor_id'];
        $post_id = $_POST['post_id'];
        $comentario = $_POST['comentario'];
        $id_anuncio = $_POST['id_anuncio'];
        $fecha = date_default_timezone_get();
        $comentario = trim($comentario);
        $comentario = htmlentities($comentario);

        //Asumiendo que ya tenemos una conexion a nuestra base de datos.
        $sql = "INSERT INTO comentarios (nick, comentario, fecha_comentario, id_anuncio) VALUES (:autor_id, :comentario, :fecha, :id_anuncio)";

        $query = $con->prepare($sql);
        $query->execute(array(":autor_id"=>$autor_id,":comentario"=>$comentario, ":fecha"=>$fecha, "id_anuncio"=>$id_anuncio));
        
        if ($query) {
            
            echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$autor_id.'</strong>  <span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$fecha.'</span>
                    </div>
                    <div class="panel-body">'.$comentario.'</div>
                 </div>';  
            exit();
        }

    endif;

?>
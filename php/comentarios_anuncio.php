<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once('conexion.php');

    if ($_POST) :
        $autor_id = $_POST['autor_id'];
        $comentario = $_POST['comentario'];
        $id_anuncio = $_POST['id_anuncio'];
        //$fecha = date("d/m/Y");
        $comentario = trim($comentario);
        $comentario = htmlentities($comentario);

        $sql = "INSERT INTO comentarios (comentario, nick, fecha_comentario, anuncio_id) VALUES (:comentario, :autor_id, NOW() , :id_anuncio)";
        $query = $con->prepare($sql);

        $query->execute(array(":comentario"=>$comentario,":autor_id"=>$autor_id, ":id_anuncio"=>$id_anuncio));
        
        if ($query) {
            
            echo '<div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$autor_id.'</strong>  <span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$fecha.'</span>
                        </div>
                        <div class="panel-body">'.$comentario.'</div>
                     </div>
                    </div>';  
            exit();
        }

    endif;
?>
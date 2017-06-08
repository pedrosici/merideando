<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once('conexion.php');

    if ($_POST) :
        $autor_id = $_POST['autor_id'];
        $comentario = $_POST['comentario'];
        $id_anuncio = $_POST['id_anuncio'];
        $titulo = $_POST['titulo'];
        $titulo = trim($titulo);
        $titulo = htmlentities($titulo);
        $valoracion = $_POST['valoracion'];
        $fecha = 'NOW()';
        $comentario = trim($comentario);
        $comentario = htmlentities($comentario);

        $sql = "INSERT INTO comentarios (comentario, usuario_id, titulo, fecha_comentario, anuncio_id, valoracion) VALUES (:comentario, :usuario_id, :titulo, NOW(), :anuncio_id, :valoracion)";
        $query = $con->prepare($sql);

        $query->execute(array(":comentario"=>$comentario,":usuario_id"=>$autor_id, ":titulo"=>$titulo, ":anuncio_id"=>$id_anuncio, ":valoracion"=>$valoracion));
        
        if ($query) {
            
            $sql = "SELECT u.nombre, c.* FROM comentarios c INNER JOIN usuarios u ON c.usuario_id = u.id WHERE c.anuncio_id = ? ORDER BY id_comentario DESC LIMIT 1";
            $consulta = $con->prepare($sql);
            $consulta->execute(array($id_anuncio));
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            
            date_default_timezone_set('UTC');
            echo '<div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$resultado['nombre'].'</strong>  <span style="float:right"; class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$resultado['fecha_comentario'].'</span>
                                </div>
                                <div class="panel-body">
                                    <h3 class="panel-title">'.$resultado['titulo'].'</h3>
                                    <p>'.$resultado['comentario'].'</p>
                                     <p style="float:right";><i class="fa fa-star" aria-hidden="true"></i> '.$resultado['valoracion'].'/5</p>
                                </div>
                            </div>
                          </div>';  
            exit();
        }

    endif;
?>
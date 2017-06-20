<?php
//Evitamos que aparezcan errores no importantes
error_reporting(E_ALL ^ E_NOTICE);
//Incluimos archivo de conexión a la BD
require_once('conexion.php');

//Si se ejecuta el método POST:
    if ($_POST) :
//Guardamos los datos del autor del comentario y del anuncio que comenta
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

        //Realizamos la inserción del comentario
        $sql = "INSERT INTO comentarios (comentario, usuario_id, titulo, fecha_comentario, anuncio_id, valoracion) VALUES (:comentario, :usuario_id, :titulo, NOW(), :anuncio_id, :valoracion)";
        $query = $con->prepare($sql);

        $query->execute(array(":comentario"=>$comentario,":usuario_id"=>$autor_id, ":titulo"=>$titulo, ":anuncio_id"=>$id_anuncio, ":valoracion"=>$valoracion));
        
        if ($query) {
            //Mostramos el comentario sin recargar la página
            
            $sql = "SELECT u.nombre, c.* FROM comentarios c INNER JOIN usuarios u ON c.usuario_id = u.id WHERE c.anuncio_id = ? ORDER BY id_comentario DESC LIMIT 1";
            $consulta = $con->prepare($sql);
            $consulta->execute(array($id_anuncio));
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            
            date_default_timezone_set('UTC');
            echo '<div class="col-md-6 in fade">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$resultado['nombre'].'</strong>  <span style="float:right"; class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$resultado['fecha_comentario'].'</span>
                                </div>
                                <div class="panel-body">
                                    <h3 class="panel-title">'.$resultado['titulo'].'</h3>
                                    <p>'.$resultado['comentario'].'</p>

                                    <div class="valoracion-'.$resultado['id_anuncio'].'"></div>
                                </div>
                            </div>
                          </div>';
            ?>
            
        <?php
            
        }
        
        //Realizamos el cálculo para actualizar la valoración media del anuncio al incorporar una nueva valoración
        $sql = "SELECT COUNT(id_comentario) as num_comentarios, SUM(valoracion) as suma FROM comentarios WHERE anuncio_id = ?";
        $query = $con->prepare($sql);
        $query->execute(array($id_anuncio));
        $num_coment = $query->fetch(PDO::FETCH_ASSOC);
       
        //Dividimos la suma de las valoraciones entre el numero de comentarios
        $valor = $num_coment['suma'] / $num_coment['num_comentarios'];
        //Actualizamos el anuncio
        $sql = "UPDATE anuncios SET valor_medio = :valor_medio WHERE id_anuncio = :id_anuncio";
        $query = $con->prepare($sql);
        $query->execute(array(":valor_medio"=>$valor, ":id_anuncio"=>$id_anuncio));
        
        

    endif;
?>
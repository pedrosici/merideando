<?php
 include('conexion.php');
 session_start();
    $id = $_SESSION['user_id'];
   
    $sql = "SELECT com.*, a.razon_soc, a.id_anuncio, a.valor_medio, u.nombre
            FROM comentarios com INNER JOIN usuarios u ON com.usuario_id = u.id INNER JOIN anuncios a ON com.anuncio_id = a.id_anuncio";
    $query = $con->prepare($sql);
    $query->execute();
    $tabla = "";
   
    // Comprobamos existencia del anuncio
    if ($query->rowCount() > 0){
        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
            
          $enlace = '<a href=\"anuncio.php?id='.$resultado['id_anuncio'].'\" target=\"_blank\" title=\"Ver Anuncio\"><i class=\"fa fa-link fa-2x\" aria-hidden=\"true\"></i></a>';
            
		  $eliminar = '<a href=\"#eliminar-comentario\" onclick=\"setIdComentario('.$resultado['id_comentario'].')\" data-toggle=\"modal\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Borrar</a>';
                
                $tabla.='{
                        "razon_soc":"'.$resultado['razon_soc'].'",
                        "titulo":"'.$resultado['titulo'].'",
                        "autor":"'.$resultado['nombre'].'",           
                        "valoracion":"'.$resultado['valor_medio'].'/5",
                        "enlace":"'.$enlace.'",
                        "acciones":"'. $eliminar.'"
                                                
                },';		
                                           
            }   

            //eliminamos la coma que sobra
            $tabla = substr($tabla,0, strlen($tabla) - 1);
            echo '{"data":['.$tabla.']}';	
        ?>
    <?php

        } else {  
            //eliminamos la coma que sobra
            $tabla = substr($tabla,0, strlen($tabla) - 1);
            echo '{"data":['.$tabla.']}';	
        }                                
    ?>
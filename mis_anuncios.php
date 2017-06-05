
<?php
 include('php/conexion.php');
 session_start();
    $id = $_SESSION['user_id'];
   
    $sql = "SELECT a.id_anuncio, a.razon_soc, a.cif, a.direccion, a.telefono, a.email, a.descripcion, a.imagen, a.likes, a.hates, c.nombre_cat FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.usuario_id = ?";
    $query = $con->prepare($sql);
    $query->execute(array($id));
    $tabla = "";
   
    // Comprobamos existencia del anuncio
    if ($query->rowCount() > 0){
        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
            
          $enlace = '<a href=\"anuncio.php?id='.$resultado['id_anuncio'].'\" target=\"_blank\" title=\"Ver Anuncio\"><i class=\"fa fa-link fa-2x\" aria-hidden=\"true\"></i></a>';
            
          $editar = '<a href=\"#editar-anuncio\" title=\"Editar\" data-toggle=\"modal\"  class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Editar</a>';
            
		  $eliminar = '<a href=\"#eliminar-anuncio\" onclick=\"setIdAnuncio('.$resultado['id_anuncio'].')\" data-toggle=\"modal\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Borrar</a>';
                
                $tabla.='{
                        "razon":"'.$resultado['razon_soc'].'",
                        "imagenUrl":"'.$resultado['imagen'].'",
                        "categoria":"'.$resultado['nombre_cat'].'",           
                        "valoracion":"'.$resultado['likes'].'",
                        "enlace":"'.$enlace.'",
                        "acciones":"'.$editar.$eliminar.'"
                                                
                },';		
                                             /* echo '<tr>
                                                    <td>'.$resultado['razon_soc'].'</td>
                                                    <td><img src="images/'.$resultado['imagen'].'" height="50"/></td>
                                                    <td>'.$resultado['nombre_cat'].'</td>
                                                    <td>'.$resultado['likes'].'</td>
                                                    <td><a href="anuncio.php?id='.$resultado['id_anuncio'].'" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a>
                                                    <a href="#editar-anuncio" class="fa fa-pencil fa-2x" data-toggle="modal" onClick="editarAnuncio('.$resultado['id_anuncio'].');" title="Editar Anuncio"></a>
                                                    <td> <a  href="#eliminar-anuncio" data-toggle="modal" onClick="setIdAnuncio('.$resultado['id_anuncio'].')" class="fa fa-trash fa-2x" title="Eliminar anuncio"></a></td>
                                                 </tr>'; */
            }   

            //eliminamos la coma que sobra
            $tabla = substr($tabla,0, strlen($tabla) - 1);
            echo '{"data":['.$tabla.']}';	
        ?>
    <?php

        } else {  
            echo '<div class="slider_text text-center"><h3>No tienes ningún anuncio creado todavía</h3></div>';
        }                                
    ?>
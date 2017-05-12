<?php
 include ('conexion.php');

 session_start();

 if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
    print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
 } else{
    $id_usuario = $_SESSION['user_id'];
 }

    $id = $_POST['id'];
    
    // Eliminamos el anuncio

     $sql = "DELETE FROM anuncios WHERE id_anuncio = ?";
     $query = $con->prepare($sql);
     $query->execute(array($id));

    // Actualizamos los registros y los recuperamos

     $sql = "SELECT a.id_anuncio, a.razon_soc, a.email, a.imagen, a.likes, c.nombre_cat FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.usuario_id = ? ";
     $query = $con->prepare($sql);
     $query->execute(array($id_usuario));

    if ($query->rowCount() > 0 ){
        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
            echo '<table class="table table-striped table-condensed table-hover table-bordered text-center">
                   <tr>
                     <th width="150">Razón social</th>
                     <th width="50">Logo</th>
                     <th width="50">Categoría</th>
                     <th width="25">Votos</th>
                     <th width="50">Enlace</th>
                     <th width="50">Acción</th>
                    </tr>
                    <tr>
                      <td>'.$resultado['razon_soc'].'</td>
                      <td><img src="images/'.$resultado['imagen'].'" height="50"/></td>
                      <td>'.$resultado['nombre_cat'].'</td>
                      <td>'.$resultado['likes'].'</td>
                      <td><a href="anuncio.php?id='.$resultado['id_anuncio'].'" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a>
                      <td><a href="#editar-anuncio" class="fa fa-pencil fa-2x" data-toggle="modal" onClick="editarAnuncio('.$resultado['id_anuncio'].');" title="Editar Anuncio"></a> <a href="#eliminar-anuncio" data-toggle="modal" onClick="setIdAnuncio('.$resultado['id_anuncio'].')" class="fa fa-trash fa-2x" title="Eliminar anuncio"></a></td>
                     </tr>
                    </table>';    
        } // fin WHILE
    } else {  
        echo '<div class="slider_text text-center"><h3>No tienes ningún anuncio creado todavía</h3></div>';
    } //fin IF

?>
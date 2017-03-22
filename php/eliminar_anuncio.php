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

 $sql = "DELETE FROM anuncios WHERE id_anuncio = '$id'";
 $query = $con->query($sql);

// Actualizamos los registros y los recuperamos

 $sql1 = "SELECT * FROM anuncios WHERE usuario_id = '$id_usuario'";
 $query = $con->query($sql1);

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
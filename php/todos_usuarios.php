
<?php
 include('conexion.php');
 session_start();
    $id = $_SESSION['user_id'];
   
    $sql = "SELECT * FROM USUARIOS";
    $query = $con->prepare($sql);
    $query->execute();
    $tabla = "";
   
    // Comprobamos existencia del anuncio
    if ($query->rowCount() > 0){
        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 

		  $eliminar = '<a href=\"#eliminar-usuario\" onclick=\"setIdUsuario('.$resultado['id'].')\" data-toggle=\"modal\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Borrar</a>';
                
                $tabla.='{
                        "username":"'.$resultado['usuario'].'",
                        "nombre":"'.$resultado['nombre'].'",
                        "email":"'.$resultado['email'].'",           
                        "fecha":"'.$resultado['fecha_creacion'].'",
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
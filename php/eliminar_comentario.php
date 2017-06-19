<?php
 include ('conexion.php');

 session_start();

 if(isset($_SESSION["user_id"]) != 1 || $_SESSION["user_id"] == null){
    print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
 } else{
    $id_usuario = $_SESSION['user_id'];
 }

    $id = $_POST['id'];
    
    // Eliminamos el usuario

     $sql = "DELETE FROM comentarios WHERE id_comentario = ?";
     $query = $con->prepare($sql);
     $query->execute(array($id));
    
    if ($query != null){
        exit();
    }


?>
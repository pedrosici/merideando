<?php

include('conexion.php');
if (isset($_POST['id_categoria'])){
    $id_subcat = $_POST['id_categoria'];
   
    $sql = "SELECT * FROM subcategorias WHERE categoria_id = ? ORDER BY nombre_subcat ASC";
   
    $query = $con->prepare($sql);
    $query->execute(array($id_subcat));
   
    $indice = "<option value=0>Todas las subcategorías</option>";
   
    
    if ($query->rowCount() > 0 ){
        echo $indice;
        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
            
            $html = "<option value='".$resultado['id_subcategoria']."'>".$resultado['nombre_subcat']."</option>";
            echo $html;
        }
    }
    
}
?>
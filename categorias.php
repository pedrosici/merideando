<?php
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    include('php/conexion.php');

    session_start();
    $id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
 <html lang="en">
    <head>
        <!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merideando</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Bootstrap -->
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">  
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        
    </head>

    <body>
        <?php include "php/navbar.php"; ?>
        
        <section class="categorias">
            <div class="container">
                <div class="row">
                    <div class="section_title text-center mg-tp-80 mg-bt-40">						
							<h2>Categorías</h2>
							<h4>Elige la categoría adecuada para el anuncio que buscas</h4>
							<div class="icon_wrap"><i class="fa fa-search"></i></div>
				    </div>
                    <div class="col-md-12 text-center">
                        <ul class="row clearfix">
            <?php
                $sql = "SELECT categorias.*, subcategorias.* FROM categorias, subcategorias WHERE categorias.id_categoria = subcategorias.categoria_id ORDER BY categorias.nombre_cat ASC";
                    
                $query = $con->prepare($sql);
                $query->execute();
                        
                $categoria = "";
                $categorias = array();
                            
                $pos = 0;        
                        
                //Comprobamos si existen resultados
                if ($query->rowCount() > 0){
                
                   
                    while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                        
                        if($categoria != $resultado['nombre_cat']){
                            $categoria = $resultado['nombre_cat'];
                            $id_categoria = $resultado['id_categoria'];
                            $icono = $resultado['icono'];
                            
                            $pos = array_push($categorias,  array($categoria, array(), $id_categoria, $icono));
                            
                        }    
                        $categorias[$pos][1][] = array( $resultado['id_subcategoria'], $resultado['nombre_subcat'] );
                       
                    }


                    foreach ($categorias as $categoria)
                        {
 
                            if( !empty( $categoria[0] ) ) {
                             echo "<li class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>";
                                 echo "<section class='lista-subcategorias'>
                                        <div><i class='fa ".$categoria[3]."'></i>
                                        <a href='categoria.php?id=".$categoria[2]."'><span class='lista-categoria-titulo'>".$categoria[0]."</span></a>
                                        </div>";
                           
                            }
                            if (count($categoria[1]) > 0)
                            {
                               
                                        
                                foreach ($categoria[1] as $subCat)
                                {
                                    echo "<ul class='list'>
                                    <li><a href='categoria.php?id=" . $subCat[0] . "'>" .
                                        $subCat[1] . "</a></li></ul>";
                                }
                                echo "</section></li>";
                                
                            }
                    }  
                
                
                
                }  // FIN if
                   
                        
                        
                        
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        
        
       <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
        <!--Import jQuery before materialize.js-->
        
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
     </body>
</html>
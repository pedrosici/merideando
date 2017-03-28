<?php 
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    include('php/conexion.php');

    session_start();
    $id = $_SESSION['user_id'];

    //Seleccionamos los datos referentes a la categoría elegida 
    $sql = "SELECT * FROM categorias WHERE id_categoria='{$_GET['id']}'";
    $query = $con->query($sql)

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
        <!-- Incluimos el navbar o cabecera de la página -->
        <?php include "php/navbar.php"; ?>
        <section class="categorias">
            <div class="container">
                <div class="row"> 
               <?php      //Comprobamos si existen resultados
                    if (mysqli_num_rows($query) > 0){
                        while ($resultado = $query->fetch_array()){  
                    
                    echo '<div class="section_title text-center mg-tp-80 mg-bt-40">						
							<h2>'.$resultado['nombre_cat'].'</h2>
							<h4>Encuentra los anuncios más relevantes en esta categoría</h4>
							<div class="icon_wrap"><i class="fa '.$resultado['icono'].'"></i></div>
				    </div>';
                        }
                    }
                ?>  
                </div>
            </div>
        </section> 
        
        <section class="main container-fluid mg-bt-40">     
             <aside  id="bloqueblog" class="col-md-3 pull-left">
                <div class="section_title text-center mg-bt-40">
                    <h2>Categorias</h2>
                 </div>
        <!-- Script php para las categorias -->
                <?php

                    // Consulta SQL
                    $sql= "SELECT * FROM categorias ORDER BY id_categoria DESC";
                    $query = $con->query($sql);
                    // Comprobamos existencia
                    if (mysqli_num_rows($query) > 0){
                     // Mostramos resultados
                        while ($resultado = $query->fetch_array()){ 
                            echo '<div class="list-group">
                       <a href="categoria.php?id='.$resultado['id_categoria'].'" class="list-group-item"><h4><i class="fa '.$resultado['icono'].'"></i> '.$resultado['nombre_cat'].'</h4></a>
                    </div>';

                        } //end while
                    }     //end if

                    ?>

                </aside>
        
        
        <section class="col-md-9">
            <?php

                    // Consulta SQL
                    $sql= "SELECT * FROM anuncios WHERE categoria_id ='{$_GET['id']}'";
                    $query = $con->query($sql);
                   
                    // Comprobamos existencia
                    if (mysqli_num_rows($query) > 0){
                     // Mostramos resultados
                        while ($resultado = $query->fetch_array()){ 
                           echo '<div class="col-md-12 list-group">
                                <div class="media-left media-middle">
                                    <a href="anuncio.php">
                                        <img class="media-object img-rounded" src="images/'.$resultado['imagen'].'" alt="logo" width="150">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">'.$resultado['razon_soc'].'</h4><i class="fa fa-map-marker"></i> '.$resultado['direccion'].'
                                    <p>'.$resultado['descripcion'].'</p>
                                </div>
                            </div>';
                        }
                    }
                            
            ?>
           
        </section>
    </section>
                
        <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
        <!--Import jQuery before materialize.js-->
        
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
     </body>
</html>
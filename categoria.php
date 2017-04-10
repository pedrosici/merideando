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
               <?php //Comprobamos si existen resultados
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
                 <div class="col-md-11">
                    <div class="section_title text-center mg-bt-40">
                        <h3><i class="fa fa-align-justify"></i> Categorias</h3>
                     </div>
        <!-- Script php para las categorias -->
                     
                     <ul class="list-group">
            <?php
                // Consulta SQL
                $sql= "SELECT * FROM categorias ORDER BY id_categoria DESC";
                $query = $con->query($sql);
                // Comprobamos existencia
                if (mysqli_num_rows($query) > 0){
                // Mostramos resultados
                     while ($resultado = $query->fetch_array()){ 
                        echo '  <a href="categoria.php?id='.$resultado['id_categoria'].'">
                                <li class="list-group-item">
                                  <h4><i class="fa '.$resultado['icono'].'"></i> '.$resultado['nombre_cat'].'</h4></a>
                                </li></a>
                             ';

                        } //end while
                    }     //end if

                    ?>
                         </ul>
                        
                    </div>
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
                                <div class="wrapper">
                                    <div class="item-list">
                                        <div class="col-sm-2 no-padding">
                                            <a href="anuncio.php?id='.$resultado['id_anuncio'].'">
                                                <img class="media-object img-rounded" src="images/'.$resultado['imagen'].'" alt="logo" width="150">
                                            </a>
                                        </div>
                                        <div class="col-sm-7">
                                            <a href="anuncio.php?id='.$resultado['id_anuncio'].'"><h4 class="title">'.$resultado['razon_soc'].'</h4></a>
                                            <h5 class="subtitulo"><i class="fa fa-map-marker"></i> '.$resultado['direccion'].'</h5>
                                            <p>'.$resultado['descripcion'].'</p>
                                        </div>
                                        <div class="col-sm-3 botones text-right">
                                              <a href="anuncio.php?id='.$resultado['id_anuncio'].'" class="btn btn-primary btn-md"><i class="fa fa-eye fa-2x"></i> Ver</a>
                                            <a class="btn btn-primary btn-md"><i class="fa fa-thumbs-o-up fa-2x"></i> 20</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                    
                        echo '<div class="col-md-12 mg-tp-80 text-center">
                                <h4>No existen anuncios para esta categoría</h4>
                               </div>
                        ';
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
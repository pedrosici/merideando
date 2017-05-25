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
            <?php
                $sql = "SELECT categorias.nombre_cat, categorias.id_categoria, categorias.icono, COUNT(anuncios.id_anuncio) AS 'cantidad' FROM categorias LEFT JOIN anuncios ON categorias.id_categoria = anuncios.categoria_id GROUP BY categorias.id_categoria";
                    
                $query = $con->prepare($sql);
                $query->execute();
                //Comprobamos si existen resultados
                if ($query->rowCount() > 0){
                    while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){                
                        echo ' <a href="categoria.php?id='.$resultado['id_categoria'].'" target="_blank"><div class="col-md-4 col-sm-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                        <div class="single_feature">
                            <i class="fa '.$resultado['icono'].'"></i>
                                <h4>'.$resultado['nombre_cat'].'</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">'.$resultado['cantidad'].' anuncios publicados</li>
                                    </ul>
                                </div>
                            </div></a>';                                                              
                     
                            } //FIN while
                           }  // FIN if
                    ?>
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
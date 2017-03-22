<?php
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    include('php/conexion.php');

    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
	   print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}


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
                    <div class="section_title text-center">						
							<h2>Negocios y servicios</h2>
							<h4>Elige la categoría que buscas</h4>
							<div class="icon_wrap"><i class="fa fa-search"></i></div>
				    </div>
                    <div class="col-md-12">
                        <?php
                            $sql = "SELECT COUNT(a.id_anuncio) as cantidad, c.nombre_cat FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria GROUP BY c.id_categoria";
                            $query = $con->query($sql);
                        //Comprobamos si existen resultados
                           if (mysqli_num_rows($query) > 0){
                            while ($resultado = $query->fetch_array()){                                            
                                                                     
                 echo '<ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i>
                                <span class="badge">'.$resultado['cantidad'].'</span>'.$resultado['nombre_cat'].'
                            </li>
                        </ul>';
                     
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
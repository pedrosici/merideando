<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

session_start();
include('php/conexion.php');
        
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">  
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    </head>
     
 <html lang="en">
	 <head>
        <!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merideando - Panel Admin.</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Bootstrap -->
         <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
         <script src="js/main.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">  
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    </head>
	<body>
    <?php include "php/navbar.php"; ?>
     
     <div class="container">
        <div class="row">
            
        <?php 
            // Consulta SQL
            $sql = "SELECT * FROM anuncios WHERE id_anuncio = '{$_GET['id']}'";
            $query = $con->query($sql);
            // Comprobamos existencia del anuncio
            
             if ($query->num_rows > 0 ){
                while ($resultado = $query->fetch_array()){
        ?>
            <div class="col-md-12 mg-tp-40 text-center">
                    <img src="images/<?php echo $resultado['imagen']; ?>" height="100">
            </div>
             <div class="section_title mg-tp-40 mg-bt-40  text-center">						
                 <h2><?php echo $resultado['razon_soc']; ?></h2>


            </div>   
             <div class="col-md-12 mg-bt-40 text-center">
                <button class="btn btn-success" type="button">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="badge">4</span>
                </button>
                 <button class="btn btn-danger" type="button">
                  <i class="fa fa-thumbs-down" aria-hidden="true"></i> <span class="badge">1</span>
                </button>


            </div>
        
        
            
        <div class="col-md-12 mg-bt-80 text-center">
                <p><?php echo $resultado['descripcion']; ?> </p>
            <div class="icon_wrap"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
        </div>
         
    </div>    
            
            
    <div class="row">    
        <div class="col-md-4 mg-bt-80">
            <div class="mg-bt-40 text-center">
                <h3>Contacto</h3>
            </div>
            
            <table class="table table-striped table-condensed table-hover">
                <tr><th><i class="fa fa-map-marker" aria-hidden="true"></i></th>
                    <th><?php echo $resultado['direccion']; ?></th>
                </tr>
                <tr><td><i class="fa fa-phone" aria-hidden="true"></i></td>
                    <td><?php echo $resultado['telefono']; ?></td>
                </tr>
                <tr><td><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
                    <td><a href="mailto:<?php echo $resultado['email']; ?>">Contactar vía email</a></td>
                </tr>
                
            </table>
            
        </div>
        <div class="col-md-4 mg-bt-80">
            <div class="mg-bt-40 text-center">
                <h3>Horario Laboral</h3>
            </div>
            
            <table class="table table-striped table-condensed table-hover">
                <tr>
                    <th>Dias laborales</th>
                    <th>Fin de Semana</th>
                </tr>
                <tr>
                    <td>10:00 AM - 20:30 PM</td>
                    <td>11:30 AM - 18:00</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 mg-bt-80">
            <div class="mg-bt-40 text-center">
                <h3>Redes sociales</h3>
            </div>
            
                <ul class="social" style="list-style:none;" >
                    <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                </ul>
             
        </div>
             
    </div>
         
    <div class="row">
        <div class="col-md-6 mg-bt-80">
            <div class="mg-bt-40 text-center">
                <h3>Galeria</h3>
            </div>
            
            <img src="images/galileo.jpg" class="img-thumbnail" width="150">
            <img src="images/galileo.jpg" class="img-thumbnail" width="150">
            <img src="images/galileo.jpg" class="img-thumbnail" width="150">
        </div>
            
        <div class="col-md-6 mg-bt-80">
            <div class="mg-bt-40 text-center">
                <h3>Comentarios</h3>
            </div>
            
            <section class="posts">
                <article class="post clearfix">
                    <p class="post-title">La mejor pizzería de Mérida</p>
                   
                         
                    <p class="post-contenido text-justify">
                        Gran variedad de pizzas y pasta a buen precio. Estaba todo rico. El restaurante es muy amplio y el vestuario del personal resulta curioso... :)
                    </p>
                </article>
            </section>
        </div>
   </div>
         
    <?php
                } //FIN IF
             } //FIN WHILE
        else {
            echo '<h3> No existe ningún anuncio publicado en esta sección.';
        }
    ?>
</div>
        
    <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
      <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
    </body>
  </html>
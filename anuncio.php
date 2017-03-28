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
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merideando - Panel Admin.</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Bootstrap -->
         
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
            $sql = "SELECT a.razon_soc, a.cif, a.direccion, a.longitud, a.latitud, a.telefono, a.email, a.descripcion, a.imagen, a.total_votos, c.nombre_cat, c.icono FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.id_anuncio = '{$_GET['id']}'";
            $query = $con->query($sql);
            // Comprobamos existencia del anuncio
            
             if ($query->num_rows > 0 ){
                while ($resultado = $query->fetch_array()){
                    $lat = $resultado['latitud'];
                    $lng = $resultado['longitud'];
        ?>
            <div class="col-md-12 mg-tp-40 mg-bt-40 text-center">
                    <img src="images/<?php echo $resultado['imagen']; ?>" class="img-rounded" height="100">
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
            <div class="icon_wrap"><i class="fa <?php echo $resultado['icono']; ?>" aria-hidden="true"></i></div>
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
        
        <div class="col-md-12 mg-bt-40">
            <div class="mg-bt-40 text-center">
                <h3>Ubicación</h3>
            </div>
            <div id="map"></div>
        </div>
        
        <div class="col-md-12 mg-bt-40">
            <div class="mg-bt-40 text-center">
                <h3>Comentarios y Opiniones</h3>
            </div>
            
            <section class="posts col-md-6">
                <article class="post clearfix">
                    <h3 class="post-title">La mejor pizzería de Mérida</h3><h6 class="post-fecha"><i class="fa fa-clock-o"></i> 26/03/2017  <span class="post-autor">por Pedro</span></h6>
                   
                   
                         
                    <p class="post-contenido text-justify">
                        Gran variedad de pizzas y pasta a buen precio. Estaba todo rico. El restaurante es muy amplio y el vestuario del personal resulta curioso... :)
                    </p>
                </article>
            </section>
            
            <section class="posts col-md-6">
                <article class="post clearfix">
                    <h3 class="post-title">No está mal, un italiano más</h3><h6 class="post-fecha"><i class="fa fa-clock-o"></i> 26/03/2017  <span class="post-autor">por Juan</span></h6>
                   
                   
                         
                    <p class="post-contenido text-justify">
                        Pizzería bien situada, en el centro de Mérida. Buen local y camareros atentos pero la masa de las pizzas estaba congelada, tampoco tenian agua embotellada.
                    </p>
                </article>
            </section>
        </div>
        <div class="col-md-12 text-center mg-bt-40">
            <a class="btn btn-primary">Comentar</a>
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
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC516yYGBDQeQIHcm7W1KhWJ_NDL8iUT8s&callback=initMap">
    </script>   
      <script type="text/javascript">
        function initMap() {
	        var coord = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 18,
	          center: coord
	        });
	        var marker = new google.maps.Marker({
	          position: coord,
	          map: map
	        });
	      }
        </script>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
    </body>
  </html>
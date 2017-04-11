<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

session_start();
include('php/conexion.php');

$busqueda = $_GET['id'];

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
            $sql = "SELECT  a.razon_soc, a.cif, a.direccion, a.telefono, a.email, a.descripcion, a.imagen, c.nombre_cat, c.icono FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.id_anuncio = ?";
            $query = $con->prepare($sql);
            $query->execute(array($busqueda));
            //Comprobamos si existen resultados
            if ($query->rowCount() > 0){
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                    //Posición ubicación anuncio
                    $lat = $resultado['latitud'];
                    $lng = $resultado['longitud']; ?>
            
            <div class="col-md-12 mg-tp-40 mg-bt-40 text-center">
                    <img src="images/<?php echo $resultado['imagen']; ?>" class="img-rounded" height="100">
            </div>
             <div class="section_title mg-tp-40 mg-bt-40  text-center">						
                 <h2><?php echo $resultado['razon_soc']; ?></h2>
            </div>   
            
            <div class="col-md-12 mg-bt-40 text-center">
                <ul class="votos">
                    <li class="btn btn_votos  btn-success" data-voto="likes" data-id="<?php echo $resultado['id_anuncio'];?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="badge"><?php echo $resultado['likes'];?></span></li>
                    <li class="btn_votos btn btn-danger" data-voto="hates" data-id="<?php echo $resultado['id_anuncio'];?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="badge"><?php echo $resultado['hates'];?></span></li>
                </ul>
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
                <h3>Opiniones y comentarios</h3>
            </div>
        </div>
        
    </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div id="listaComentarios">
                
        <?php
            $sql = "SELECT comentario, nick, fecha_comentario FROM comentarios WHERE id_anuncio = ?";
            $query = $con->prepare($sql);
            $query->execute(array($busqueda));
                    
            //Comprobamos si existen resultados
            if ($query->rowCount() > 0){
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                    echo '<div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$resultado['nick'].'</strong>  <span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$resultado['fecha_comentario'].'</span>
                                </div>
                                <div class="panel-body">'.$resultado['comentario'].'</div>
                            </div>
                          </div>';
                }
            }
                ?>
            
            </div>
        </div><!-- /col-sm-5 -->
        
        
        <div class="col-sm-12 text-center mg-tp-40 mg-bt-40">
            <form role="form" name="comentario" id="comentarios_ajax" method="POST" class="col-md-6 col-md-offset-3 text-center">
                <h3>Escribe tu opinión</h3>
                <p>Tu opinión es importante, intenta ser justo y sincero con tu aportación.</p>
			 <div class="form-group">
                <label for="name">Tu nombre</label>
			     <input id="autor_id" name="name" type="text" class="form-control" placeholder="Autor del comentario" required>
		      </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="comentario" name="comentario" class="form-control" placeholder="Escribe tu comentario acerca del anuncio" required></textarea>
                </div>
                <input type="hidden" id="id_anuncio" value="<?php echo $busqueda; ?>">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Comentar">
                </div>
		</form>
            <div id="resultado"></div>
        </div>
   </div>
         
    <?php
                } //FIN IF
             } //FIN WHILE
        else {
            echo '<div class="col-md-12 mg-bt-80 mg-tp-80 text-center"><h3>¡ERROR! El anuncio que intenta ver no existe.</h3></div>';
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
        <script type="text/javascript" src="js/main.js"></script>
        
        <script>
            $(document).ready(function() {
            /*Obtenemos el evento Submit, este ejecuta cuando el usuario hace click al boton comentar
            #comentario_ajax es el id del formulario de donde tratamos de enviar el comentario, si tu formulario tiene otro id tenes que cambiar este acontinucion*/
            $("#comentarios_ajax").submit(function() {
                var autor_id = $("#autor_id").val();
                var post_id = $("#post_id").val();
                var comentario = $("#comentario").val();
                var id_anuncio = $("#id_anuncio").val();
                var cadena = 'id_anuncio='+id_anuncio+'&autor_id='+autor_id+'&post_id='+post_id+'&comentario='+encodeURIComponent(comentario);
                $.ajax({ type: "POST", 
                         url: "php/comentarios_anuncio.php", 
                         data: cadena,
                         cache: false, 
                         success: function(datos){ 
                                  if (datos) {  
                                     $("#resultado").addClass('alert alert-success').html('¡Su comentario ha sido publicado con éxito').show(200).delay(3000).hide(200);
                                     $("#listaComentarios").append(datos); 
                                     }
                                  }
                });
                return false;
            });
            });
        </script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
    </body>
  </html>
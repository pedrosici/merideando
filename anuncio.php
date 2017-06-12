<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

session_start();
include('php/conexion.php');

$sesion = false;
if(isset($_SESSION["user_id"]) || $_SESSION["user_id"] != null){ $sesion = true; }


$id_anuncio = $_GET['id'];


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
            $sql = "SELECT a.razon_soc, a.cif, a.direccion, a.longitud, a.latitud, a.telefono, a.email, a.descripcion, a.web, a.twitter, a.facebook, a.instagram, a.imagen, a.likes, a.hates, c.nombre_cat, c.icono FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.id_anuncio = ?";
            $query = $con->prepare($sql);
            $query->execute(array($id_anuncio));
            
            // Comprobamos existencia del anuncio
             if ($query->rowCount() > 0){
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                    //Posición ubicación anuncio
                    $lat = $resultado['latitud'];
                    $lng = $resultado['longitud']; ?>
            
            <div class="col-md-4 mg-tp-40 mg-bt-40 text-center">
                    <img src="images/anuncios/<?php echo $resultado['imagen']; ?>" class="img-rounded" height="80">
            </div>
             <div class="col-md-8 mg-tp-40 mg-bt-40 text-center ">						
                 <h2><?php echo $resultado['razon_soc']; ?></h2>
                 <p><?php echo $resultado['descripcion']; ?> </p>
            </div>   

            <div class="col-md-12 mg-bt-40 text-center">
                <div class="icon_wrap"><i class="fa <?php echo $resultado['icono']; ?>" aria-hidden="true"></i></div>
            </div>
<!--
            <div class="col-md-12 mg-bt-40 text-center">
                <div class="mg-bt-40 text-center">
                <h3>Valora este servicio</h3>
                </div>
                <ul class="votos">
                    <li class="btn btn_votos  btn-success" data-voto="likes" data-id="<?php // echo $resultado['id_anuncio'];?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="badge"><?php //echo $resultado['likes'];?></span></li>
                    <li class="btn_votos btn btn-danger" data-voto="hates" data-id="<?php //echo $resultado['id_anuncio'];?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="badge"><?php //echo $resultado['hates'];?></span></li>
                </ul>
             </div>
-->
  
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
                <?php 
                    if ($resultado['web'] != NULL || $resultado['web'] != "" ){
                        echo '<tr><td><i class="fa fa-link" aria-hidden="true"></i></td>
                                <td><a href="http://'.$resultado['web'].'">Visitar web</a></td>
                              </tr>';
                    }  ?>
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
                    <td>11:30 AM - 18:00 PM</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4 mg-bt-80 text-center">
            <div class="mg-bt-40 text-center">
                <h3>Redes sociales</h3>
            </div>
            <div class="row">
            <?php   
            if (($resultado['facebook'] == "") && ($resultado['twitter'] == "") && ($resultado['instagram'] == "")){
                echo '<p>El anunciante no dispone de redes sociales.</p>';
            } else {
                echo '<div class="col-md-12 text-center">';
                if ($resultado['facebook'] != NULL || $resultado['facebook'] != "" ){
                    echo '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-center">
                            <div class="icon-circle">
                                <a href="https://es-la.facebook.com/'.$resultado['facebook'].'" class="ifacebook title="facebook"><i class="fa fa-facebook"></i></a>
                            </div>
                          </div>';
                }
                if ($resultado['twitter'] != NULL || $resultado['twitter'] != "" ){
                    echo '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-center">
                            <div class="icon-circle">
                                <a href="https://twitter.com/'.$resultado['twitter'].'" class="itwittter" title="Twitter"><i class="fa fa-twitter"></i></a>
                            </div>
                          </div>';
                }
                if ($resultado['instagram'] != NULL || $resultado['instagram'] != "" ){
                    echo '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-center">
                            <div class="icon-circle">
                                <a href="https://www.instagram.com/'.$resultado['instagram'].'" class="iinstagram" title="instagram"><i class="fa fa-instagram"></i></a>
                            </div>
                          </div>';
                        }
                        echo '</div>';
                    }  ?>
              </div>   
                
        </div>

        <div class="col-md-12 mg-bt-40">
            <div class="mg-bt-40 text-center">
                <h3>Ubicación</h3>
            </div>
            <div id="map"></div>
        </div>  
   
        <div class="col-sm-12 mg-bt-40">
            <div class="mg-bt-40 text-center">    
        <?php
            $sql = "SELECT COUNT(id_comentario) as num_comentarios FROM comentarios WHERE anuncio_id = ?";
            $query = $con->prepare($sql);
            $query->execute(array($id_anuncio)); 
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            //Comprobamos si existen resultados
            if ($query->rowCount() > 0){
                echo '<h3>Opiniones del anuncio ('.$resultado['num_comentarios'].' opiniones)</h3>';
            }
            
        ?>
   
            </div>
            
            <div id="listaComentarios">
                
        <?php
            $sql = "SELECT u.nombre, c.* FROM comentarios c INNER JOIN usuarios u ON c.usuario_id = u.id WHERE c.anuncio_id = ?";
            $query = $con->prepare($sql);
            $query->execute(array($id_anuncio));
                    
            //Comprobamos si existen resultados
            if ($query->rowCount() > 0){
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                    echo '<div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$resultado['nombre'].'</strong>  <span style="float:right"; class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$resultado['fecha_comentario'].'</span>
                                </div>
                                <div class="panel-body">
                                    <h3 class="panel-title">'.$resultado['titulo'].'</h3>
                                    <p>'.$resultado['comentario'].'</p>
                                    <p style="float:right";><i class="fa fa-star" aria-hidden="true"></i> '.$resultado['valoracion'].'/5</p>
                                </div>
                            </div>
                          </div>';
                }
            }
                ?>
            
            </div>
        </div><!-- /col-sm-5 -->
            
            
        
            
        <?php
            if ($sesion){ ?>
                <div class="col-sm-12 text-center mg-tp-40 mg-bt-40">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                             <h3 class="panel-title">Escribe tu opinión sobre este negocio</h3>
                         </div>
                         <div class="panel-body">
                            <form role="form" id="comentarios_ajax" method="POST" class="col-md-12 text-center">
                                
                             <div class="form-group text-center col-sm-8 col-sm-offset-2">
                                <label for="name">Título de tu opinión</label>
                                 <input id="titulo" name="titulo" type="text" class="form-control" placeholder="Escribe un título" max-length="50" required>
                              </div>
                              
                              <div class="form-group col-sm-8 col-sm-offset-2">
                                    <label for="message">Tu opinión</label>
                                    <textarea id="comentario" name="comentario" class="form-control" rows="3" maxlength="300" placeholder="Escribe tu comentario acerca del anuncio" required></textarea>
                              </div>
                                
                              <div class="form-group col-sm-2 col-sm-offset-5 text-center">
                                    <label for="valoracion">Valoración (0 a 5)</label>  
<!--
                                        <ul class="stars stars-24">
                                            <li>1</li>
                                            <li>2</li>
                                            <li>3</li>
                                            <li>4</li>
                                            <li>5</li>
                                        </ul>
-->
                                   <select class="form-control" id="valoracion">
                                       <option value="0">0 - Horrible</option>
                                       <option value="1">1 - Insuficiente</option>
                                       <option value="2">2 - No me convence</option>
                                       <option value="3">3 - Aceptable</option>
                                       <option value="4">4 - Notable</option>
                                       <option value="5">5 - Sobresaliente</option>
                                   </select>     
                                   
                              </div>
                              <div class="form-group col-sm-10 col-sm-offset-1 text-center">
                                <input type="checkbox" name="legal" id="legal" title="Debe aceptar las condiciones" required />
                                  <small>Certifico que esta opinión está basada en mi propia experiencia, que refleja mi opinión sincera sobre este anuncio y que además no me ha ofrecido incentivo o pago alguno por escribirla.</small>
                              </div>
                               <!-- Guardamos el id del anuncio sobre el que se hace el comentario y el id del usuario que realiza el comentario --> 
                              <input type="hidden" id="id_anuncio" value="<?php echo $id_anuncio; ?>" />
                              <input type="hidden" id="autor_id" value="<?php echo $_SESSION["user_id"]; ?>" />
                                
                              <div class="form-group col-sm-12 mg-tp-40">
                                <button type="submit" name="submit" value="submit" class="btn btn-default"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Publicar Opinión</button>
                              </div>
                            </form>
                                <!-- Mensaje de aviso tras escribir el comentario -->
                              <div class="col-sm-12" id="resultado"></div>
                    </div>
                </div>
            </div>
       <?php    
            }
            else { ?>
                <div class="col-sm-12 mg-tp-40 mg-bt-40 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Solo pueden opinar los usuarios registrados. Haz <a href="login.php">Login</a> o <a href="registro.php">Regístrate</a></h4>
                        </div>
                    </div>
                </div>

        <?php  }
   
                } //FIN IF
             } //FIN WHILE
        else {
            echo '<div class="col-md-12 mg-bt-80 mg-tp-80 text-center"><h3>¡ERROR! El anuncio que intenta ver no existe.</h3></div>';
        }
    ?>
        </div> <!-- FIN ROW -->  
    </div> <!-- FIN CONTAINER -->
        
    <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
     <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
     <script type="text/javascript" src="js/main.js"></script>   
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
        
        <script>
            $(document).ready(function() {
            /*Obtenemos el evento Submit, este ejecuta cuando el usuario hace click al boton comentar
            #comentario_ajax es el id del formulario de donde tratamos de enviar el comentario, si tu formulario tiene otro id tenes que cambiar este acontinucion*/
                $("#comentarios_ajax").submit(function() {
                    var id_usuario = $("#autor_id").val();
                    var id_anuncio = $("#id_anuncio").val();
                    var titulo = $("#titulo").val();
                    var valoracion = $("#valoracion option:selected").val();
                    var comentario = $("#comentario").val();
                    
                    var cadena = '&id_anuncio='+id_anuncio+'&autor_id='+id_usuario+'&titulo='+titulo+'&comentario='+encodeURIComponent(comentario)+'&valoracion='+valoracion;

                    $.ajax({ type: "POST", 
                             url: "php/comentarios_anuncio.php", 
                             data: cadena,
                             cache: false, 
                             success: function(datos){ 
                                      if (datos) {  
                                         $("#resultado").addClass('alert alert-success').html('Comentario publicado con éxito');
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
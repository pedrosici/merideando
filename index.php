<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
//Iniciamos variables SESSION
session_start();
//Incluimos archivo de conexion a la BD
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

    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="images/logo1.png"  width="100px"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Inicio<span class="sr-only">(current)</span></a></li>
                <!-- Mostramos las opciones de cuenta segun la sesión del usuario -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nosotros <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#nosotros">Servicio</a></li>
                    <li><a href="#anunciate">Anúnciate</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                  </ul>
                </li>
                <li><a href="categorias.php">Categorías</a></li>
              </ul>
                
              <ul class="nav navbar-nav navbar-right">
                  <li>
                      <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar en la web">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                      </form>
                  </li>
                  <!-- Mostramos las opciones de cuenta segun la sesión del usuario -->
                  <?php if(!isset($_SESSION["user_id"])):?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Mi cuenta <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a></li>
                    <li><a href="registro.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Regístrate</a></li>
                  </ul>
                </li>
                  <?php else:?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Mi cuenta <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="panel_usuario.php"><i class="fa fa-bullhorn" aria-hidden="true"></i> Mis anuncios</a></li>
                    <li><a href="php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
                  </ul>
                </li>
                  <?php endif;?>
              </ul>

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
   
    <!-- START HOME -->
        <header>
            <div class="slider_overlay">
                <div id="block" data-vide-bg="video/video" data-vide-options="position: 0% 50%" style= "height:100%";>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">

                                <div class="slider_text text-center">
                                    <h2 class="titulo">Hola, estas Merideando</h2>
                                     <p>Encuentra información acerca de multitud de servicios y negocios situados en Mérida. </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-md-offset-4 text-center">
                                <form action="index.php" method="POST" name="buscador" id="buscador">
                                  <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input class="form-control" type="text" placeholder="¿Qué buscas?">
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="section-padding" id="nosotros">
            <div class="container">
                <div class="row">
                    <div class="section_title text-center">						
							<h2>Bienvenido a Merideando.es</h2>
							<h4>Busca y encuentra</h4>
							<div class="icon_wrap"><i class="fa fa-search"></i></div>
						</div>	
                    <div class="col-md-5 col-md-offset-1 col-md-6">
							<div class="single_welcome">
								<p>Nuestra propuesta de valor reside en proporcionar un servicio de búsqueda y localización de establecimientos y servicios locales que sean útiles tanto al visitante como a la ciudadanía emeritense.</p>
							</div>
						</div><!--- END COL -->
						<div class="col-md-5 col-md-6">
							<div class="single_welcome">
								<p>La base de nuestro buscador está basado en anuncios publicados por los propios dueños de cada negocio o servicio e intentan facilitar al cliente la mayor información posible acerca del mismo.</p>
							</div>
                </div>
                </div>
            </div>
        </section>
        
        <section class="nosotros">
				<div class="container">
					<div class="row text-center">
						<div class="section_title mg-bt-40">						
							<h2>Sobre nosotros</h2>
                            <h4>Conoce como trabajamos</h4>
							<div class="icon_wrap"><i class="fa fa-heart-o"></i></div>	
						</div>		
                        <br>
						<div class="col-md-4 col-sm-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_feature">
								<i class="fa fa-desktop"></i>
								<h4>Herramienta útil</h4>
								<p>Publicar anuncios en nuestra página es un medio ideal para contactar con posibles clientes y con la garantía de ganar visibilidad en internet.</p>
							</div>
						</div><!-- END COL -->
                        
                       <?php //Consulta para sacar TOTAL de anuncios en la BD
                            $sql = "SELECT COUNT(id_anuncio) as cantidad FROM anuncios";
                            $query = $con->query($sql);
                        //Comprobamos si existen resultados
                           if (mysqli_num_rows($query) > 0){
                            while ($resultado = $query->fetch_array()){
                                echo '<div class="col-md-4 col-sm-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="single_feature">
								<i class="fa fa-database"></i>
								<h4>Variedad de anuncios</h4>
								<p>Disponemos de más de 10 <a href="categorias.php">categorías</a> diferentes y '.$resultado['cantidad'].' anuncios publicados hasta el momento, ¿A qué esperas para publicar el tuyo?</p>
							</div>
						</div><!-- END COL -->';
                            }
                           }
                        
                        ?>
						
						<div class="col-md-4 col-sm-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
							<div class="single_feature">
								<i class="fa fa-heart-o"></i>
								<h4>Somos profesionales</h4>
								<p>Merideando es el primer buscador de anuncios que ofrece una interfaz de calidad y responsiva. Estamos comprometidos con nuestra labor.</p>
							</div>
						</div><!-- END COL -->
						
					</div><!-- END ROW -->
				</div><!-- END CONTAINER -->		
			</section>
			<!-- END FEATURES -->
        
            <!-- END NOSOTROS -->
        
        <!-- START ANUNCIATE -->
        
    <section class="anunciate section-padding" id="anunciate">
            <div class="container">
					<div class="row text-center">
						<div class="section_title mg-bt-40">						
							<h2>Anúnciate</h2>
                            <h4>Ten presencia en internet</h4>
							<div class="icon_wrap"><i class="fa fa-bullhorn"></i></div>	
						</div>	
                    
                         <div class="col-md-4 wow fadeInLeft" data-wow-duration="1s" delay="0.2s" data-wow-offset="0">
                             <div class="single-address">
                                <i class="fa fa-pencil-square-o"></i>
                                <h4>Regístrate</h4>
                             </div>
                             <p>Necesitamos información sobre ti y tu negocio. Para registrarte, pincha en <a href="login.php">este enlace</a></p>
                        </div>
                        
                        <div class="col-md-4 wow fadeInLeft" data-wow-duration="1s" delay="0.2s" data-wow-offset="0" >
                            <div class="single-address">
                                <i class="fa fa-pencil-square-o"></i>
                            <h4>Crea tu anuncio</h4>
                            </div>
                            <p>Una vez registrado podrás empezar a crear el anuncio ideal, para ello puedes acceder a <a href="panel_usuario.php">tu panel de administración</a></p>    
                        </div>
                        <div class="col-md-4 wow fadeInLeft" data-wow-duration="1s" delay="0.2s" data-wow-offset="0">
                            <div class="single-address">
                                <i class="fa fa-pencil-square-o"></i>
                                <h4>Visualiza tu anuncio y compártelo</h4>
                            </div>
                            <p>Ya has publicado tu anuncio, es hora de que todos lo vean. Puedes compartirlo o ver el resto de anuncios relacionados con el tuyo</p>
                                
                        </div><!-- FIN COL -->
                   
                    
                    </div> <!-- FIN ROW -->
                </div><!-- FIN CONTAINER -->
    </section><!-- FIN SECTION -->
        
    <section class="novedades section-padding">
            <div class="container">
                <div class="row">
                    <div class="section_title text-center">						
							<h2>Novedades</h2>
							<h4>Últimos anuncios publicados</h4>
							<div class="icon_wrap"><i class="fa fa-search"></i></div>
				    </div>
                    
                     <?php
                        //Consulta para sacar ultimos anuncios publicados
                            $sql = "SELECT * FROM anuncios ORDER BY fecha DESC LIMIT 3";
                            $query = $con->query($sql);
                        //Comprobamos si existen resultados
                           if (mysqli_num_rows($query) > 0){
                            while ($resultado = $query->fetch_array()){
                    
                       
                                
                            echo '<div class="col-md-4 media">
                              <div class="media-left media-middle">
                                <a href="#">
                                  <img class="media-object" src="images/'.$resultado['imagen'].'" alt="logo" width="50">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading">'.$resultado['razon_soc'].'</h4>
                                '.$resultado['direccion'].'
                              </div>
                            </div>';
                            } // FIN while
                           } //FIN if
                        ?> 
                    </div>
                </div>
            
        </section>
        
     <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
     <!-- Script para mostrar Google Maps con mi API Key -->
        <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC516yYGBDQeQIHcm7W1KhWJ_NDL8iUT8s&callback=initMap">
    </script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
    </body>
  </html>
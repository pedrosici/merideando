<?php

//Evitamos que nos salgan los NOTICES de PHP

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
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        

    </head>
  


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
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        

    </head>
    <body>
        <!-- Incluimos el navbar o cabecera de la página -->
        <?php include "php/navbar.php"; ?>
 <!-- START HOME -->
        <header>
            <div id="backimage">
            <div class="slider_overlay">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">

                                <div class="slider_text text-center">
                                    <h2 class="titulo">Conoce Merideando</h2>
                                     <p>Somos el buscador referente en Mérida. Te enseñamos a darte a conocer en la ciudad </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="fondo">
				<div class="container">
					<div class="row text-center">
						<div class="section_title mg-bt-40">						
							<h2>Sobre Nosotros</h2>
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
                            $query = $con->prepare($sql);
                            $query->execute();
                        //Comprobamos si existen resultados
                           if ($query->rowCount() > 0){
                            while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
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
        
    <!-- Incluimos el footer o pie de página -->       
    <?php include "php/footer.php"; ?>
     
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>
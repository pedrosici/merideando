<?php
    //Evitamos que nos salgan los NOTICES de PHP
    

    session_start();
?>

<!DOCTYPE html>
 <html lang="en">
    <head>
        <!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merideando - Registro</title>
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
         <header data-stellar-background-ratio="0.5" id="home" class="hero" style="background-image: url(images/teatro_romano.jpg);  background-size:cover; background-position: center center;">
           <div class="slider_overlay">
               
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">

                                <div class="slider_text text-center" id="titulo_registro">
                                    <h2 class="titulo">Registra tu anuncio</h2>
                                     <p>Antes de publicar tu anuncio debes registrar una cuenta de usuario en Merideando </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                                
                                <div class="slider_text text-center" id="titulo_login" style="display:none;">
                                    <h2 class="titulo">Inicia sesión</h2>
                                     <p>Identifícate para acceder a tu cuenta de Merideando </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                            </div>  
                            <!-- Formulario Registro -->
                            <div class="col-md-6 col-md-offset-3" id="registro" >
                                <form role="form" name="registro" action="php/registrar.php" method="post" accept-charset="utf-8">
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="text" class="form-control col-md-6" name="usuario" id="usuario" placeholder="Tu nombre de usuario" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="text" class="form-control col-md-6" name="nombre" id="nombre" placeholder="Tu nombre completo" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="email" class="form-control col-md-6" name="email" id="email" placeholder="Email de contacto" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="password" class="form-control col-md-6" name="password" id="password" placeholder="Contraseña" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <input type="password" class="form-control col-md-6" name="confirm_password" id="confirm_password" placeholder="Confirma contraseña" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Crear mi cuenta</button>
                                    </div>
                                    <div class="col-md-8 col-md-offset-2 text-center cuenta">
                                        <a href="login.php"><p>Ya soy usuario de Merideando</p></a>
                                    </div>
                                </div>
                                </form>

                            </div>  <!-- FIN Formulario Registro -->
                        </div> <!-- fin ROW -->
                    </div> <!-- FIN container -->
               
             </div> <!-- FIN slider overlay -->
     </header>  
         
     <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
  
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
        
         <script src="js/valida_registro.js"></script>

    </body>
  </html>
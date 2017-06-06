<?php
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    
    session_start();
    
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
        <!-- Incluimos el NAVBAR de nuestra pagina -->
        <?php include "php/navbar.php";?>
   
    <!-- START HOME -->
        <header data-stellar-background-ratio="0.5" id="home" class="hero" style="background-image: url(images/teatro_romano.jpg);  background-size:cover; background-position: center center;">
            <div class="slider_overlay">
               
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">

                                <div class="slider_text text-center" id="titulo_registro">
                                    <h2 class="titulo">Inicia Sesión en Merideando</h2>
                                     <p>Antes de publicar tu anuncio debes loguearte si ya tienes una cuenta de usuario registrada en Merideando </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                                
                                <div class="slider_text text-center" id="titulo_login" style="display:none;">
                                    <h2 class="titulo">Inicia sesión</h2>
                                     <p>Identifícate para acceder a tu cuenta de Merideando </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                            </div>
                           
                            <!-- Formulario LOGIN -->
                            <div class="col-md-6 col-md-offset-3">
                                <form role="form" id="login_form" action="php/loguear.php" method="POST" accept-charset="utf-8">
                                    <div class="form-group row">
                                          <div class="col-md-8 col-md-offset-2">
                                              <p><?php echo isset($error) ? utf8_decode($error) : '' ; ?></p> 
                                         </div>
                                    </div>
                                    <div class="form-group row">
                                          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                              <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                                <input type="text" class="form-control col-md-6" name="usuario" id="usuario" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Usuario" required />
                                              </div>
                                         </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password" class="form-control col-md-6" name="password" id="password" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Contraseña" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mg-bt-40 text-center">
                                              <button type="submit" id="login_btn" class="btn btn-primary">Iniciar Sesión</button>
                                         </div>
                                         <div id="checklogin"></div>
                                        
                                        
                                    </div>
                                </form>
                                <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3 text-center cuenta">
                                            <a href="registro.php"><p>No tengo cuenta en Merideando</p></a>
                                        </div>
                            </div>
                            
                            
                            
                            <!-- FIN Formulario LOGIN -->
                        </div>
                    </div>
                
            </div>
        </header>
            
     
        
        <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
       
        
      <!--Import jQuery before materialize.js-->
      
      <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
        <script src="js/valida_login.js"></script>
        
    </body>
  </html>
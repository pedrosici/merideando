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
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
                                    <h2 class="titulo">Regístrate en Merideando</h2>
                                     <p>Antes de publicar tu anuncio debes registrar una cuenta de usuario en Merideando </p>
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                                </div>
                            </div>  
                            <!-- Formulario Registro -->
                            <div class="col-md-8 col-md-offset-2" id="registro" >
                                <form role="form" id="registro_form" action="php/registrar.php" method="POST" accept-charset="utf-8">
                                <div class="form-group row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control col-md-6" name="nombre" id="nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}[ ]{1}[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}" placeholder="Tu Nombre y Apellidos" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                            <input type="text" class="form-control col-md-6" name="usuario" id="usuario" placeholder="Tu Nombre de Usuario" minlength="4" maxlength="13" title="Tu nombre de usuario debe tener mínimo 4 caracteres" pattern="^([a-z]+[0-9]{0,2}){4,13}$" required />  
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                            <input type="email" class="form-control col-md-6" name="email" id="email" placeholder="Email de contacto" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" class="form-control col-md-6" name="password" id="password" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" class="form-control col-md-6" name="confirm_password" id="confirm_password" placeholder="Confirma contraseña" required />
                                            
                                        </div>   
                                    </div>
                                    <div id="checkPassword"></div>
                                </div>                                   
                                <div class="form-group row text-center">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button type="submit" class="btn btn-default" id="registro_btn">Crear mi cuenta</button>
                                    </div>
                                    <div id="checkregistro"></div> 
                                </div>
                            </form>
                                <div class="col-md-12 text-center cuenta">
                                    <a href="login.php"><p>Ya soy usuario de Merideando</p></a>
                                </div>
                            </div>  <!-- FIN Formulario Registro -->
                        </div> <!-- fin ROW -->
                    </div> <!-- FIN container -->
             </div> <!-- FIN slider overlay -->
     </header>  
         
     <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
  
        
      <!--Import jQuery before materialize.js-->
      
      <script src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
        
         <script src="js/valida_registro.js"></script>

    </body>
  </html>
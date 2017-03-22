<nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="images/logo1.png"  width="100px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio<span class="sr-only">(current)</span></a></li>
                  <!-- Mostramos las opciones de cuenta segun la sesión del usuario -->
                  <?php if(!isset($_SESSION["user_id"])):?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nosotros <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#nosotros">Servicio</a></li>
                    <li><a href="#anunciate">Anúnciate</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                  </ul>
                </li>
                <li><a href="categorias.php">Categorías</a></li>
                 <?php else:?>
                  <li><a href="panel_usuario.php">Mis anuncios</a></li>
                  <li><a href="categorias.php">Categorías</a></li>
                  
                <?php endif;?>
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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Identifícate <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
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
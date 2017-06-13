<?php

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
//Iniciamos variables SESSION
session_start();

if(isset($_SESSION["user_id"]) || $_SESSION["user_id"] != null){
    $nombre = $_SESSION['nombre'];
    $id = $_SESSION['user_id'];
}

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
        <link href="css/hover.css" rel="stylesheet" media="all"> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        

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
                <li><a href="nosotros.php">Nosotros</a></li>     
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorías <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                    <?php

                        $sql = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
                        $query = $con->prepare($sql);
                        $query->execute();
                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                            
                            echo '<li><a href="categoria.php?id='.$resultado['id_categoria'].'"><i class="fa '.$resultado['icono'].'"></i> '.$resultado['nombre_cat'].'</a></li>';
                            echo '<li role="separator" class="divider"></li>';
                        }
                          echo '<li><a href="categorias.php"><i class="fa fa-bars" aria-hidden="true"></i> Todas las categorias</a></li>';
                      ?>
                      </ul>
                  </li>
                  
                  
              </ul>
                
              <ul class="nav navbar-nav navbar-center">
                   <li class="text-center"><p class="navbar-btn"><a class="btn btn-default" href="panel_usuario.php"><i class="fa fa-plus-circle "></i> Crea tu anuncio</a></p>
                  </li> 
              </ul>  
                
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="mapa_anuncios.php"><i class="fa fa-map" aria-hidden="true"></i> Mapa de Anuncios</a></li>
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
                            <div class="col-md-6 col-md-offset-3 text-center">
                                <div class="form-group">
                                    <form>
                                        <div class="input-group">
                                            <input id="buscador" class="form-control input-lg" type="text" placeholder="¿Qué buscas?" />
                                            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                                        </div>
                                    </form>
                                
                                </div>
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
        
    <section class="fondo section-padding" id="nosotros">
        <div class="container">
            <div class="row">
                <div class="section_title text-center">
                    <h2>¿Qué necesitas hoy?</h2>
				    <h4>Elige una de nuestras categorías</h4>
				    <div class="icon_wrap"><i class="fa fa-search"></i></div>
				</div>
                <div class="col-md-12">
            <?php 
            $sql = "SELECT * FROM categorias";
            $query = $con->prepare($sql);
            $query->execute();
        
        //Comprobamos si existen resultados
            if ($query->rowCount() > 0){
                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                echo '<div class="col-md-4 cuadro-categoria">
                        <a href="categoria.php?id='.$resultado['id_categoria'].'" >
                        <span class="fa-stack fa-lg hover-grow">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa '.$resultado['icono'].' fa-stack-1x fa-inverse"></i>
                        </span>
                        <span class="nombre-categoria">'.$resultado['nombre_cat'].'</span>
                        </a>
                    </div>';
                }
            }
            ?>       
                </div>
            </div>
        </div>
    </section>
        
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="section_title text-center mg-bt-40">						
                    <h2>Novedades</h2>
                    <h4>Conoce los anuncios más relevantes</h4>
                    <div class="icon_wrap"><i class="fa fa-search"></i></div>  
                </div>

               <div class="col-md-12 mg-bt-40 text-center">   
                  <!-- Nav tabs -->
                 
                    <a href="#recientes" aria-controls="home" role="tab" data-toggle="tab"><button class="btn btn-default btn-lg" role="presentation" class="active"><i class="fa fa-clock-o" aria-hidden="true"></i> Más Recientes</button></a>
                    <a href="#valorados" aria-controls="profile" role="tab" data-toggle="tab"><button class="btn btn-default btn-lg" role="presentation"><i class="fa fa-star-o" aria-hidden="true"></i> Mejor Valorados</button></a>
                    <a href="#comentados" aria-controls="messages" role="tab" data-toggle="tab"><button class="btn btn-default btn-lg" role="presentation"><i class="fa fa-comment-o" aria-hidden="true"></i> Más Comentados</button></a>
                    
                  <!-- Tab panes -->
                 <div class="tab-content mg-tp-40">
                    <div role="tabpanel" class="tab-pane fade in active" id="recientes">
                        
                    <?php
                    //Consulta para sacar ultimos anuncios publicados
                    $sql = "SELECT a.razon_soc,a.id_anuncio, a.direccion, a.imagen, a.categoria_id, c.nombre_cat, c.icono FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE id_anuncio = a.id_anuncio ORDER BY fecha DESC LIMIT 5";
                    $query = $con->prepare($sql);
                    $query->execute();
                    //Comprobamos si existen resultados
                    if ($query->rowCount() > 0){
                      while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                       ?>   
                        <div class="listado-anuncios">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img class="img-rounded" src="images/anuncios/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['razon_soc']; ?>" width="100px">
                                        </div>
                                        <div class="col-xs-9">
                                            <h3 class="listado-titulo"><a href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>"><?php echo $resultado['razon_soc']; ?></a></h3>
                                            <p class="listado-categoria"><i class="fa <?php echo $resultado['icono']; ?>"></i> <?php echo $resultado['nombre_cat']; ?></p>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-0"><i class="fa fa-map-marker listado-ubicacion"></i> <?php echo $resultado['direccion']; ?></div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-3">
                                    <p>Posteado hace 5 días</p>
                                </div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-2 col-sm-offset-0 col-md-1">
                                     <div class="listado-favorito">
                                <?php
                                    $sql_fav = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id AND anuncio_id = :anuncio_id";
                                    $query_fav = $con->prepare($sql_fav);
                                    $query_fav->execute(array(':usuario_id'=>$id, ':anuncio_id'=> $resultado['id_anuncio']));
                                    $num_rows = $query_fav->fetchColumn();
                          
                                    if ($num_rows > 0){
                                        echo '<a href="#" data-toggle="tooltip" data-placement="top" title="" class="fav-active" data-original-title=">Guardar como favorito"><i class="fa fa-heart fa-2x"></i></a>';
                                    } else {
                                        echo '<a href="#" data-toggle="tooltip" data-placement="top" title="" class="fav" data-original-title=">Guardar como favorito"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></a>';
                                    }
                                ?>
                                        
                                     </div>
                                </div>
                            </div>
                        </div> 

                        <?php  
                      } // FIN while
                    } //FIN if
                        ?> 
                     
                    </div>
                     
                    <div role="tabpanel" class="tab-pane fade" id="valorados">...</div>
                    <div role="tabpanel" class="tab-pane fade" id="comentados">
                    <?php
                        //Consulta para sacar ultimos anuncios publicados
                        $sql = "SELECT COUNT(com.anuncio_id) as num_comentarios , a.razon_soc, a.id_anuncio, a.direccion, a.imagen, a.categoria_id, c.nombre_cat, c.icono FROM anuncios a INNER JOIN categorias c ON a.categoria_id = c.id_categoria INNER JOIN comentarios com ON a.id_anuncio = com.anuncio_id GROUP BY com.anuncio_id ORDER BY num_comentarios DESC LIMIT 5";
                        $query = $con->prepare($sql);
                        $query->execute();
                        //Comprobamos si existen resultados
                        if ($query->rowCount() > 0){
                          while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                    ?>   
                            <div class="listado-anuncios">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img class="img-rounded" src="images/anuncios/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['razon_soc']; ?>" width="100px">
                                        </div>
                                        <div class="col-xs-9">
                                            <h3 class="listado-titulo"><a href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>"><?php echo $resultado['razon_soc']; ?></a></h3>
                                            <p class="listado-categoria"><i class="fa <?php echo $resultado['icono']; ?>"></i> <?php echo $resultado['nombre_cat']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-0"><i class="fa fa-map-marker listado-ubicacion"></i> <?php echo $resultado['direccion']; ?></div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-3">
                                    <p><i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo $resultado['num_comentarios']; ?> opiniones</p>
                                </div>

                                <div class="col-xs-10 col-xs-offset-2 col-sm-2 col-sm-offset-0 col-md-1">
                                     <div class="listado-favorito">
                                <?php
                                    $sql_fav = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id AND anuncio_id = :anuncio_id";
                                    $query_fav = $con->prepare($sql_fav);
                                    $query_fav->execute(array(':usuario_id'=>$id, ':anuncio_id'=> $resultado['id_anuncio']));
                                    $num_rows = $query_fav->fetchColumn();
                          
                                    if ($num_rows > 0){
                                        echo '<a href="#" data-toggle="tooltip" data-placement="top" title="" class="fav-active" data-original-title=">Guardar como favorito"><i class="fa fa-heart fa-2x"></i></a>';
                                    } else {
                                        echo '<a href="#" data-toggle="tooltip" data-placement="top" title="" class="fav" data-original-title=">Guardar como favorito"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></a>';
                                    }
                                ?>
                                     </div>
                                </div>
                            </div>
                        </div>
                        
                           <?php  
                      } // FIN while
                    } //FIN if
                        ?> 
                        
                    </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <!-- Incluimos el footer o pie de página -->       
    <?php include "php/footer.php"; ?>
    
    <script type="text/javascript" src="js/main.js"></script>
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="js/bootstrap.min.js"></script>
        
    <script>   
         $(document).ready(function(){

             $('#buscador').autocomplete({
                 source: "php/busqueda.php",
                 minLength: 2,
                 select: function(event, ui) {
                     var url = ui.item.id;
                     if (url != '#') {
                         location.href = 'anuncio.php?id=' + url; 
                     }
                 },
                 open: function(event, ui) {
                     $(".ui-autocomplete").css("z-index", 1000)
                 }
             })

            });  
    </script>
        
    <script src="js/jquery.vide.min.js"></script>
        
    </body>
</html>
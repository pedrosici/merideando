<?php 
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    include('php/conexion.php');

    session_start();
    $id = $_SESSION['user_id'];

    if (isset($_GET['id'])){
        $id_cat = $_GET['id'];
        //Seleccionamos los datos referentes a la categoría elegida 
        $sql = "SELECT * FROM categorias WHERE id_categoria = ? ";
        $query = $con->prepare($sql);
        $query->execute(array($id_cat));
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        
        $miga = '<div class="col-xs-12 mg-bt-40">
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="categorias.php">Categorias</a></li>
                    <li class="active">'.$resultado['nombre_cat'].'</li>
                </ol>
                </div>';
    }
    else if (isset($_GET['idsubcat'])){
        $id_subcat = $_GET['idsubcat'];
         //Seleccionamos los datos referentes a la subcategoría elegida 
        $sql = "SELECT s.* , c.* FROM subcategorias s, categorias c WHERE s.categoria_id = c.id_categoria AND s.id_subcategoria = ?";
        $query = $con->prepare($sql);
        $query->execute(array($id_subcat));
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        
        $miga = '<div class="col-xs-12 mg-bt-40">
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="categorias.php">Categorias</a></li>
                    <li><a href="categoria.php?id='.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</a></li>
                    <li class="active">'.$resultado['nombre_subcat'].'</li>
                </ol>
                </div>';
    }
        
   
  
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
        
        <!--Import jQuery-->
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!-- jplist core -->
        <script src="js/jplist.core.min.js"></script>	
        <!-- jplist bootstrap sort dropdown control -->			
        <script src="js/jplist.bootstrap-sort-dropdown.min.js"></script>
        <script>
            $('document').ready(function(){
               $('#demo').jplist({				
                  itemsBox: '.list' 
                  ,itemPath: '.list-item' 
                  ,panelPath: '.jplist-panel'	
               });

            });
        </script>
    </head>

    <body>
        <!-- Incluimos el navbar o cabecera de la página -->
        <?php include "php/navbar.php"; ?>
        
    
    <div id="demo">
        <section class="main container-fluid mg-bt-40"> 
            <div class="col-sm-2 col-md-2 mg-tp-40 text-center pull-left">
                <div class="col-xs-12 section_title mg-bt-40">
                    <h4>CATEGORÍAS</h4>
                </div>
        <!-- Script php para las categorias -->
                <div class="col-xs-12 mg-bt-40">     
                    <select class="form-control" name="categoria" id="categoria"> 
                    <?php
                        if (isset($id_cat)){
                            $sql = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
                            $query = $con->prepare($sql);
                            $query->execute();
                            while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                                if ($resultado['id_categoria'] == $id_cat){
                                    echo '<option selected value="'.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</option>';
                                }
                                else{
                                    echo '<option value="'.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</option>';
                                    }
                                }
                        } elseif (isset($id_subcat)){
                            $sql = "SELECT s.* , c.* FROM subcategorias s, categorias c WHERE s.id_subcategoria = ?";
                            $query = $con->prepare($sql);
                            $query->execute(array($_GET['idsubcat']));
                            
                            while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                                if ($resultado['id_categoria'] == $resultado['categoria_id']){
                                    echo '<option selected value="'.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</option>';
                                }
                                else{
                                    
                                    echo '<option value="'.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</option>';
                                    }
                                }
                        }      
                        ?>
                    </select>
                </div>     
                <div class="col-xs-12 section_title text-center mg-bt-40">
                    <h4>SUBCATEGORÍAS</h4>
                </div>
                <div class="col-xs-12 mg-bt-40">
                    <select class="form-control" name="subcategoria" id="subcategoria">
                        <option value="0">Todas las subcategorías</option>
                    </select>
                </div>
                
                 <div class="col-xs-12 section_title text-center mg-bt-40">
                    <h4>FILTROS</h4>
                </div>
                <div class="col-xs-12 mg-bt-40">
                    <!-- panel -->
               <div class="jplist-panel">						

                  <!-- jplist bootstrap sort dropdown control -->
                  <div 
                     class="dropdown"
                     data-control-type="boot-sort-drop-down" 
                     data-control-name="bootstrap-sort-dropdown-demo" 
                     data-control-action="sort"
                     data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->
                    <button 
                     class="btn btn-default dropdown-toggle" 
                     type="button" 
                     id="sort-by-dropdown-btn" 
                     data-toggle="dropdown" 
                     aria-expanded="true">					
                     <span data-type="selected-text">Ordenar por</span>
                     <span class="caret"></span>						
                    </button>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                     <li role="presentation">
                        <a 
                           role="menuitem" 
                           tabindex="-1" 
                           href="#" 
                           data-path=".title" 
                           data-order="asc" 
                           data-type="text" 
                           data-default="true"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Orden Alfabético</a>
                     </li>
                     <li role="presentation" class="divider"></li>
                     <li role="presentation">
                        <a 
                           role="menuitem" 
                           tabindex="-1" 
                           href="#" 
                           data-path=".comentarios" 
                           data-order="desc" 
                           data-type="number"><i class="fa fa-comment-o" aria-hidden="true"></i> Más Comentados</a>
                     </li>	
                     <li role="presentation" class="divider"></li>
                     <li role="presentation">
                        <a 
                           role="menuitem" 
                           tabindex="-1" 
                           href="#" 
                           data-path=".fecha" 
                           data-order="desc" 
                           data-type="datetime"><i class="fa fa-calendar" aria-hidden="true"></i> Más Recientes</a>
                     </li>  
                    <li role="presentation" class="divider"></li>
                    <li role="presentation">
                        <a 
                           role="menuitem" 
                           tabindex="-1" 
                           href="#" 
                           data-path=".valoracion" 
                           data-order="desc" 
                           data-type="number"><i class="fa fa-star" aria-hidden="true"></i> Valoración</a>
                     </li>
                    </ul>
                  </div>                                 
               </div>
            </div>
        </div>

        <section class="col-xs-12 col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-1 mg-tp-40 mg-bt-80">     
        <?php
            if (isset($id_cat)){
                // Consulta SQL
                $sql= "SELECT anuncios.*, COUNT(comentarios.id_comentario) AS 'num_comentarios', subcategorias.nombre_subcat FROM anuncios LEFT JOIN comentarios ON anuncios.id_anuncio = comentarios.anuncio_id LEFT JOIN subcategorias ON anuncios.subcategoria_id = subcategorias.id_subcategoria WHERE anuncios.categoria_id = ? GROUP BY anuncios.id_anuncio";
                $query = $con->prepare($sql);
                $query->execute(array($id_cat));
                echo $miga;
          ?>      
                <div class="list">
               <?php  //Comprobamos si existen resultados
                if ($query->rowCount() > 0){           
                 while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){  ?> 
                    <div class="list-item">
                    <div class="listado-anuncios">
                        <div class="row">
                            <div class="col-xs-9 col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="img-thumbnail" src="images/anuncios/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['razon_soc']; ?>">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3 class="listado-titulo"><a class="title" href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>"><?php echo $resultado['razon_soc']; ?></a></h3>
                                        <p class="listado-categoria"> <?php echo $resultado['nombre_subcat']; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="hidden-xs col-sm-6 col-md-3 col-md-offset-0"><i class="fa fa-map-marker listado-ubicacion"></i> <?php echo $resultado['direccion']; ?></div>
                            
                            <div class="hidden-xs col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-2">
                                <?php
                                    if ($resultado['num_comentarios'] == 0){
                                        echo '<p><i class="fa fa-comment-o" aria-hidden="true"></i> <span class="comentarios">¡Sé el primero!</span></p>';
                                        } elseif ($resultado['num_comentarios'] == 1) {
                                            echo '<p> <i class="fa fa-comment" aria-hidden="true"></i> <span class="comentarios">'.$resultado['num_comentarios'].'</span> opinión</p>';
                                        } elseif ($resultado['num_comentarios'] > 1) { 
                                         echo '<p> <i class="fa fa-comments-o" aria-hidden="true"></i> <span class="comentarios">'.$resultado['num_comentarios'].'</span> opiniones</p>';
                                    }
                                ?>
                            </div>
                            <div class="hidden fecha"><?php echo $resultado['fecha'];?></div>
                            <div class="col-xs-3 col-sm-2 col-sm-offset-0 col-md-1">
                                <div class="listado-favorito">
                                    <?php
                              
                                          //Si el usuario está logueado
                                          if (isset($id)){
                                                $sql_fav = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id AND anuncio_id = :anuncio_id";
                                                $query_fav = $con->prepare($sql_fav);
                                                $query_fav->execute(array(':usuario_id'=>$id, ':anuncio_id'=> $resultado['id_anuncio']));
                                                $num_rows = $query_fav->fetchColumn();

                                               ///Si el usuario tiene algun anuncio marcado como favorito lo marcamos en rojo
                                                if ($num_rows > 0){
                                                    echo '<div id="heart'.$resultado['id_anuncio'].'" class="oneLine heart_icon on" rel="'.$id.'" data-toggle="tooltip" data-placement="right" title="Eliminar de mis favoritos"></div>';
                                                } else {
                                                    echo '<div id="heart'.$resultado['id_anuncio'].'" class="oneLine heart_icon off" rel="'.$id.'" data-toggle="tooltip" data-placement="right" title="Añadir a mis favoritos"></div>';
                                                }
                                         } else {
                                              echo '<div class="oneLine heart_icon off" data-toggle="tooltip" data-placement="right" title="¡Debes loguearte primero!"></div>';
                                          }
                                            ?>
                                 </div>
                            </div>
                                
                            </div>
                        </div> 
                    </div>
               <!-- FIN WHILE -->
                
                        
                        
                   <?php   }   
 
                        } //FIN IF
                    
                } else if (isset($id_subcat)){
                   // Consulta SQL
                    $sql= "SELECT anuncios.*, COUNT(comentarios.id_comentario) AS 'num_comentarios', subcategorias.nombre_subcat FROM anuncios LEFT JOIN comentarios ON anuncios.id_anuncio = comentarios.anuncio_id LEFT JOIN subcategorias ON anuncios.subcategoria_id = subcategorias.id_subcategoria WHERE anuncios.subcategoria_id = ? GROUP BY anuncios.id_anuncio";
                    $query = $con->prepare($sql);
                    $query->execute(array($id_subcat));
                    echo $miga;
                    //Comprobamos si existen resultados
                    if ($query->rowCount() > 0){ ?>
                    <?php 
                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){  ?>
                            <div class="listado-anuncios">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <img class="img-thumbnail" src="images/anuncios/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['razon_soc']; ?>">
                                            </div>
                                            <div class="col-xs-9">
                                                <h3 class="listado-titulo"><a href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>"><?php echo $resultado['razon_soc']; ?></a></h3>
                                                <p class="listado-categoria"> <?php echo $resultado['nombre_subcat']; ?></p>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-10 col-xs-offset-2 col-sm-6 col-md-3 col-md-offset-0"><i class="fa fa-map-marker listado-ubicacion"></i> <?php echo $resultado['direccion']; ?></div>

                                    <div class="col-xs-10 col-xs-offset-2 col-sm-4 col-sm-offset-0 col-md-2">
                                        <?php
                                            if ($resultado['num_comentarios'] == 1){
                                                    echo '<p><i class="fa fa-comment-o" aria-hidden="true"></i> '.$resultado['num_comentarios'].' opinión </p>';
                                                } else {
                                                    echo '<p> <i class="fa fa-comments-o" aria-hidden="true"></i> '.$resultado['num_comentarios'].' opiniones</p>';
                                                }                                      
                                        ?>
                                    </div>

                                    <div class="hidden fecha"><?php echo $resultado['fecha'];?></div>
                                        <div class="col-xs-10 col-xs-offset-2 col-sm-2 col-sm-offset-0 col-md-1">
                                            <div class="listado-favorito">
                                            <?php
                              
                                          //Si el usuario está logueado
                                          if (isset($id)){
                                                $sql_fav = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id AND anuncio_id = :anuncio_id";
                                                $query_fav = $con->prepare($sql_fav);
                                                $query_fav->execute(array(':usuario_id'=>$id, ':anuncio_id'=> $resultado['id_anuncio']));
                                                $num_rows = $query_fav->fetchColumn();

                                               ///Si el usuario tiene algun anuncio marcado como favorito lo marcamos en rojo
                                                if ($num_rows > 0){
                                                    echo '<div id="heart'.$resultado['id_anuncio'].'" class="oneLine heart_icon on" rel="'.$id.'" data-toggle="tooltip" data-placement="right" title="Eliminar de mis favoritos"></div>';
                                                } else {
                                                    echo '<div id="heart'.$resultado['id_anuncio'].'" class="oneLine heart_icon off" rel="'.$id.'" data-toggle="tooltip" data-placement="right" title="Añadir a mis favoritos"></div>';
                                                }
                                         } else {
                                              echo '<div class="oneLine heart_icon off" data-toggle="tooltip" data-placement="right" title="¡Debes loguearte primero!"></div>';
                                          }
                                            ?>
                                             </div>
                                        </div>

                                    </div>
                                </div>   
            <?php
                                                                         
                        } // FIN WHILE
                
                    }
                
                } else {
                    echo '<div class="col-sm-12 mg-tp-80 text-center">
                            <h4>No existen anuncios para esta categoría</h4>
                          </div>';
                }
                            
            ?>
                </div>
            </section> 
        </section>
     </div>            
        <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>

        <!-- Rellenar combobox subcategorías -->    
        <script>
             $(document).ready(function(){
                  
                //Cuando el combo de categorias cambie de valor
                
                    $("#categoria option:selected").each(function(){
                        //Guardamos la seleccion de la categoria
                        id_cat = $(this).val();
                       
                        //Llamamos al archivo que manda el id de la subcategoría
                        $.post("php/crear_anuncio.php", {id_categoria: id_cat}, function(data){
                            //Le devolvemos ese id_subcat al option del combobox de subcategorias
                            $("#subcategoria").html(data);
                        });
                    });
               
                 
                 
            }); 
        </script>
        
        <script type="text/javascript">
       $(".heart_icon").mouseout(function() {
          $(this).removeAttr("style");
        });
 
        $(".heart_icon").on("click", function(){ // Click event (when user click on the heart button)
            var getMediaId = $(this).attr("id").split("heart");
            console.log(getMediaId);
            var anuncioId = getMediaId[1]; // Result is the media Id from div called "heart"

            // Check if Class Attribut contains "off". If yes then the new value (when user click) will be 1. Else the new value will be 0.
            if ( $(this).attr("class").indexOf('off') !== -1 ) var value = 1; else var value = 0;

            // Get the user Id
            var userId=$(this).attr("rel");

            var dataFields = {'anuncioId': anuncioId, 'userId': userId, 'value': value}; // We pass the 3 arguments
            $.ajax({ // Ajax
                type: "POST",
                url: "php/favoritos.php",
                data: dataFields,
                timeout: 3000,
                success: function(dataBack){
                    },
                error: function() {}
            });

            // If the value is 1 we update the Class and run the CSS3 Animation
            if (value == 1) {
                $("#heart" + anuncioId).removeClass("off").addClass("on heartAnimation");
                // We increment the counter (+1)
                $("#heart_num_vote" + anuncioId).text(parseInt($("#heart_num_vote" + anuncioId).text()) + 1);
            }	
            if (value == 0) {
                $("#heart" + anuncioId).removeClass("on heartAnimation").addClass("off").css("background-position","left");
                $("#heart_num_vote" + anuncioId).text(parseInt($("#heart_num_vote" + anuncioId).text()) - 1);
            }
        });
        
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
        
        <script>
            $('#categoria').on('change', function() {
              window.open('categoria.php?id=' + this.value, "_self");
            })
            
            $('#subcategoria').on('change', function(){
                window.open('categoria.php?idsubcat=' + this.value, "_self");
            })
        
        </script>
     </body>
</html>
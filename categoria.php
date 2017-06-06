<?php 
    //Evitamos que nos salgan los NOTICES de PHP
    error_reporting(E_ALL ^ E_NOTICE);
    include('php/conexion.php');

    session_start();
    $id = $_SESSION['user_id'];

    if (isset($_GET['id'])){
         $id_cat = $_GET['id'];
         //Seleccionamos los datos referentes a la categoría elegida 
        $sql = "SELECT * FROM categorias WHERE id_categoria='{$_GET['id']}'";
    }
    else if (isset($_GET['idsubcat'])){
        $id_subcat = $_GET['idsubcat'];
         //Seleccionamos los datos referentes a la categoría elegida 
        $sql = "SELECT s.* , c.icono FROM subcategorias s, categorias c WHERE s.categoria_id = c.id_categoria AND s.id_subcategoria ='{$_GET['idsubcat']}'";
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
    </head>

    <body>
        <!-- Incluimos el navbar o cabecera de la página -->
        <?php include "php/navbar.php"; ?>
        
        <section class="categorias">
            <div class="container">
                <div class="row"> 
                    
             <?php 
                if (isset($id_cat)){
                    //Comprobamos si existen resultados
                    $query = $con->prepare($sql);
                    $query->execute(array());
                    //Comprobamos si existen resultados
                    if ($query->rowCount() > 0){
                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                        echo '<div class="section_title text-center mg-tp-80 mg-bt-40">				     <h2>'.$resultado['nombre_cat'].'</h2>
							     <h4>Encuentra los anuncios más relevantes en esta categoría</h4>
							     <div class="icon_wrap"><i class="fa '.$resultado['icono'].'"></i></div>
				                </div>';
                        }
                    }
                } else if (isset($id_subcat)){
                    //Comprobamos si existen resultados
                    $query = $con->prepare($sql);
                    $query->execute(array());
                    //Comprobamos si existen resultados
                    if ($query->rowCount() > 0){
                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                        echo '<div class="section_title text-center mg-tp-80 mg-bt-40">				     <h2>'.$resultado['nombre_subcat'].'</h2>
							     <h4>Encuentra los anuncios más relevantes en esta subcategoría</h4>
							     <div class="icon_wrap"><i class="fa '.$resultado['icono'].'"></i></div>
				                </div>';
                        }
                    }
                }
                   
                ?>  
                </div>
            </div>
        </section> 
        
        <section class="main container-fluid mg-bt-40"> 
            <div class="col-sm-3 col-md-3 mg-bt-40 pull-left">
                <div class="section_title text-center mg-bt-40">
                    <h3><i class="fa fa-align-justify"></i> Categorias</h3>
                </div>
        <!-- Script php para las categorias -->
                <div class="mg-bt-40">     
                    <select class="form-control" name="categoria" id="categoria"> 
                    <?php
                        $sql = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
                        $query = $con->prepare($sql);
                        $query->execute();
                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
                            if ($resultado['id_categoria'] == $id_cat){
                                echo '<option selected value="'.$resultado['id_categoria'].'>">'.$resultado['nombre_cat'].'</option>';
                            }
                            else{
                                echo '<option value="'.$resultado['id_categoria'].'">'.$resultado['nombre_cat'].'</option>';
                                }
                        ?>
                                
                            <?php   } ?>
                    </select>
                </div>     
                <div class="section_title text-center mg-bt-40">
                    <h3><i class="fa fa-align-justify"></i> Subcategorías</h3>
                </div>
                <div class="mg-bt-40">
                    <select class="form-control" name="subcategoria" id="subcategoria">
                        <option value="0">Todas las subcategorías</option>
                    </select>
                </div>
            </div>

        <section class="col-sm-9 col-md-9">
        <?php
            if (isset($id_cat)){
                // Consulta SQL
                $sql= "SELECT anuncios.*, COUNT(comentarios.id_comentario) AS 'num_comentarios', subcategorias.nombre_subcat FROM anuncios LEFT JOIN comentarios ON anuncios.id_anuncio = comentarios.anuncio_id LEFT JOIN subcategorias ON anuncios.subcategoria_id = subcategorias.id_subcategoria WHERE anuncios.categoria_id = ? GROUP BY anuncios.id_anuncio";
                $query = $con->prepare($sql);
                $query->execute(array($id_cat));
                //Comprobamos si existen resultados
                if ($query->rowCount() > 0){
                    while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){  ?>
                        
                    <div class="listado-anuncios">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="img-thumbnail" src="images/anuncios/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['razon_soc']; ?>">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3 class="listado-titulo"><a href="anuncio.php?id='.$resultado['id_anuncio'].'"><?php echo $resultado['razon_soc']; ?></a></h3>
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
                            
                            <div class="col-xs-10 col-xs-offset-2 col-sm-2 col-sm-offset-0 col-md-1">
                                <div class="listado-favorito">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" class="estrella" data-original-title=">Guardar como favorito"><i class="fa fa-star fa-2x"></i></a>
                                 </div>
                            </div>
                                
                            </div>
                        </div>  
               <!-- FIN WHILE -->
                
                        
                        
                   <?php   }   /* echo '<div class="col-sm-12 list-group">
                                <div class="wrapper">
                                <a href="anuncio.php?id='.$resultado['id_anuncio'].'">
                                    <div class="item-list">
                                        <div class="col-sm-4 col-xs-3">
                                            <img class="img-rounded" src="images/'.$resultado['imagen'].'" alt="logo" width="200">
                                        </div>
                                        <div class="info-list col-sm-6 col-xs-7">
                                            <a href="anuncio.php?id='.$resultado['id_anuncio'].'"><h4 class="title">'.$resultado['razon_soc'].'</h4></a>
                                            <h5 class="subtitulo"><i class="fa fa-map-marker"></i> '.$resultado['direccion'].' <i class="fa fa-align-justify"></i> '.$resultado['nombre_subcat'].'</h5>';
                                        
                                        if ($resultado['num_comentarios'] == 1){
                                            echo '<h5><i class="fa fa-comment-o" aria-hidden="true"></i> '.$resultado['num_comentarios'].' opinión </h5>';
                                        } else {
                                            echo '<h5> <i class="fa fa-comments-o" aria-hidden="true"></i> '.$resultado['num_comentarios'].' opiniones</h5>';
                                        }
                                            
                                            
                                        echo '</div>
                                        <div class="col-sm-2 col-xs-2">
                                              <a href="anuncio.php?id='.$resultado['id_anuncio'].'" class="btn btn-primary btn-sm"><i class="fa fa-eye fa-2x"></i> Ver</a>
                                        </div>
                                        </a>
                                    </div>
                                    
                                </div>';*/
 
                        } //FIN IF
                    
                } else if (isset($id_subcat)){
                   // Consulta SQL
                    $sql= "SELECT anuncios.*, COUNT(comentarios.id_comentario) AS 'num_comentarios', subcategorias.nombre_subcat FROM anuncios LEFT JOIN comentarios ON anuncios.id_anuncio = comentarios.anuncio_id LEFT JOIN subcategorias ON anuncios.subcategoria_id = subcategorias.id_subcategoria WHERE anuncios.subcategoria_id = ? GROUP BY anuncios.id_anuncio";
                    $query = $con->prepare($sql);
                    $query->execute(array($id_subcat));
                    //Comprobamos si existen resultados
                    if ($query->rowCount() > 0){
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

                                    <div class="col-xs-10 col-xs-offset-2 col-sm-2 col-sm-offset-0 col-md-1">
                                        <div class="listado-favorito">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" class="estrella" data-original-title=">Guardar como favorito"><i class="fa fa-star fa-2x"></i></a>
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
           
        </section>
           
    </section>
                
        <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script src="js/jquery.vide.min.js"></script>
        
        <!-- Rellenar combobox subcategorías -->    
        <script>
             $(document).ready(function(){
                  
                //Cuando el combo de categorias cambie de valor
                $("#categoria").change(function(){
                    $("#categoria option:selected").each(function(){
                        //Guardamos la seleccion de la categoria
                        id_cat = $(this).val();
                        //Llamamos al archivo que manda el id de la subcategoría
                        $.post("php/crear_anuncio.php", {id_categoria: id_cat}, function(data){
                            //Le devolvemos ese id_subcat al option del combobox de subcategorias
                            $("#subcategoria").html(data);
                        });
                    });
                })
                 
                 
            }); 
        </script>
     </body>
</html>
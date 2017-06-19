<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
include('php/conexion.php');

$sesion = false;
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
	print "<script>window.location='login.php';</script>";
}
else{
    $sesion = true;
    $nombre = $_SESSION['nombre'];
    $id = $_SESSION['user_id'];
}


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
         <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
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
        if ($id == 1){ ?>  
            <div class="col-md-12 col-xs-12">
                <div class="slider_text text-center">
                    <h2><i class="fa fa-lock" aria-hidden="true"></i> Hola, <?php echo $nombre; ?></h2>
                    <div class="single_welcome">
				        <p>Desde aquí podrás consultar las estadísticas de su sitio y administrar los anuncios, usuarios y comentarios existentes.</p>
				</div>
              </div>
            </div> 
        <?php
            $sql ="SELECT (SELECT COUNT(id_anuncio) FROM  anuncios) AS num_anuncios,
                (SELECT COUNT(id_comentario) FROM  comentarios) AS num_comentarios,
                (SELECT COUNT(id) FROM usuarios) AS num_usuarios"; 
            $query = $con->prepare($sql);
            $query->execute();
            if ($resultado = $query->fetch(PDO::FETCH_ASSOC)){        
            ?>
            <div class="row mg-bt-40">
                <div class="col-xs-4">
                    <div class="card card-inverse card-success">
                        <div class="card-block bg-success">
                            <div class="rotate">
                                <i class="fa fa-bullhorn fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Anuncios totales publicados</h6>
                            <h1 class="display-1"><?php echo $resultado['num_anuncios']; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="card card-inverse card-info">
                        <div class="card-block bg-info">
                            <div class="rotate">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Comentarios totales publicados</h6>
                            <h1 class="display-1"><?php echo $resultado['num_comentarios']; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="card card-inverse card-danger">
                        <div class="card-block bg-danger">
                            <div class="rotate">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Usuarios totales registrados</h6>
                            <h1 class="display-1"><?php echo $resultado['num_usuarios']; ?></h1>
                        </div>
                    </div>
                </div>
                                                    
            </div>
            
    <?php } else {
                echo '<p>No se pudieron mostrar las estadísticas</p>';
            }
            
    ?>
            
            <div class="col-md-12 mg-bt-80" role="tablist">
                <ul id="tabs" class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#anuncios" role="tab" data-toggle="tab">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i>
                        </span>Anuncios de los usuarios</a>
                    </li>
                    <li role="presentation"><a href="#perfil" role="tab" data-toggle="tab">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                        </span> Usuarios registrados</a>
                    </li>
                    <li role="presentation"><a href="#opiniones" role="tab" data-toggle="tab">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-comments-o fa-stack-1x fa-inverse"></i>
                        </span>Opiniones de los usuarios</a>
                    </li>
                           
                </ul>
                                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="anuncios">
                        <div class="col-md-12 mg-tp-40"></div>
                                            
<!--
                            <table border="0" align="center">
                                <tr>
                                    <td width="100"><a href="#crear-anuncio" class="btn btn-default btn-md" data-toggle="modal"><i class="fa fa-bullhorn" aria-hidden="true"></i> Crear nuevo anuncio</a></td>
                                </tr>
                            </table>           
-->
                        
                        <div class="col-md-12">    
                            <table id="all_anuncios" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Categoría</th>        
                                        <th>Valoración Media</th>
                                        <th>Enlace</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>           
                            </table> 
                            <div id="mensaje-anuncio"></div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade in" id="perfil">
                        <div class="col-md-12 mg-tp-40"></div>
                        <div class="col-md-12">    
                            <table id="all_usuarios" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nombre de Usuario</th>
                                        <th>Nombre Completo</th>
                                        <th>Email</th>
                                        <th>Fecha Creación</th>        
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>           
                            </table> 
                            <div id="mensaje-user"></div>
                        </div>
                    </div>
                         
                    <div role="tabpanel" class="tab-pane fade in" id="opiniones">
                        <div class="mg-bt-40"></div>
                        <div class="col-md-12">    
                            <table id="all_comentarios" class="table table-bordered table-hover text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Anuncio</th>
                                        <th>Título Comentario</th>
                                        <th>Autor</th>
                                        <th>Valoración</th>
                                        <th>Enlace</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>           
                            </table> 
                            <div id="mensaje-coment"></div>
                        </div>
                    </div>   
                     
                </div> <!-- FIN TAB CONTENT -->
            </div>
                            
                            
        <?php 
            } else {

        ?>
                            <div class="col-md-12 col-xs-12">
                                <div class="slider_text text-center">
                                    <h2><i class="fa fa-hand-peace-o" aria-hidden="true"></i> Hola, <?php echo $nombre; ?></h2>
                                     <div class="single_welcome">
								        <blockquote><p>Estas en tu panel de administración como usuario de Merideando. Desde aquí podrás publicar y modificar tus propios anuncios.<br>
                                         Para empezar, pincha en "Crear nuevo anuncio", a continuación deberás rellenar los datos del mismo. <br>Intenta ser lo más claro y conciso posible, esto ayudará a que los usuarios se fijen en el y tengas una mejor valoración.</p></blockquote>
							         </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mg-bt-80" role="tablist">
                                <ul id="tabs" class="nav nav-tabs">
                                    <li role="presentation" class="active"><a href="#anuncios" role="tab" data-toggle="tab">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i>
                                        </span> Mis Anuncios</a>
                                    </li>
                                    <li role="presentation"><a href="#perfil" role="tab" data-toggle="tab">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                                        </span> Mi perfil</a>
                                </li>
                                    <li role="presentation"><a href="#opiniones" role="tab" data-toggle="tab">
                                       <span class="fa-stack fa-lg">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-comments-o fa-stack-1x fa-inverse"></i>
                                        </span> Mis Opiniones</a>
                                    </li>
                                    <li role="presentation"><a href="#favoritos" role="tab" data-toggle="tab">
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                                        </span> Mis Favoritos</a></li> 
                                    
                                </ul>
                                
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="anuncios">
                                        <div class="col-md-12 mg-tp-40">
                                            
                                            <table border="0" align="center">
                                                <tr>
                                                    <td width="100"><a href="#crear-anuncio" class="btn btn-default btn-md" data-toggle="modal"><i class="fa fa-bullhorn" aria-hidden="true"></i> Crear nuevo anuncio</a></td>
                                                </tr>
                                            </table>
                                          
                                        </div>
                                        
                                 
                                        
                                        
                                        <!--<div class="col-md-12 col-xs-12 ">
                                            <div class="registros" id="agrega-anuncio">
                                               <table class="table table-striped table-condensed table-hover table-bordered text-center">-->
                                        <div class="col-md-12">    
                                            <table id="mis_anuncios" class="table  table-bordered table-hover text-center" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Imagen</th>
                                                    <th>Categoría</th>        
                                                    <th>Valoración Media</th>
                                                    <th>Enlace</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                
                                            </table> 
                                            <div id="mensaje"></div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                        $sql ="SELECT nombre, usuario, email, fecha_creacion, password,
                                            (SELECT COUNT(id_anuncio)
                                             FROM  anuncios WHERE anuncios.usuario_id = usuarios.id) AS num_anuncios,
                                            (SELECT COUNT(id_comentario)
                                            FROM  comentarios 
                                             WHERE comentarios.usuario_id = usuarios.id
                                            ) AS num_comentarios,
                                            (SELECT COUNT(id_fav) 
                                             FROM favoritos 
                                            WHERE favoritos.usuario_id = usuarios.id 
                                            ) AS num_favoritos
                                            FROM usuarios 
                                             WHERE usuarios.id = ?";
                   
                                        $query = $con->prepare($sql);
                                        $query->execute(array($id));
                                         if ($resultado = $query->fetch(PDO::FETCH_ASSOC)){

                                    ?>
                                    <div role="tabpanel" class="tab-pane fade in" id="perfil">
                                        <div class="panel panel-info mg-tp-40">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Datos de tu Perfil de Usuario</h3>
                                            </div>
                                            <div class="panel-body">
                                              <div class="row">
                                                <div class=" col-md-12 col-lg-12 text-center"> 
                                                  <table class="table table-user-information no-border">
                                                    <tbody>
                                                      <tr>
                                                        <td>Tu Nombre:</td>
                                                        <td><?php echo $resultado['nombre']; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Tu Usuario:</td>
                                                        <td><?php echo $resultado['usuario']; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Tu Email:</td>
                                                        <td><a href="<?php echo $resultado['email']; ?>"><?php echo $resultado['email']; ?></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Fecha Creación Cuenta:</td>
                                                        <td><?php echo $resultado['fecha_creacion']; ?></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                  
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="card card-inverse card-success">
                                                            <div class="card-block bg-success">
                                                                <div class="rotate">
                                                                    <i class="fa fa-bullhorn fa-5x"></i>
                                                                </div>
                                                                <h6 class="text-uppercase">Anuncios publicados</h6>
                                                                <h1 class="display-1"><?php echo $resultado['num_anuncios']; ?></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="card card-inverse card-info">
                                                            <div class="card-block bg-info">
                                                                <div class="rotate">
                                                                    <i class="fa fa-comments fa-5x"></i>
                                                                </div>
                                                                <h6 class="text-uppercase">Comentarios publicados</h6>
                                                                <h1 class="display-1"><?php echo $resultado['num_comentarios']; ?></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="card card-inverse card-danger">
                                                            <div class="card-block bg-danger">
                                                                <div class="rotate">
                                                                    <i class="fa fa-heart fa-5x"></i>
                                                                </div>
                                                                <h6 class="text-uppercase">Anuncios favoritos</h6>
                                                                <h1 class="display-1"><?php echo $resultado['num_favoritos']; ?></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                            <?php } 
                                    
                            $sql = "SELECT com.*, a.razon_soc, a.id_anuncio, a.valor_medio
                                    FROM comentarios com INNER JOIN usuarios u ON com.usuario_id = u.id INNER JOIN anuncios a ON com.anuncio_id = a.id_anuncio
                                    WHERE u.id = ?";
                            $query = $con->prepare($sql);
                            $query->execute(array($id));
                            ?>
                                    
                            <div role="tabpanel" class="tab-pane fade in" id="opiniones">
                                <div class="col-md-12 mg-tp-40 text-center"> 
                                    <div class="col-sm-12 mg-bt-40">
                                        <h3>Historial de tus comentarios publicados</h3>
                                    </div>
                                    
                                    
                            <?php
                            if ($query->rowCount() > 0){
                                
                            ?>
                            <table class="table table-striped table-bordered table-list text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="150">Anuncio</th>
                                        <th class="text-center" width="50">Título del comentario</th>
                                        <th class="text-center" width="50">Tu valoración</th>
                                        <th class="text-center" width="50">Valoración Media</th>
                                        <th class="text-center" width="25">Fecha</th>
                                        <th class="text-center" width="50">Enlace</th>
                                    </tr>
                                </thead>
                           
                             <?php
                                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                                   <tr>
                                        <td><?php echo $resultado['razon_soc']; ?></td>
                                        <td><?php echo $resultado['titulo']; ?></td>
                                        <td><?php echo $resultado['valoracion']; ?>/5</td>
                                        <td><?php echo $resultado['valor_medio']; ?>/5</td>
                                        <td><?php echo $resultado['fecha_comentario']; ?></td>
                                        <td><a href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a></td>
                                    </tr>
                        <?php  } ?>
                           </table>
                    <?php    } else {
                               echo '<div class="col-sm-12 mg-tp-40 mg-bt-40 text-center">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No tienes publicada aún ninguna valoración</h4>
                                            </div>
                                        </div>
                                    </div>';
                            } ?>
                            
                                    
                                </div>
                            </div>   
                             <?php 
                                $sql = "SELECT a.id_anuncio, a.razon_soc, a.imagen, a.valor_medio
                                        FROM favoritos f INNER JOIN anuncios a ON f.anuncio_id = a.id_anuncio
                                        WHERE f.usuario_id = ?";
                                $query = $con->prepare($sql);
                                $query->execute(array($id));
                            ?>
                                    
                            <div role="tabpanel" class="tab-pane fade in" id="favoritos">
                                 <div class="col-md-12 mg-tp-40">  
                                     <div class="col-sm-12 mg-bt-40 text-center">
                                        <h3>Anuncios marcados como favoritos</h3>
                                    </div>
                                     
                                <?php
                                        
                            if ($query->rowCount() > 0){ ?>
                                <table class="table table-striped table-bordered table-list text-center"> 
                                    <thead class="success">
                                        <tr>
                                            <th class="text-center" width="150">Anuncio</th>
                                            <th class="text-center" width="50">Logo</th>
                                            <th class="text-center" width="50">Valoración Media</th>
                                            <th class="text-center" width="50">Enlace</th>
                                            
                                        </tr>
                                    </thead> 
                                 <?php   
                                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                                            <tr>
                                                <td><?php echo $resultado['razon_soc']; ?></td>
                                                <td><img class="img-rounded" src="images/anuncios/<?php echo $resultado['imagen']; ?>" height="30"></td>
                                                <td><?php echo $resultado['valor_medio']; ?>/5</td>
                                                <td><a href="anuncio.php?id=<?php echo $resultado['id_anuncio']; ?>" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a></td>
                                                
                                            </tr>
                                   <?php } ?>
                                    
                                       </table>
                                     
                            <?php  } else {
                                echo '<div class="col-sm-12 mg-tp-40 mg-bt-40 text-center">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No tienes ningún anuncio marcado como favorito</h4>
                                            </div>
                                        </div>
                                    </div>';
                            } ?>
                                    
                                    
                                </div>
                            </div>
                        </div> <!-- FIN TAB CONTENT -->
                    </div>
            <?php  } ?>
                </div>
            </div>
       
   <!-- MODAL PARA CREAR ANUNCIOS -->     

        <div class="modal fade" data-backdrop="false" id="crear-anuncio" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3>Crea tu anuncio</h3>
                   </div>
                    <form id="formulario" method="post" role="form" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="razon">Razón Social*</label>
                                        <input type="text" class="form-control col-md-6" name="razon" placeholder="Introduce un nombre" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cif">NIF*</label>
                                         <input type="text" class="form-control col-md-6" name="cif" id="identidad" placeholder="Introduce un NIF" pattern="^(([A-Z])|\d)?\d{8}(\d|[A-Z])?$" title="Introduce un NIF válido" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono">Teléfono*</label>
                                        <input type="text" class="form-control" name="telefono" id="tel" pattern="[0-9]{9}" title="Introduce sólo números y máximo 9" placeholder="Teléfono de contacto" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="direccion">Dirección física</label> (Ej: John Lennon, 36)
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">E-mail*</label>
                                        <input type="text" class="form-control" name="email" placeholder="E-mail de contacto" required>
                                    </div>
                                    
                                </div>
                            
                            
                            <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="categoria">Categoría</label>
                                        
                                        <select class="form-control" name="categoria" id="categoria">
                                            <option value="0">Elige la categoría de tu anuncio</option>
                                    <?php
                                        $sql = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
                                        $query = $con->prepare($sql);
                                        $query->execute();

                                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                                            <option value="<?php echo $resultado['id_categoria']?>"><?php echo $resultado['nombre_cat']?></option>
                                    <?php   } ?>
      
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoria">Subcategoría</label>
                                        <select class="form-control" name="subcategoria" id="subcategoria">
                                           <option value="0">Elige una categoría</option>
                                        </select>
                                    </div>
                                    
                             </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="descripcion">Descripción* (Máximo 500 caracteres)</label>
                                    <textarea class="form-control" rows="5" name="descripcion" id="descripcion" maxlength="500" onKeyDown="contarCaracteres()" onKeyUp="contarCaracteres()" placeholder="Describe tu negocio" required></textarea>
                                    <input type="text"  style=" border:none" value="0 caracteres introducidos"  id="result" readonly>
                                </div>
                                <!-- PASAMOS OCULTO EL ID DEL USUARIO QUE CREA EL ANUNCIO -->
                                <input type="hidden" name="id_usuario" value="<?php echo '.$id.'?>">
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="web">Web de tu negocio</label>
                                   <div class="input-group">
                                        <span class="input-group-addon primary"><span>http://</span></span>
                                        <input type="text" class="form-control" name="web" id="web" placeholder="Url de mi web">
                                        <span class="input-group-addon primary"><span class="fa fa-link"></span></span>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="web">Redes sociales</label>
                                   <div class="input-group">
                                        <span class="input-group-addon primary"><span>@</span></span>
                                        <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter">
                                        <span class="input-group-addon primary"><span class="fa fa-twitter"></span></span>
                                   </div>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon primary"><span>@</span></span>
                                        <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram">
                                        <span class="input-group-addon primary"><span class="fa fa-instagram"></span></span>
                                    </div>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon primary"><span>facebook.com/</span></span>
                                        <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Facebook">
                                        <span class="input-group-addon primary"><span class="fa fa-facebook"></span></span>
                                   </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="logo">Logo*</label>
                                    <input type="file" name="logo" id="imagen" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4" id="imagen_previa">
                                    <img class="img-responsive col-xs-6" id="vistaprevia" src="images/noimage.png" width="100%" />
                                </div>
                                <div id="error-img"></div>
                            </div>
                            <div class="form-group row">
                                
                            </div>
                        </div>
                   <div class="modal-footer">
                        <p style="float:left;">* Campos Obligatorios</p>
                        <button type="submit" name="submit" class="btn btn-success" id="crear">Crear anuncio</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                   </div>
                </form>
              </div>
           </div>
        </div>
        
        <!-- MODAL PARA EDITAR ANUNCIOS -->     

        <div class="modal fade" data-backdrop="false" id="editar-anuncio" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3>Edita tu anuncio</h3>
                   </div>
                    <form id="formulario-editar" method="POST" role="form" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="razon">Razón Social*</label>
                                        <input type="text" class="form-control col-md-6" name="razon" id="razon_soc"  placeholder="Introduce un nombre" required />
                                    </div>
                               <div class="col-md-4">
                                        <label for="cif">NIF*</label>
                                        <input type="text" class="form-control col-md-6" name="cif" id="nif" placeholder="Introduce un NIF"   />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telefono">Teléfono*</label>
                                        <input type="text" class="form-control" name="telefono" id="phone" pattern="[0-9]{9}" placeholder="Teléfono de contacto" required />
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="direccion">Dirección física (Ej: John Lennon, 36)</label>
                                        <input type="text" class="form-control" name="direccion" id="direc" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">E-mail*</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail de contacto" required>
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="categoria">Categoría</label>
                                        <select class="form-control" name="categoria" id="id_cat">
                                    <?php
                                        $sql = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
                                        $query = $con->prepare($sql);
                                        $query->execute();

                                        while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                                            <option value="<?php echo $resultado['id_categoria']?>"><?php echo $resultado['nombre_cat']?></option>
                                    <?php   } ?>
      
                                        </select>
                                    </div>
                                <div class="col-md-6">
                                        <label for="categoria">Subcategoría</label>
                                        <select class="form-control" name="subcategoria" id="subcat">
                                           <option value="0">Elige una categoría</option>
                                        </select>
                                    </div>
                                    
                             </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="descripcion">Descripción* (Máximo 500 caracteres)</label>
                                    <textarea class="form-control" rows="5" name="descripcion" placeholder="Describe tu negocio" id="descrip" required></textarea>
                                </div>
                                <!-- PASAMOS OCULTO EL ID DEL USUARIO QUE CREA EL ANUNCIO -->
                                <input type="hidden" name="id_usuario" value="<?php echo '.$id.'?>">
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="web">Web de tu negocio</label>
                                   <div class="input-group">
                                        <span class="input-group-addon primary"><span>http://</span></span>
                                        <input type="text" class="form-control" name="web" id="url" placeholder="Url de mi web" />
                                        <span class="input-group-addon primary"><span class="fa fa-link"></span></span>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="web">Redes sociales</label>
                                   <div class="input-group">
                                        <span class="input-group-addon primary"><span>@</span></span>
                                        <input type="text" class="form-control" name="twitter" id="twit" placeholder="Twitter" />
                                        <span class="input-group-addon primary"><span class="fa fa-twitter"></span></span>
                                   </div>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon primary"><span>@</span></span>
                                        <input type="text" class="form-control" name="instagram" id="insta" placeholder="Instagram" />
                                        <span class="input-group-addon primary"><span class="fa fa-instagram"></span></span>
                                    </div>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon primary"><span>facebook.com/</span></span>
                                        <input type="text" class="form-control" name="facebook" id="fb" placeholder="Facebook">
                                        <span class="input-group-addon primary"><span class="fa fa-facebook"></span></span>
                                   </div>
                                  
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="logo">Logo*</label>
                                    <input type="file" name="logonuevo" id="logo" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4" id="imagen-previa">
                                    <img class="img-responsive" src="images/noimage.png" id="img" width="70%" />
                                </div>
                            </div>
                            <!-- PASAMOS OCULTO EL ID DEL ANUNCIO QUE CREA EL ANUNCIO -->
                                <input type="hidden" id="id_anuncio" name="anuncio"/>
                        </div> <!-- FIN MODAL BODY -->
                        
                       <div class="modal-footer">
                            <button type="submit" class="btn btn-success" value="Editar" id="Editar">Editar anuncio</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                       </div>
                    </form> <!-- FIN FORM -->
              </div>
           </div>
        </div>
        
        <!-- MODAL ELIMINAR ANUNCIO -->
        <div class="modal fade" data-backdrop="false" id="eliminar-anuncio" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar anuncio</h4>
              </div>
                <div class="col-sm-12">
                <p>¿Estás seguro de que deseas eliminar este anuncio?</p>
                 </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" data-dismiss="modal" onClick="eliminarAnuncio();" class="btn btn-danger">Sí</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- MODAL ELIMINAR USUARIO -->
        <div class="modal fade" data-backdrop="false" id="eliminar-usuario" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Usuario</h4>
              </div>
                <div class="col-sm-12">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                 </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" data-dismiss="modal" onClick="eliminarUsuario();" class="btn btn-danger">Sí</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- MODAL ELIMINAR COMENTARIO -->
        <div class="modal fade" data-backdrop="false" id="eliminar-comentario" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Usuario</h4>
              </div>
                <div class="col-sm-12">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                 </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" data-dismiss="modal" onClick="eliminarComentario();" class="btn btn-danger">Sí</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
    <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
    <!--Import jQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>  
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>          
    <script src="js/datatable_anuncio.js"></script>
    <script src="js/datatable_anuncio_admin.js"></script>
    <script src="js/datatable_usuario_admin.js"></script>
    <script src="js/datatable_comentario_admin.js"></script>
        
   
   
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
        
        <script>
             $(document).ready(function(){
                  
                 //Cuando el combo de categorias cambie de valor
                $("#id_cat").change(function(){
                    $("#id_cat option:selected").each(function(){
                        //Guardamos la seleccion de la categoria
                        id_cat = $(this).val();
                        //Llamamos al archivo que manda el id de la subcategoría
                        $.post("php/crear_anuncio.php", {id_categoria: id_cat}, function(data){
                            //Le devolvemos ese id_subcat al option del combobox de subcategorias
                            $("#subcat").html(data);
                            
                        });
                    });
                })
                 
                 
            }); 
        </script>
        
        <script>
             function contarCaracteres(){
                $("#result").val($("#descripcion").val().length + " caracteres introducidos "); 
             }
        </script>
        
    </body>
  </html>
<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);
include('php/conexion.php');

$sesion = false;
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
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
                            <div class="col-md-12 col-xs-12">
                                <div class="slider_text text-center">
                                    <h2 >Hola, <?php echo $nombre; ?></h2>
                                     <div class="single_welcome">
								        <p>Estas en tu panel de administración como usuario de Merideando.<br> Desde aquí podrás publicar y modificar tus propios anuncios.
                                         Para empezar, pincha en "Crear nuevo anuncio", a continuación deberás rellenar los datos del mismo. Intenta ser lo más claro y conciso posible, esto ayudará a que los usuarios se fijen en el y tengas una mejor valoración.</p>
							         </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mg-bt-40" role="tablist">
                                <ul id="tabs" class="nav nav-tabs">
                                    <li role="presentation" class="active"><a href="#anuncios" role="tab" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i> Mis Anuncios</a></li>
                                    <li role="presentation"><a href="#perfil" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Mi perfil</a></li>
                                    <li role="presentation"><a href="#opiniones" role="tab" data-toggle="tab"><i class="fa fa-comments-o" aria-hidden="true"></i> Mis Opiniones</a></li>
                                    <li role="presentation"><a href="#favoritos" role="tab" data-toggle="tab"><i class="fa fa-star" aria-hidden="true"></i> Mis Favoritos</a></li> 
                                    <li role="presentation"><a href="#ayuda" role="tab" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Ayuda</a></li>  
                                </ul>
                                
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="anuncios">
                                        <div class="col-md-12 mg-tp-40">
                                            
                                            <table border="0" align="center">
                                                <tr>
                                                    <td width="100"><a href="#crear-anuncio" class="btn btn-primary" data-toggle="modal"><i class="fa fa-bullhorn" aria-hidden="true"></i> Crear nuevo anuncio</a></td>
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
                                                    <th>Valoración</th>
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
                                              <h3 class="panel-title"><?php echo $resultado['nombre'];?></h3>
                                            </div>
                                            <div class="panel-body">
                                              <div class="row">
                                                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="images/avatar_unknown.png" class="img-circle img-responsive"> </div>

                                                <div class=" col-md-9 col-lg-9 "> 
                                                  <table class="table table-user-information">
                                                    <tbody>
                                                      <tr>
                                                        <td>Usuario:</td>
                                                        <td><?php echo $resultado['usuario']; ?></td>
                                                      </tr>
                                                        <tr>
                                                        <td>Email</td>
                                                        <td><a href="<?php echo $resultado['email']; ?>"><?php echo $resultado['email']; ?></a></td>
                                                       </tr>
                                                       <tr>
                                                        <td>Contraseña:</td>
                                                           <td><a href="#">Cambiar contraseña</a></td>
                                                        </tr>
                                                      <tr>
                                                        <td>Fecha Creación Cuenta:</td>
                                                        <td><?php echo $resultado['fecha_creacion']; ?></td>
                                                      </tr>
                                                        
                                                      <tr>
                                                        <td>Anuncios Publicados:</td>
                                                        <td><?php echo $resultado['num_anuncios']; ?> anuncios creados</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Opiniones Publicadas:</td>
                                                        <td><?php echo $resultado['num_comentarios']; ?> opiniones</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Anuncios Favoritos:</td>
                                                        <td><?php echo $resultado['num_favoritos']; ?> anuncios favoritos </td>
                                                      </tr>
                                                        
                                                    </tbody>
                                                  </table>

                                                  
                                                </div>
                                              </div>
                                            </div>
                                                 <div class="panel-footer">
                                                        <span>Perfil de Usuario de Merideando</span>
                                                        <span class="pull-right">
                                                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Editar Mi Perfil</a>
                                                            
                                                        </span>
                                                    </div>

                                          </div>
                                    </div>
                                <?php } 
                                    
                                $sql = "SELECT comentarios.id_comentario, comentarios.fecha_comentario, comentarios.anuncio_id, comentarios.comentario
                                FROM comentarios, usuarios
                                WHERE comentarios.usuario_id = usuarios.id AND usuarios.id = ?";
                                    
                                ?>
                            <div role="tabpanel" class="tab-pane fade in" id="opiniones">
                                <div class='col-md-12'>
                                              
                                </div>
                            <div role="tabpanel" class="tab-pane fade in" id="favoritos">
                                        
                            </div>
                        </div> <!-- FIN TAB CONTENT -->
                    </div>   
                </div>
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
                                        <input type="tel" class="form-control" name="telefono" id="telef" pattern="[0-9]{9}" title="Introduce sólo números y máximo 9" placeholder="Teléfono de contacto" required>
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
                                    <div class="col-md-6">
                                        <label for="razon">Razón Social*</label>
                                        <input type="text" class="form-control col-md-6" name="razon" id="razon_soc"  placeholder="Introduce un nombre" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccion">Dirección física (Ej: John Lennon, 36)</label>
                                        <input type="text" class="form-control" name="direccion" id="direc" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="cif">NIF*</label>
                                        <input type="text" class="form-control col-md-6" name="cif" id="identidad" placeholder="Introduce un NIF" pattern="^(([A-Z])|\d)?\d{8}(\d|[A-Z])?$" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono">Teléfono*</label>
                                        <input type="tel" class="form-control" name="telefono" id="telef" pattern="[0-9]{9}" placeholder="Teléfono de contacto" required>
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
                                        <label for="email">E-mail*</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail de contacto" required>
                                    </div>
                             </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="descripcion">Descripción* (Máximo 500 caracteres)</label>
                                    <textarea class="form-control" rows="5" name="descripcion" placeholder="Describe tu negocio" id="descripcion" required></textarea>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
        
    <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
    <!--Import jQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>  
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>          
    <script src="js/lenguajeusuario.js"></script>   
        
   
   
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
             function contarCaracteres(){
                $("#result").val($("#descripcion").val().length + " caracteres introducidos "); 
             }
        </script>
        
    </body>
  </html>
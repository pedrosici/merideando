<?php
//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

include('php/conexion.php');

session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}

$nombre = $_SESSION['nombre'];
$id = $_SESSION['user_id'];



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
         <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
         <script src="js/main.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
                            
                            <div class="col-md-12">
                               	<div class="registros text-center">
                                <table border="0" align="center">
                                    <tr>
                                        <td width="335"><input type="text" placeholder="Busca un anuncio" id="bs-prod"/></td>
                                        <td width="100"><a href="#crear-anuncio" class="btn btn-primary" data-toggle="modal">Crear nuevo anuncio</a></td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                                
                            
                            <div class="col-md-12 col-xs-12 ">
                                <div class="registros" id="agrega-anuncio">
                                   
                            <?php
                            
                            $sql = "SELECT a.id_anuncio, a.razon_soc, a.cif, a.direccion, a.telefono, a.email, a.descripcion, a.imagen, a.likes, a.hates, c.nombre_cat FROM anuncios a INNER JOIN categorias c on a.categoria_id = c.id_categoria WHERE a.usuario_id = ?";
                             $query = $con->prepare($sql);
                             $query->execute(array($id));
                            
                            // Comprobamos existencia del anuncio
                             if ($query->rowCount() > 0){
                                 echo '<table class="table table-striped table-condensed table-hover table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="150">Razón social</th>
                                            <th class="text-center" width="50">Logo</th>
                                            <th class="text-center" width="50">Categoría</th>
                                            <th class="text-center" width="25">Votos</th>
                                            <th class="text-center" width="50">Enlace</th>
                                            <th class="text-center" width="50">Acción</th>
                                        </tr>
                                        </thead>'; 
                                while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){ 
                                
                                    echo '<tr>
                                        <td>'.$resultado['razon_soc'].'</td>
                                        <td><img src="images/'.$resultado['imagen'].'" height="50"/></td>
                                        <td>'.$resultado['nombre_cat'].'</td>
                                        <td>'.$resultado['likes'].'</td>
                                        <td><a href="anuncio.php?id='.$resultado['id_anuncio'].'" target="_blank"><i class="fa fa-link fa-2x" aria-hidden="true"></i></a>
                                        <td><a href="#editar-anuncio" class="fa fa-pencil fa-2x" data-toggle="modal" onClick="editarAnuncio('.$resultado['id_anuncio'].');" title="Editar Anuncio"></a> <a  href="#eliminar-anuncio" data-toggle="modal" onClick="setIdAnuncio('.$resultado['id_anuncio'].')" class="fa fa-trash fa-2x" title="Eliminar anuncio"></a></td>
                                     </tr>'; 
                                } echo '</table>'; ?> 
                                 
                            <?php
                                
                            } else {  
                                echo '<div class="slider_text text-center"><h3>No tienes ningún anuncio creado todavía</h3></div>';
                            }                                
                            ?>
                                    
                                    
                                         
                            </div>
                            <div id="mensaje"></div>
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
                                    <div class="col-md-6">
                                        <label for="razon">Razón Social*</label>
                                        <input type="text" class="form-control col-md-6" name="razon" placeholder="Introduce un nombre" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccion">Dirección física</label> (Ej: John Lennon, 36)
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="cif">CIF*</label>
                                        <input type="text" class="form-control col-md-6" name="cif" id="cif" placeholder="Introduce un CIF" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono">Teléfono*</label>
                                        <input type="text" class="form-control" name="telefono" placeholder="Teléfono de contacto" required>
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="categoria">Categoría</label>
                                        <select class="form-control" name="categoria">
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
                                        <input type="text" class="form-control" name="email" placeholder="E-mail de contacto" required>
                                    </div>
                             </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="descripcion">Descripción*</label>
                                    <textarea class="form-control" rows="5" name="descripcion" placeholder="Describe tu negocio" required></textarea>
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
                                    <input type="file" name="logo" id="imagen" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4" id="imagen_previa">
                                    <img class="img-responsive" id="vistaprevia" src="images/noimage.png" width="70%" />
                                </div>
                                <div id="error-img"></div>
                            </div>
                        </div>
                   <div class="modal-footer">
                        <button type="submit" class="btn btn-success" value="crear" id="crear">Crear anuncio</button>
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
                                        <label for="cif">CIF*</label>
                                        <input type="text" class="form-control col-md-6" name="cif" id="identidad" placeholder="Introduce un CIF" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono">Teléfono*</label>
                                        <input type="text" class="form-control" name="telefono" id="telef" placeholder="Teléfono de contacto" required>
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
                                    <label for="descripcion">Descripción*</label>
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
                                <input type="hidden" name="id_anuncio" value="<?php echo '.$id_anuncio.'?>">
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
        
    <!--Import jQuery before materialize.js-->
       
      <script src="js/bootstrap.min.js"></script>
      <script>
        $(function () {
            $('[data-toggle="popover"]').popover({ html: true});
        })
        </script>
         
    </body>
  </html>
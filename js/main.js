var id_anuncio = 0;

$(document).ready(function (e) {
    $("#formulario").on('submit',(function(e) {
    e.preventDefault();
    $("#mensaje").empty();
    var url = '/merideando/php/crear_anuncio.php';
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(nuevo){   // A function to be called if request succeeds
                $('#mensaje').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>¡Anuncio creado con exito!</h4>').show(200).delay(3000).hide(200);
			    $('#mis_anuncios').DataTable().ajax.reload();
                
			return false;
        }
    });
    }));
});


$(function() {
    $("#imagen").change(function() {
        $("#error-img").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))){
            $('#vistaprevia').attr('src','images/noimage.png');
            $("#error-img").html("<div class='col-sm-12'><p class='alert alert-warning alert-dismissible mg-bt-40 text-center'>¡Selecciona una imagen válida!</p>"+"<h4>Nota</h4>"+"<span>Sólo las extensiones jpeg, jpg and png son admitidas.</span></div>");
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

    function imageIsLoaded(e) {
        $("#imagen").css("color","green");
        $('#imagen_previa').css("display", "block");
        $('#vistaprevia').attr('src', e.target.result);
        $('#vistaprevia').attr('width', '70%');
    };


//Funcion para las nuevas imágenes
function editarAnuncio(id){
   
    var url = '/merideando/php/editar_anuncio.php';
    $.ajax({
        type:'POST',
        url: url,
        data:'id=' + id,
        success: function(valores){
            //Deseleccionamos el option del select que saldrá por defecto al editar un anuncio
             $('#id_cat option').attr("selected", false);
             $('#subcat option').attr("selected", false);
            
            //Evalúa un código JavaScript representado como una cadena de caracteres (string)
            var datos = JSON.parse(valores);

            $('#id_anuncio').val(id);
            $('#razon_soc').val(datos[0]);
            $('#nif').val(datos[1]);
            $('#direc').val(datos[2]);
            $('#phone').val(datos[3]);
            console.log($('#phone').val(datos[3]));
            $('#email').val(datos[4]);
            $('#descrip').val(datos[5]);
            $('#url').val(datos[6]);
            $('#id_anuncio').val(datos[7]);
            $('#twit').val(datos[8]);
            $('#insta').val(datos[9]);
            $('#fb').val(datos[10]);
            $('#img').attr("src", 'images/anuncios/' + datos[11]);
           
            //Seleccionamos por defecto la categoría del anuncio que deseamos editar
            $('#id_cat option[value=' + datos[12] + ']').attr('selected', true);
            //Seleccionamos por defecto la subcategoría del anuncio que deseamos editar
            $('#subcat option[value=' + datos[13] + ']').attr('selected', true);
        }
        
        
    });
    return false;
}

$(document).ready(function (e) {
    $("#formulario-editar").on('submit',(function(e) {
    e.preventDefault();
    $("#mensaje").empty();
    var url = '/merideando/php/editar_anuncio.php';
    $.ajax({
        url: url, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(nuevo){   // A function to be called if request succeeds
                $('#mensaje').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>¡Anuncio editado con éxito!</h4>').show(200).delay(3000).hide(200);
			    $('#agrega-anuncio').html(nuevo);
			return false;
                return false;
        }
    });
    }));
});



// Función para las imágenes que se editan
$(function() {
    $("#logo").change(function() {
        $("#error_img").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))){
            $('#img').attr('src','noimage.png');
            $("#error_img").html("<div class='col-sm-12'><p class='alert alert-warning alert-dismissible mg-bt-40 text-center'>¡Selecciona una imagen válida!</p>"+"<h4>Nota</h4>"+"<span>Sólo las extensiones jpeg, jpg and png son admitidas.</span></div>");
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = imageIsLoad;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

    function imageIsLoad(e) {
        $("#logo").css("color","green");
        $('#imagen_previa').css("display", "block");
        $('#img').attr('src', e.target.result);
        $('#img').attr('width', '70%');
    };





//Guardamos id_anuncio para pasarlo al modal
function setIdAnuncio(id){
    id_anuncio = id;
}

function setIdUsuario(id){
    id_usuario = id;
}

function setIdComentario(id){
    id_comentario = id;
}



function eliminarSeleccion(id){
    // Recorremos todos los valores
    $("#"+id+" option").each(function(){
    // Marcamos cada valor como NO seleccionado
    $("#"+id+" option[value="+this.value+"]").prop("selected",false);
    });
}

function eliminarAnuncio(){
    var url = '/merideando/php/eliminar_anuncio.php';
       $.ajax({
        type:'POST',
        url: url,
        data: 'id=' + id_anuncio,
        success: function(nuevo){
            $('#mis_anuncios').DataTable().ajax.reload();
            $('#all_anuncios').DataTable().ajax.reload();
            $('#mensaje').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>Anuncio eliminado con exito</h4>').show(200).delay(3000).hide(200);
            $('#mensaje-anuncio').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>Anuncio eliminado con exito</h4>').show(200).delay(3000).hide(200);
			$('#agrega-anuncio').html(nuevo);
			return false;
        }
        });
    return false;
}

function eliminarComentario(){
    var url = '/merideando/php/eliminar_comentario.php';
       $.ajax({
        type:'POST',
        url: url,
        data: 'id=' + id_comentario,
        success: function(nuevo){
            $('#all_comentarios').DataTable().ajax.reload();
            $('#mensaje-coment').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>Comentario eliminado con exito</h4>').show(200).delay(3000).hide(200);
			
			return false;
        }
        });
    return false;
}

function eliminarUsuario(){
    var url = '/merideando/php/eliminar_usuario.php';
       $.ajax({
        type:'POST',
        url: url,
        data: 'id=' + id_usuario,
        success: function(nuevo){
            $('#all_usuarios').DataTable().ajax.reload();
            $('#mensaje-user').addClass('alert alert-success alert-dismissible mg-bt-40 text-center').html('<h4>Usuario eliminado con exito</h4>').show(200).delay(3000).hide(200);
			
			return false;
        }
        });
    return false;
}

$(document).ready(function() {
	$('.votos .btn_votos').click(function (e) {
	 	e.preventDefault();
		var voto_hecho = $(this).data('voto');
		var id = $(this).data("id"); 
		var li = $(this);
		
		if(voto_hecho && id)
		{
			$.post('votar_anuncio.php', {'id':id, 'voto':voto_hecho}, function(data) 
			{
				if (data!="voto_duplicado") 
				{
					li.addClass(voto_hecho+"_votado").find("span").text(data);
					li.closest("ul").append("<span class='votado'>Gracias!</span>");
				}
				else li.closest("ul").append("<span class='votado'>Ya has votado!</span>");
			});
			setTimeout(function() {$('.votado').fadeOut('fast');}, 3000);
		}
	});
});

 
       
       



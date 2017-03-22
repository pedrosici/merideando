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
            $('#mensaje').addClass('bg-success').html('Anuncio creado con exito').show(200).delay(2500).hide(200);
			$('#agrega-anuncio').html(nuevo);
			return false;
        }
    });
    }));
});

$(function() {
    $("#imagen").change(function() {
    $("#mensaje").empty(); // To remove the previous error message
   
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))){
        $('#vistaprevia').attr('src','noimage.png');
        $("#mensaje").html("<p id='error'>Selecciona una imagen válida</p>"+"<h4>Nota</h4>"+"<span id='error_message'>Solo las extensiones jpeg, jpg and png son admitidas.</span>");
        return false;
    }
    else {
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
        $('#vistaprevia').attr('width', '80px');
        $('#vistaprevia').attr('height', '80px');
    };




function nuevoAnuncio(){
    
    var url = '/merideando/php/crear_anuncio.php';
    $.ajax({
        type:'POST',
        url: url,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(nuevo){
            $('#mensaje').addClass('bg-success').html('Anuncio creado con exito').show(200).delay(2500).hide(200);
			$('#agrega-anuncio').html(nuevo);
			return false;
        }
    });
    return false;
}

function editarAnuncio(id){
    var url = '/merideando/php/editar_anuncio.php';
    $.ajax({
        type:'POST',
        url: url,
        data:'id=' + id,
        success: function(valores){
            //Evalúa un código JavaScript representado como una cadena de caracteres (string)
            var datos = eval(valores);
            $('#razon_soc').val(datos[0]);
            $('#cif').val(datos[1]);
            $('#direccion').val(datos[2]);
            $('#telefono').val(datos[3]);
            $('#email').val(datos[4]);
            $('#descripcion').val(datos[5]);
            $('#imagen').val(datos[6]);
            $('#categoria').val(datos[7]);
//            $('#editar-anuncio').modal({
//                show:true,
//                backdrop:'static'
//            })
        }
    });
    return false;
}

function eliminarAnuncio(id){
    var url = '/merideando/php/eliminar_anuncio.php';
    var pregunta = confirm("¿Está seguro de que desea eliminar el anuncio?");
    if (pregunta == true){
       $.ajax({
        type:'POST',
        url: url,
        data: 'id=' + id,
        success: function(nuevo){
            $('#mensaje').addClass('bg-success').html('Anuncio eliminado con exito').show(200).delay(2500).hide(200);
			$('#agrega-anuncio').html(nuevo);
			return false;
        }
        });
    return false;
    } else {
       return false; 
    }
}
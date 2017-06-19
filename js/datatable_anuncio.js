$(document).ready(function() {			   
	$('#mis_anuncios').DataTable( {	
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "php/mis_anuncios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "razon" },
			{ "data": "imagenUrl",
              "render": function(data, type, row){
                   return '<img class="img-rounded" src="images/anuncios/'+data+'" height="30px" />';
              }
            },
			{ "data": "categoria" },
			{ "data": "valoracion" },
			{ "data": "enlace"},
            { "data": "acciones"}
          
			
			],
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="-1">Todos</option>'+
		        '</select> anuncios',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Todavía no ha creado ningún anuncio",
		    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ anuncios",
		    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 anuncios",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ anuncios)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Filtrar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
        }
	});
    
    $('#mis_comentarios').DataTable( {	
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "mis_comentarios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "mensaje" },
			{ "data": "anuncio",
              "render": function(data, type, row){
                   return '<img class="img-rounded" src="images/'+data+'" height="40px"/>';
              }
            },
			{ "data": "valoracion" },
            { "data": "fecha" },
            { "data": "acciones"}
          
			
			],
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="-1">Todos</option>'+
		        '</select> anuncios',    
		    "sZeroRecords":    "Todavía no ha opinado en ningún anuncio",
		    "sEmptyTable":     "Todavía no ha opinado en ningún anuncio",
		    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ opiniones",
		    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 opiniones",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ opiniones)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Filtrar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
        }
	});
    
});
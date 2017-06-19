$(document).ready(function() {			   
	$('#all_comentarios').DataTable( {	
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "php/todos_comentarios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "razon_soc" },
			{ "data": "titulo" },
			{ "data": "autor" },
			{ "data": "valoracion"},
            { "data": "enlace"},
            { "data": "acciones"}
          
        ],
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="-1">Todos</option>'+
		        '</select> comentarios',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Todavía no ha publicado ningún comentario",
		    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ comentarios",
		    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 comentarios",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ comentarios)",
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
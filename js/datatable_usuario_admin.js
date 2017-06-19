$(document).ready(function() {			   
	$('#all_usuarios').DataTable( {	
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "php/todos_usuarios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "username" },
			{ "data": "nombre" },
			{ "data": "email" },
			{ "data": "fecha"},
            { "data": "acciones"}
        ],
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="-1">Todos</option>'+
		        '</select> usuarios',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Todavía no se ha registrado ningún usuario",
		    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ usuarios",
		    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 usuarios",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ usuarios)",
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
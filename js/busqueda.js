$(document).ready(function(){
    $('#buscar').on('keyup',function(){
        var busqueda = $('#buscar').val();
        $.ajax({
            type:'POST',
            url:'php/busqueda.php',
            data: {'buscar': busqueda}
            
        })
        .done(function(resultado){
            $('#resultado').html(resultado);
        })
        .fail(function(){
            alert('No se encontraron resultados');
        })
    })
});
jQuery(document).on('submit', '#login_form', function(event){
    event.preventDefault();
    jQuery.ajax({
        url: 'php/loguear.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('#checklogin').html("");
            $('#login_btn').val('Validando...');
        }
    })
    .done(function(respuesta){
        
        if (!respuesta.error){
             $("#checklogin").html("<div class='col-md-8 col-md-offset-2 aviso aviso-exito text-center'><i class='fa fa-check'></i> Login correcto</div>"); 
            location.href = 'panel_usuario.php';
        } else {
           $("#login_btn").val("Iniciar Sesión");
           $("#checklogin").html("<div class='col-md-8 col-md-offset-2 aviso aviso-error text-center'><i class='fa fa-close'></i> Login incorrecto</div>"); 
        }
        
        
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    
});
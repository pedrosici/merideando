jQuery(document).on('submit', '#login_form', function(event){
    event.preventDefault();
    jQuery.ajax({
        url: 'php/loguear.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('#login_btn').val('Validando...');
        }
    })
    .done(function(respuesta){
        
        if (!respuesta.error){
            location.href = 'panel_usuario.php';
        } else {
           document.getElementById('checkLogin').className = 'alert alert-danger col-md-8 col-md-offset-2  text-center'; 
            $('#checkLogin').html("<p><i class='fa fa-close'></i> El usuario o la contraseña no es correcto</p>");
            setTimeout(function(){
                $('#checkLogin').hide;
            }, 3000);
            $('#login_btn').val('Iniciar Sesión');
        }
        
        
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});
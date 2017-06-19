jQuery(document).on('submit', '#registro_form', function(event){
    event.preventDefault();
    jQuery.ajax({
        url: 'php/registrar.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('#checkregistro').html("");
            $("#checkPassword").html("");
            $('#registro_btn').html("<i class='fa fa-spinner fa-spin fa-fw'></i> Registrando...");
        }
    })
    
    .done(function(respuesta){
        
        if (respuesta.success){
             $("#registro_btn").html("Crear mi cuenta");
             $("#checkregistro").html("<div class='col-md-12 aviso aviso-exito text-center'><i class='fa fa-check'></i> Usted ya es nuevo usuario de Merideando. Proceda a loguearse.</div>"); 
            
        } else {
           $("#registro_btn").html("Crear mi cuenta");
           $("#checkregistro").html("<div class='col-md-12 aviso aviso-error text-center'><i class='fa fa-close'></i> Error en el registro. El nombre de usuario o el correo electrónico están ya en uso.</div>"); 
        }
        
        
    })
    
});


$(document).ready(function(){
    $("#confirm_password").keyup(checkPasswordMatch);
});

$(document).ready(function(){
    $("#password").keyup(checkPasswordMatch);
});

function checkPasswordMatch(){
    var repetirPass = document.getElementById('confirm_password').value;
    var tamañoPass = repetirPass.length;
    var passvalido = false;
    if (tamañoPass > 0){
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        
        if (password != confirmPassword){
            $("#checkPassword").html("<div class='col-md-6 col-md-offset-3 aviso aviso-error text-center'><i class='fa fa-close'></i> Las contraseñas no coinciden</div>");
            document.getElementById("registro_btn").disabled = true;                         
        } else {
            $("#checkPassword").html("<div class='col-md-6 col-md-offset-3 aviso aviso-exito text-center'><i class='fa fa-check'></i> Las contraseñas coinciden</div>");
            document.getElementById("registro_btn").disabled = false;
        }
    }
}






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
            document.getElementById("submitRegistro").disabled = true;                         
        } else {
            $("#checkPassword").html("<div class='col-md-6 col-md-offset-3 aviso aviso-exito text-center'><i class='fa fa-check'></i> Las contraseñas coinciden</div>");
            document.getElementById("submitRegistro").disabled = false;
        }
    }
}





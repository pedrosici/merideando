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
            document.getElementById('checkPassword').className = 'alert alert-danger alert-xs col-md-8 col-md-offset-2  text-center';   - 
            $("#checkPassword").html("<p><i class='fa fa-close'></i> Las contraseñas introducidas no coinciden</p>");
            document.getElementById("submitRegistro").disabled = true;                         
        } else {
            $("#checkPassword").html("<div class='alert alert-success col-sm-12  text-center'><i class='fa fa-check'></i> Las contraseñas introducidas coinciden.</div>");
            passvalido = true;
            document.getElementById("submitRegistro").disabled = false;
        }
    }
}





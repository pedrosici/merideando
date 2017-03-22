with(document.login){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && usuario.value==""){
			ok=false;
			alert("Debe escribir un nombre de usuario");
			usuario.focus();
		}
		if(ok && password.value==""){
			ok=false;
			alert("Debe escribir su password");
			password.focus();
		}
		if(ok){ submit(); }
	}
}

with(document.registro){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && razon.value == ""){
			ok=false;
			alert("Debe escribir el nombre de su negocio");
			usuario.focus();
		}
		if(ok &&cif.value == ""){
			ok=false;
			alert("Debe escribir el CIF de su negocio");
			cif.focus();
		}
		if(ok && direccion.value == ""){
			ok=false;
			alert("Debe escribir la dirección de su negocio");
			direccion.focus();
		}
		if(ok && email.value == ""){
			ok=false;
			alert("Debe escribir un email de contacto correcto");
			email.focus();
		}
		if(ok && descripcion.value == ""){
			ok=false;
			alert("Debe escribir una descripción sobre su negocio");
			descripcion.focus();
		}
        
		if(ok){ submit(); }
	}
}
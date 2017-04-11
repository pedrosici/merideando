<?php

require_once("conexion.php");
if($_POST)
{
	$voto = trim($_POST["voto"]);
	$id = filter_var(trim($_POST["id"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	
	if (isset($_COOKIE["votado_".$id]))
	{
		echo "voto_duplicado";
	}
	else
	{
		$total_votos=$con->query("select ".$voto." from anuncios  WHERE id_anuncio='$id' limit 1");
		if ($fila=$total_votos->fetch_array()) $numero=$fila[$voto];
		
		$votado=$con->query("UPDATE anuncios SET ".$voto."=".$voto."+1 WHERE id_anuncio='$id'");
		setcookie("votado_".$id, 1, time()+7200);
		echo ($numero+1);
        
	}

}

?>
<?php
	header('Content-type: text/javascript');
	$dir = opendir("../../Imagenes");

	$salida = "var tinyMCEImageList = new Array(\n";
	$salida.= "//Nombre, URL\n";
	
	$imagenes = array();
	while(($imagen = readdir($dir)) != false){
		if($imagen != '.' && $imagen != '..'){
			$imagenes[] = '["'.$imagen.'", "../Imagenes/'.$imagen.'"]';
		}
	}
	
	$salida .= join(",\n", $imagenes);
	$salida .= ');';
	echo $salida;
?>
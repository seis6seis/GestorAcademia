<?php
////////////////////////////////////////////////////
//Convierte fecha de mysql a normal
////////////////////////////////////////////////////
function cambiarfecha($fecha){
		return implode('-', array_reverse(explode('-', $fecha)));
}

function Codificar($Frase){
	$Clave="3nGL1sh";
	$PosClave=0;
	$NFrase="";
	
	for($Pos=0;$Pos<strlen($Frase);$Pos++){
		$CarFrase=substr($Frase,$Pos,1);
		$CarClave=substr($Clave,$PosClave,1);
		$NCaracter=ord($CarFrase)+ord($CarClave);
		$NFrase=$NFrase+chr($NCaracter);
		$PosClave=$PosClave+1;
		if ($PosClave==strlen($Clave)) $PosClave=0;
	}
	return $NFrase;
}

function Descodificar($Frase){
	$Clave="3nGL1sh";
	$PosClave=0;
	$NFrase="";
	
	for($Pos=0;$Pos<strlen($Frase);$Pos++){
		$CarFrase=substr($Frase,$Pos,1);
		$CarClave=substr($Clave,$PosClave,1);
		$NCaracter=ord($CarFrase)-ord($CarClave);
		$NFrase=$NFrase+chr($NCaracter);
		$PosClave=$PosClave+1;
		if ($PosClave==strlen($Clave)) $PosClave=0;
	}
	return $NFrase;
}

?>
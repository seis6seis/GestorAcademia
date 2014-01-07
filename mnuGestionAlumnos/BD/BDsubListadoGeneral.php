<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");

$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM alumnos WHERE Centro='".$_SESSION['Centro']."'";
	if ($_SESSION['SQL']!="") $sql=$sql." AND Grupo='".$_SESSION['SQL']."'";
	$sql=$sql." LIMIT 0, 50000;";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->Codi=substr($row->Codi,3);
		$row->Grupo=substr($row->Grupo,3);
		if ($row->Fecha_Al=='0000-00-00'){ $row->Fecha_Al=''; } else{ $row->Fecha_Al=cambiarfecha($row->Fecha_Al); }
		if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
		if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
		$retArray[] = $row;
	}
	$data = json_encode($retArray);
	$ret = "{data:" . $data."}";
	echo $ret;
}
if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
		if ($value->Materiales=='on' || $value->Materiales=='YES'){
			$Material='YES';
		}else{
			$Material='NO';
		}
		if ($value->Descuento=='on' || $value->Descuento=='YES'){
			$Dto='YES';
		}else{
			$Dto='NO';
		}
    	$sql = "UPDATE Alumnos SET ".
			"Codi='".$_SESSION['Centro'].$value->Codi."', ".
			"Reserva='".$value->Reserva."', ".
			"Fecha_Al='".cambiarfecha($value->Fecha_Al)."', ".
			"Fecha_Co='".cambiarfecha($value->Fecha_Co)."', ".
			"Fecha_Ba='".cambiarfecha($value->Fecha_Ba)."', ".
			"Nombre_Alumno='".$value->Nombre_Alumno."', ".
			"Direccion='".$value->Direccion."', ".
			"Ciudad='".$value->Ciudad."', ".
			"Codigo_Postal='".$value->Codigo_Postal."', ".
			"Telefono='".$value->Telefono."', ".
			"Movil='".$value->Movil."', ".
			"Pago='".$value->Pago."', ".
			"Grupo='".$_SESSION['Centro'].$value->Grupo."', ".
			"Materiales='".$Material."', ".
			"Descuento='".$Dto."', ".
			"Motivo_Dto='".$value->Motivo_Dto."', ".
			"Procedencia='".$value->Procedencia."', ".
			"Profesion_Estudios='".$value->Profesion_Estudios."', ".
			"Necesidad='".$value->Necesidad."', ".
			"Edad='".$value->Edad."', ".
			"IDColegio='".$value->IDColegio."', ".
			"Correo='".$value->Correo."', ".
			"Cambios='".$value->Cambios."', ".
			"Observaciones='".$value->Observaciones."' ".
			"WHERE Codi='".$_SESSION['Centro'].$value->Codi."'";
	    if(mysql_query($sql)==FALSE){
        	$errors .= mysql_error();
      	}
  	}
  	//deal with those deleted
	$sql="";
	$deletedRecords = $json->{'deletedRecords'};
	foreach ($deletedRecords as $value){
		$params[] = "'".$_SESSION['Centro'].$value->Codi."'";
	}
	$sql = "DELETE FROM Alumnos WHERE Codi IN (" . join(",", $params) . ")";
	//echo $sql;
	if(mysql_query($sql)==FALSE){
		$errors .= mysql_error();
	}

  $ret = "{success : true,exception:''}";
	echo $ret;
}

?>
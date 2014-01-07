<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM historico_pagos WHERE Centro='".$_SESSION['Centro']."'";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->Cod=substr($row->Cod,3);
		if ($row->Fecha_Ge=='0000-00-00'){ $row->Fecha_Ge=''; } else{ $row->Fecha_Ge=cambiarfecha($row->Fecha_Ge); }
		if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
		if ($row->Fecha_Cobro=='0000-00-00'){ $row->Fecha_Cobro=''; } else{ $row->Fecha_Cobro=cambiarfecha($row->Fecha_Cobro); }
		if ($row->Fecha_De=='0000-00-00'){ $row->Fecha_De=''; } else{ $row->Fecha_De=cambiarfecha($row->Fecha_De); }
		$retArray[] = $row;
	}

	$data = json_encode($retArray);
	$ret = "{data:" . $data ."}";
	//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
	//$ret .= "recordType : 'object'}";
	echo $ret;
}
if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";
	
  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] = $value->Numero_Pago;
  }
  $sql = "DELETE FROM historico_pagos WHERE Numero_Pago IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
		if ($value->Materiales=='on'){
			$Material='YES';
		}else{
			$Material='NO';
		}
		if ($value->Descuent=='on'){
			$Dto='YES';
		}else{
			$Dto='NO';
		}
    $sql = "UPDATE historico_pagos SET ".
			"Numero_Pago='".$value->Numero_Pago."', ".
			"Cod='".$_SESSION['Centro'].$value->Cod."', ".
			"Fecha_Ge='".cambiarfecha($value->Fecha_Ge)."', ".
			"Fecha_Co='".cambiarfecha($value->Fecha_Co)."', ".
			"Fecha_Cobro='".cambiarfecha($value->Fecha_Cobro)."', ".
			"Fecha_De='".cambiarfecha($value->Fecha_De)."', ".
			"Nombre_Alumno='".$value->Nombre_Alumno."', ".
			"Importe='".$value->Importe."', ".
			"Matricula='".$value->Matricula."', ".
			"Dto='".$value->Dto."', ".
			"Cuota='".$value->Cuota."', ".
			"Materiales='".$value->Materiales."', ".
			"Periodo='".$value->Periodo."', ".
			"Centro='".$value->Centro."' ".
			"WHERE Numero_Pago='".$value->Numero_Pago."'";
	
	    if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  $ret = "{success : true,exception:''}";
	echo $ret;
}

?>
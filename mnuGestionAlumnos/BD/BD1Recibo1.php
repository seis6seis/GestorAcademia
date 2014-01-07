<?php
session_start();

header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

$json=json_decode(stripslashes($_POST["_gt_json"]));
 
if($json->{'action'} == 'save'){
//echo $_POST["_gt_json"];
  $sql = "";
  $params = array();
  $errors = "";
	
  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] = $value->Numero_Pago;
  }
   $sql="DELETE FROM historico_pagos WHERE Numero_Pago IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
  	if ($value->Fecha_Cobro=='') $value->Fecha_Cobro='0000-00-00';
  	if ($value->Fecha_De=='') $value->Fecha_De='0000-00-00';
	$sql = "UPDATE historico_pagos SET ".
   			"Importe='".$value->Importe."', ".
			"Matricula='".$value->Matricula."', ".
			"Cuota='".$value->Cuota."', ".
			"Dto='".$value->Dto."', ".
			"Materiales='".$value->Materiales."', ".
			"Fecha_Cobro='".cambiarfecha($value->Fecha_Cobro)."', ".
			"Fecha_De='".cambiarfecha($value->Fecha_De)."' ".
			"WHERE Numero_Pago='".$value->Numero_Pago."'";
		if(mysql_query($sql)==FALSE){
        	$errors .= mysql_error();
		}
  }

  $ret ="{success : true,exception:''}";
	echo $ret;
}
?>
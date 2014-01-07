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
	$sql = "SELECT Numero_Pago, Cod, Fecha_Cobro, Fecha_De, Cuota, Dto, Matricula, Materiales, Periodo, Pagado, Nombre_Alumno FROM historico_pagos ".$_SESSION['SQL'];

	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		//$row->Codi=substr($row->Codi,3);
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

?>
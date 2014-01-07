<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");

$json=json_decode(stripslashes($_POST["_gt_json"]));

//if($json->{'action'} == 'load'){
//pageno starts with 1 instead of 0
	$sql="SELECT idCuenta, Fecha, idTipo, Descripcion, Haber, Debe FROM Movimientos WHERE ".$_SESSION['SQL']." ORDER BY Fecha ASC";
	$sql=$sql." LIMIT 0, 50000;";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->idCuenta=substr($row->idCuenta,3);
		if ($row->Fecha=='0000-00-00'){ $row->Fecha=''; } else{ $row->Fecha=cambiarfecha($row->Fecha); }
		$retArray[] = $row;
	}
	$data = json_encode($retArray);
	$ret = "{data:" . $data."}";
	echo $ret;
//}

?>
<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");
//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM Faltas WHERE Centro='".$_SESSION['Centro']."'".$_SESSION['SQL'];

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	if ($row->Fecha_Falta=='0000-00-00'){ $row->Fecha_Falta=''; } else{ $row->Fecha_Falta=cambiarfecha($row->Fecha_Falta); }
	if ($row->Fecha_Contacto=='0000-00-00'){ $row->Fecha_Contacto=''; } else{ $row->Fecha_Contacto=cambiarfecha($row->Fecha_Contacto); }
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>
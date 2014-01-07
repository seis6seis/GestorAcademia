<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

//pageno starts with 1 instead of 0
$sql="SELECT Faltas.idFalta, Alumnos.Grupo, Alumnos.Nombre_Alumno, Alumnos.Telefono, Alumnos.Movil, Faltas.Fecha_Falta, Faltas.Fecha_Contacto, Faltas.Justificada";
$sql=$sql." FROM Alumnos INNER JOIN Faltas ON Alumnos.Codi = Faltas.Codigo";
$sql=$sql." WHERE Faltas.Centro='".$_SESSION['Centro']."' AND (Faltas.Fecha_Falta Between '".date("Y-m-d",time()-(15*24*60*60))."' And '".date("Y-m-d")."')";
$sql=$sql." ORDER BY Faltas.Fecha_Falta DESC";

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	$row->Grupo=substr($row->Grupo,3);
	$row->Fecha_Contacto=cambiarfecha($row->Fecha_Contacto);
	$row->Fecha_Falta=cambiarfecha($row->Fecha_Falta);
  $retArray[] = $row;
}
$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
echo $ret;
?>
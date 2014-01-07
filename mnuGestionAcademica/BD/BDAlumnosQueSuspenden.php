<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

//pageno starts with 1 instead of 0
$sql="SELECT GruposCuotas.Profesor, Alumnos.Nombre_Alumno, Alumnos.Codi, Alumnos.Grupo, Alumnos.Fecha_Al, RegistroAcademicos.EnSuColegio, Alumnos.Fecha_Ba, Alumnos.Necesidad, RegistroAcademicos.Fecha, RegistroAcademicos.Interna, Alumnos.Profesion_Estudios";
$sql=$sql." FROM GruposCuotas INNER JOIN (Alumnos INNER JOIN RegistroAcademicos ON Alumnos.Codi = RegistroAcademicos.IdAlumno) ON GruposCuotas.Grupo = Alumnos.Grupo";
$sql=$sql." WHERE (Alumnos.Necesidad='SUS' OR RegistroAcademicos.EnSuColegio<6) AND Alumnos.Centro='".$_SESSION['Centro']."';";

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	//$row->Codi=substr($row->Codi,3);
	$row->Fecha_Al=cambiarfecha($row->Fecha_Al);
	$row->Fecha_Ba=cambiarfecha($row->Fecha_Ba);
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>
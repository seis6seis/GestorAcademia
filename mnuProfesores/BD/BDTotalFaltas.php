<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
//pageno starts with 1 instead of 0
$sql="SELECT Alumnos.Grupo, Alumnos.Nombre_Alumno, Count(Faltas.Codigo) AS CuentaDecodigo";
$sql=$sql." FROM Alumnos INNER JOIN Faltas ON Alumnos.Codi = Faltas.Codigo";
$sql=$sql." WHERE (Alumnos.Centro='".$_SESSION['Centro']."')";
$sql=$sql." GROUP BY Alumnos.Grupo, Alumnos.Nombre_Alumno";
$sql=$sql." ORDER BY Count(Faltas.Codigo) DESC";

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	//$row->Codi=substr($row->Codi,3);
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>
<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
//pageno starts with 1 instead of 0
$sql="SELECT Nombre_Alumno, Codi, Telefono, Fecha_Ba, Grupo, Correo, Profesion_Estudios, Necesidad";
$sql=$sql." FROM Alumnos";
$sql=$sql." WHERE (Fecha_Ba='0000-00-00' AND Centro='".$_SESSION['Centro']."' AND Grupo='".$_SESSION['SQL']."')";
$sql=$sql." ORDER BY Nombre_Alumno";

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
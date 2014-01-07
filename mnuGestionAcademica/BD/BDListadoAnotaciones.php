<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

//pageno starts with 1 instead of 0
$sql = "SELECT GruposCuotas.Profesor, GruposCuotas.Grupo, GruposCuotas.Programa, Clases.Fecha, Clases.TipoDeberes, Clases.ControlPreDeberes, Clases.ControlDeberes, Clases.ComentariosProf";
$sql=$sql." FROM GruposCuotas INNER JOIN Clases ON GruposCuotas.Grupo = Clases.IdGrupo";
$sql=$sql." WHERE (Clases.Fecha>'".cambiarfecha($_SESSION['SQL'])."' AND GruposCuotas.Centro='".$_SESSION['Centro']."')";
$sql=$sql." ORDER BY GruposCuotas.Profesor, GruposCuotas.Grupo, Clases.Fecha DESC";

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	$row->Grupo=substr($row->Grupo,3);
	$row->Fecha=cambiarfecha($row->Fecha);
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data ."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>
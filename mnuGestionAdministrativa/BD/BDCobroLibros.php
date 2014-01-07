<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");
$json = json_decode(stripslashes($_POST["_gt_json"]));
$pageNo = $json->{"pageInfo"}->{"pageNum"};
$pageSize = 20;

//to get how many records totally.
/*$sql = "SELECT count(*) AS cnt FROM alumnos WHERE Centro='".$_SESSION['Centro']."'";
if ($_SESSION['SQL']!="") $sql=$sql." AND Grupo='".$_SESSION['SQL']."'";
$handle = mysql_query($sql);
$row = mysql_fetch_object($handle);
$totalRec = $row->cnt;

//make sure pageNo is inbound
if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))){
  $pageNo = 1;
}*/
//pageno starts with 1 instead of 0
$sql="TRANSFORM Sum(Cobros.Materiales) AS SumaDeMATERIALES";
$sql=$sql." SELECT Alumnos.Nombre_Alumno, Alumnos.Materiales, Alumnos.Fecha_Co, Alumnos.Fecha_Ba, GruposCuotas.Materiales";
$sql=$sql." FROM GruposCuotas INNER JOIN (Alumnos LEFT JOIN Cobros ON Alumnos.Codi = Cobros.Cod) ON GruposCuotas.Grupo = Alumnos.Grupo";
$sql=$sql." WHERE (Alumnos.Materiales='YES' AND Alumnos.Centro='".$_SESSION['Centro']."')";
$sql=$sql." GROUP BY Alumnos.Nombre_Alumno, Alumnos.Materiales, Alumnos.Fecha_Co, Alumnos.Fecha_Ba, GruposCuotas.Materiales";
$sql=$sql." ORDER BY GruposCuotas.Materiales DESC ";
//$sql=$sql." PIVOT 'MaterialCobrada'";
$sql=$sql." LIMIT " . (($pageNo - 1) * $pageSize) . ", " . $pageSize;

$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
	if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
  $retArray[] = $row;
}

$data = json_encode($retArray);
$ret = "{data:" . $data."}";
//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
//$ret .= "recordType : 'object'}";
echo $ret;
?>
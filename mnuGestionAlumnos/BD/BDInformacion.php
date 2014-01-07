<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");

$json = json_decode(stripslashes($_POST["_gt_json"]));
//$pageNo = $json->{"pageInfo"}->{"pageNum"};
//$pageSize = 20;

//to get how many records totally.
$sql = "SELECT count(*) AS cnt FROM Informacion WHERE Centro='".$_SESSION['Centro']."'";
$handle = mysql_query($sql);
$row = mysql_fetch_object($handle);
//$totalRec = $row->cnt;

//make sure pageNo is inbound
//if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))){
//  $pageNo = 1;
//}

//pageno starts with 1 instead of 0
$sql = "SELECT * FROM Informacion WHERE Centro='".$_SESSION['Centro']."'";
//$sql=$sql." LIMIT " . (($pageNo - 1) * $pageSize) . ", " . $pageSize;
$handle = mysql_query($sql);    
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
	if ($row->Fecha=='0000-00-00'){ $row->Fecha=''; } else{ $row->Fecha=cambiarfecha($row->Fecha); }
	if ($row->F_Nacimiento=='0000-00-00'){ $row->F_Nacimiento=''; } else{ $row->F_Nacimiento=cambiarfecha($row->F_Nacimiento); }
  $retArray[] = $row;
}
$data = json_encode($retArray);

$ret = "{data:" . $data."}";
echo $ret;
?>
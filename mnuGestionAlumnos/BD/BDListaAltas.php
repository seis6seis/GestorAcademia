<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");
$json = json_decode(stripslashes($_POST["_gt_json"]));

//pageno starts with 1 instead of 0
	$sql="SELECT * FROM Alumnos WHERE Centro='".$_SESSION['Centro']."' ".$_SESSION['SQL']." ORDER BY Fecha_Al ASC";
	//echo $sql;
	
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
	if ($row->Fecha_Al=='0000-00-00'){ $row->Fecha_Al=''; } else{ $row->Fecha_Al=cambiarfecha($row->Fecha_Al); }
	if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
	if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
		$retArray[] = $row;
	}
	
	$data = json_encode($retArray);
	$ret = "{data:" . $data ."}";
echo $ret;
?>
<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");

$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
//pageno starts with 1 instead of 0
	$sql = "SELECT g.Grupo, g.Horarios, g.Profesor, count( a.Codi ) AS PlazasOcupadas ".
			"FROM gruposcuotas g LEFT JOIN alumnos a ON g.Grupo = a.Grupo ".
			"WHERE a.Fecha_Ba='0000-00-00' AND g.Centro = '".$_SESSION['Centro']."' GROUP BY g.Grupo";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		//$row->Grupo=substr($row->Grupo,3);
		$retArray[] = $row;
	}
	$data = json_encode($retArray);
	$ret = "{data:" . $data."}";
	echo $ret;
}


?>
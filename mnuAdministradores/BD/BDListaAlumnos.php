<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");
//This is sigma grid exporting handler 
require_once('../../grid/GridServerHandler.php');
$type = getParameter('exportType');

$json=json_decode(stripslashes($_POST["_gt_json"]));

if ( $type == 'xls' ){
	if($_SESSION['SQL']=='')
		$sql = "SELECT * FROM alumnos";
	else
		$sql = "SELECT * FROM alumnos WHERE Centro='".$_SESSION['SQL']."'";
	$handle = mysql_query($sql);    
	$salida_cvs='"Codi", "Reserva", "Fecha_Al", "Fecha_Co", "Fecha_Ba", "Nombre_Alumno", '.
				'"Direccion", "Ciudad", "Codigo_Postal", "Pais", "Telefono", "Movil", "Pago", '.
				'"Grupo", "Materiales", "Descuento", "Motivo_Dto", "Procedencia", "Profesion_Estudios", '.
				'"Necesidad", "Edad", "IDColegio", "Correo", "Cambios", "Centro"'."\n";
	while ($row = mysql_fetch_object($handle)) {
		$row->Codi=substr($row->Codi,3);
		$row->Grupo=substr($row->Grupo,3);
		if ($row->Fecha_Al=='0000-00-00'){ $row->Fecha_Al=''; } else{ $row->Fecha_Al=cambiarfecha($row->Fecha_Al); }
		if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
		if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
		$salida_cvs=$salida_cvs.'"'.$row->Codi.'", "'.$row->Reserva.'", "'.$row->Fecha_Al.'", "'.
					$row->Fecha_Co.'", "'.$row->Fecha_Ba.'", "'.$row->Nombre_Alumno.'", "'.
					$row->Direccion.'", "'.$row->Ciudad.'", "'.	$row->Codigo_Postal.'", "'.
					$row->Pais.'", "'.$row->Telefono.'", "'.$row->Movil.'", "'.$row->Pago.'", "'.
					$row->Grupo.'", "'.$row->Materiales.'", "'.$row->Descuento.'", "'.$row->Motivo_Dto.'", "'.
					$row->Procedencia.'", "'.$row->Profesion_Estudios.'", "'.$row->Necesidad.'", "'.
					$row->Edad.'", "'.$row->IDColegio.'", "'.$row->Correo.'", "'.$row->Cambios.'", "'.
					$row->Centro.'"'."\n";
	}
	//Adapta la BBDD que esta en UTF-8 a Windows ISO-8859
	$salida_cvs=iconv ( "UTF-8", "ISO-8859-1", $salida_cvs);

	//Exporta el fichero resultado
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: filename=ListadoAlumnos.csv");
	print $salida_cvs;
	exit;
}

if($json->{'action'} == 'load'){
	$pageNo = $json->{"pageInfo"}->{"pageNum"};
	$pageSize = 100;

	//to get how many records totally.
	if($_SESSION['SQL']=='')
		$sql = "SELECT count(*) AS cnt FROM alumnos";
	else
		$sql = "SELECT count(*) AS cnt FROM alumnos WHERE Centro='".$_SESSION['SQL']."'";
	$handle = mysql_query($sql);
	$row = mysql_fetch_object($handle);
	$totalRec = $row->cnt;

	//make sure pageNo is inbound
	if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))){
	  $pageNo = 1;
	}
	//pageno starts with 1 instead of 0
	if($_SESSION['SQL']=='')
		$sql = "SELECT * FROM alumnos";
	else
		$sql = "SELECT * FROM alumnos WHERE Centro='".$_SESSION['SQL']."'";
	$sql=$sql." LIMIT " . (($pageNo - 1) * $pageSize) . ", " . $pageSize;
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->Codi=substr($row->Codi,3);
		$row->Grupo=substr($row->Grupo,3);
		if ($row->Fecha_Al=='0000-00-00'){ $row->Fecha_Al=''; } else{ $row->Fecha_Al=cambiarfecha($row->Fecha_Al); }
		if ($row->Fecha_Co=='0000-00-00'){ $row->Fecha_Co=''; } else{ $row->Fecha_Co=cambiarfecha($row->Fecha_Co); }
		if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
	  $retArray[] = $row;
	}
	$data = json_encode($retArray);
	$ret = "{data:" . $data.",\n";
	$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
	$ret .= "recordType : 'object'}";
	echo $ret;
}
?>
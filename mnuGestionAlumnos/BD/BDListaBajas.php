<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
require ("../../Connections/funciones.php");
mysql_query ("SET NAMES 'utf8'");
$json = json_decode(stripslashes($_POST["_gt_json"]));

//pageno starts with 1 instead of 0
	//$sql = "SELECT * FROM historico_bajas WHERE Centro='".$_SESSION['Centro']."'";
	$sql="Select Historico_Bajas.Codigo, Historico_Bajas.Fecha_Al, Historico_Bajas.Fecha_Ba, Historico_Bajas.Nombre_Alumno, ";
	$sql=$sql."Historico_Bajas.Direccion, Historico_Bajas.Telefono, Historico_Bajas.Pago, Historico_Bajas.Procedencia, ";
	$sql=$sql."Historico_Bajas.Profesion, Historico_Bajas.Edad, Historico_Bajas.Observaciones, GruposCuotas.Grupo, GruposCuotas.Profesor, ";
	$sql=$sql."Historico_Bajas.Profesor AS chkProfesor, Historico_Bajas.Horario, Historico_Bajas.Contenido, Historico_Bajas.Otros ";
	$sql=$sql."FROM (Alumnos INNER JOIN GruposCuotas ON Alumnos.Grupo = GruposCuotas.Grupo) INNER JOIN Historico_Bajas ON Alumnos.Codi = Historico_Bajas.Codigo ";
	$sql=$sql."WHERE Historico_Bajas.Centro='".$_SESSION['Centro']."' ".$_SESSION['SQL']." ORDER BY Historico_Bajas.Fecha_Ba ASC";
	//echo $sql;
	
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
	if ($row->Fecha_Al=='0000-00-00'){ $row->Fecha_Al=''; } else{ $row->Fecha_Al=cambiarfecha($row->Fecha_Al); }
	if ($row->Fecha_Ba=='0000-00-00'){ $row->Fecha_Ba=''; } else{ $row->Fecha_Ba=cambiarfecha($row->Fecha_Ba); }
		$retArray[] = $row;
	}
	
	$data = json_encode($retArray);
	$ret = "{data:" . $data ."}";
echo $ret;
?>
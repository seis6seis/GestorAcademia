<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

if($_POST['action'] == 'TotalFaltas'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT Count(Fecha_Falta) as TotalFaltas FROM Faltas WHERE Codigo='".$_POST['Codigo']."' AND (Fecha_Falta BETWEEN '".date("Y-m-d", time()-(7*86400))."' AND '".date("Y-m-d")."') AND Centro='".$_SESSION['Centro']."';";
	$handle = mysql_query($sql);

	if(!$handle)
		$return['Res'] = "ERROR: ".mysql_error();
	else{
		$row = mysql_fetch_object($handle);
		$return['Res'] = "OK";
		$return['Total']=$row->TotalFaltas;
		$return['SQL']=$sql;
	}

	echo json_encode($return);
}

if($_POST['action'] == 'save'){
	$sql = "";
	$sql = "SELECT Count(Fecha_Falta) as TotalFaltas FROM Faltas WHERE Codigo='".$_POST['CodAlumno']."' AND Fecha_Falta='".cambiarfecha($_POST['Fecha'])."';";
	$handle = mysql_query($sql);

	if(!$handle)
		$return['Res'] = "ERROR: ".mysql_error();
	else{
		$row = mysql_fetch_object($handle);
		if($row->TotalFaltas==0){
			$sql = "INSERT INTO Faltas (Codigo, Fecha_Falta, Justificada, Centro) ";
			$sql=$sql." VALUES ('". $_POST['CodAlumno']."', '".cambiarfecha($_POST['Fecha'])."', '".$_POST['Justificada']."', '".$_SESSION['Centro']."');";

			if(!mysql_query($sql))
				$return['Res'] = "ERROR: ".mysql_error();
			else
				$return['Res'] = "OK";
		}else
			$return['Res'] = "ERROR: Ya existe una falta asignada al día indicado.";
	}
	echo json_encode($return);
}
?>
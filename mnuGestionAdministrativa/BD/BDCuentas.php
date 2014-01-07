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
	$sql = "SELECT idMovi,Fecha,idCuenta,idTipo,Descripcion,Haber,Debe FROM Movimientos".$_SESSION['SQL']." ORDER BY Fecha ASC";
	$handle = mysql_query($sql);    
	$salida_cvs='"id. Movimiento", "Fecha", "id. Cuenta", "id. Tipo", "Descripcion", "Haber", "Debe"'."\n";
	while ($row = mysql_fetch_object($handle)) {
		$salida_cvs=$salida_cvs.'"'.$row->idMovi.'", "'.cambiarfecha($row->Fecha).'", "'.$row->idCuenta.'", "'.$row->idTipo.'", "'.$row->Descripcion.'", "'.str_replace(".", ",", $row->Haber).'", "'.str_replace(".", ",", $row->Debe).'"'."\n";
	}
	//Adapta la BBDD que esta en UTF-8 a Windows ISO-8859
	$salida_cvs=iconv ( "UTF-8", "ISO-8859-1", $salida_cvs);

	//Exporta el fichero resultado
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: filename=MovimientosCuentas.csv");
	print $salida_cvs;
	exit;
}

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT idMovi,Fecha,idCuenta,idTipo,Descripcion,Haber,Debe FROM Movimientos".$_SESSION['SQL']." ORDER BY Fecha ASC";
	$totalRec=0;
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$totalRec=$totalRec+1;
		if ($row->Fecha=='0000-00-00'){ $row->Fecha=''; } else{ $row->Fecha=cambiarfecha($row->Fecha); }
		$retArray[] = $row;
	}
	
	$data = json_encode($retArray);
	$ret = "{data:" . $data .",\n";
	$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
	$ret .= "recordType : 'object'}";
	echo $ret;
}
if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";
  //deal with those updated
  if($_SESSION['Permiso']==1 or $_SESSION['Permiso']==4){
	  $sql = "";
	  $updatedRecords = $json->{'updatedRecords'};
	  foreach ($updatedRecords as $value){
		$sql = "UPDATE Movimientos SET ".
				"idMovi='".$value->idMovi."', ".
				"Fecha='".cambiarfecha($value->Fecha)."', ".
				"idTipo='".$value->idTipo."', ".
				"idCuenta='".$value->idCuenta."', ".
				"Descripcion='".$value->Descripcion."', ".
				"Haber='".str_replace(",",".",$value->Haber)."', ".
				"Debe='".str_replace(",",".",$value->Debe)."' ".
				"WHERE idMovi='".$value->idMovi."'";
		if(mysql_query($sql)==FALSE){
			$errors .= mysql_error();
		}
	  }
	//deal with those deleted
	$sql="";
	$deletedRecords = $json->{'deletedRecords'};
	foreach ($deletedRecords as $value){
		$params[] = $value->idMovi;
	}
	$sql = "DELETE FROM Movimientos WHERE idMovi IN (" . join(",", $params) . ")";
	if(mysql_query($sql)==FALSE){
		$errors .= mysql_error();
	}
  }  
  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Movimientos (Fecha,idTipo,idCuenta,Descripcion,Haber,Debe,Centro) ";
	$sql=$sql."VALUES ('".cambiarfecha($value->Fecha)."', '".$value->idTipo."', '".$value->idCuenta."', '".$value->Descripcion."', '".str_replace(",",".",$value->Haber)."', '".str_replace(",",".",$value->Debe)."','".$_SESSION['Centro']."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }

  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
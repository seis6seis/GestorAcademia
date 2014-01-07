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
	$sql = "SELECT * FROM Cuentas WHERE Centro='".$_SESSION['SQL']."'";
	$handle = mysql_query($sql);    
	$salida_cvs='"id. Cuenta", "Descripcion", "Participacion", "Centro"'."\n";
	while ($row = mysql_fetch_object($handle)) {
		$salida_cvs=$salida_cvs.'"'.$row->IDCuenta.'", "'.$row->Descripcion.'", "'.str_replace(".", ",", $row->Participacion).'", "'.$row->Centro.'"'."\n";
	}
	//Adapta la BBDD que esta en UTF-8 a Windows ISO-8859
	$salida_cvs=iconv ( "UTF-8", "ISO-8859-1", $salida_cvs);

	//Exporta el fichero resultado
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: filename=Cuentas.csv");
	print $salida_cvs;
	exit;
}

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM Cuentas WHERE Centro='".$_SESSION['SQL']."'";

	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->IDCuenta=substr($row->IDCuenta,3);
		$retArray[] = $row;
	}
	
	$data = json_encode($retArray);
	$ret = "{data:" . $data ."}";
	echo $ret;
}
if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";

  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] ="'". $_SESSION['SQL'].$value->IDCuenta."'";
  }
  $sql = "DELETE FROM Cuentas WHERE IDCuenta IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Cuentas SET ".
      "IDCuenta='".$_SESSION['SQL'].$value->IDCuenta."', ".
      "Descripcion='".$value->Descripcion."', ".
      "Participacion='".$value->Participacion."', ".
      "Centro='".$_SESSION['SQL']."' ".
      "WHERE IDCuenta='".$_SESSION['SQL'].$value->IDCuenta."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Cuentas (IDCuenta, Descripcion, Participacion, Centro) ";
		$sql=$sql."VALUES ('".
		$_SESSION['SQL'].$value->IDCuenta."', '".
		$value->Descripcion."', '".
		$value->Participacion."', '".
		$_SESSION['SQL']."')";
    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
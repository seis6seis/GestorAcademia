<?php
session_start();

header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
require ("../../Connections/funciones.php");

$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT idMovi,Fecha,idCuenta,idTipo,Descripcion,Haber,Debe FROM Movimientos".$_SESSION['SQL'];
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
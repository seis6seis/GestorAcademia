<?php
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
$json=json_decode(stripslashes($_POST["_gt_json"]));
require ("../../Connections/funciones.php");

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM RegistroAcademicos";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		//$row->idAlumno=substr($row->idAlumno,3);
		$row->Fecha=cambiarfecha($row->Fecha);
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
    $params[] = $value->idRegistro;
  }
  $sql = "DELETE FROM RegistroAcademicos WHERE idRegistro IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE RegistroAcademicos SET ".
      "idAlumno='".$value->idAlumno."', ".
      "Fecha='".cambiarfecha($value->Fecha)."', ".
      "Interna='".$value->Interna."', ".
      "EnSuColegio='".$value->EnSuColegio."' ".
      "WHERE idRegistro='".$value->idRegistro."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO RegistroAcademicos (idAlumno, Fecha, Interna, EnSuColegio) ";
		$sql=$sql."VALUES ('". $value->idAlumno."', '".cambiarfecha($value->Fecha)."', '".$value->Interna."', '".$value->EnSuColegio."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
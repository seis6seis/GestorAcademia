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
	$sql = "SELECT * FROM Faltas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Fecha_Falta DESC";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->Fecha_Falta=cambiarfecha($row->Fecha_Falta);
		$row->Fecha_Contacto=cambiarfecha($row->Fecha_Contacto);
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
    $params[] = $value->idFalta;
  }
  $sql = "DELETE FROM Faltas WHERE idFalta IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Faltas SET ".
      "Codigo='".$value->Codigo."', ".
      "Fecha_Falta='".cambiarfecha($value->Fecha_Falta)."', ".
      "Fecha_Contacto='".cambiarfecha($value->Fecha_Contacto)."', ".
			"Justificada='".$value->Justificada."' ".
      "WHERE idFalta='".$value->idFalta."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Faltas (Codigo, Fecha_Falta, Fecha_Contacto, Justificada, Centro) ";
		$sql=$sql." VALUES ('". $value->Codigo."', '".cambiarfecha($value->Fecha_Falta)."', '".cambiarfecha($value->Fecha_Contacto)."', 'NO', '".$_SESSION['Centro']."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
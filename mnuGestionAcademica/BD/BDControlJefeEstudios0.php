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
	$sql = "SELECT * FROM Clases WHERE idGrupo='".$_SESSION['SQL']."'";

	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->idGrupo=substr($row->idGrupo,3);
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
    $params[] = $value->idClase;
  }
  $sql = "DELETE FROM Clases WHERE idClase IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Clases SET ".
      "ControlPreDeberes='".$value->ControlPreDeberes."', ".
      "ControlDeberes='".$value->ControlDeberes."', ".
      "ComentariosProf='".$value->ComentariosProf."' ".
      "WHERE idClase='".$value->idClase."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Clases (ControlPreDeberes, ControlDeberes, ComentariosProf) ";
		$sql=$sql."VALUES ('".$value->ControlPreDeberes."', '".$value->ControlDeberes."', '".$value->ComentariosProf."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
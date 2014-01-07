<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM Movimientos WHERE Centro='".$_SESSION['SQL']."'";

	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		//$row->Codi=substr($row->Codi,3);
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
    $params[] = $value->idMovi;
  }
  $sql = "DELETE FROM Movimientos WHERE idMovi IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Movimientos SET ".
      "idMovi='".$value->idMovi."', ".
      "idCuenta='".$value->idCuenta."', ".
      "idTipo='".$value->idtipo."', ".
      "Fecha='".$value->Fecha."', ".
      "Descripcion='".$value->Descripcion."', ".
      "Haber='".$value->Heber."', ".
      "Debe='".$value->Debe."', ".
      "Centro='".$value->Centro."' ".
      "WHERE idMovi='".$value->idMovi."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Cobros (idMovi, idCuenta, idTipo, Fecha, Descripcion, Haber, Debe, Centro) ";
		$sql=$sql."VALUES ('".
		$value->idMovi."', '".
		$value->idCuenta."', '".
		$value->idTipo."', '".
		$value->Fecha."', '".
		$value->Descripcion."', '".
		$value->Haber."', '".
		$value->Debe."', '".
		$value->Centro."')";
    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
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
	$sql = "SELECT * FROM Balances WHERE Centro='".$_SESSION['Centro']."' ORDER BY Fecha ASC";
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		if ($row->Fecha=='0000-00-00'){ $row->Fecha=''; } else{ $row->Fecha=cambiarfecha($row->Fecha); }
		$retArray[] = $row;
	}

	$data = json_encode($retArray);
	$ret = "{data:" . $data ."}";
	//$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
	//$ret .= "recordType : 'object'}";
	echo $ret;
}
if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";
	
  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] = $value->id;
  }
  $sql = "DELETE FROM Balances WHERE id IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Balances SET ".
			"id='".$value->id."', ".
			"Fecha='".cambiarfecha($value->Fecha)."', ".
			"Caja='".str_replace(",",".",$value->Caja)."', ".
			"Centro='".$_SESSION['Centro']."' ".
			"WHERE id='".$value->id."'";
	
	    if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }
  
  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Balances (id, Fecha, Caja, Centro) ";
	$sql=$sql."VALUES ('".$value->id."', '".date("y-m-d")."', '".$value->Caja."', '".$_SESSION['Centro']."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }

  $ret = "{success : true,exception:''}";
	echo $ret;
}

?>
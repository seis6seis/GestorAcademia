<?php
session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
$json=json_decode(stripslashes($_POST["_gt_json"]));

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM Notas";
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
    $params[] = $value->ID;
  }
  $sql = "DELETE FROM Notas WHERE ID IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Notas SET ".
      "Codi='".$value->Codi."', ".
      "Parcial='".$value->Parcial."', ".
      "Gram_y_Voc='".$value->Gram_y_Voc."', ".
      "E_Oral='".$value->E_Oral."', ".
      "E_Escrita='".$value->E_Escrita."', ".
      "Compresion='".$value->Compresion."', ".
      "Reading='".$value->Reading."', ".
      "Global='".$value->Global."', ".
      "N_Faltas='".$value->N_Faltas."', ".
      "Observaciones='".$value->Observaciones."' ".
      "WHERE ID='".$value->ID."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Notas (Codi, Parcial, Gram_y_Voc, E_Oral, E_Escrita, Compresion, Reading, Global, N_Faltas, Observaciones) ";
		$sql=$sql."VALUES ('". $value->Codi."', '".$value->Parcial."', '".$value->Gram_y_Voc."', '".$value->E_Oral."', '".$value->E_Escrita."', '".$value->Compresion."', '".$value->Reading."', '".$value->Global."', '".$value->N_Faltas."', '".$value->Observaciones."')";

    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
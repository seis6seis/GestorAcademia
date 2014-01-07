<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
$json=json_decode(stripslashes($_POST["_gt_json"]));
require ("../../Connections/funciones.php");

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM GruposCuotas WHERE Centro='".$_SESSION['Centro']."'";
	//$sql=$sql." LIMIT 5000" ;
	$handle = mysql_query($sql);    
	$retArray = array();
	while ($row = mysql_fetch_object($handle)) {
		$row->Grupo=substr($row->Grupo,3);
		$retArray[] = $row;
	}
	$data = json_encode($retArray);
	$ret = "{data:" . $data."}";
	echo $ret;
}

if($json->{'action'} == 'save'){
  $sql = "";
  $params = array();
  $errors = "";

  //deal with those deleted
  $deletedRecords = $json->{'deletedRecords'};
  foreach ($deletedRecords as $value){
    $params[] = "'".$_SESSION['Centro'].$value->Grupo."'";
  }
  $sql = "DELETE FROM GruposCuotas WHERE Grupo IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE GruposCuotas SET ".
      "Grupo='".$_SESSION['Centro'].$value->Grupo."', ".
      "Centro='".$value->Centro."', ".
      "Programa='".$value->Programa."', ".
      "HorasSemana='".$value->HorasSemana."', ".
      "Horarios='".$value->Horarios."', ".
      "Profesor='".$value->Profesor."', ".
      "Matriculas='".$value->Matriculas."', ".
      "Materiales='".$value->Materiales."', ".
      "CuotasMes='".$value->CuotasMes."', ".
      "CuotasTrim='".$value->CuotasTrim."', ".
      "CuotasCuat='".$value->CuotasCuat."', ".
      "CuotasAno='".$value->CuotasAno."' ".
      "WHERE Grupo='".$_SESSION['Centro'].$value->Grupo."'";

    if(mysql_query($sql)==FALSE){
    	$errors .= mysql_error();
		}
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO GruposCuotas ".
		"VALUES ('".$_SESSION['Centro'].$value->Grupo."', '".
		$_SESSION['Centro']."', '".
		$value->Programa."', '".
		$value->HorasSemana."', '".
		$value->Horarios."', '".
		$value->Profesor."', '".
		$value->Matriculas."', '".
		$value->Materiales."', '".
		$value->CuotasMes."', '".
		$value->CuotasTrim."', '".
		$value->CuotasCuat."', '".
		$value->CuotasAno."')";
    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
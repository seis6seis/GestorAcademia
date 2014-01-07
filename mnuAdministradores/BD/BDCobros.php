<?php
	session_start();
header('Content-type:text/javascript;charset=UTF-8');
mysql_connect("localhost","root","pedroman") or die("Could not connect: " . mysql_error());
mysql_select_db("gestoracademia".$_SESSION['CursoEscolar']) or die("Could not select database: " . mysql_error());
mysql_query ("SET NAMES 'utf8'");
$json=json_decode(stripslashes($_POST["_gt_json"]));
require ("../../Connections/funciones.php");
//This is sigma grid exporting handler 
require_once('../../grid/GridServerHandler.php');
$type = getParameter('exportType');

if ( $type == 'xls' ){
	$sql = "SELECT * FROM Cobros WHERE Centro='".$_SESSION['SQL']."'";
	$handle = mysql_query($sql);    
	$salida_cvs='"idCobro", "Cod", "Fecha_Ge", "Fecha_De", "Importe", "Matricula", "Dto", "Cuota", "Materiales", "Periodo", "Pagado", "Metalico", "Centro"'."\n";
	while ($row = mysql_fetch_object($handle)) {
		$salida_cvs=$salida_cvs.'"'.$row->idCobro.'", "'.$row->Cod.'", "'.cambiarfecha($row->Fecha_Ge).'", '.
				'"'.cambiarfecha($row->Fecha_De).'", '.
				'"'.str_replace(".", ",", $row->Importe).'", '.
				'"'.str_replace(".", ",", $row->Matricula).'", '.
				'"'.str_replace(".", ",", $row->Dto).'", '.
				'"'.str_replace(".", ",", $row->Cuota).'", '.
				'"'.str_replace(".", ",", $row->Materiales).'", '.
				'"'.$row->Periodo.'", '.
				'"'.$row->Pagado.'", "'.$row->Metalico.'", "'.$row->Centro.'"'."\n";
	}
	//Adapta la BBDD que esta en UTF-8 a Windows ISO-8859
	$salida_cvs=iconv ( "UTF-8", "ISO-8859-1", $salida_cvs);

	//Exporta el fichero resultado
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: filename=Cobros.csv");
	print $salida_cvs;
	exit;
}

if($json->{'action'} == 'load'){
	//pageno starts with 1 instead of 0
	$sql = "SELECT * FROM Cobros WHERE Centro='".$_SESSION['SQL']."'";

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
    $params[] = $value->idCobro;
  }
  $sql = "DELETE FROM Cobros WHERE idCobro IN (" . join(",", $params) . ")";
  if(mysql_query($sql)==FALSE){
    $errors .= mysql_error();
  }

  //deal with those updated
  $sql = "";
  $updatedRecords = $json->{'updatedRecords'};
  foreach ($updatedRecords as $value){
    $sql = "UPDATE Cobros SET ".
      "idCobro='".$value->idCobro."', ".
      "Cod='".$value->Cod."', ".
      "Fecha_Ge='".$value->Fecha_Ge."', ".
      "Fecha_De='".$value->Fecha_De."', ".
      "Fecha_Cobro='".$value->Fecha_Cobro."', ".
      "Importe='".$value->Importe."', ".
      "Matricula='".$value->Matricula."', ".
      "Dto='".$value->Dto."', ".
      "Cuota='".$value->Cuota."', ".
      "Materiales='".$value->Materiales."', ".
      "Periodo='".$value->Periodo."', ".
      "Pagado='".$value->Pagado."', ".
      "Metalico='".$value->Metalico."', ".
      "Centro='".$value->Centro."' ".
      "WHERE idCobro='".$value->idCobro."'";

      if(mysql_query($sql)==FALSE){
        $errors .= mysql_error();
      }
  }

  //deal with those inserted
  $sql = "";
  $insertedRecords = $json->{'insertedRecords'};
  foreach ($insertedRecords as $value){
    $sql = "INSERT INTO Cobros (idCobro, Cod, Fecha_Ge, Fecha_De, Fecha_Cobro, Importe, Matricula, Dto, Cuota, Materiales, Periodo, Pagado, Metalico, Centro) ";
		$sql=$sql."VALUES ('".
		$value->idCobro."', '".
		$value->Cod."', '".
		$value->Fecha_Ge."', '".
		$value->Fecha_De."', '".
		$value->Fecha_Cobro."', '".
		$value->Importe."', '".
		$value->Matricula."', '".
		$value->Dto."', '".
		$value->Cuota."', '".
		$value->Materiales."', '".
		$value->Periodo."', '".
		$value->Pagado."', '".
		$value->Metalico."', '".
		$value->Centro."')";
    if(mysql_query($sql)==FALSE){
      $errors .= mysql_error();
    }
  }
  $ret = "{success : true,exception:''}";
	echo $ret;
}
?>
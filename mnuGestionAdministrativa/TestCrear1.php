<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
.Titulo {
	font-size: 36px;
	font-weight: bold;
}
-->
</style>
<!-- InstanceParam name="Titulo" type="boolean" value="true" -->
</head>

<body>
  <table width="100%" border="0">
    <tr>
      <td width="111"><img src="../Imagenes/logo_blanco.png" alt="Logo EnglishConnection" width="111" height="49" /></td>
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Creacion de Test<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />

  <div align="center">
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$Contador=1;
	while ($Contador<=$_POST['Contador']){
		$sql="SELECT Test, NumPregunta FROM Test WHERE Test='".$_POST['NomTest']."' AND NumPregunta=".$Contador;
		$miconexion->consulta($sql);
		if( $miconexion->numregistros()==0){
			$sql="INSERT INTO test (Test, NumPregunta, FechaIni, FechaFin, Pregunta)";
			$sql=$sql." VALUES('".$_POST['txtNomTest']."', ".$Contador.",'".cambiarfecha($_POST['txtFechaIni'])." ".$_POST['txtHoraIni'].":00', '".cambiarfecha($_POST['txtFechaFin'])." ".$_POST['txtHoraFin'].":00', '".$_POST['txtP'.$Contador]."')";
			$miconexion->consulta($sql);
			if (!empty($miconexion->$Error)){
				echo "Error al insertar documentos: ".$miconexion->Error."<br />";
				echo $sql;
			}
		}
		else{
			$sql="UPDATE test SET "
			."Test='".$_POST['txtNomTest']."', "
			."NumPregunta=".$Contador.", "
			."FechaIni='".cambiarfecha($_POST['txtFechaIni'])." ".$_POST['txtHoraIni'].":00', "
			."FechaFin='".cambiarfecha($_POST['txtFechaFin'])." ".$_POST['txtHoraFin'].":00', "
			."Pregunta='".$_POST['txtP'.$Contador]."' "
			."WHERE Test='".$_POST['NomTest']."' AND NumPregunta=".$Contador;
			$miconexion->consulta($sql);
			if (!empty($miconexion->$Error)){
				echo "Error al insertar documentos: ".$miconexion->Error."<br />";
				echo $sql;
			}
		}
		$Contador++;
	}
?>
    <strong>Se ha grabado las preguntas, <a href="Test0.php">pulse para volver a crear test</a></strong></div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

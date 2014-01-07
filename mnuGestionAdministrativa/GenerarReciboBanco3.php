<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Generar Recibo Banco - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Generar Recibo Banco<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
<div align="center">
  <p><br />
    <?php

	$hismarcarBD = new DB_mysql ;
	$hismarcarBD->conectar();
	$fec=$_POST['txtFechaCargo'];
	//Pasar a Array los Numeros de pagos a tratar
	$NumPagos = explode("," , $_POST['txtNumPagos']); 

	for ($a=0;$a<=count($NumPagos)-1;$a+=1){
		$sql="UPDATE Historico_Pagos SET Pagado='YES' WHERE Numero_Pago='".$NumPagos[$a]."'";
		$hismarcarBD->consulta($sql);
	}
	
 	// Poner fechas de cobro
	$sql="UPDATE Historico_Pagos SET Historico_Pagos.Fecha_Cobro ='".substr($fec,4,2)."-".substr($fec,2,2)."-".substr($fec,0,2)."'";
	$sql=$sql." WHERE (Historico_Pagos.Fecha_Cobro='0000-00-00' AND Historico_Pagos.Pagado='YES' AND Historico_Pagos.Centro='".$_SESSION['Centro']."')";
	$hismarcarBD->consulta($sql);
	//Ingreso Cobros
	$sql="INSERT INTO cobros (Cod, Fecha_Cobro, Fecha_De, Importe, Matricula, Dto, Cuota, Materiales, Pagado, Metalico, Periodo, Centro)";
	$sql=$sql." SELECT Historico_Pagos.Cod, Historico_Pagos.Fecha_Cobro, Historico_Pagos.Fecha_De, Historico_Pagos.Importe, Historico_Pagos.Matricula, Historico_Pagos.Dto, Historico_Pagos.Cuota, Historico_Pagos.Materiales, Historico_Pagos.Pagado, Historico_Pagos.Metalico, Historico_Pagos.Periodo, Historico_Pagos.Centro";
	$sql=$sql." FROM Historico_Pagos";
	$sql=$sql." WHERE (Historico_Pagos.Pagado='YES' AND Historico_Pagos.Centro='".$_SESSION['Centro']."')";
	$hismarcarBD->consulta($sql);
	//Eliminar Cobros
	$sql="DELETE";//Fecha_Cobro, Pagado
	$sql=$sql." FROM Historico_Pagos";
	$sql=$sql." WHERE ((Not Fecha_Cobro='0000-00-00') AND Pagado='YES' AND Centro='".$_SESSION['Centro']."')";
	$hismarcarBD->consulta($sql);
  ?>
      <strong>Se han volcado los datos a Cobros.<br /> 
      En caso de error pongase en contacto con el Administrador.</strong></p>
  <p>Total de Registros Volcados: <?php echo count($NumPagos) ?></p>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

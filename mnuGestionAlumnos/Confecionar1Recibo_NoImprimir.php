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
<title>Generar Recibo - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
	window.onunload = top.opener.location.reload();
</script>
<!-- InstanceEndEditable -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Generar Recibo No Imprimir<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	//Actualizar la tabla de pagos
	$sql="UPDATE historico_pagos SET Pagado='YES', Fecha_Cobro='".cambiarfecha($_GET['F_Cobro'])."' WHERE numero_pago='".$_GET['NumPago']."'";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al actualizar Historico de Pagos: ".$miconexion->Error."<br />";
		echo $sql."<br />";
	}
	
	//Vuelca el recibo a la tabla movimientos en el apartado caja
	$sql="INSERT INTO movimientos (Descripcion, Haber, Fecha, idcuenta, idTipo, Centro) ";
	$sql=$sql."SELECT historico_pagos.Nombre_Alumno, historico_pagos.matricula+historico_pagos.materiales+historico_pagos.cuota+historico_pagos.dto, historico_pagos.Fecha_Cobro, '".$_SESSION['Centro']."CB1', 'IN', '".$_SESSION['Centro']."' ";
	$sql=$sql."FROM historico_pagos WHERE historico_pagos.numero_pago=".$_GET['NumPago'];
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar movimiento: ".$miconexion->Error."<br />";
		echo $sql;
	}
	
	//Vuelca en cobros
	$sql="INSERT INTO cobros (Cod, Fecha_Cobro,Fecha_De, Importe, Matricula, Dto, Cuota, Materiales, Pagado, Metalico, Periodo, Centro) ";
	$sql=$sql."SELECT historico_pagos.Cod, historico_pagos.Fecha_Cobro, historico_pagos.Fecha_De, historico_pagos.Importe, historico_pagos.Matricula, historico_pagos.Dto, historico_pagos.Cuota, historico_pagos.Materiales, historico_pagos.Pagado, historico_pagos.Metalico, historico_pagos.Periodo, '".$_SESSION['Centro']."' ";
	$sql=$sql."FROM historico_pagos ";
	$sql=$sql."WHERE historico_pagos.Pagado='YES' AND historico_pagos.Fecha_Cobro!='0000-00-00' AND centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar Cobro: ".$miconexion->Error."<br />";
		echo $sql;
	}
	
	//Elimina los reistros volcados
	$sql="DELETE FROM historico_pagos ";
	$sql=$sql."WHERE ((Not Fecha_Cobro='0000-00-00') AND Pagado='YES' AND Centro='".$_SESSION['Centro']."')";
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al elimina los reistros volcados: ".$miconexion->Error."<br />";
		echo $sql;
	}
	else{
		echo"<p>&nbsp;</p>\n";
		echo"<p align='center'><strong>Realizado el cobro</strong></p>\n";
	}
	
	$miconexion->desconectar();
	//$miconexion2->desconectar();
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

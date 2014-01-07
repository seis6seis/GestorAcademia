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
<title>Volcado de Recibos - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" --><strong>Adul. Cuatrimestre y Anual</strong><!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <div align="center">
  <?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="INSERT INTO historico_pagos (Fecha_Co, Fecha_De, Cod, Nombre_Alumno, Cuota, Dto, Importe, Periodo, Centro)";
	$sql=$sql." SELECT Alumnos.Fecha_Co, Alumnos.Fecha_Ba, Alumnos.Codi, Alumnos.Nombre_Alumno, If(Alumnos.Pago LIKE 'CU_%',GruposCuotas.CuotasTrim*".$_POST['cmbRecibo'].",If(Alumnos.Pago LIKE 'AN_%', GruposCuotas.CuotasAno*".$_POST['cmbRecibo'].", 0)) AS Cuota, If(Alumnos.Descuento='YES','12345.12','0'),'12345.12','".date('m')."','".$_SESSION['Centro']."'";
	$sql=$sql." FROM GruposCuotas INNER JOIN Alumnos ON GruposCuotas.Grupo=Alumnos.Grupo";
	$sql=$sql." WHERE (Alumnos.Fecha_Ba='0000-00-00' AND (Alumnos.Pago LIKE 'CU_%' OR Alumnos.Pago LIKE 'AN_%') AND alumnos.Centro='".$_SESSION['Centro']."')";

	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	else {
		$sql="UPDATE historico_pagos SET Dto=(Cuota*0.03)*(-1) WHERE Dto='12345.12'";
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else {
			$sql="UPDATE historico_pagos SET Importe=historico_pagos.Cuota+historico_pagos.Dto WHERE Importe='12345.12'";
			$miconexion->consulta($sql);
			if (!empty($miconexion->$Error)){
				echo $miconexion->Error."<br />";
				echo $sql;
			}
			else {
				echo "<br /><br /><br />\n";
				echo "<div align=center><b>Han sido realizado el volcado de recibos Mensual.</b><div>\n";
			}
		}
	}

?>
  <br />
    <strong><a href="VolcadoRecibos0.php">Ir a Volcado de Recibos</a></strong>
  </div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Apunte<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
	$Haber=str_replace(",",".", $_POST['txtHaber']);
	$Debe=str_replace(",",".", $_POST['txtDebe']);

	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="INSERT INTO Movimientos (idCuenta, idTipo, Fecha, Descripcion, Haber, Debe, Centro) ";
	$sql=$sql."VALUES ('".$_POST['cmbIDCuenta']."','".$_POST['cmbIDTipo']."','".$_POST['txtFecha']."','".$_POST['txtDescripcion']."','".$Haber."','".$Debe."','".$_POST['txtCentro']."')";

	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo $miconexion->Error."<br />";
		echo $sql;
	}
	else {
		echo "<br /><br /><br />\n";
		echo "<div align=center><b>El apunte &#8220;".$_POST['txtDescripcion']."&#8221; ha sido añadido.</b><div>\n";
	}
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

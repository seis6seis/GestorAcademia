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
<title>Datos Banco - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Datos Bancarios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php

	$miconexion = new DB_mysql ;
	$miconexion->conectar();

	$sql="SELECT Titular,Codigo_Banco,Codigo_Oficina,Digito_Control,Numero_Cuenta FROM banco WHERE Cod='".$_POST['hiddenCodigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	if ($miconexion->numregistros()!=0){
		$sql="UPDATE banco SET Titular='".$_POST['txtTitular']."', Codigo_Banco='".$_POST['txtbanco']."', Codigo_Oficina='".$_POST['txtsucursal']."', Digito_Control='".$_POST['txtdc']."', Numero_Cuenta='".$_POST['txtcuenta']."'  WHERE Cod='".$_POST['hiddenCodigo']."'";
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else {
			echo "<br /><br /><br />\n";
			echo "<div align=center><b>Los datos bancarios de &#8220;".$_POST['hiddenCodigo']."&#8221; han sido modificados.</b><div>\n";
		}

	}
	else{
			$sql="INSERT INTO banco (Cod,Nombre,Titular,Codigo_Banco,Codigo_Oficina,Digito_Control,Numero_Cuenta) ";
			$sql=$sql."VALUES ('".$_POST['hiddenCodigo']."','".$_POST['hiddenNombre']."','".$_POST['txtTitular']."','".$_POST['txtbanco']."','".$_POST['txtsucursal']."','".$_POST['txtdc']."','".$_POST['txtcuenta']."')";
			$miconexion->consulta($sql);
			if (!empty($miconexion->$Error)){
				echo $miconexion->Error."<br />";
				echo $sql;
			}
			else {
				echo "<br /><br /><br />\n";
				echo "<div align=center><b>Los datos bancarios de &#8220;".$_POST['hiddenCodigo']."&#8221; ha sido añadido.</b><div>\n";
			}
	}
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

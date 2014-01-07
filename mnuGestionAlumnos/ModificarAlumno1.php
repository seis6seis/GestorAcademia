<?php
	session_start();
	include("../login.class.php");
	require ("../Connections/funciones.php");

	$login=new login();
	$login->inicia();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Modificar Alumno - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->

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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Modificar Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p><br />
    <?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		if ($_POST['Material']=='on'){
			$Material='YES';
		}else{
			$Material='NO';
		}
		if ($_POST['Dto']=='on'){
			$Dto='YES';
		}else{
			$Dto='NO';
		}
		$sql="UPDATE alumnos SET Reserva='".$_POST['Reserva']."', Fecha_Al='".cambiarfecha($_POST['FecAlta'])."', Fecha_Co='".cambiarfecha($_POST['FecCom'])."', Fecha_Ba='".cambiarfecha($_POST['FecBaja'])."', Nombre_Alumno='".$_POST['NomAlumno']."', Direccion='".$_POST['Direccion']."', Ciudad='".$_POST['Ciudad']."', Codigo_Postal='".$_POST['CP']."', Telefono='".$_POST['Tlf']."', Movil='".$_POST['Movil']."', Pago='".$_POST['Pago']."', Grupo='".$_POST['Grupo']."', Materiales='".$Material."', Descuento='".$Dto."', Motivo_Dto='".$_POST['MotivoDto']."', Procedencia='".$_POST['Procedencia']."', Profesion_Estudios='".$_POST['Profesion']."', Necesidad='".$_POST['Necesidad']."', Edad='".$_POST['Ano']."', IDColegio='".$_POST['IDColegio']."', Correo='".$_POST['Correo']."', Cambios='".$_POST['Cambios']."', Observaciones='".$_POST['Observaciones']."' WHERE Codi='".$_POST['txtCentro'].$_POST['Codigo']."'";
		$miconexion->consulta($sql);
		if (!empty($miconexion->Error)){
			echo $miconexion->Error."<br />";

		}
		else {
			echo "<br /><br /><br />\n";
			echo "<div align=center><b>El alumno &#8220;".$_POST['Codigo']."&#8221; ha sido modificado.</b><div>\n";
		}
		$miconexion->desconectar();
  ?>
  </p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
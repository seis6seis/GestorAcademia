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
<title>Eliminar Alumnos sin Reserva - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Eliminar Alumnos sin Reserva<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	if($_POST['cmbCentro']!='' && $_POST['cmbCentro']!='Todos'){
		//Vacia Notas
		$sql="DELETE FROM Alumnos WHERE Centro='".$_POST['cmbCentro']."' AND Reserva=''";
		$miconexion->consulta($sql);
		echo "Se ha borrado los datos del Centro ".$_POST['cmbCentro'];
	}
	
	if($_POST['cmbCentro']=='Todos'){
		//Vacia Notas
		$sql="DELETE FROM Alumnos WHERE Reserva=''";
		//$miconexion->consulta($sql);
		echo "Se ha borrado los datos de TODOS los Centros.";
	}
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
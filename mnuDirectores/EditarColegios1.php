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
<title>Editar Colegios - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Colegios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
	<div align="center"><br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	if ($_POST['txtModificar']=='Nuevo'){
			$sql="SELECT idClegio FROM Colegio WHERE idClegio='".$_SESSION['Centro'].$_POST['txtCodigo']."'";
			$miconexion->consulta($sql);
			if ($miconexion->numregistros()!=0){
				echo "El Colegio ".$_POST['txtCodigo']." ya existe. <a href='EditarGrupos0.php?Codigo=Nuevo'>pulsar para volver</a>.<br />";
			}
			else{
				$sql="INSERT INTO Colegios (idClegio, NombreC, Hsalidas, Centro)";
				$sql=$sql." VALUES ('".$_SESSION['Centro'].$_POST['txtCodigo']."','".$_POST['txtNombreC']."','";
				$sql=$sql.$_POST['txtHsalidas']."','".$_SESSION['Centro']."')";
			}
	}
	else{
			$sql="UPDATE Colegios SET idClegio='".$_SESSION['Centro'].$_POST['txtCodigo']."',NombreC='".$_POST['txtNombreC'];
			$sql=$sql."',Hsalidas='".$_POST['txtHsalidas']."' WHERE idClegio='".$_POST['txtModificar']."'";
	}
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar Colegio: ".$miconexion->Error."<br />";
		echo $sql;
	}
	else{
		echo "	    <strong>Se ha modificado el Colegio'".$_POST['txtNombreC']."', <a href='EditarColegios0.php?Codigo=Nuevo'>pulsar para volver</a>.</strong></div>";
	}
?>
	    <br />
	    <br />
	    <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

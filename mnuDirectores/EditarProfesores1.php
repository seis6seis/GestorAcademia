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
<title>Editar Usuarios - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Usuarios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
	<div align="center"><br />
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	if (isset($_POST['txt04'])) $Permiso=3;
	if ($_POST['txtModificar']=='Nuevo'){
		$sql="SELECT Usuario FROM Usuarios WHERE Usuario='".$_POST['txt00']."'";
		$miconexion->consulta($sql);
		if ($miconexion->numregistros()!=0){
			echo "El usuario ".$_POST['txt00']." ya existe, posiblemente en otro centro. <a href='EditarProfesores0.php?Codigo=Nuevo'>pulsar para volver</a>.<br />";
		}
		else{
			$sql="INSERT INTO Usuarios (Usuario,Clave,NombreCompleto,Centro,Permisos,HorasSemanales,Salario,OtrosSalarios)";
			$sql=$sql." VALUES ('".$_POST['txt00']."','".$_POST['txt01']."','".$_POST['txt02']."','".$_POST['txt03']."','".$Permiso."','".$_POST['txtHorasSemanales']."','".$_POST['txtSalario']."','".$_POST['txtOtrosSalarios']."')";
		}
	}
	else{
		$sql="UPDATE Usuarios SET Usuario='".$_POST['txt00']."',Clave='".$_POST['txt01']."',NombreCompleto='".$_POST['txt02']."',";
		$sql=$sql."Centro='".$_POST['txt03']."',Permisos='".$_POST['txt04']."',HorasSemanales='".$_POST['txtHorasSemanales']."',Salario='".$_POST['txtSalario']."',OtrosSalarios='".$_POST['txtOtrosSalarios']."'";
		$sql=$sql." WHERE Usuario='".$_POST['txtModificar']."'";
	}
	$miconexion->consulta($sql);
	if (!empty($miconexion->$Error)){
		echo "Error al insertar usuario: ".$miconexion->Error."<br />";
		echo $sql;
	}
	else{
		echo "	    <strong>Se ha modificador el usuario'".$_POST['txt02']."', <a href='EditarProfesores0.php?Codigo=Nuevo'>pulsar para volver</a>.</strong></div>";
	}
?>
	    <br />
	    <br />
	    <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

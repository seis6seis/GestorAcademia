<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Crear Profesores - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nueva Información<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		if ($_POST['chkMatriculado']=='checked'){
			$Matriculado='YES';
		}
		else{
			$Matriculado='NO';
		}
		$sql="INSERT INTO informacion (Fecha,Nombre,Direccion,Telefono,F_Nacimiento,Estudia,Observaciones,Matriculado,ComoConocio,Centro) ";
		$sql=$sql."VALUES ('".cambiarfecha($_POST['txtFecha'])."','".$_POST['txtNombre']."','".$_POST['txtDireccion']."','".$_POST['txtTelefono']."','".cambiarfecha($_POST['txtFechaNacimiento'])."','".$_POST['txtEstudia']."','".$_POST['txtObservacones']."','".$Matriculado."','".$_POST['txtComoConocio']."','".$_POST['Centro']."')";

		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else {
			echo "<br /><br /><br />\n";
			echo "<div align=center><b>La informacion del alumno &#8220;".$_POST['txtNombre']."&#8221; ha sido añadido.</b><div>\n";
		}
		$miconexion->desconectar();
  ?>
  <br />
  <p align="center"><strong><a href='Informacion0.php?Centro=<?php echo $_POST['txtCentro']?>'>Volver a Informacion</a></strong></p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

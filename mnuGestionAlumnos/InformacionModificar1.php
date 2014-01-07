<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/funciones.php");
//	header('Content-type:text/javascript;charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Modificar Profesor - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Modificar Informacion del Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p><br />
    <?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		if($_POST['chkMatriculado']=='on'){
			$Matricula='YES';
		}
		else{
			$Matricula='NO';
		}
		$sql="UPDATE Informacion SET Fecha='".cambiarfecha($_POST['txtFecha'])."', Nombre='".$_POST['txtNombre']."', Direccion='".$_POST['txtDireccion']."',Telefono='".$_POST['txtTelefono']."', F_Nacimiento='".cambiarfecha($_POST['txtFechaNacimiento'])."', Estudia='".$_POST['txtEstudia']."', Observaciones='".$_POST['txtObservacones']."', Matriculado='".$Matricula."', ComoConocio='".$_POST['txtComoConocio']."' WHERE ID_Informacion='".$_POST['ID']."'";
		
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else {
			echo "<br /><br /><br />\n";
			echo "<div align=center><b>La informacion del alumno &#8220;".$_POST['txtNombre']."&#8221; ha sido modificado.</b><div>\n";
		}
		$miconexion->desconectar();
  ?>
  </p>
  <p align="center"><strong><a href='Informacion0.php?Centro=<?php echo $_POST['txtCentro']?>'>Volver a Informacion</a></strong></p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

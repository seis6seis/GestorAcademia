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
<title>Nuevo Alumno - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p><br />
    <?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
    $sql="SELECT Codi FROM Alumnos WHERE Codi='".$_POST['txtCentro'].$_POST['Codigo']."'";
		$miconexion->consulta($sql);
		if ($miconexion->numregistros()==0){
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
			$sql="INSERT INTO alumnos (Codi, Reserva, Fecha_Al, Fecha_Co, Fecha_Ba, Nombre_Alumno, Direccion, Ciudad, Codigo_Postal, Telefono, Movil, Pago, Grupo, Materiales, Descuento, Motivo_Dto, Procedencia, Profesion_Estudios, Necesidad, Edad, IDColegio, Correo, Cambios, Observaciones, Centro) ";
			$sql=$sql."VALUES ('".$_POST['txtCentro'].$_POST['Codigo']."', '".$_POST['Reserva']."', '".cambiarfecha($_POST['FecAlta'])."', '".cambiarfecha($_POST['FecCom'])."', '".cambiarfecha($_POST['FecBaja'])."', '".$_POST['NomAlumno']."', '".$_POST['Direccion']."', '".$_POST['Ciudad']."', '".$_POST['CP']."', '".$_POST['Tlf']."', '".$_POST['Movil']."', '".$_POST['Pago']."', '".$_POST['Grupo']."', '".$Material."', '".$Dto."', '".$_POST['MotivoDto']."', '".$_POST['Procedencia']."', '".$_POST['Profesion']."', '".$_POST['Necesidad']."', '".$_POST['Ano']."', '".$_POST['IDColegio']."', '".$_POST['Correo']."', '".$_POST['Cambios']."', '".$_POST['Observaciones']."', '".$_POST['txtCentro']."')";
			$miconexion->consulta($sql);
			if (!empty($miconexion->$Error)){
				echo $miconexion->Error."<br />";
			}
			else {
				echo "<br /><br /><br />\n";
				echo "<div align=center><b>El usuario &#8220;".$_POST['Codigo']."&#8221; ha sido añadido.</b><div>\n";
			}
		}
		else{
				echo "<div align=center><b>El usuario &#8220;".$_POST['Codigo']."&#8221; ya existe. <h3>¡¡Por lo que no se puee crear!!</h3></b></div>\n";
		}
		$miconexion->desconectar();
  ?>
  </p>
  <p>&nbsp;</p>
  <p align="center"><a href="NuevoAlumno0.php?Centro=<?php echo$_SESSION['Centro'] ?>"><strong>Agregar otro Alumno</strong></a></p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
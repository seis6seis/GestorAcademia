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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Buscar Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="BuscarAlumno0.php">
    <p><strong>&nbsp;&nbsp;Buscar Alumno por Nombre: </strong>
      <input name="txtBuscar" type="text" id="txtBuscar" value="<?php echo $_POST['txtBuscar'] ?>" />
      <input type="submit" name="button" id="button" value="Enviar" />
      <br />
      <font color="#FF0000"><strong>*</strong></font>
      Use el comodin %. (Ej: %AL, todo lo que finalice en AL. Ej: AL%, todo lo que comience en AL. Ej: %AL%, todo lo que contenga AL).<br />
    </p>
  </form>
  <br />
<table  border="1" align="center">
  <tr>
    <td width="108"><div align="center"><strong>Codigo</strong></div></td>
		<td width="299"><div align="center"><strong>Reserva</strong></div></td>
		<td width="399"><div align="center"><strong>Fecha Alta</strong></div></td>
		<td width="299"><div align="center"><strong>Fecha Comienzo</strong></div></td>
		<td width="299"><div align="center"><strong>Fecha Baja</strong></div></td>
    <td width="299"><div align="center"><strong>Nombre Alumno</strong></div></td>
		<td width="299"><div align="center"><strong>Direccion</strong></div></td>
		<td width="299"><div align="center"><strong>Ciudad</strong></div></td>
		<td width="299"><div align="center"><strong>Codigo Postal</strong></div></td>
		<td width="299"><div align="center"><strong>Telefono</strong></div></td>
		<td width="299"><div align="center"><strong>Movil</strong></div></td>
		<td width="299"><div align="center"><strong>Pago</strong></div></td>
		<td width="299"><div align="center"><strong>Grupo</strong></div></td>
		<td width="299"><div align="center"><strong>Materiales</strong></div></td>
		<td width="299"><div align="center"><strong>Descuento</strong></div></td>
		<td width="299"><div align="center"><strong>Motivo Dto.</strong></div></td>
		<td width="299"><div align="center"><strong>Procedencia</strong></div></td>
		<td width="299"><div align="center"><strong>Profesion/Estudios</strong></div></td>
		<td width="299"><div align="center"><strong>Necesidad</strong></div></td>
		<td width="299"><div align="center"><strong>Edad</strong></div></td>
		<td width="299"><div align="center"><strong>IDColegio</strong></div></td>
		<td width="299"><div align="center"><strong>Correo</strong></div></td>
		<td width="299"><div align="center"><strong>Cambios</strong></div></td>
		<td width="299"><div align="center"><strong>Observaciones</strong></div></td>
  </tr>

<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT * FROM alumnos WHERE Nombre_Alumno LIKE '".$_POST['txtBuscar']."' AND Centro='".$_SESSION['Centro']."' ORDER BY Nombre_Alumno ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo"  <tr>\n";
    echo"    <td><a href='ModificarAlumno0.php?Codigo=".$row['Codi']."&Centro=".$_SESSION['Centro']."' target='_blank'>&nbsp;".substr($row['Codi'],3)."&nbsp;</a></td>\n";
    echo"    <td>&nbsp;".$row['Reserva']."</td>\n";
    echo"    <td>&nbsp;".cambiarfecha($row['Fecha_Al'])."</td>\n";
    echo"    <td>&nbsp;".cambiarfecha($row['Fecha_Co'])."</td>\n";
    echo"    <td>&nbsp;".cambiarfecha($row['Fecha_Ba'])."</td>\n";
    echo"    <td>&nbsp;".$row['Nombre_Alumno']."</td>\n";
    echo"    <td>&nbsp;".$row['Direccion']."</td>\n";
    echo"    <td>&nbsp;".$row['Ciudad']."</td>\n";
    echo"    <td>&nbsp;".$row['Codigo_Postal']."</td>\n";
    echo"    <td>&nbsp;".$row['Telefono']."</td>\n";
    echo"    <td>&nbsp;".$row['Movil']."</td>\n";
    echo"    <td>&nbsp;".$row['Pago']."</td>\n";
    echo"    <td>&nbsp;".$row['Grupo']."</td>\n";
    echo"    <td>&nbsp;".$row['Materiales']."</td>\n";
    echo"    <td>&nbsp;".$row['Descuento']."</td>\n";
    echo"    <td>&nbsp;".$row['Motivo_Dto']."</td>\n";
    echo"    <td>&nbsp;".$row['Procedencia']."</td>\n";
    echo"    <td>&nbsp;".$row['Profesion_Estudios']."</td>\n";
    echo"    <td>&nbsp;".$row['Necesidad']."</td>\n";
    echo"    <td>&nbsp;".$row['Edad']."</td>\n";
    echo"    <td>&nbsp;".$row['IDColegio']."</td>\n";
    echo"    <td>&nbsp;".$row['Correo']."</td>\n";
    echo"    <td>&nbsp;".$row['Cambios']."</td>\n";
    echo"    <td>&nbsp;".$row['Observaciones']."</td>\n";
		echo"  </tr>\n";
	}
?>
</table>
<br />

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

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
<title>Imprimir Notas - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Imprimir Notas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="get" action="ImprimirNotas2.php">
      <table width="400" border="1" align="center">
        <tr>
          <td width="14%"><div align="center">&nbsp;</div></td>
          <td width="14%"><div align="center"><strong>Codigo</strong></div></td>
          <td width="72%"><div align="center"><strong>Nombre</strong></div></td>
        </tr>
<?php
	$Total=0;
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Alumnos.Codi, Alumnos.Nombre_Alumno";
	$sql=$sql." FROM (Alumnos INNER JOIN Notas ON Alumnos.Codi = Notas.Codi)";
	$sql=$sql." WHERE Alumnos.Fecha_Ba='0000-00-00' AND Alumnos.Grupo='".$_GET['Grupo']."' AND Notas.Parcial='".$_GET['Parcial']."'";
	$sql=$sql." ORDER BY Alumnos.Codi ASC";
	$miconexion->consulta($sql);
	while($Alumno=mysql_fetch_array($miconexion->Consulta_ID)){
		echo "        <tr>\n";
		echo "          <td>\n";
		echo "            <input type='checkbox' name='chk".$Alumno['Codi']."' id='chk".$Alumno['Codi']."' checked='checked' />\n";
		echo "          </td>\n";
		echo "          <td>".$Alumno['Codi']."</td>\n";
		echo "          <td>".$Alumno['Nombre_Alumno']."</td>\n";
		echo "        </tr>\n";
		$Total=$Total+1;
	}
?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><div align="center">
            <label>
            <input type="submit" name="button" id="button" value="Enviar" />
            </label>
          </div></td>
        </tr>
      </table>
    <input name="Grupo" type="hidden" id="Grupo" value="<?php echo $_GET['Grupo'] ?>" />
    <input name="Parcial" type="hidden" id="Parcial" value="<?php echo $_GET['Parcial'] ?>" />
    <input name="Total" type="hidden" id="Total" value="<?php echo $Total ?>" />
  </form>
  <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

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
<title>Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->

<style type="text/css">
.Encabezado1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.Encabezado2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Label {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #0033FF;
	font-style: italic;
}
.Respuestas{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
</style>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM gruposcuotas WHERE Grupo='".$_POST['selGrupo']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
          <table width="900" border="0" align="left">
            <tr>
              <td width="77%" height="45" align="center" valign="top" class="Encabezado1">
              <div align="center">English Student Control<br />
              Group:&nbsp;<?php echo $_POST['selGrupo'] ?></div></td>
              <td width="6%" align="left" valign="top" class="Encabezado1">&nbsp;</td>
              <td width="17%" align="left" valign="top" class="Encabezado2">
                Edición:1<br />
                Fecha:01/03/06<br />
                Pagina 1 de 1
              </td>
            </tr>
          </table>
				 <!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <table width="970" border="0">
    <tr>
      <td width="24%"><span class="Label">Syllabus:&nbsp;</span><span class="Respuestas"><?php echo $row['Programa'] ?></span></td>
      <td width="45%"><span class="Label">Timetable:&nbsp;</span><span class="Respuestas"><?php echo $row['Horarios'] ?></span></td>
      <td width="31%"><span class="Label">Teacher:&nbsp;</span><span class="Respuestas"><?php echo $row['Profesor'] ?></span></td>
    </tr>
  </table>
  <br />
  <table width="970" border="1">
    <tr>
      <td class="Label"><div align="center">Names</div></td>
      <td class="Label"><div align="center">Course</div></td>
      <td class="Label"><div align="center">Needed</div></td>
      <td class="Label"><div align="center">Absences</div></td>
      <td class="Label"><div align="center">Exams Marks</div></td>
      <td class="Label"><div align="center">Increase</div></td>
      <td class="Label"><div align="center">School Marks</div></td>
    </tr>
<?php
	$sql="SELECT * FROM Alumnos WHERE Grupo='".$_POST['selGrupo']."' AND Fecha_Ba='0000-00-00' ORDER BY Codi ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "    <tr>";
		echo "      <td>".$row['Nombre_Alumno']."</td>";
		echo "      <td><div align='center'>".$row['Profesion_Estudios']."</div></td>";
		echo "      <td><div align='center'>".$row['Necesidad']."</div></td>";
		echo "      <td>&nbsp;</td>";
		echo "      <td>&nbsp;</td>";
		echo "      <td>&nbsp;</td>";
		echo "      <td>&nbsp;</td>";
		echo "    </tr>";
	}
?>
  </table>
  <br />
  <table width="970" border="1">
    <tr>
      <td class="Label"><div align="center">Date</div></td>
      <td class="Label"><div align="center">Progress in book (pag)</div></td>
      <td class="Label"><div align="center">Homework readings (pag)</div></td>
      <td class="Label"><div align="center">Homework Speakings</div></td>
      <td class="Label"><div align="center">Homework Writingns</div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

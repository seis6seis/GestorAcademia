<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Volcado de Recibos - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Volcado de recibos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
<form id="form1" name="form1" method="post" action="VolcadoRecibos5-1.php">
  <table width="501" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
      <td width="495" height="128" align="left" valign="top">
      	<table width="100%" border="0">
        <tr>
          <td width="33%">&nbsp;</td>
          <td width="4%">&nbsp;</td>
          <td width="63%" rowspan="5" align="left" valign="top">
            <fieldset>
              <legend><strong>Opciones Iniciales</strong></legend>
        			<label>              
                <input type="radio" name="OpcionesIniciales" value="op1" id="OpcionesIniciales_0" />
                Volcado de matriculas inicio Año academico.
              </label>
        			<br />
              <label>
                <input type="radio" name="OpcionesIniciales" value="op2" id="OpcionesIniciales_1" />
                Solo Material.
              </label>
              <br />
              <label>
                <input type="radio" name="OpcionesIniciales" value="op3" id="OpcionesIniciales_2" />
                Solo Septiembre.
              </label>
              <br />
              <label>
                <input type="radio" name="OpcionesIniciales" value="op4" id="OpcionesIniciales_3" />
                Septiembre y Material.
              </label>
              <br />
              <label>
                <input type="radio" name="OpcionesIniciales" value="op5" id="OpcionesIniciales_4" />
                Octubre y Material.
              </label>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td rowspan="4">
          	<div align="center">
            	<a href="VolcadoRecibos1.php"><strong>Trimestral y Mensual</strong></a><br />
              <a href="VolcadoRecibos2.php"><strong>Mensual</strong></a><br />
              <a href="VolcadoRecibos3-1.php"><strong>Adul. Cuatrimestre y Anual</strong></a><br />
              <a href="VolcadoRecibos4-1.php"><strong>Adultos Cuatrimestre</strong></a>
            </div>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><div align="center">
            <input type="submit" name="button" id="button" value="Aceptar" />
          </div></td>
        </tr>
      </table>
			</td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" --><strong>Adul. Cuatrimestre y Anual</strong><!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <form id="form1" name="form1" method="post" action="VolcadoRecibos3-2.php">
    <label> 
      <div align="center"><strong>Escoja el numero de recibo:</strong><br />
      <select name="cmbRecibo" id="cmbRecibo">
        <option value="0.6" selected="selected">Primer recibo</option>
        <option value="0.4">Segundo recibo</option>
      </select>
      <br />
      <br />
    	<input type="submit" name="button" id="button" value="Enviar" />
    </label>
    </div>
</form>
  <hr />
  <div align="center">  </div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

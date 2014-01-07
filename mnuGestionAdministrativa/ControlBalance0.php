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
<title>Control y Balance - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

function balance(valor)
{
	var Cadena;
	Cadena="ControlBalance_Balance0.php";
	Cadena=Cadena+"?FecInicial="+document.form1.txtFechaInicial.value;
	Cadena=Cadena+"&FecFinal="+document.form1.txtFechaFinal.value;
	popup(Cadena,800,400,'yes');
}
</script>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
-->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Control y Balance<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="">
    <table width="435" border="0" align="center">
      <tr>
        <td width="60%"><strong>Fecha Final:&nbsp;&nbsp;&nbsp;
        <label>
        <input name="txtFechaFinal" type="text" id="txtFechaFinal" value="<?php echo date('d-m-Y') ?>" size="15" maxlength="10" />
        </label>
        </strong></td>
        <td width="40%" rowspan="2" align="left" valign="top"><span class="Estilo1">
          	<a href="#" onclick="javascript:window.open('ControlBalance_Balance0.php?FecInicial='+document.form1.txtFechaInicial.value+'&FecFinal='+document.form1.txtFechaFinal.value)">Balance</a><br>
        	<a href="#" onclick="javascript:window.open('MovimientosCuentas.php?FecInicial='+document.form1.txtFechaInicial.value+'&FecFinal='+document.form1.txtFechaFinal.value)">Movimientos por Cuentas</a><br>
	        <a href="#" onclick="javascript:window.open('PendientesCobro0.php')">Pendientes de Cobro</a></span>
         </td>
      </tr>
      <tr>
        <td><strong>Fecha Inicial:</strong>
            <input name="txtFechaInicial" type="text" id="txtFechaInicial" size="15" maxlength="10"/>
        </td>
      </tr>
    </table>
  </form>
  <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

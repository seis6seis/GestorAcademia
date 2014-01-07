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
<title>Datos Banco - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script language="javascript">
function obtenerDigito(valor){
  valores = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
  control = 0;
  for (i=0; i<=9; i++)
    control += parseInt(valor.charAt(i)) * valores[i];
  control = 11 - (control % 11);
  if (control == 11) control = 0;
  else if (control == 10) control = 1;
  return control;
}
function numerico(valor){
  cad = valor.toString();
  for (var i=0; i<cad.length; i++) {
    var caracter = cad.charAt(i);
	if (caracter<"0" || caracter>"9")
	  return false;
  }
  return true;
}
function validar(f) {
  if (f.txtbanco.value == ""  || f.txtsucursal.value == "" ||
      f.txtdc.value == "" || f.txtcuenta.value == "" || f.txtTitular.value=="")
    alert("Por favor, introduzca los datos de su cuenta");
  else {
    if (f.txtbanco.value.length != 4 || f.txtsucursal.value.length != 4 ||
        f.txtdc.value.length != 2 || f.txtcuenta.value.length != 10)
      alert("Por favor, introduzca correctamente los datos de su cuenta;"
	    + " no están completos");
    else {
      if (!numerico(f.txtbanco.value) || !numerico(f.txtsucursal.value) ||
          !numerico(f.txtdc.value) || !numerico(f.txtcuenta.value))
        alert("Por favor, introduzca correctamente los datos de su "
         + "cuenta; no son numericos");
      else {
        if (!(obtenerDigito("00" + f.txtbanco.value + f.txtsucursal.value) ==
              parseInt(f.txtdc.value.charAt(0))) || 
            !(obtenerDigito(f.txtcuenta.value) ==
              parseInt(f.txtdc.value.charAt(1))))
          alert("Los dígitos de control no se corresponden con los demás"
            + " números de la cuenta");
	    else
          return true;
      }
    }
  }
	return false;
}
</script>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Datos Bancarios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
if (substr($_GET['Alumno'],3)=="null"){
	echo "<br>\n";
	echo "<br>\n";
	echo "<br>\n";
	echo "<br>\n";
	echo "<p><div align='center'><strong>Seleccione alumno para agregar datos bancarios.</strong></div></p>\n";
}
else{
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Codi,Nombre_Alumno,Descuento,Pago,Fecha_Co FROM alumnos WHERE Codi='".$_GET['Alumno']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
  <hr />
  <div align="center"></div>
  <table width="84%" border="0" align="center">
    <tr>
      <td height="24" align="center" valign="top" bgcolor="#999999"><strong>Codigo:&nbsp;</strong> 
        <label>
        <input name="txtCodigo" type="text" class="formulario" id="txtCodigo" value="<?php echo $row['Codi'] ?>" size="10" maxlength="10" READONLY/>&nbsp;
        <input name="txtNombre" type="text" id="txtNombre" value="<?php echo $row['Nombre_Alumno'] ?>" maxlength="50" class="formulario" READONLY/>
        <strong>Dto.:&nbsp;</strong>
        <input type="checkbox" name="chkDTO" id="chkDTO" value="<?php echo $row['Descuento'] ?>" class="formulario" onclick='this.checked = !this.checked' />&nbsp;
        <input name="txtPago" type="text" class="formulario" id="txtPago" value="<?php echo $row['Pago'] ?>" size="6" maxlength="4" READONLY />
        &nbsp;
        <strong>Fecha Comienzo:&nbsp;</strong> 
      <input name="txtFComienzo" type="text" class="formulario" id="txtFComienzo" value="<?php echo cambiarfecha($row['Fecha_Co']) ?>" size="13" maxlength="10" READONLY />
        &nbsp; </label></td>
    </tr>
    <tr>
      <td height="135" align="center" valign="middle">
        <form id="form1" name="form1" method="post" onSubmit = "return validar(this)" action="DatosBanco1.php" class="formulario">
          <input type="hidden" name="hiddenCodigo" id="hiddenCodigo" value="<?php echo $row['Codi'] ?>" />
					<input type="hidden" name="hiddenNombre" id="hiddenNombre" value="<?php echo $row['Nombre_Alumno'] ?>" />

<?php
	$sql="SELECT Titular,Codigo_Banco,Codigo_Oficina,Digito_Control,Numero_Cuenta FROM banco WHERE Cod='".$_GET['Alumno']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
          <br />
          <table width="90%" border="0" align="center">
          <tr>
            <td width="23%" align="left" valign="top"><strong>Titular:&nbsp;</strong></td>
            <td width="77%" align="left" valign="top"><label>
              <input name="txtTitular" type="text" id="txtTitular" value="<?php echo $row['Titular'] ?>" size="68" maxlength="40" class="formulario" />
            </label></td>
          </tr>
          <tr>
            <td align="left" valign="top"><strong>Cuenta Bancaria:&nbsp;</strong></td>
            <td align="left" valign="top"><label>
              <input name="txtbanco" type="text" id="txtbanco" value="<?php echo $row['Codigo_Banco'] ?>" size="6" maxlength="4" class="formulario" />&nbsp;
              <input name="txtsucursal" type="text" id="txtsucursal" value="<?php echo $row['Codigo_Oficina'] ?>" size="6" maxlength="4" class="formulario" />&nbsp;
              <input name="txtdc" type="text" id="txtdc" value="<?php echo $row['Digito_Control'] ?>" size="4" maxlength="2" class="formulario" />&nbsp;
              <input name="txtcuenta" type="text" id="txtcuenta" value="<?php echo $row['Numero_Cuenta'] ?>" size="13" maxlength="10" class="formulario" />&nbsp;</label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div align="center">
              <label>
              <input type="submit" name="button" id="button" value="Enviar" />
              </label>
              <label>
              <input type="reset" name="button2" id="button2" value="Restablecer" />
              </label>
            </div></td>
          </tr>
        </table>
        </form>      </td>
    </tr>
  </table>
<?php
}
?>
  <br />
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

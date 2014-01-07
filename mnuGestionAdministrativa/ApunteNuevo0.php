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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Apunte<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
	<form id="form1" name="form1" method="post" action="ApunteNuevo1.php">
	  <table width="436" border="0" align="center">
      <tr>
        <td width="71" height="17"><strong>Fecha:</strong></td>
        <td width="149"><label>
          <input name="txtFecha" type="text" id="txtFecha" tabindex="0" value="<?php echo date('Y-m-d') ?>" maxlength="10" />
        </label></td>
        <td width="53"><strong>Descripción:</strong></td>
      <td width="145"><label>
        <input name="txtDescripcion" type="text" id="txtDescripcion" maxlength="50" tabindex="3" />
      </label></td>
      </tr>
      <tr>
        <td><strong>idCuenta:</strong></td>
        <td><label>
          <select name="cmbIDCuenta" id="cmbIDCuenta" tabindex="1">
	          <option value='' class='formulario'>&nbsp;</option>
<?php
	$miconexion = new DB_mysql ;
  $miconexion->conectar();
	$sql="SELECT IDCuenta,Descripcion FROM Cuentas WHERE Centro='".$_GET['Centro']."' ORDER BY IDCuenta ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "          	<option value='".$row['IDCuenta']."' class='formulario'>".$row['Descripcion']."</option>\n";
	}
?>
          </select>
          </label>        </td>
        <td><strong>Haber:</strong></td>
        <td><label>
          <input name="txtHaber" type="text" id="txtHaber" maxlength="10" tabindex="4" />
        </label></td>
      </tr>
      <tr>
        <td><strong>idTipo:</strong></td>
        <td><label>
          <select name="cmbIDTipo" id="cmbIDTipo" tabindex="2">
	          <option value='' class='formulario'>&nbsp;</option>
<?php
	$sql="SELECT * FROM Tipos ORDER BY ID ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "          	<option value='".$row['Cod']."' class='formulario'>".$row['Descripcion']."</option>\n";
	}
?>
          </select>
        </label></td>
        <td><strong>Debe:</strong></td>
        <td><input name="txtDebe" type="text" id="txtDebe" maxlength="10" tabindex="5" /></td>
      </tr>
      <tr>
        <td><input name="txtCentro" type="hidden" id="txtCentro" value="<?php echo $_GET['Centro'] ?>" tabindex="14" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
        	<div align="center">
            <label>
              <input type="submit" name="button" id="button" value="Enviar" tabindex="6" />
            </label>
            &nbsp;&nbsp;&nbsp;
            <label>
              <input type="reset" name="button2" id="button2" value="Restablecer" tabindex="7" />
            </label>
					</div>				</td>
      </tr>
    </table>
	</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

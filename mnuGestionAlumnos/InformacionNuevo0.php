<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Nueva Informacion - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nueva Información<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<form id="form1" name="form1" method="post" action="InformacionNuevo1.php">
  <table width="61%" border="0" align="center">
    <tr>
      <td width="16%"><strong>Fecha:</strong></td>
      <td width="32%"><label>
        <input name="txtFecha" type="text" id="txtFecha" maxlength="10" value='<?php echo cambiarfecha(date("Y-m-d")) ?>' tabindex='0' readonly />
      </label></td>
      <td width="21%"><strong>Telefono:</strong></td>
      <td width="31%"><label>
        <input name="txtTelefono" type="text" id="txtTelefono" tabindex='4' maxlength="9"  />
      </label></td>
    </tr>
    <tr>
      <td><strong>Matriculado:</strong></td>
      <td><label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="chkMatriculado" type="checkbox" id="chkMatriculado" tabindex='1' />
      </label></td>
      <td><strong>Estudia:</strong></td>
      <td><label>
        <input name="txtEstudia" type="text" id="txtEstudia" tabindex='5' maxlength="50" />
      </label></td>
    </tr>
    <tr>
      <td><strong>Apellidos, Nombre:</strong></td>
      <td><label>
        <input name="txtNombre" type="text" id="txtNombre" tabindex='2' maxlength="40" />
      </label></td>
      <td><strong>Fecha Nacimiento:</strong></td>
      <td><label>
        <input name="txtFechaNacimiento" type="text" id="txtFechaNacimiento" tabindex='6' maxlength="10" />
      </label></td>
    </tr>
    <tr>
      <td><strong>Dirección:</strong></td>
      <td><label>
        <input name="txtDireccion" type="text" id="txtDireccion" tabindex='3' maxlength="40" />
      </label></td>
      <td><strong>Obsevaciones:</strong></td>
      <td><label>
        <input type="text" name="txtObservacones" id="txtObservacones" tabindex='7' />
      </label></td>
    </tr>
    <tr>
      <td><strong>Como nos Conocio:</strong></td>
      <td><select name="txtComoConocio" id="txtComoConocio" tabindex='8'>
        <option>----</option>
        <option value="AC" <?php if($row['ComoConocio']=='AC') echo " selected='selected'" ?> >Alumno del Centro</option>
        <option value="FA" <?php if($row['ComoConocio']=='FA') echo " selected='selected'" ?> >Fachada</option>
        <option value="IA" <?php if($row['ComoConocio']=='IA') echo " selected='selected'" ?> >Paginas Amarillas</option>
        <option value="IG" <?php if($row['ComoConocio']=='IG') echo " selected='selected'" ?> >Google</option>
        <option value="IL" <?php if($row['ComoConocio']=='IL') echo " selected='selected'" ?> >Internet Local </option>
        <option value="PP" <?php if($row['ComoConocio']=='PP') echo " selected='selected'" ?> >Papel, Carteles, Buzon</option>
        <option value="RF" <?php if($row['ComoConocio']=='RF') echo " selected='selected'" ?> >Referencias</option>
        <option value="OT" <?php if($row['ComoConocio']=='OT') echo " selected='selected'" ?> >Otros</option>
      </select></td>
      <td><input name="Centro" type="hidden" id="Centro" value="<?php echo $_GET['Centro'] ?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><label>
        <div align="center">
          <input type="submit" name="btnEnviar" id="btnEnviar" value="Enviar" tabindex='8' />
          <input type="reset" name="btnRestablecer" id="btnRestablecer" value="Restablecer" tabindex='9' />
        </div>
      </label></td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

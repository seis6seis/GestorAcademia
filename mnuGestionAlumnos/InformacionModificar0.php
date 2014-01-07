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
<title>Modificar Profesor - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Modificar Informacion del Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM Informacion WHERE ID_Informacion='".$_GET['ID']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
  <hr />
  <form id="form1" name="form1" method="post" action="InformacionModificar1.php">
    <table width="61%" border="0" align="center">
      <tr>
        <td width="16%"><strong>Fecha:</strong></td>
        <td width="32%"><label>
        <input name="txtFecha" type="text" id="txtFecha" maxlength="10" value='<?php echo cambiarfecha($row['Fecha']) ?>' tabindex='0' readonly />
        </label></td>
        <td width="21%"><strong>Telefono:</strong></td>
        <td width="31%"><label>
        <input name="txtTelefono" type="text" id="txtTelefono" tabindex='4' maxlength="9" value='<?php echo $row['Telefono'] ?>'  />
        </label></td>
      </tr>
      <tr>
        <td><strong>Matriculado:</strong></td>
        <td><label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="chkMatriculado" type="checkbox" id="chkMatriculado" tabindex='1' <?php if($row['Matriculado']=='YES') echo "checked='checked'" ?> />
        </label></td>
        <td><strong>Estudia:</strong></td>
        <td><label>
        <input name="txtEstudia" type="text" id="txtEstudia" tabindex='5' maxlength="50" value='<?php echo $row['Estudia'] ?>' />
        </label></td>
      </tr>
      <tr>
        <td><strong>Apellidos, Nombre:</strong></td>
        <td><label>
        <input name="txtNombre" type="text" id="txtNombre" tabindex='2' maxlength="40" value='<?php echo $row['Nombre'] ?>' />
        </label></td>
        <td><strong>Fecha Nacimiento:</strong></td>
        <td><label>
        <input name="txtFechaNacimiento" type="text" id="txtFechaNacimiento" tabindex='6' maxlength="10" value='<?php echo cambiarfecha($row['F_Nacimiento']) ?>' />
        </label></td>
      </tr>
      <tr>
        <td><strong>Dirección:</strong></td>
        <td><label>
        <input name="txtDireccion" type="text" id="txtDireccion" tabindex='3' maxlength="40" value='<?php echo $row['Direccion'] ?>' />
        </label></td>
        <td><strong>Obsevaciones:</strong></td>
        <td><label>
        <input type="text" name="txtObservacones" id="txtObservacones" tabindex='7' value='<?php echo $row['Observaciones'] ?>' />
        </label></td>
      </tr>
      <tr>
        <td><strong>Como nos Conocio:</strong></td>
        <td>
          <select name="txtComoConocio" id="txtComoConocio" tabindex='8'>
          	<option>----</option>
            <option value="AC" <?php if($row['ComoConocio']=='AC') echo " selected='selected'" ?> >Alumno del Centro</option>
            <option value="FA" <?php if($row['ComoConocio']=='FA') echo " selected='selected'" ?> >Fachada</option>
            <option value="IA" <?php if($row['ComoConocio']=='IA') echo " selected='selected'" ?> >Paginas Amarillas</option>
            <option value="IG" <?php if($row['ComoConocio']=='IG') echo " selected='selected'" ?> >Google</option>
            <option value="IL" <?php if($row['ComoConocio']=='IL') echo " selected='selected'" ?> >Internet Local </option>
            <option value="PP" <?php if($row['ComoConocio']=='PP') echo " selected='selected'" ?> >Papel, Carteles, Buzon</option>
            <option value="RF" <?php if($row['ComoConocio']=='RF') echo " selected='selected'" ?> >Referencias</option>
            <option value="OT" <?php if($row['ComoConocio']=='OT') echo " selected='selected'" ?> >Otros</option>
          </select>
        </td>
        <td>&nbsp;</td>
        <td><input name="ID" type="hidden" id="ID" value="<?php echo $_GET['ID'] ?>" /></td>
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

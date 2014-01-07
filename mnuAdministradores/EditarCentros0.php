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
<title>Editar Centro - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Centros<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="EditarCentros1.php">
  <p><strong>&nbsp;&nbsp;Editar Centro:&nbsp;</strong> 
    <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
			<option value='EditarCentros0.php'>&nbsp;</option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Codigo, NombreCentro FROM Centros";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "<option value='EditarCentros0.php?Codigo=".$row['Codigo']."'";
		if ($_GET['Codigo']==$row['Codigo']) echo " selected ";
		echo ">".$row['Codigo']."--".$row['NombreCentro']."</option>";
	}
?>
    </select>
<?php
	$sql="SELECT * FROM Centros WHERE Codigo='".$_GET['Codigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
    &nbsp;&nbsp;
    <a href="EditarCentros0.php?Codigo=Nuevo"><strong>Agregar</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--    <a href="EditarCentros2.php?Codigo=<?php echo $_GET['Codigo'] ?>"><strong>Borrar</strong></a><br /> -->
  </p>
  <table width="759" border="0" align="center">
    <tr>
      <td width="15%"><strong>Codigo:</strong></td>
      <td width="16%"><label>
        <input name="txt00" type="text" id="txt00" tabindex="0" value="<?php echo $row['Codigo'] ?>" size="20" maxlength="3" <?php	if ($_GET['Codigo']=='Nuevo' or $_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td width="17%"><strong>NIF Presentador:</strong></td>
      <td width="18%"><label>
        <input name="txt08" type="text" id="txt08" tabindex="8" value="<?php echo $row['NIF_Presentador'] ?>" size="20" maxlength="9" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td width="17%"><strong>NIF Ordenante:</strong></td>
      <td width="17%"><input name="txt13" type="text" id="txt13" tabindex="13" value="<?php echo $row['NIF_Ordenante'] ?>" size="20" maxlength="9" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>Nombre Centro:</strong></td>
      <td><label>
        <input name="txt01" type="text" id="txt01" tabindex="1" value="<?php echo $row['NombreCentro'] ?>" size="20" maxlength="50" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Nombre Presentador:</strong></td>
      <td><label>
        <input name="txt09" type="text" id="txt09" tabindex="9" value="<?php echo $row['Nombre_Presentador'] ?>" size="20" maxlength="40" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Nombre Ordenante:</strong></td>
      <td><input name="txt14" type="text" id="txt14" tabindex="14" value="<?php echo $row['Nombre_Ordenante'] ?>" size="20" maxlength="40" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>Direccion:</strong></td>
      <td><label>
        <input name="txt02" type="text" id="txt02" tabindex="2" value="<?php echo $row['Direccion'] ?>" size="20" maxlength="255" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Sufijo Presentador:</strong></td>
      <td><label>
        <input name="txt10" type="text" id="txt10" tabindex="10" value="<?php echo $row['Sufijo_Presentador'] ?>" size="20" maxlength="3" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Sufijo Ordenante:</strong></td>
      <td><input name="txt15" type="text" id="txt15" tabindex="15" value="<?php echo $row['Sufijo_Ordenante'] ?>" size="20" maxlength="3" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>CP:</strong></td>
      <td><label>
        <input name="txt03" type="text" id="txt03" tabindex="3" value="<?php echo $row['CP'] ?>" size="20" maxlength="5" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Entidad Presentador:</strong></td>
      <td><label>
        <input name="txt11" type="text" id="txt11" tabindex="11" value="<?php echo $row['Entidad_Presentador'] ?>" size="20" maxlength="4" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Entidad Ordenante:</strong></td>
      <td><input name="txt16" type="text" id="txt16" tabindex="16" value="<?php echo $row['Entidad_Ordenante'] ?>" size="20" maxlength="4" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>Poblacion:</strong></td>
      <td><label>
        <input name="txt04" type="text" id="txt04" tabindex="4" value="<?php echo $row['Poblacion'] ?>" size="20" maxlength="50" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Oficina Presentador:</strong></td>
      <td><label>
        <input name="txt12" type="text" id="txt12" tabindex="12" value="<?php echo $row['Oficina_Presentador'] ?>" size="20" maxlength="4" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><strong>Oficina Ordenante:</strong></td>
      <td><input name="txt17" type="text" id="txt17" tabindex="17" value="<?php echo $row['Oficina_Ordenante'] ?>" size="20" maxlength="4" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>Provincia:</strong></td>
      <td><label>
        <input name="txt05" type="text" id="txt05" tabindex="5" value="<?php echo $row['Provincia'] ?>" size="20" maxlength="50" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td>&nbsp;</td>
      <td><label></label></td>
      <td><strong>DC Ordenante:</strong></td>
      <td><input name="txt18" type="text" id="txt18" tabindex="18" value="<?php echo $row['DC_Ordenante'] ?>" size="20" maxlength="2" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>Telefono:</strong></td>
      <td><label>
        <input name="txt06" type="text" id="txt06" tabindex="6" value="<?php echo $row['Telefono'] ?>" size="20" maxlength="15" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td>&nbsp;</td>
      <td><label></label></td>
      <td><strong>Nº Cuenta Ordenante:</strong></td>
      <td><input name="txt19" type="text" id="txt19" tabindex="19" value="<?php echo $row['N_Cuenta_Ordenante'] ?>" size="20" maxlength="10" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> /></td>
    </tr>
    <tr>
      <td><strong>email:</strong></td>
      <td><label>
        <input name="txt07" type="text" id="txt07" tabindex="7" value="<?php echo $row['email'] ?>" size="20" maxlength="255" <?php	if ($_GET['Codigo']=='') echo " readonly " ?> />
      </label></td>
      <td><input name="txtModificar" type="hidden" id="txtModificar" value="<?php echo $_GET['Codigo'] ?>" /></td>
      <td><label></label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>URL del cuadrante:</strong></td>
      <td colspan="5"><label>
        <input name="txt20" type="text" id="txt20" value="<?php echo $row['URLCuadrante'] ?>" size="100" />
        <br />
        Para crear cuadrante acceda a la <a href="https://sheet.zoho.com/home.do" target="_blank">web</a> con el usuario: <em>englishconnection</em> y clave: <em>Nj64sG6eDY5mUhaf</em></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6"><div align="center">
        <label>
        <input type="submit" name="button" id="button" value="<?php if ($_GET['Codigo']=='Nuevo'){ echo 'Añadir'; }else{ echo 'Modificar'; } ?>" />
&nbsp;&nbsp; </label>
        <label>
        <input type="reset" name="button2" id="button2" value="Restablecer" />
        </label>
      </div></td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

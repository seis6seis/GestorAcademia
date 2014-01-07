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
<title>Editar Colegios - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function validar(formulario){
	if (formulario.txtCodigo.value==""){
		alert("Se necesita indicar Codigo.");
		return false;
	}
	else{
		return true;
	}
}
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Colegios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="EditarColegios1.php" onsubmit="return validar(this)">
  <p><strong>&nbsp;&nbsp;Editar Colegio:&nbsp;</strong> 
    <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
			<option value='EditarColegios0.php'>&nbsp;</option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();

	$sql="SELECT NombreC,idClegio FROM Colegios WHERE Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "<option value='EditarColegios0.php?Codigo=".$row['idClegio']."'";
		if ($_GET['Codigo']==$row['idClegio']) echo " selected ";
		echo ">".$row['NombreC']."</option>";
	}
?>
    </select>
<?php
	$sql="SELECT * FROM Colegios WHERE idClegio='".$_GET['Codigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
    &nbsp;&nbsp;
    <a href="EditarColegios0.php?Codigo=Nuevo"><strong>Agregar</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="EditarColegios2.php?Codigo=<?php echo $_GET['Codigo'] ?>"><strong>Borrar</strong></a><br />
  </p>
  <table width="317" border="0" align="center">
    <tr>
      <td width="149" align="left" valign="middle"><strong>Codigo:</strong></td>
      <td width="158" align="left" valign="middle"><label>
      <input name="txtCodigo" type="text" id="txtCodigo" maxlength="8" value='<?php echo substr($row['idClegio'],3) ?>'/>
      </label></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Nombre Completo:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtNombreC" type="text" id="txtNombreC" tabindex="2" value='<?php echo $row['NombreC'] ?>' maxlength="50"/>
      </label></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Horario Salida:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtHsalidas" type="text" id="txtHsalidas" tabindex="3"  value='<?php echo $row['Hsalidas'] ?>' maxlength="100"/>
      </label></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><input type="hidden" name="txtModificar" id="txtModificar" value="<?php echo $_GET['Codigo'] ?>" />
      </td>
    </tr>
    <tr>
      <td height="17" align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><label></label></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">
      	<p>
        <input type="submit" name="button" id="button" value="<?php if ($_GET['Codigo']=='Nuevo'){ echo 'Añadir'; }else{ echo 'Modificar'; } ?>" tabindex="12" />
        &nbsp;&nbsp;
        <input type="reset" name="button2" id="button2" value="Restablecer" tabindex="13"/>
      	</p>      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

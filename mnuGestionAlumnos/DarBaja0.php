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
<title>Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script language="javascript">
function validar(f) {
  if (f.txtCodigo.value == ""  || f.txtFecha.value == ""){
    alert("Por favor, rellene los campos Codigo y Fecha");
	}
}
function AnularBaja(){
	if(window.document.form1.txtCodigo.value!="") {
		if (confirm("¿Estas seguro, de eliminar esta baja?")==true){
			location.href="DarBaja2.php?Codigo="+window.document.form1.txtCodigo.value;
		}
	}
}
</script>
<STYLE TYPE="text/css">
//------------------para cuando tengas links de texto  -------------------
A:link{color:white;text-decoration:none}
A:visited{color:white;text-decoration:none}
A:hover{color:white;text-decoration:none}
//--------------------------------------------------------------------------
</STYLE>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Dar de Baja<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM Historico_Bajas WHERE Codigo='".$_SESSION['Centro'].$_GET['Codigo']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
  <form id="form1" name="form1" method="post" onSubmit = "return validar(this)" action="DarBaja1.php">
    <table width="434" border="0" align="center">
      <tr>
        <td width="21%"><strong>Cod. Alumno:</strong></td>
				<td width="28%"><label>
          <input name="txtCodigo" type="text" id="txtCodigo" tabindex="0" size="10" maxlength="10" value="<?php echo $_GET['Codigo'] ?>"/>
          </label>        </td>
        <td colspan="2">
        <label></label></td>
</tr>
      <tr>
        <td><strong>Fecha Baja:</strong></td>
        <td><input name="txtFecha" type="text" id="txtFecha" tabindex="1" value="<?php if ($row['Fecha_Ba']){ echo cambiarfecha($row['Fecha_Ba']); }else{ echo date("d-m-Y"); } ?>" size="10" maxlength="10" /></td>
        <td width="16%">&nbsp;</td>
        <td width="35%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><strong>Motivos de la baja</strong></div></td>
      </tr>
      <tr>
        <td colspan="4">
        	<div align="center">
            <input name="chkProfesor" type="checkbox" id="chkProfesor" tabindex="2" <?php if ($row['Profesor']=='YES'){ echo "checked='checked'"; } ?>  />
            Profesor
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
            <input type="checkbox" name="chkContenido" id="chkContenido" tabindex="3" <?php if ($row['Contenido']=='YES'){ echo "checked='checked'"; } ?> />
            Contenido        
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
            <input type="checkbox" name="chkHorario" id="chkHorario" tabindex="4" <?php if ($row['Horario']=='YES'){ echo "checked='checked'"; } ?> />
            Horario          </div>        </td>
      </tr>
      <tr>
        <td align="left" valign="top"><strong>Otros:</strong></td>
        <td colspan="3"><label>
          <textarea name="txtOtros" id="txtOtros" cols="45" rows="5" tabindex="5" ><?php echo $row['Otros'] ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
          <div align="center">
            <input type="submit" name="btnAceptar" id="btnAceptar" value="Confirmar Baja" tabindex="6" />          
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="btnAnularBaja" id="btnAnularBaja" value="Anular Baja" onclick="javascript:AnularBaja();" tabindex="7" />
          </div>
        </td>
      </tr>
    </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

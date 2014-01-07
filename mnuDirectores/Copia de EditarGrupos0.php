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
<title>Editar Grupos - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function validar(formulario){
	if (formulario.txtGrupo.value==""){
		alert("Se necesita indicar Grupo.");
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Grupos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="EditarGrupos1.php" onsubmit="return validar(this)">
  <p><strong>&nbsp;&nbsp;Editar Grupo:&nbsp;</strong> 
    <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
			<option value='EditarGrupos0.php'>&nbsp;</option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();

	$sql="SELECT Grupo FROM GruposCuotas WHERE Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "<option value='EditarGrupos0.php?Codigo=".$row['Grupo']."'";
		if ($_GET['Codigo']==$row['Grupo']) echo " selected ";
		echo ">".substr($row['Grupo'],3)."</option>";
	}
?>
    </select>
<?php
	$sql="SELECT * FROM GruposCuotas WHERE Grupo='".$_GET['Codigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
    &nbsp;&nbsp;
    <a href="EditarGrupos0.php?Codigo=Nuevo"><strong>Agregar</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="EditarGrupos2.php?Codigo=<?php echo $_GET['Codigo'] ?>"><strong>Borrar</strong></a><br />
  </p>
  <table width="657" border="0" align="center">
    <tr>
      <td width="67" align="left" valign="middle"><strong>Grupo:</strong></td>
      <td width="144" align="left" valign="middle"><label>
      <input name="txtGrupo" type="text" id="txtGrupo" maxlength="50" value='<?php echo substr($row['Grupo'],3) ?>'/>
      </label></td>
      <td width="26" align="left" valign="middle">&nbsp;</td>
      <td width="76" align="left" valign="middle"><strong>Materiales:</strong></td>
      <td width="144" align="left" valign="middle"><input name="txtMateriales" type="text" id="txtMateriales" tabindex="7" value='<?php echo $row['Materiales'] ?>' maxlength="11"/></td>
      <td width="24">&nbsp;</td>
      <td width="146">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Programa:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtPrograma" type="text" id="txtPrograma" tabindex="2" value='<?php echo $row['Programa'] ?>' maxlength="50"/>
      </label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><strong>Cuotas Mes:</strong></td>
      <td align="left" valign="middle"><input name="txtCuotasMes" type="text" id="txtCuotasMes" tabindex="8" value='<?php echo $row['CuotasMes'] ?>' maxlength="11"/></td>
      <td>&nbsp;</td>
      <td align="center" valign="middle" bgcolor="#999999"><strong><a href="<?php echo $URL ?>" target="_blank">Diseñar Cuadrante</a></strong></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Horas Semana:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtHorasSemana" type="text" id="txtHorasSemana" tabindex="3"  value='<?php echo $row['HorasSemana'] ?>' maxlength="4"/>
      </label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><strong>Cuota Trim:</strong></td>
      <td align="left" valign="middle"><input name="txtCuotasTrim" type="text" id="txtCuotasTrim" tabindex="9" value='<?php echo $row['CuotasTrim'] ?>' maxlength="11"/></td>
      <td>&nbsp;</td>
      <td align="center" valign="middle" bgcolor="#999999"><strong><a href="subListadoGrupos_01.php" target="_blank">Tablas GruposCuotas</a></strong></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Horarios:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtHorarios" type="text" id="txtHorarios" tabindex="4"  value='<?php echo $row['Horarios'] ?>' maxlength="50"/>
      </label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><strong>Couta Cuat:</strong></td>
      <td align="left" valign="middle"><input name="txtCuotasCuat" type="text" id="txtCuotasCuat" tabindex="10" value='<?php echo $row['CuotasCuat'] ?>' maxlength="11"/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Profesor:</strong></td>
      <td align="left" valign="middle"><label>
        <select name="cmbProfesor" id="cmbProfesor" tabindex="5">
          <option>-----</option>
<?php
					$miconexion1 = new DB_mysql;
					$miconexion1->conectar();

					$sql="SELECT * FROM Usuarios WHERE Permisos='3' AND Centro='".$_SESSION['Centro']."' ORDER BY NombreCompleto ASC";
					$miconexion1->consulta($sql);
					while ($row1 =mysql_fetch_array($miconexion1->Consulta_ID)) {
						echo "						<option value='".$row1['Usuario']."' id='formulario'";
						if ($row1['Usuario']==$row['Profesor']){
							echo " selected ";
						}
						echo ">".$row1['NombreCompleto']."</option>\n";
					}
?>
        </select>
      </label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><strong>Cuota Año:</strong></td>
      <td align="left" valign="middle"><input name="txtCuotasAno" type="text" id="txtCuotasAno" tabindex="11"  value='<?php echo $row['CuotasAno'] ?>' maxlength="11"/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="left" valign="middle"><strong>Matriculas:</strong></td>
      <td align="left" valign="middle"><label>
        <input name="txtMatriculas" type="text" id="txtMatriculas" tabindex="6" value='<?php echo $row['Matriculas'] ?>' maxlength="11"/>
      </label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><input type="hidden" name="txtModificar" id="txtModificar" value="<?php echo $_GET['Codigo'] ?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="17" align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle"><label></label></td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7" align="center" valign="middle">
      	<p>
        <input type="submit" name="button" id="button" value="<?php if ($_GET['Codigo']=='Nuevo'){ echo 'Añadir'; }else{ echo 'Modificar'; } ?>" tabindex="12" />
        &nbsp;&nbsp;
        <input type="reset" name="button2" id="button2" value="Restablecer" tabindex="13"/>
      	</p>
      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

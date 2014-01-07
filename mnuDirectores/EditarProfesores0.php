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
<title>Editar Usuarios - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function validar(formulario){

	if (formulario.txt01.value.length  <=5){
		alert("Se necesita como minimo 6 caracteres y maximo 50 caracteres, para la contraseña.");
		return false;
	}
	else{
		if (formulario.txt00.value=="" || formulario.txt02.value==""){
			alert("Se necesita rellenar todos los campos.");
			return false;
		}
		else{
			return true;
		}
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editar Usuarios<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="form1" name="form1" method="post" action="EditarProfesores1.php" onsubmit="return validar(this)">
  <p><strong>&nbsp;&nbsp;Editar Usuario:&nbsp;</strong> 
    <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
			<option value='EditarProfesores0.php'>&nbsp;</option>
<?php
echo $_GET['Codigo'];
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Usuario, NombreCompleto FROM Usuarios WHERE Centro='".$_SESSION['Centro']."' AND (Permisos='2' OR Permisos='3')";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "<option value='EditarProfesores0.php?Codigo=".$row['Usuario']."'";
		if ($_GET['Codigo']==$row['Usuario']) echo " selected ";
		echo ">".$row['NombreCompleto']."</option>";
	}
?>
    </select>
<?php
	$sql="SELECT * FROM Usuarios WHERE Usuario='".$_GET['Codigo']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
    &nbsp;&nbsp;
    <a href="EditarProfesores0.php?Codigo=Nuevo"><strong>Agregar</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="EditarProfesores2.php?Codigo=<?php echo $_GET['Codigo'] ?>"><strong>Borrar</strong></a><br />
  </p>
  <table width="32%" border="0" align="center">
  <tr>
    <td width="26%"><strong>Usuario:</strong></td>
    <td width="74%"><input name="txt00" type="text" id="txt00" tabindex="0" value="<?php echo $row['Usuario'] ?>" size="20" maxlength="50"/></td>
  </tr>
  <tr>
    <td><strong>Contraseña:</strong></td>
    <td><input name="txt01" type="text" id="txt01" tabindex="1" value="<?php echo $row['Clave'] ?>" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td><strong>Nombre Completo:</strong></td>
    <td><input name="txt02" type="text" id="txt02" tabindex="2" value="<?php echo $row['NombreCompleto'] ?>" size="20" maxlength="255" /></td>
  </tr>
	<tr>
  	<td align="left" valign="middle">
    	<strong>Horas Semanales:      </strong></td>
    <td align="left" valign="middle">
    	<input name="txtHorasSemanales" type="text" id="txtHorasSemanales" tabindex="3" value='<?php echo $row['HorasSemanales'] ?>' size="20" maxlength="10" />    </td>
  </tr>
  <tr>
  	<td align="left" valign="middle">
    	<strong>Salario:      </strong></td>
    <td align="left" valign="middle">
    	<input name="txtSalario" type="text" id="txtSalario" tabindex="4" value='<?php echo $row['Salario'] ?>' size="20" maxlength="11" />    </td>
  </tr>
  <tr>
  	<td align="left" valign="middle">
    	<strong>Otros Salarios:      </strong></td>
    <td align="left" valign="middle">
    	<input name="txtOtrosSalarios" type="text" id="txtOtrosSalarios" tabindex="5" value='<?php echo $row['OtrosSalarios'] ?>' size="20" maxlength="11" />    </td>
  </tr>
  <tr>
  	<td align="left" valign="middle">
    	<strong>Num. Alumnos:</strong></td>
    <td align="left" valign="middle">
<?php
/*			if ($_GET['Codigo']!=''){
				$miconexion1 = new DB_mysql ;
				$miconexion1->conectar();
				
				$sql="SELECT COUNT(*) AS total ";
				$sql=$sql."FROM usuarios, alumnos INNER JOIN gruposcuotas ON alumnos.Grupo = gruposcuotas.Grupo ";
				$sql=$sql."LEFT JOIN gruposcuotas ON usuarios.Usuario=gruposcuotas.Profesor ";
				$sql=$sql."WHERE usuarios.Usuario='".$_GET['Codigo']."'";
	
				$miconexion1->consulta($sql);
				$row1=mysql_fetch_array($miconexion1->Consulta_ID);
				echo "-".$row1['total'];
			}
			*/
?>    
    </td>
  </tr>
  <tr>
    <td><input name="txtModificar" type="hidden" id="txtModificar" value="<?php echo $_GET['Codigo'] ?>"/>
      <input type="hidden" name="txt03" id="txt03" value="<?php echo $_SESSION['Centro'] ?>" />
      <input name="txt04" type="hidden" id="txt04" value="<?php echo $row['Permisos'] ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      <div align="center">
        <label>
          <input type="submit" name="button" id="button" value="<?php if ($_GET['Codigo']=='Nuevo'){ echo 'Añadir'; }else{ echo 'Modificar'; } ?>" tabindex="6" />
&nbsp;&nbsp;				</label>
        <label>
          <input type="reset" name="button2" id="button2" value="Restablecer" tabindex="7" />
        </label>
      </div>    </td>
    </tr>
</table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

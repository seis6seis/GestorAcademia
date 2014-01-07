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
<title>Modificar Alumno - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Modificar Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM alumnos WHERE Codi='".$_GET['Codigo']."'";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
		$miconexion2 = new DB_mysql;
		$miconexion2->conectar();
?>
  <form id="formulario" name="form1" method="post" action="ModificarAlumno1.php">
    <table width="770" border="0" align="center">
    <tr>
      <td width="63"><strong>Codigo:</strong></td>
			<td width='161'><input name='Codigo' type='text' id='formulario' tabindex='1' size='15' maxlength='7' value='<?php echo substr($row['Codi'],3) ?>' readonly/></td>
      <td width="92"><strong>Reserva:</strong></td>
			<td width='166'><input name='Reserva' type='text' id='formulario' tabindex='2' size='15' maxlength='1' value='<?php echo $row['Reserva'] ?>'/></td>
      <td width="110"><strong>Fecha Alta:</strong></td>
			<td width="152"><input name='FecAlta' type='text' id='formulario' tabindex='3' size='15' maxlength='10' value='<?php echo cambiarfecha($row['Fecha_Al']) ?>' readonly/>
			  <font color="#FF0000" size="+2">*</font></td>
    </tr>
    <tr>
      <td width="63"><strong>Fecha Comienzo:</strong></td>
			<td width='161'><input name='FecCom' type='text' id='formulario' tabindex='4' size='15' maxlength='10' value='<?php echo cambiarfecha($row['Fecha_Co']) ?>'/>
			  <font color="#FF0000" size="+2">*</font></td>
      <td width="92"><strong>Fecha Baja:</strong></td>
			<td width='166'>
      	<input name='FecBaja' type='text' id='formulario' tabindex='5' size='15' maxlength='10' value='<?php echo cambiarfecha($row['Fecha_Ba']) ?>' readonly onclick="javascript: popup('DarBaja0.php?Codigo=<?php echo substr($row['Codi'],3) ?>', 500, 350,'no');" title="Al pulsar permitira dar de baja al alumno."/>
			  <font color="#FF0000" size="+2">*</font></td>
      <td width="110"><strong>Nombre Alumno:</strong></td>
			<td><input name='NomAlumno' type='text' id='formulario' tabindex='6' size='15' maxlength='40' value='<?php echo $row['Nombre_Alumno'] ?>'/></td>
    </tr>
    <tr>
      <td width="63"><strong>Direccion:</strong></td>
      <td width="161"><input name="Direccion" type="text" id="formulario" tabindex="7" size="15" maxlength="40" value='<?php echo $row['Direccion'] ?>' /></td>
      <td width="92"><strong>Ciudad:</strong></td>
      <td width="166"><input name="Ciudad" type="text" id="formulario" tabindex="8" size="15" maxlength="35" value='<?php echo $row['Ciudad'] ?>' /></td>
      <td width="110"><strong>Codigo Postal:</strong></td>
      <td><input name="CP" type="text" id="formulario" tabindex="9" size="15" maxlength="5" value='<?php echo $row['Codigo_Postal'] ?>' /></td>
    </tr>
    <tr>
      <td width="63"><strong>Telefono:</strong></td>
      <td width="161"><input name="Tlf" type="text" id="formulario" tabindex="10" size="15" maxlength="9" value='<?php echo $row['Telefono'] ?>' /></td>
      <td width="92"><strong>Movil:</strong></td>
      <td width="166"><input name="Movil" type="text" id="formulario" tabindex="11" size="15" maxlength="9" value='<?php echo $row['Movil'] ?>' /></td>
      <td width="110"><strong>Pago:</strong></td>
      <td><label>
      <select name="Pago" id="Pago" tabindex="12">
        <option  class='formulario'>----</option>
        <option value="AN_B" <?php if($row['Pago']=='AN_B') echo "selected='selected'" ?> >AN_B</option>
        <option value="AN_M" <?php if($row['Pago']=='AN_M') echo "selected='selected'" ?> >AN_M</option>
        <option value="CU_B" <?php if($row['Pago']=='CU_B') echo "selected='selected'" ?> >CU_B</option>
        <option value="CU_M" <?php if($row['Pago']=='CU_M') echo "selected='selected'" ?> >CU_M</option>
        <option value="ME_B" <?php if($row['Pago']=='ME_B') echo "selected='selected'" ?> >ME_B</option>
        <option value="ME_M" <?php if($row['Pago']=='ME_M') echo "selected='selected'" ?> >ME_M</option>
        <option value="TR_B" <?php if($row['Pago']=='TR_B') echo "selected='selected'" ?> >TR_B</option>
        <option value="TR_M" <?php if($row['Pago']=='TR_M') echo "selected='selected'" ?> >TR_M</option>
        <option value="FIN" <?php if($row['Pago']=='FIN') echo "selected='selected'" ?> >FIN</option>
       </select>
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Grupo:</strong></td>
      <td width="161"><label>
        <select name="Grupo" id="Grupo" tabindex="13">
         	<option class='formulario'>----</option>
<?php 
					//echo "					<option value='".$row['Grupo']."' class='formulario'>".substr($row['Grupo'],3)."</option>\n";
					$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_GET['Centro']."' ORDER BY Grupo ASC";
					$miconexion2->consulta($sql);
					while ($row2 =mysql_fetch_array($miconexion2->Consulta_ID)) {
						if ($row2['Grupo']==$row['Grupo']){
							echo "					<option value='".$row2['Grupo']."' class='formulario' selected='selected'>".substr($row2['Grupo'],3)."</option>\n";
						}
						else{
							echo "					<option value='".$row2['Grupo']."' class='formulario'>".substr($row2['Grupo'],3)."</option>\n";
						}
					}
?>
        </select>
      </label></td>
      <td width="92"><strong>Materiales:</strong></td>
      <td width="166"><label>
        <input type="checkbox" name="Material" id="Material" tabindex="14" <?php if ($row['Materiales']=='YES') {echo "checked='checked'";} ?>/>
      </label></td>
      <td width="110"><strong>Descuento:</strong></td>
      <td><label>
        <input type="checkbox" name="Dto" id="Dto" tabindex="15" <?php if ($row['Descuento']=='YES') {echo "checked='checked'";} ?> />
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Motivo Dto.:</strong></td>
      <td width="161"><label>
        <select name="MotivoDto" id="MotivoDto" tabindex="16">
        	<option class='formulario'>----</option>
          <option value="MC" <?php if($row['Motivo_Dto']=='MC') echo "selected='selected'" ?> >Mul Cur</option>
          <option value="FA" <?php if($row['Motivo_Dto']=='FA') echo "selected='selected'" ?> >Familiares</option>
          <option value="OT" <?php if($row['Motivo_Dto']=='OT') echo "selected='selected'" ?> >Otros</option>
        </select>
      </label></td>
      <td width="92"><strong>Procedencia:</strong></td>
      <td width="166"><label>
        <select name="Procedencia" id="Procedencia" tabindex="17">
        	<option class='formulario'>----</option>
          <option value="AC" <?php if($row['Procedencia']=='AC') echo "selected='selected'" ?> >Alumno del Centro</option>
          <option value="FA" <?php if($row['Procedencia']=='FA') echo "selected='selected'" ?> >Fachada</option>
          <option value="IA" <?php if($row['Procedencia']=='IA') echo "selected='selected'" ?> >Paginas Amarillas</option>
          <option value="IG" <?php if($row['Procedencia']=='IG') echo "selected='selected'" ?> >Google</option>
          <option value="IL" <?php if($row['Procedencia']=='IL') echo "selected='selected'" ?> >Internet Local </option>
          <option value="PP" <?php if($row['Procedencia']=='PP') echo "selected='selected'" ?> >Papel, Carteles, Buzon</option>
          <option value="RF" <?php if($row['Procedencia']=='RF') echo "selected='selected'" ?> >Referencias</option>
          <option value="OT" <?php if($row['Procedencia']=='OT') echo "selected='selected'" ?> >Otros</option>
        </select>
      </label></td>
      <td width="110"><strong>Profesion/Estudios:</strong></td>
      <td><input name="Profesion" type="text" id="formulario" tabindex="18" size="15" maxlength="50" value='<?php echo $row['Profesion_Estudios'] ?>' /></td>
    </tr>
    <tr>
      <td width="63"><strong>Necesidad:</strong></td>
      <td width="161"><label>
        <select name="Necesidad" id="Necesidad" tabindex="19">
        	<option class='formulario'>----</option>
          <option value="MEJ" <?php if($row['Necesidad']=='MEJ') echo "selected='selected'" ?> >Mejorar</option>
          <option value="SUS" <?php if($row['Necesidad']=='SUS') echo "selected='selected'" ?> >Suspende</option>
          <option value="TRA" <?php if($row['Necesidad']=='TRA') echo "selected='selected'" ?> >Trabajo</option>
          <option value="AMP" <?php if($row['Necesidad']=='AMP') echo "selected='selected'" ?> >Ampliar conocimiento</option>
          <option value="OTR" <?php if($row['Necesidad']=='OTR') echo "selected='selected'" ?> >Otros</option>
        </select>
      </label></td>
      <td width="92"><strong>Año Nacimiento:</strong></td>
      <td width="166"><input name="Ano" type="text" id="formulario" tabindex="20" size="15" maxlength="15" value='<?php echo $row['Edad'] ?>' /></td>
      <td width="110"><strong>IDColegio:</strong></td>
      <td><label>
        <select name="IDColegio" id="select" tabindex="21">
        	<option class='formulario'>----</option>
<?php
					$sql="SELECT * FROM colegios WHERE Centro='".$_GET['Centro']."' ORDER BY NombreC ASC";
					$miconexion2->consulta($sql);
					while ($row2 =mysql_fetch_array($miconexion2->Consulta_ID)) {
						echo "<option value='".$row2['idClegio']."' class='formulario' ";
						if($row['IDColegio']==$row2['idClegio']){
							echo " selected='selected";
						}
						echo ">".$row2['NombreC']."</option>\n";
					}
					$miconexion2->desconectar();
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Correo:</strong></td>
      <td width="161"><input name="Correo" type="text" id="formulario" tabindex="22" size="15" maxlength="255" value='<?php echo $row['Correo'] ?>' /></td>
      <td width="92"><strong>Cambios:</strong></td>
      <td width="166"><input name="Cambios" type="text" id="formulario" tabindex="23" size="15" maxlength="50" value='<?php echo $row['Cambios'] ?>' /></td>
      <td width="110"><strong>Observaciones:</strong></td>
      <td><input name="Observaciones" type="text" id="formulario" tabindex="24" size="15" maxlength="100" value='<?php echo $row['Observaciones'] ?>' /></td>
    </tr>
    <tr>
      <td width="63">&nbsp;</td>
      <td width="161"><input name="txtCentro" type="hidden" id="txtCentro" value="<?php echo $_GET['Centro'] ?>" /></td>
      <td width="92">&nbsp;</td>
      <td width="166">&nbsp;</td>
      <td width="110">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">
        <div align="center">
          <p>
            <input type="submit" name="Modificar" id="formulario" value="Modificar" tabindex="25"/>
            &nbsp;&nbsp;
            <input type="reset" name="Restablecer" id="formulario" value="Restablecer"tabindex="26" /></p>
          <p align="left"><font color="#FF0000" size="+2">*</font><font color="#FF0000"> Poner - entre la fecha. Ejm &quot;27-01-2010&quot;</font></p>
      </div>      </td>
    </tr>
  </table>

  </form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

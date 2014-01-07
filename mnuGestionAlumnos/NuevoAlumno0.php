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
<title>Nuevo Alumno - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

    function validar_form(){
      if (document.formulario.Codigo.value.length==0){
        alert("Tiene que escribir el Codigo del alumno")
        document.formulario.Codigo.focus()
        return 0; 
      }
      if (document.formulario.Grupo.selectedIndex==0){
        alert("Tiene que escoger su Grupo")
        document.formulario.Grupo.focus()
        return 0; 
      }
      if (document.formulario.NomAlumno.value.length==0){
        alert("Tiene que escribir el Nombre del Alumno")
        document.formulario.NomAlumno.focus()
        return 0; 
      }

      document.formulario.submit(); 
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Alumno<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form id="formulario" name="formulario" method="post" action="NuevoAlumno1.php">
  <table width="770" border="0" align="center">
    <tr>
      <td width="63"><strong>Codigo:</strong></td>
      <td width="161"><input name="Codigo" type="text" id="formulario3" tabindex="1" size="15" maxlength="7" /></td>
      <td width="92"><strong>Reserva:</strong></td>
      <td width="166"><input name="Reserva" type="text" id="formulario" tabindex="2" size="15" maxlength="1" /></td>
      <td width="110"><strong>Fecha Alta:</strong></td>
      <td width="152"><input name="FecAlta" type="text" id="formulario" tabindex="3" size="15" maxlength="10"  value='<?php echo date("d-m-Y") ?>' READONLY/>
      <font color="#FF0000" size="+2">*</font></td>
    </tr>
    <tr>
      <td width="63"><strong>Fecha Comienzo:</strong></td>
      <td width="161"><input name="FecCom" type="text" id="formulario2" tabindex="4" size="15" maxlength="10" />
        <font color="#FF0000" size="+2">*</font></td>
      <td width="92"><strong>Fecha Baja:</strong></td>
      <td width="166"><input name="FecBaja" type="text" id="formulario" tabindex="5" size="15" maxlength="10" readonly onclick="javascript: popup('DarBaja0.php?Codigo=<?php echo substr($row['Codi'],3) ?>', 500, 350,'no');" title="Al pulsar permitira dar de baja al alumno."/>
        <font color="#FF0000" size="+2">*</font></td>
      <td width="110"><strong>Nombre Alumno:</strong></td>
      <td><input name="NomAlumno" type="text" id="formulario" tabindex="6" size="15" maxlength="40" /></td>
    </tr>
    <tr>
      <td width="63"><strong>Direccion:</strong></td>
      <td width="161"><input name="Direccion" type="text" id="formulario" tabindex="7" size="15" maxlength="40" /></td>
      <td width="92"><strong>Ciudad:</strong></td>
      <td width="166"><input name="Ciudad" type="text" id="formulario" tabindex="8" size="15" maxlength="35" /></td>
      <td width="110"><strong>Codigo Postal:</strong></td>
      <td><input name="CP" type="text" id="formulario" tabindex="9" size="15" maxlength="5" /></td>
    </tr>
    <tr>
      <td width="63"><strong>Telefono:</strong></td>
      <td width="161"><input name="Tlf" type="text" id="formulario" tabindex="10" size="15" maxlength="9" /></td>
      <td width="92"><strong>Movil:</strong></td>
      <td width="166"><input name="Movil" type="text" id="formulario" tabindex="11" size="15" maxlength="9" /></td>
      <td width="110"><strong>Pago:</strong></td>
      <td><label>
      <select name="Pago" id="Pago" tabindex="12">
        <option>----</option>
        <option value="AN_B">Anual Banco</option>
        <option value="AN_M">Anual Metalico</option>
        <option value="QU_B">Quintimestral Banco</option>
        <option value="QU_M">Quintimestral Metalico</option>
        <option value="ME_B">Mensual Banco</option>
        <option value="ME_M">Mensual Metalico</option>
        <option value="TR_B">Trimestre Banco</option>
        <option value="TR_M">Trimestre Metalico</option>
        <option value="FIN">FIN</option>
       </select>
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Grupo:</strong></td>
      <td width="161">
        <select name="Grupo" id="Grupo" tabindex="13">
        	<option value='----' class='formulario'>----</option>
<?php 
					$miconexion = new DB_mysql;
					$miconexion->conectar();
					$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_GET['Centro']."' ORDER BY Grupo ASC";
					$miconexion->consulta($sql);
					while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
						echo "					<option value='".$row['Grupo']."' class='formulario'>".$row['Grupo']."</option>\n";
					}
?>
        </select>
      </td>
      <td width="92"><strong>Materiales:</strong></td>
      <td width="166"><label>
        <input type="checkbox" name="Material" id="Material" tabindex="14"/>
      </label></td>
      <td width="110"><strong>Descuento:</strong></td>
      <td><label>
        <input type="checkbox" name="Dto" id="Dto" tabindex="15" />
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Motivo Dto.:</strong></td>
      <td width="161"><label>
        <select name="MotivoDto" id="MotivoDto" tabindex="16">
					<option value='----' class='formulario'>----</option>
          <option value="MC">Mul Cur</option>
          <option value="FA">Familiares</option>
          <option value="OT">Otros</option>
        </select>
      </label></td>
      <td width="92"><strong>Procedencia:</strong></td>
      <td width="166"><label>
        <select name="Procedencia" id="Procedencia" tabindex="17">
        	<option value='----' class='formulario'>----</option>
          <option value="FA">Fachada</option>
          <option value="RF">Referencias</option>
          <option value="IL">Internet</option>
          <option value="AZ">Azafatas</option>          
          <option value="OT">Otros</option>
        </select>
      </label></td>
      <td width="110"><strong>Profesion/Estudios:</strong></td>
      <td><input name="Profesion" type="text" id="formulario" tabindex="18" size="15" maxlength="50" /></td>
    </tr>
    <tr>
      <td width="63"><strong>Necesidad:</strong></td>
      <td width="161"><label>
        <select name="Necesidad" id="Necesidad" tabindex="19">
        	<option value='----' class='formulario'>----</option>
          <option value="MEJ">Mejorar</option>
          <option value="SUS">Suspende</option>
          <option value="TRA">Trabajo</option>
          <option value="AMP">Ampliar conocimiento</option>
          <option value="OTR">Otros</option>
        </select>
      </label></td>
      <td width="92"><strong>Año Nacimiento:</strong></td>
      <td width="166"><input name="Ano" type="text" id="formulario" tabindex="20" size="15" maxlength="15" /></td>
      <td width="110"><strong>IDColegio:</strong></td>
      <td><label>
        <select name="IDColegio" id="select" tabindex="21">
        	<option value='----' class='formulario'>----</option>
<?php
					$sql="SELECT * FROM colegios WHERE Centro='".$_GET['Centro']."' ORDER BY NombreC ASC";
					$miconexion->consulta($sql);
					while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
						echo "					<option value='".$row['idClegio']."' class='formulario'>".$row['NombreC']."</option>\n";
					}
					$miconexion->desconectar();
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td width="63"><strong>Correo:</strong></td>
      <td width="161"><input name="Correo" type="text" id="formulario" tabindex="22" size="15" maxlength="255" /></td>
      <td width="92"><strong>Cambios:</strong></td>
      <td width="166"><input name="Cambios" type="text" id="formulario" tabindex="23" size="15" maxlength="50" /></td>
      <td width="110"><strong>Observaciones:</strong></td>
      <td><input name="Observaciones" type="text" id="formulario" tabindex="24" size="15" maxlength="100" /></td>
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
          <p align="center">
            <input type="button" name="Añadir" id="formulario" value="Añadir" tabindex="25" onclick="validar_form()"/>
            &nbsp;&nbsp;
            <input type="reset" name="Restablecer" id="formulario" value="Restablecer"tabindex="26" />
          </p>
          <p align="left">            <font color="#FF0000" size="+2">*</font><font color="#FF0000"> Poner - entre la fecha. Ejm &quot;27-01-2010&quot;</font></p>
        </div>      </td>
    </tr>
  </table>
  </form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

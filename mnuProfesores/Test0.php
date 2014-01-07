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
<title>Gestor Academia - Test</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Realizar de Test<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <strong>Segun el servidor hoy es <?php echo date('d-m-Y') ?> y las <?php echo date('H:i') ?> (pulse F5 para actualizar la hora.)</strong>
  <form action="Test1.php" method="post">
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$miconexion1 = new DB_mysql ;
	$miconexion1->conectar();

	$sql="SELECT * FROM Test WHERE FechaIni<='".date('Y-m-d H:i').":00' AND FechaFin>='".date('Y-m-d H:i').":00' AND NumPregunta=1";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
	if($miconexion->numregistros()==0){
		echo "<br><br><p align='center'>No hay Test ahora mismo. Espere a la hora indicada.</p>";
		die();
	}
	
	$sql="SELECT * FROM TestR WHERE Test='".$row['Test']."' AND Usuario='".$_SESSION['idusuario']."'";
	$miconexion1->consulta($sql);
	mysql_fetch_array($miconexion1->Consulta_ID);
	if($miconexion1->numregistros()!=0){
		echo "<br><br><p align='center'>El test ya lo has realizado.</p>";
		die();
	}
	
?>
    <table width="50%" border="0" align="center">
      <tr>
        <td><strong>Titulo del Test:</strong></td>
        <td><label>
          <input name="txtNomTest" type="text" id="txtNomTest" size="50" maxlength="50" value="<?php echo $row['Test'] ?>" readonly="readonly"/>
        </label></td>
      </tr>
      <tr>
        <td width="30%"><strong>Fecha Comienzo:</strong></td>
        <td width="70%">
          <input name="txtFechaIni" type="text" id="txtFechaIni" size="15" maxlength="10" value="<?php if(isset($row['Test'])){ echo cambiarfecha(substr($row['FechaIni'],0,10)); } else { echo ""; } ?>" readonly="readonly" />
          <input name="txtHoraIni" type="text" id="txtHoraIni" size="10" maxlength="5" value="<?php if(isset($row['Test'])){ echo substr($row['FechaIni'],11,5); } else { echo ""; } ?>" readonly="readonly" />
        </td>
      </tr>
      <tr>
        <td><strong>Fecha Fin:</strong></td>
        <td>
          <input name="txtFechaFin" type="text" id="txtFechaFin" size="15" maxlength="10" value="<?php  if(isset($row['Test'])){ echo cambiarfecha(substr($row['FechaFin'],0,10)); } else { echo ""; }?>" readonly="readonly" />
          <input name="txtHoraFin" type="text" id="txtHoraFin" size="10" maxlength="5" value="<?php  if(isset($row['Test'])){ echo substr($row['FechaFin'],11,5); } else { echo ""; } ?>" readonly="readonly" />
        </td>
      </tr>
    </table>
    <br />
    <div id="cont"> 
      <table id="t" width="860" border="0" align="center">
<?php
	$Contador=1;
	if(isset($row['Test'])){
		$sql="SELECT * FROM Test WHERE Test='".$row['Test']."' ORDER BY NumPregunta ASC";
		$miconexion->consulta($sql);
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo"      	<tr>\n";
			echo"          <td width='6%'><div align='center'><strong>".$Contador."º</strong></div></td>\n";
			echo"          <td width='94%'>".$row['Pregunta']."<input name='txtP".$Contador."' type='hidden' id='txtP".$Contador."' value='".$row['Pregunta']."' /></td>\n";
			echo"      	</tr>\n";
			echo"      	<tr>\n";
			echo"          <td width='6%'>&nbsp;</td>\n";
			echo"          <td width='94%'><input name='txtR".$Contador."' type='text' id='txtR".$Contador."' size='120' maxlength='300' value='' /></td>\n";
			echo"      	</tr>\n";			
			$Contador++;
		}
		$Contador--;
	}
?>
      </table>
    </div>
    <p align="center"><input type="submit" name="button" id="button" value="Grabar Cambios" /></p>
  	<input name="Contador" type="hidden" id="Contador" value="<?php echo $Contador; ?>" />
  </form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

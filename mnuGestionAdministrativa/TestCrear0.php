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
<title>Gestor Academia - Crear Test</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script language="JavaScript">
	var i=2;
	function A()
	{
		if (i<=document.getElementById('Contador').value){i=document.getElementById('Contador').value;i++;}
		var t=document.getElementById('cont').innerHTML;
		t=t.substring(0,(t.length-8));
		t+="<tr><td><div align='center'><strong>"+i+"º</strong></div></td><td><input name='txtP"+i+"' type='text' id='txtP"+i+"' size='120' maxlength='300' /></td><td><div align='center'><input type='submit' name='btnAnadir' id='btnAnadir' value='Añadir' onClick='A();' /></div></td></tr>";
//		t+="<tr><td><strong>1º</strong></td><td><input name='txtP1' type='text' id='txtP1' size='120' maxlength='300' /></td></tr></table>";
		//t+="<tr><td>"+i+",1</td><td>"+i+",2</td><td>"+i+",3</td></tr></table>";
		document.getElementById('cont').innerHTML=t;
		document.getElementById('Contador').value=i;
		i++;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Creacion de Test<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <form action="TestCrear1.php" method="post">
<?php
	if(isset($_GET['Test'])){
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT * FROM Test WHERE Test='".$_GET['Test']."' ORDER BY NumPregunta ASC";
		$miconexion->consulta($sql);
		$row =mysql_fetch_array($miconexion->Consulta_ID);
	}
?>
  	<input name="NomTest" type="hidden" id="NomTest" value="<?php echo $row['Test']; ?>" />
    <table width="50%" border="0" align="center">
      <tr>
        <td><strong>Titulo del Test:</strong></td>
        <td><label>
          <input name="txtNomTest" type="text" id="txtNomTest" size="50" maxlength="50" value="<?php echo $row['Test'] ?>"/>
        </label></td>
      </tr>
      <tr>
        <td width="30%"><strong>Fecha Comienzo:</strong></td>
        <td width="70%">
          <input name="txtFechaIni" type="text" id="txtFechaIni" size="15" maxlength="10" value="<?php if(isset($_GET['Test'])){ echo cambiarfecha(substr($row['FechaIni'],0,10)); } else { echo date('d-m-Y'); } ?>" />
          <input name="txtHoraIni" type="text" id="txtHoraIni" size="10" maxlength="5" value="<?php if(isset($_GET['Test'])){ echo substr($row['FechaIni'],11,5); } else { echo date('H:i',time()+3600); } ?>" />        </td>
      </tr>
      <tr>
        <td><strong>Fecha Fin:</strong></td>
        <td>
          <input name="txtFechaFin" type="text" id="txtFechaFin" size="15" maxlength="10" value="<?php  if(isset($_GET['Test'])){ echo cambiarfecha(substr($row['FechaFin'],0,10)); } else { echo date('d-m-Y'); }?>" />
          <input name="txtHoraFin" type="text" id="txtHoraFin" size="10" maxlength="5" value="<?php  if(isset($_GET['Test'])){ echo substr($row['FechaFin'],11,5); } else { echo date('H:i',time()+7200); } ?>" />        </td>
      </tr>
    </table>
    <br />
    <div id="cont"> 
      <table id="t" width="860" border="0" align="center">
<?php
	$Contador=1;
	if(isset($_GET['Test'])){
		$sql="SELECT * FROM Test WHERE Test='".$_GET['Test']."' ORDER BY NumPregunta ASC";
		$miconexion->consulta($sql);
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo"      	<tr>\n";
			echo"          <td width='6%'><div align='center'><strong>".$Contador."º</strong></div></td>\n";
			echo"          <td width='86%'><input name='txtP".$Contador."' type='text' id='txtP".$Contador."' size='120' maxlength='300' value='".$row['Pregunta']."' /></td>\n";
			echo"          <td width='8%'>\n";
			echo"            <div align='center'>\n";
			echo"              <input type='submit' name='btnAnadir' id='btnAnadir' value='Añadir' onClick='A();' />\n";
			echo"            </div>\n";
			echo"          </td>\n";
			echo"        </tr>\n";
			$Contador++;
		}
		$Contador--;
	}
	else{
			echo"      	<tr>\n";
			echo"          <td width='6%'><div align='center'><strong>1º</strong></div></td>\n";
			echo"          <td width='86%'><input name='txtP1' type='text' id='txtP1' size='120' maxlength='300' value='' /></td>\n";
			echo"          <td width='8%'>\n";
			echo"            <div align='center'>\n";
			echo"              <input type='submit' name='btnAnadir' id='btnAnadir' value='Añadir' onClick='A();' />\n";
			echo"            </div>\n";
			echo"          </td>\n";
			echo"        </tr>\n";	
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

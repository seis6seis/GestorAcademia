<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mover BBDD - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Mover BBDD<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
<p><br />
  <?php
	$Tablas=$_POST["selTabla"];
	$Centros=$_POST['selCentros'];
	$conn=mysql_connect("localhost","root","pedroman") or die("Error:".mysql_error());

	if ($_POST['opOpciones']=='M_A_P'){
		for ($t=0;$t<count($Tablas);$t++){
			if ($Tablas[$t]!="apoyos" && $Tablas[$t]!="banco" && $Tablas[$t]!="centros" && $Tablas[$t]!= "clases" && $Tablas[$t]!="documentos" && $Tablas[$t]!="historico_bajas" && $Tablas[$t]!="tipos" && $Tablas[$t]!="notas" && $Tablas[$t]!="registroacademicos"){
				for ($c=0;$c<count($Centros);$c++){
					$sql="INSERT INTO gestoracademia2.".$Tablas[$t]." SELECT * FROM gestoracademia.".$Tablas[$t]." WHERE Centro='".$Centros[$c]."'";
					$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
					echo "<b>Copiada la tabla:</b>".$Tablas[$t]."<b> del Centro:</b>".$Centros[$c]."<br>";
				}
			}
			else{
				$sql="INSERT INTO gestoracademia2.".$Tablas[$t]." SELECT * FROM gestoracademia.".$Tablas[$t];
				$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
				echo "<b>Copiada la tabla:</b>".$Tablas[$t]."<br>";
			}
		}
	}
	
	if ($_POST['opOpciones']=='M_A_P'){
		for ($t=0;$t<count($Tablas);$t++){
			if ($Tablas[$t]!="apoyos" && $Tablas[$t]!="banco" && $Tablas[$t]!="centros" && $Tablas[$t]!= "clases" && $Tablas[$t]!="documentos" && $Tablas[$t]!="historico_bajas" && $Tablas[$t]!="tipos" && $Tablas[$t]!="notas" && $Tablas[$t]!="registroacademicos"){
				for ($c=0;$c<count($Centros);$c++){
					$sql="INSERT INTO gestoracademia.".$Tablas[$t]." SELECT * FROM gestoracademia2.".$Tablas[$t]." WHERE Centro='".$Centros[$c]."'";
					$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
					echo "<b>Copiada la tabla:</b>".$Tablas[$t]."<b> del Centro:</b>".$Centros[$c]."<br>";
				}
			}
			else{
				$sql="INSERT INTO gestoracademia.".$Tablas[$t]." SELECT * FROM gestoracademia2.".$Tablas[$t];
				$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
				echo "<b>Copiada la tabla:</b>".$Tablas[$t]."<br>";
			}
		}
	}
	
	if ($_POST['opOpciones']=='E_A'){
		for ($t=0;$t<count($Tablas);$t++){
			if ($Tablas[$t]!="apoyos" && $Tablas[$t]!="banco" && $Tablas[$t]!="centros" && $Tablas[$t]!= "clases" && $Tablas[$t]!="documentos" && $Tablas[$t]!="historico_bajas" && $Tablas[$t]!="tipos" && $Tablas[$t]!="notas" && $Tablas[$t]!="registroacademicos"){
				for ($c=0;$c<count($Centros);$c++){
					$sql="DELETE FROM gestoracademia.".$Tablas[$t]." WHERE Centro='".$Centros[$c]."'";
					$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
					echo "<b>Borrada la tabla:</b>".$Tablas[$t]."<b> del Centro:</b>".$Centros[$c]."<br>";
				}
			}
			else{
				$sql="DELETE FROM gestoracademia.".$Tablas[$t];
				$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
				echo "<b>Borrada la tabla:</b>".$Tablas[$t]."<br>";
			}
		}
	}
	
	if ($_POST['opOpciones']=='E_P'){
		for ($t=0;$t<count($Tablas);$t++){
			if ($Tablas[$t]!="apoyos" && $Tablas[$t]!="banco" && $Tablas[$t]!="centros" && $Tablas[$t]!= "clases" && $Tablas[$t]!="documentos" && $Tablas[$t]!="historico_bajas" && $Tablas[$t]!="tipos" && $Tablas[$t]!="notas" && $Tablas[$t]!="registroacademicos"){
				for ($c=0;$c<count($Centros);$c++){
					$sql="DELETE FROM gestoracademia2.".$Tablas[$t]." WHERE Centro='".$Centros[$c]."'";
					$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
					echo "<b>Borrada la tabla:</b>".$Tablas[$t]."<b> del Centro:</b>".$Centros[$c]."<br>";
				}
			}
			else{
				$sql="DELETE FROM gestoracademia2.".$Tablas[$t];
				$result=mysql_query($sql,$conn) or die("Error:".mysql_error());
				echo "<b>Borrada la tabla:</b>".$Tablas[$t]."<br>";
			}
		}
	}
	
?>
  </p>
<div align="center"><strong>Finalizado el proceso.</strong></div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

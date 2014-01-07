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
<title>Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Cuadrante<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p><br />
    <?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$miconexion1 = new DB_mysql ;
	$miconexion1->conectar();
	
	$CSV="";
	$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		$sql1="SELECT COUNT(Codi) AS Total FROM Alumnos WHERE Fecha_Ba='0000-00-00' AND Grupo='".$row['Grupo']."'";
		$miconexion1->consulta($sql1);
		$row1=mysql_fetch_array($miconexion1->Consulta_ID);
		$CSV=$CSV.$row['Grupo'].';'.$row['Programa'].';'.$row1['Total'].'\n';
	}
?>
  </p>
  <p>Se va a proceder a salvar los datos en tu PC en <strong><em>C:\Cuadrante.csv, </em></strong>en caso de error deshabilite la seguridad del Internet Explorer:</p>
  <ul>
    <li>Herramientas -&gt; Opciones de Internet -&gt; Seguridad.</li>
    <li>Marcamos Sitios de confianza y despues el boton Sitios.</li>
    <li>En Agregar este sitio web a la zona de: escribir si no aparece<em><strong> http://www.englishconnection.es/GestorAcademia</strong></em> y desmarcamos Requerir comprobación del servidor ... despues pulsamos Agregar y Cerrar.</li>
    <li>En Niveles permitidos para esta zona ponerlo en Baja.</li>
    <li>Pulsamos el boton Nivel Personalizado y buscamos <em><strong>Inicializar y generar scrips de los controles ActiveX no marcados como seguros para scripts</strong></em> y lo dejamos en habilitar<br />  
      <br />
    </li>
  </ul>
  <script language="javascript">
   fso = new ActiveXObject("Scripting.FileSystemObject");
   tf = fso.CreateTextFile("c:\\Cuadrante.csv", true);
   // Escribir una línea con un carácter de nueva línea.
   tf.Write("<?php echo $CSV; ?>") ;
   tf.Close();
    </script>
  <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

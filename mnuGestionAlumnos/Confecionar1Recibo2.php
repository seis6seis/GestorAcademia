<?php
	session_start();
	include("../login.class.php");
	require ("../Connections/funciones.php");

	$login=new login();
	$login->inicia();
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Gestion de Recibos y Cobros<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <p><br />
    <?php
		require ("../Connections/DB_mysql.class.php");
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		//Numero_Pago,Fecha_De,Cuota,Dto,Matricula,Materiales,Periodo,Pagado FROM historico_pagos
		$sqlSET=str_replace("~", "'", $_GET['SQL']);
		$sqlWHERE=str_replace("~", "'", $_GET['SQL2']);
		$sql="UPDATE historico_pagos SET ".$sqlSET." WHERE ".$sqlWHERE;
		//echo $sql;
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo $miconexion->Error."<br />";
			echo $sql;
		}
		else{
		}
		$miconexion->desconectar();
  ?>
<script type="text/javascript">
	window.location.href="Confecionar1Recibo0.php?txtBuscarCodigo=<?php echo substr($_GET['Codigo'],3) ?>";
</script>
  </p>
  <p>&nbsp;</p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
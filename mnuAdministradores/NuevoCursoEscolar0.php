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
<title>Nuevo Curso Escolar - Gestor Academia</title>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Nuevo Curso Escolar<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <blockquote>
    <p>Se va ha proceder a preparar los datos para para el nuevo curso escolar:</p>
  </blockquote>
  <form id="form1" name="form1" method="post" action="NuevoCursoEscolar1.php">
    <table width="60%" border="0" align="center">
      <tr>
        <td width="50%"><strong>Centro:
          <select name="cmbCentro" id="cmbCentro">
            <option value="">&nbsp;</option>
            <option value="Todos">Todos</option>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT Codigo, NombreCentro FROM Centros ORDER BY Codigo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
		echo "          	<option value='".$row['Codigo']."' >".$row['NombreCentro']."</option>";
	}
?>
          </select>
        </strong></td>
        <td width="50%"><strong>Nuevo Curso Escolar:
          <input name="txtCurso" type="text" id="txtCurso" value="<?php echo date("Y",time())."-".date("Y", strtotime("+1 year")) ?>" size="15" />
        </strong></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
              <input type="submit" name="button" id="button" value="Aceptar" />
          </div></td>
      </tr>
    </table>
</form>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="Spain" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Fco. Javier Martinez Ramirez" />
  <meta name="description" content="Gestor Academia" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Gestor Academia</title>
  <!-- InstanceEndEditable -->
<link href="/GestorAcademia/CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}
</script>
<!-- InstanceEndEditable -->
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>
  <table width="100%" border="0">
    <tr>
      <td width="140"><img src="../Imagenes/logo_blanco.png" alt="Logo EnglishConnection" width="111" height="49" /></td>
      <td align="right" valign="middle">
        <div align="right">
          <?php $usuario=$_COOKIE['idusuario'] ?> 
					<div align='right' class='usuario'><b>Usuario:</b> ( <?php echo $_SESSION['NombrePermiso'].") ".$_COOKIE['idusuario']  ?>
					| <a href='/GestorAcademia/SalirSession.php'>Cerrar session</a></div>
					<div align='right' class='usuario'>
          	<font size=4>
            <b>Centro:</b>&nbsp;
<?php
						echo $_SESSION['Centro']." - ";
						if($_SESSION['NombrePermiso']=="Administrador" || $_SESSION['NombrePermiso']=="Contable"){
							$miconexion_Centro = new DB_mysql;
							$miconexion_Centro->conectar();
							echo "<select name='cmbCentros' id='cmbCentros' onchange=\"MM_jumpMenu('parent',this,0)\" tabindex='0'>\n";
							$sql="SELECT Codigo, NombreCentro FROM centros ORDER BY Codigo ASC";
							$miconexion_Centro->consulta($sql);
							while ($row =mysql_fetch_array($miconexion_Centro->Consulta_ID)) {
								echo "<option value='../CambioCentroAdmin.php?Centro=".$row['Codigo']."' id='formulario'";
								if ($row['NombreCentro']==$_SESSION['NombreCentro']) echo " selected";
								echo ">".$row['NombreCentro']."</option>\n";
							}
							echo "</select>\n";
							$miconexion_Centro->desconectar();
						}
						else{
							echo $_SESSION['NombreCentro'];
						}
?>
            <b>Curso:</b>&nbsp;
						<select name='cmbCursoEscolar' id='cmbCursoEscolar' onchange="MM_jumpMenu('parent',this,0)" tabindex='1'>
            <option value='/GestorAcademia/CambioCurso.php?Curso=Actual' id='formulario' <?php if ($_SESSION['CursoEscolar']==""){ echo " selected"; } ?> >Curso Actual</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=Proximo' id='formulario' <?php if ($_SESSION['CursoEscolar']=="2"){ echo " selected"; } ?> >Curso Proximo</option>
            </select>
          	</font>
          </div>
        </div>
      </td>
    </tr>
  </table>

	<div id="container-navigation">
		<ul id="navigation">
<?php	if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){ ?>
			<li>
				<a href="/GestorAcademia/mnuGestionAlumnos/index.php">Gestion de Alumnos</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){
?>
			<li>
				<a href="/GestorAcademia/mnuGestionAcademica/index.php">Gestion Academica</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or $_SESSION['NombrePermiso']=="Contable"){
?>
			<li>
				<a href="/GestorAcademia/mnuGestionAdministrativa/index.php">Gestion Administrativa</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director"){
?>
			<li>
				<a href="/GestorAcademia/mnuDirectores/index.php">Directores</a>
			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or  $_SESSION['NombrePermiso']=="Profesor"){
?>
 			<li>
				<a href="/GestorAcademia/mnuProfesores/index.php">Profesores</a>			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador"){
?>
 			<li>
				<a href="/GestorAcademia/mnuAdministradores/index.php">Admnistradores</a>			</li>
<?php
			}
			if($_SESSION['NombrePermiso']=="Administrador" or $_SESSION['NombrePermiso']=="Director" or  $_SESSION['NombrePermiso']=="Alumno"){
?>
 			<li>
				<a href="/GestorAcademia/mnuAlumnos/index.php">Alumnos</a>			</li>
<?php
			}
?>

		</ul>
	</div>
	<br />
	<table width="100%" border="0" align="left">
		<tr>
   		<td width="130" align="left" valign="top">
			<!-- InstanceBeginEditable name="SubMenu" -->
				<div id='SubMenu' style="width:130px;">
          <p><a href="#" onclick="popup('EditarGrupos0.php?Codigo=Nuevo', 850,400,'no')"><strong>Editar Grupos</strong></a></p>
          <p><a href="#" onclick="popup('EditarProfesores0.php?Codigo=Nuevo',500,400,'no')"><strong>Editar Profesores</strong></a></p>
          <p><a href="#" onclick="popup('EditarColegios0.php?Codigo=Nuevo',500,300,'no')"><strong>Editar Colegios</strong></a></p>
          <p><a href="#" onclick="popup('EditarCentros0.php',800,450,'no')"><strong>Editar Centro</strong></a></p>
          <p><a href="#" onclick="popup('../mnuAdministradores/EditarCuentas0.php?Codigo=<?php echo $_SESSION['Centro'] ?>',800,450,'no')"><strong>Editar Cuentas</strong></a></p>
          <p><a href="#" onclick="popup('MoverAlumnosClase.php',500,400,'no')"><strong>Mover alumnos de clase</strong></a></p>
          <p><a href="#" onclick="popup('../mnuGestionAlumnos/ListadoBajas0.php', 800,460,'no')">Listado de Bajas</a></p>
          <p><a href="#" onclick="popup('../mnuGestionAlumnos/ListadoAltas0.php', 800,460,'no')">Listado de Altas</a></p>
		  <p><a href="DeberesVacaciones0.php" target="_blank">Audios</a></p>
		  <p><a href="../mnuProfesores/Test0.php" target="_blank">Test</a></p>
			</div>
      <!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
			&nbsp;
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>

<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$_SESSION['SQL']=$_GET['Grupo'];
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
<link rel="stylesheet" type="text/css" href="../grid/gt_grid.css" />  
<link rel="stylesheet" type="text/css" href="../grid/gt_grid_height.css" />
<script type="text/javascript" src="../grid/gt_msg_sp.js"></script>
<script type="text/javascript" src="../grid/gt_const.js"></script>
<script type="text/javascript" src="../grid/gt_grid_all.js"></script>
<script type="text/javascript" src="../grid/flashchart/fusioncharts/FusionCharts.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-setup.js"></script>

<script type="text/javascript">
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
       {name : "idGrupo"},
       {name : "Fecha"},
       {name : "ActividadeseRalizadas"},
       {name : "TipoDeberes"},
       {name : "DescripcionDeberes"}
    ],
    recordType : 'object'
} 
var colsOption = [
	{id : "idGrupo" , header: " " , width :1,readonly:false},
	{id : "Fecha" , header: "Fecha" , width :100,readonly:false},
	{id : "ActividadesRealizadas" , header: "Actividades Realizadas" , width :150,readonly:false},
	{id : "TipoDeberes" , header: "Tipo Deberes" , width :150,readonly:false},
	{id : "DescripcionDeberes" , header: "Descripcion Deberes" , width :200,readonly:false}
];

var gridOption={
	id : "mygrid1",
	width: "100%",
	height: "430",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDDeberes.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print',
	pageSize : 50000
};
var FiltroBool=-1;
var CodigoSelec='-';
var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
</script>
<style type="text/css">
<!--
 .clsAdd { 
		background : url(../Imagenes/Iconos/form_add.png) no-repeat center center; 
		}
 .clsSave { 
		background : url(../Imagenes/Iconos/grabar.png) no-repeat center center; 
		}
	.clsRefresh { 
		background : url(../grid/skin/default/images/tool_reload.gif) no-repeat center center; 
		}
	.clsDelete{
		background : url(../Imagenes/Iconos/form_delete.png) no-repeat center center; {
		}

.gt-head-div {
  height:20px;
}
.gt-inner {
	height:18px;
}
-->
</style>
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
						if($_SESSION['NombrePermiso']=="Administrador"){
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
				<p><strong><a href="Faltas.php" target="_blank">Faltas&nbsp;</a></strong></p>
				<p><strong><a href="DeberesVacaciones0.php" target="_blank">Audios</a></strong></p>
			<!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
<table width="100%" border="0">
  <tr>
		<td height="21" align="left" valign="top" bgcolor="#CCCCCC"><span class="TituloPrincipal">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Deberes</span>		</td>
	</tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<strong>Grupo: </strong>&nbsp;
			<select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
				<option>&nbsp;</option>
<?php
	$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "							<option value='index.php?Grupo=".$row['Grupo']."' id='formulario'";
		if ($row['Grupo']==$_GET['Grupo']) echo " selected ";
		echo ">".substr($row['Grupo'],3)."</option>\n";
	}
?>
			</select>      </td>
  </tr>
  <tr>
    <td>
			<div id="bigbox" style="margin:15px;display:!none;">
				<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>
			</div>    </td>
  </tr>
</table>
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>

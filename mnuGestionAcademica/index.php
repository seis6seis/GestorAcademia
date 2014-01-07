<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	
	if (isset($_GET['Codigo'])){
		if ($_GET['Estado']=='00-00-0000'){ $Estado=date("Y-m-d"); } else { $Estado='0000-00-00'; }
		$sql="UPDATE Faltas SET Fecha_Contacto='".$Estado."'  WHERE idFalta='".$_GET['Codigo']."'";
		$miconexion->consulta($sql);
	}
	if (isset($_GET['justificada'])){
		if ($_GET['Estado']=='NO'){ $Estado='YES'; } else { $Estado='NO'; }
		$sql="UPDATE Faltas SET Justificada='".$Estado."'  WHERE idFalta='".$_GET['justificada']."'";
		$miconexion->consulta($sql);
	}
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
function popup(mylink, w, h){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=no,fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
			{name : "idFalta"},
      {name : "Fecha_Falta"},
      {name : "Fecha_Contacto"},
			{name : "Justificada"},
			{name : "Nombre_Alumno"},
			{name : "Telefono"},
			{name : "Movil"},
			{name : "Correo"},
			{name : "Grupo"}
    ],
    recordType : 'object'
}
function render_justificada(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Justificada' value='"+rowNo+"' id='Justificada' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "idFalta",header : " ", width:1}, 
	{id : "Fecha_Falta" , header: "Fecha Falta" , width :100,readonly:false},
	{id : "Fecha_Contacto" , header: "Fecha Contacto" , width :100,readonly:false},
	{id : "Justificada" , header : "Justificada",width :100, align : 'center',readonly:false, renderer:render_justificada},
	{id : "Nombre_Alumno" , header: "Nombre Alumno" , width :200,readonly:false},
	{id : "Telefono" , header : "Telefono",width :100, readonly:false},
	{id : "Movil" , header : "Movil",width :100, readonly:false},
	{id : "Correo" , header : "Correo",width :150, readonly:false},
	{id : "Grupo" , header : "Grupo",width :100, readonly:false}
];
Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { grid.reload() }
	}
);

var gridOption={
	id : "mygrid1",
	width: "100%",
	height: "470",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDSeguimientoFaltas.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print',
	pageSize : 50000,
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (colNO==2) 	window.location.href="index.php?Codigo="+mygrid.getColumnValue('idFalta',rowNO)+"&Estado="+mygrid.getColumnValue('Fecha_Contacto',rowNO);
		if (colNO==3) 	window.location.href="index.php?justificada="+mygrid.getColumnValue('idFalta',rowNO)+"&Estado="+mygrid.getColumnValue('Justificada',rowNO);
	}
};
var gridRow=-1;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
</script>  

<style type="text/css">
<!--
.clsAdd { 
	background : url(../Imagenes/Iconos/form_add.png) no-repeat center center; 
}
.clsEdit { 
	background : url(../Imagenes/Iconos/form_edit.png) no-repeat center center; 
}
.clsRefresh { 
	background : url(../grid/skin/default/images/tool_reload.gif) no-repeat center center; 
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
							$sql="SELECT Codigo, NombreCentro FROM centros ORDER BY NombreCentro ASC";
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
            <option value='/GestorAcademia/CambioCurso.php?Curso=1' id='formulario' <?php if ($_SESSION['CursoEscolar']==""){ echo " selected"; } ?> >Curso 1</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=2' id='formulario' <?php if ($_SESSION['CursoEscolar']=="2"){ echo " selected"; } ?> >Curso 2</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=3' id='formulario' <?php if ($_SESSION['CursoEscolar']=="3"){ echo " selected"; } ?> >Curso 3</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=4' id='formulario' <?php if ($_SESSION['CursoEscolar']=="4"){ echo " selected"; } ?> >Curso 4</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=5' id='formulario' <?php if ($_SESSION['CursoEscolar']=="5"){ echo " selected"; } ?> >Curso 5</option>
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
          <p><a href="ControlJefeEstudios0.php" target="_blank">Control Jefe Estudios</a></p>
          <p><a href="#" onclick="popup('NotasTrimestrales0.php', 800,430,'yes')">Notas Trimestrales</a></p>
          <p><a href="ListadoAnotaciones0.php" target="_blank" >Listado Anotaciones</a></p>
          <p><a href="#" onclick="popup('RegistrosAcademicos0.php', 800,450,'yes')">Registros Previos</a></p>
          <p><a href="#" onclick="popup('Apoyo0.php', 800,450,'yes')">Apoyos</a></p>
          <p><a href="AlumnosQueSuspenden0.php" target="_blank" >Control Alumnos Suspenden</a></p>
          <p><a href="#" onclick="popup('MarcarLibros0.php', 800,450,'yes')">Marcar libros de alumnos</a></p>
      </div>
			<!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
        <table width="100%" border="0">
          <tr>
            <td bgcolor="#CCCCCC">
            	<div align="left" class="TituloPrincipal">
              	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Seguimiento de Faltas
              </div>
          </tr>
          <tr>
            <td align="left" valign="top">
              <div id="bigbox" style="margin:15px;display:!none">
                <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:300px;width:100%;" ></div>
              </div>
          </tr>
        </table>
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>

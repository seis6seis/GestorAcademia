<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
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


function Filtro(Registro){
	var filterInfo=[
		{
			fieldName : "Codigo",
			logic : "startWith",
			value : Registro
		}
	]
	var grid2=Sigma.$grid("gridbox2");
	var rowNOs=grid2.filterGrid(filterInfo); 
}

var dsOption= {
    fields :[
       {name : "Nombre_Alumno"},
       {name : "Codi"},
       {name : "Profesion_Estudios"},
			 {name : "Necesidad"}
    ],
    recordType : 'object'
} 
var colsOption = [
	{id : "Nombre_Alumno" , header: "Nombre Alumnos" , width :150,readonly:false},
	{id : "Codi" , header: "Codigo" , width :80,readonly:false},
	{id : "Profesion_Estudios" , header: "Profesion" , width :95,readonly:false},
	{id : "Necesidad", header:"Necesidad", width: 100, readonly:false}
];

var gridOption={
	id : "mygrid1",
	width: "100%",
	height: "200",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDAlumnos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | filter | print',
	pageSize : 50000,
	onClickCell  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		rowSelec=rowNO;
		colSelec=colNO;
		FiltroBool=-1;
    	CodigoSelec=record['Codi'];
		var grid=Sigma.$grid("gridbox2");
		grid.loadURL = "BD/BDFaltas.php";
		grid.reload();
	}
};
var FiltroBool=-1;
var CodigoSelec='-';
var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

// Para el segundo Grid (Recibos Cobrados
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Anadir',
		action : function(event,grid) {
			if(grid.id='gridbox2'){
				if (CodigoSelec!='-'){
					FiltroBool=-1;
					grid.add();
				}
			}
			if(grid.id='gridbox3'){
				if ('<?php echo $_GET['Grupo'] ?>'!=''){
					grid.add();
				}
			}
		}
	}
);

Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar.',
		action : function(event,grid) {
			grid.del();
		}
	}
);

Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar cambios en las Notas.',
		action : function(event,grid) {
			grid.save();
			FiltroBool==-1;
		}
	}
);

Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { 
			grid.reload();
			grid.save();
			FiltroBool==-1;
		}
	}
);

var dsOption2= {
    fields :[
			{name : 'Codigo'},
      {name : 'Fecha_Falta'},
      {name : 'Fecha_Contacto'},
			{name : 'Justificada'}, 
      {name : 'Centro'},
			{name : 'idFalta'}
    ],
    recordType : 'object'
} 

var colsOption2 = [
	{id : "Codigo" , header: "Codigo" , width :75, editor:{type:"text"}},
	{id : "Fecha_Falta" , header: "Fecha_Falta" , width :100, editor:{type:"text"}},
	{id : "Fecha_Contacto" , header: "Fecha_Contacto" , width: 100},
	{id : "Justificada", header: "Justificada", width: 100, editor: { type :"select" ,options : {'YES': 'YES' ,'NO':'NO'} ,defaultText : 'NO'}},
	{id : "Centro" , header: " " , width :1, align : 'center'},
	{id : "idFalta", header : " ", width :1}
	
];

var gridOption2={
	id : "gridbox2",
	width: "99%",
	height: "200",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDFaltas.php",
	saveURL : 'BD/BDFaltas.php',
	container : 'gridbox2',
	dataset : dsOption2 ,
	columns : colsOption2,
	toolbarPosition : 'top',
	pageSize : 50000,
	toolbarContent : 'btnrefresh | state | btnadd btndel btnsave | filter | print',
	onComplete:function(grid){
		if(FiltroBool==-1) {
			Filtro(CodigoSelec);
			FiltroBool=0;
		}
	},
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (CodigoSelec!='-' && record['Codigo']=='' && (colNO==0 || colNO==1)){
			record['Codigo']=CodigoSelec;
			record['Fecha_Falta']=document.form.txtFechaActual.value;
			grid.save();
			FiltroBool==-1;
		}
	}
};
var FiltroBool=-1;
var mygrid2=new Sigma.Grid(gridOption2);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid2));

var dsOption3= {
    fields :[
			{name : 'idClase'},
			{name : 'idCodigo'},
      {name : 'Fecha'},
      {name : 'ActividadesRealizadas'},
      {name : 'TipoDeberes'},
      {name : 'DescripcionDeberes'},
      {name : 'Observaciones'}
    ],
    recordType : 'object'
} 

var colsOption3 = [
	{id : "idClase", header : " ", width :1},
	{id : "idGrupo" , header: "Grupo" , width :50, editor:{type:"text"}},
	{id : "Fecha" , header: "Fecha" , width :80, editor:{type:"text"}},
	{id : "ActividadesRealizadas" , header: "Actividades Realizadas" , width: 150, editor:{type:"text"}},
	{id : "TipoDeberes" , header: "Tipo Deberes" , width :80,  editor : { type :"select" ,options : {'Otros': 'Otros' ,'Listening':'Listening', 'Writing':'Writing', 'Speaking': 'Speaking', 'Reading': 'Reading'} ,defaultText : 'Otros'}},
	{id : "DescripcionDeberes" , header: "Descripcion Deberes" , width :280, editor : {type :"textarea", width:'200px',height:'100px'}},
	{id : "Observaciones" , header: "Incidencias/Castigos" , width :250, editor:{type:"text"}}
];

var gridOption3={
	id : "gridbox3",
	width: "99%",
	height: "200",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDDeberes.php",
	saveURL : 'BD/BDDeberes.php',
	container : 'gridbox3',
	dataset : dsOption3 ,
	columns : colsOption3,
	toolbarPosition : 'top',
	pageSize : 50000,
	toolbarContent : 'btnrefresh | state | btnadd btndel btnsave | filter | print',
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (record['idGrupo']=='' && (colNO==0 || colNO==1)){
			record['idGrupo']='<?php echo $_GET['Grupo'] ?>';
			record['Fecha']=document.form.txtFechaActual.value;
			grid.save();
			/*Filtro(CodigoSelec);*/
		}
	}
};
var mygrid3=new Sigma.Grid(gridOption3);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid3));

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
				<div id='SubMenu' style="width:130px;">
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/RegistrosAcademicos0.php', 800,430,'yes')">Registros Academicos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/Apoyo0.php', 800,620,'no')">Apoyos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/.php', 800,430,'yes')">Utilidades y documentos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/NotasTrimestrales0.php', 800,430,'yes')">Notas Trimestrales</a></p>
	      	<p><a href="Test0.php" target="_blank">Test</a></p>
			</div>
      <!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
			<table width="100%" border="0" bgcolor="#CCCCCC">
        <tr>
          <td colspan="2" class="TituloPrincipal">
						<div align="left" class="TituloPrincipal">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		          Control de Clases y Faltas          	</div>        	</td>
        </tr>
        <tr>
          <td colspan="2">
          <form action="" method="get" name="form">
						<select name="selGrupo" id="selGrupo" onchange="MM_jumpMenu('parent',this,0)">
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
            </select>
<?php
	$sql="SELECT * FROM gruposcuotas WHERE Grupo='".$_GET['Grupo']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
            <input name="txtFechaActual" type="text" id="txtFechaActual" value="<?php echo date('d-m-Y') ?>" size="15" maxlength="10" />
            <input name="txtProfesor" type="text" id="txtProfesor" value="<?php echo $row['Profesor'] ?>" size="15" maxlength="10" />
            &nbsp;&nbsp;&nbsp;
            <a href="#" onclick="popup('FaltasMasivas.php?Grupo=<?php echo $_GET['Grupo'] ?>&Fecha='+document.form.txtFechaActual.value , 500,200,'yes')"><strong>Fal. Masiva</strong></a>
            &nbsp;&nbsp;&nbsp;
            <a href="TotalFaltas.php" target="_blank"><strong>Total Faltas</strong></a> 
            &nbsp;&nbsp;&nbsp;
          	<input name="txtFechaAnterior" type="text" id="txtFechaAnterior" value="<?php echo date('d-m-Y',time()-(60*60*24*10)) ?>" size="15" maxlength="10" />
        	</form>          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="30%" align="left" valign="top"><div align="center"><strong>Alumno del Grupo:</strong></div></td>
          <td width="70%" align="left" valign="top"><div align="center"><strong>Faltas del Alumno:
            
          </strong></div></td>
        </tr>
        <tr>
          <td width="40%" align="left" valign="top">
          	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>          </td>
          <td width="60%" align="left" valign="top">
						<div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>          </td>
        </tr>
        <tr>
          <td colspan="2">
						<div align="center"><strong>Deberes del Grupo:					</strong></div></td>
        </tr>
        <tr>
          <td colspan="2">
              <div id="gridbox3" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>          </td>
        </tr>
      </table>
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>

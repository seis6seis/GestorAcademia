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
<title>Informacion - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
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
function doFilter() {
	var filterInfo=[
	{
		fieldName : "Centro",
		logic : "startWith",
		value : "<?php echo $_SESSION['Centro'] ?>"
	}
	]
	var grid=Sigma.$grid("mygrid1");
	var rowNOs=grid.filterGrid(filterInfo); 
}

var dsOption= {
    fields :[
			 {name : "Edit"},
       {name : "ID_Informacion"},
       {name : "Fecha",type:'date'},
       {name : "Matriculado"},
       {name : "Nombre"},
       {name : "Direccion"},
       {name : "Telefono"},
       {name : "Estudia"},
       {name : "F_Nacimiento",type:'date'},
       {name : "ComoConocio"},
       {name : "Observaciones"}
       //{name : "Centro"}
    ],
    recordType : 'object'
} 
function my_renderer(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit' value='"+rowNo+"' id='Edit' />";
}
function render_matricula(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Materiales' value='"+rowNo+"' id='Materiales' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id: 'Edit' , header: "Edit" , width :27, filterable: false, exportable:false, renderer:my_renderer},
	{id : "ID_Informacion" , header: "ID" , width :150,readonly:false},
	{id : "Fecha" , header: "Fecha" , width :80, align : 'center',readonly:false},
	{id : "Matriculado" , header: "Matriculado" , width :80,readonly:false, renderer:render_matricula},
	{id : "Nombre" , header: "Nombre Alumno" , width :160,readonly:false},
	{id : "Direccion" , header: "Direccion" , width :80,readonly:false},
	{id : "Telefono" , header: "Telefono" , width :90,readonly:false},
	{id : "Estudia" , header: "Estudia" , width :60,readonly:false},
	{id : "F_Nacimiento" , header: "F. Nacimiento" , width :80,readonly:false},
	{id : "ComoConocio", header: "Como conocio",width:80,readonly:false},
	{id : "Observaciones" , header: "Observaciones" , width :73,readonly:false}
	//{id : "Centro" , header: "Centro" , width :60,readonly:false}
];
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite añadir un alumno.',
		action : function(event,grid) { window.location='InformacionNuevo0.php?Centro=<?php echo $_SESSION['Centro'] ?>' }
	}
);
Sigma.ToolFactroy.register(
	'btnedit',  
	{
		cls : 'clsEdit',  
		toolTip : 'Permite Editar un Alumno.',
		action : function(event,grid) {
			if (gridRow!=-1){
				window.location="InformacionModificar0.php?ID="+mygrid.getColumnValue('ID_Informacion',gridRow);
			}
			else{
				alert("Necesita seleccionar un alumno a modificar.");
			}
		}
	}
);
Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { location.reload() }
	}
);

var gridOption={
	id : "mygrid1",
	width: "100%",
	height: "305",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDInformacion.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | nav | btnadd btnedit | state | filter | print',
	pageSize : 50000,
	onComplete:function(grid){
		//if (FiltroAutomatico==false) doFilter();
		FiltroAutomatico=true;
	},
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0) {
			gridRow=rowNO;
		}
	}
};
var gridRow=-1;
var FiltroAutomatico=false;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
function enviar(){
	window.location='InformacionPasarAlumno0.php?ID='+mygrid.getColumnValue('ID_Informacion',gridRow);
}
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Información<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <div align="center">
    <strong><a href="javascript:enviar()">Pasar a Tabla Alumnos</a></strong>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong><a href="Informacion1.php">Imprimir Informacion</a></strong>
	</div>
  <br />

	<div id="bigbox" style="margin:15px;display:!none;">
		<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:300px;width:100%;" ></div>
	</div>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

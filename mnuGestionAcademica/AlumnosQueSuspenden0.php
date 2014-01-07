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
<title>Gestor Academia</title>
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
function popup(mylink, w, h){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=no,fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

var dsOption= {
    fields :[
			{name : "Profesor"},
      {name : "Nombre_Alumno"},
      {name : "Codi"},
			{name : "Grupo"},
			{name : "Fecha_Al"},
			{name : "EnSuColegio"},
			{name : "Fecha_Ba"},
			{name : "Necesidad"},
			{name : "Fecha",type:'date'},
			{name : "Interna"},
			{name : "Profesion_Estudios"}
    ],
    recordType : 'object'
}

var colsOption = [
	{id : "Profesor",header : "Profesor", width:80}, 
	{id : "Nombre_Alumno" , header: "Nombre Alumno" , width :200,readonly:false},
	{id : "Codi" , header: "Codi" , width :80,readonly:false},
	{id : "Grupo" , header: "Grupo" , width :80,readonly:false},
	{id : "Fecha_Al" , header : "Fecha Al",width :100, readonly:false},
	{id : "EnSuColegio" , header : "En Su Colegio",width :150, readonly:false},
	{id : "Fecha_Ba" , header : "Fecha Ba",width :80, readonly:false},
	{id : "Necesidad" , header : "Necesidad",width :80, readonly:false},
	{id : "Fecha" , header : "Fecha",width :80, readonly:false},
	{id : "Interna" , header : "Interna",width :80, readonly:false},
	{id : "Profesion_Estudios" , header : "Profesion/Estudios",width :100, readonly:false}
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
	height: "300",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDAlumnosQueSuspenden.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print',
	pageSize : 50000
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado de Anotaciones<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
	<div id="bigbox" style="margin:15px;display:!none">
  	<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:300px;width:100%;" ></div>
  </div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

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
var dsOption= {
    fields :[
       {name : "Numero_Pago"},
       {name : "Cod"},
       {name : "Fecha_Ge",type:'date'},
       {name : "Fecha_Co",type:'date'},
       {name : "Fecha_Cobro",type:'date'},
       {name : "Fecha_De",type:'date'},
       {name : "Nombre_Alumno"},
       {name : "Importe"},
       {name : "Matricula"},
       {name : "Dto"},
       {name : "Cuota"},
       {name : "Materiales"},
       {name : "Periodo"},
       {name : "Centro"}
    ],
    recordType : 'object'
} 

function render_pagado(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Pagado' value='"+rowNo+"' id='Pagado' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_metalico(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Metalico' value='"+rowNo+"' id='Metalico' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "Numero_Pago" , header: "Numero_Pago", width :150,readonly:false},
	{id : "Cod" , header: "Codigo" , width :70,readonly:false},
	{id : "Fecha_Ge" , header: "Fecha Ge" , width :80,readonly:false},
	{id : "Fecha_Co" , header: "Fecha Comienzo" , width :80,readonly:false},
	{id : "Fecha_Cobro" , header: "Fecha Cobro" , width :80,readonly:false},
	{id : "Fecha_De" , header: "Fecha De" , width :80,editor:{type:"text"}},
	{id : "Nombre_Alumno" , header: "Nombre Alumnos" , width :200,readonly:false},
	{id : "Importe" , header: "Importe" , width :60, align : 'right',editor:{type:"text"}},
	{id : "Matricula" , header: "Matricula" , width :60, align : 'right',editor:{type:"text"}},
	{id : "Dto" , header: "Dto" , width :60, align : 'right',editor:{type:"text"}},
	{id : "Cuota" , header: "Cuota" , width :80, align : 'right',editor:{type:"text"}},
	{id : "Materiales" , header: "Materiales" , width :80, align : 'right',editor:{type:"text"}},
	{id : "Periodo" , header: "Periodo" , width :60, align : 'center',editor:{type:"text"}},
	{id : "Centro" , header : "Centro",width :100, readonly:false}
];

Sigma.ToolFactroy.register(
	'btnsave',  
	{
		cls : 'clsSave',  
		toolTip : 'Grabar cambios',
		action : function(event,grid) {
			grid.save();
		}
	}
);

Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar',
		action : function(event,grid) {
			grid.del();
		}
	}
);

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
	height: "400",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDHitoricoPago.php",
	saveURL : "BD/BDHitoricoPago.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btndel btnsave | state | filter | print',
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
 .clsSave { 
		background : url(../Imagenes/Iconos/grabar.png) no-repeat center center; 
		}
	.clsRefresh { 
		background : url(../grid/skin/default/images/tool_reload.gif) no-repeat center center; 
		}
	.clsDelete{
		background : url(../Imagenes/Iconos/form_delete.png) no-repeat center center; {
		}
.Estilo1 {
	font-size: 16px;
	font-weight: bold;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Pendientes de Cobro<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <br />
	<div id="bigbox" style="margin:15px;display:!none">
		<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
	</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

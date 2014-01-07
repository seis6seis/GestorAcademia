<?php 
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	$_SESSION['SQL']="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado Grupos - Gestor Academia</title>
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
		fieldName : "Nombre_Alumno",
		logic : "startWith",
		value : Sigma.Util.getValue("f_value1")
	}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.filterGrid(filterInfo); 
}

var dsOption= {
    fields :[
			{name : "Grupo"},
			{name : "Programa"},
			{name : "HorasSemana"},
			{name : "Horarios"},
			{name : "Profesor"},
			{name : "Matriculas"},
			{name : "Materiales"},
			{name : "CuotasMes"},
			{name : "CuotasTrim"},
			{name : "CuotasCuat"},
			{name : "CuotasAno"}
    ],
    recordType : 'object'
} 
function my_renderer(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit' value='"+rowNo+"' id='Edit' />";
}
function render_materiales(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Materiales' value='"+rowNo+"' id='Materiales' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_descuento(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Descuento' value='"+rowNo+"' id='Descuento' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "Grupo" , header: "Grupo" , width :70,readonly:false},
	{id : "Programa" , header: "Programa" , width :90, align : 'center',readonly:false},
	{id : "HorasSemana" , header: "Horas Semana" , width :120,readonly:false},
	{id : "Horarios" , header: "Horarios" , width :100,readonly:false},
	{id : "Profesor" , header: "Profesor" , width :80,readonly:false},
	{id : "Matriculas" , header: "Matriculas" , width :100,readonly:false},
	{id : "Materiales" , header: "Materiales" , width :100,readonly:false},
	{id : "CuotasMes" , header: "Cuotas Mes" , width :100,readonly:false},
	{id : "CuotasTrim" , header: "Cuotas Trim." , width :100,readonly:false},
	{id : "CuotasCuat" , header: "Cuotas Cuat." , width :100,readonly:false},
	{id : "CuotasAno" , header: "Cuotas Año" , width :100,readonly:false}
];
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite añadir un alumno.',
		action : function(event,grid) { popup('NuevoAlumno0.php?Centro=<?php echo $_SESSION['Centro'] ?>', 800, 430) }
	}
);
Sigma.ToolFactroy.register(
	'btnedit',  
	{
		cls : 'clsEdit',  
		toolTip : 'Permite Editar un Alumno.',
		action : function(event,grid) {
			if (gridRow!=-1){
				popup("ModificarAlumno0.php?Codigo=<?php echo $_SESSION['Centro'] ?>"+mygrid.getColumnValue('Codi',gridRow)+"&Centro=<?php echo $_SESSION['Centro'] ?>",800,430);
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
	width: "98%",
	height: "505",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDListaGrupos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | filter | print',
	pageSize : 50000
};
/*ar context = {
	sequence:false,checkBox:false,radioBox:true,selectRowWhenClick:true,paintMode:"all"
};*/
var gridRow=-1;
var FiltroAutomatico=false;
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado Grupos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
	<div id="bigbox" style="margin:15px;display:!none">
		<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
	</div>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
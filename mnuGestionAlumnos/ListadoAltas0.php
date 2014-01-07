<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");
	$_SESSION['SQL']=" ";
	if (isset($_GET['Fecha_Alta1']) && isset($_GET['Fecha_Alta2'])){
		$_SESSION['SQL']=" AND (Fecha_Al BETWEEN '".cambiarfecha($_GET['Fecha_Alta1'])."' AND '".cambiarfecha($_GET['Fecha_Alta2'])."') ";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado Altas - Gestor Academia</title>
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
	var logica;
	logica='equal';
	if (document.form1.txtFechaOrigen.value=='') document.form1.txtFechaOrigen.value='01-01-1900';
	if (document.form1.txtFechaFin.value=='') document.form1.txtFechaFin.value='31-12-2090';
	//if (document.form1.cmbProfesor.value!='') document.form1.txtFechaFin.value='31-12-2090';
	
	window.location = "ListadoAltas0.php?Fecha_Alta1="+document.form1.txtFechaOrigen.value+"&Fecha_Alta2="+document.form1.txtFechaFin.value;
}

var dsOption= {
    fields :[
       {name : "Codi"},
       {name : "Reserva"},
       {name : "Fecha_Al",type:'date'},
       {name : "Fecha_Co",type:'date'},
       {name : "Fecha_Ba",type:'date'},
       {name : "Nombre_Alumno"},
       {name : "Direccion"},
       {name : "Ciudad"},
       {name : "Codigo_Postal"},
       {name : "Telefono"},
       {name : "Movil"},
       {name : "Pago"},
       {name : "Grupo"},
       {name : "Observaciones"}
    ],
    recordType : 'object'
} 
function render_profesor(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Profesor' value='"+rowNo+"' id='Profesor' onclick='this.checked = !this.checked' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_horario(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Horario' value='"+rowNo+"' id='Horario' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_contenido(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Contenido' value='"+rowNo+"' id='Contenido' onclick='this.checked = !this.checked'  ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}

var colsOption = [
	{id : "Codi" , header: "Codigo" , width :70,readonly:false},
	{id : "Reserva" , header: "Reserva" , width :60, align : 'center',readonly:false},
	{id : "Fecha_Al" , header: "Fecha Alta" , width :80,readonly:false},
	{id : "Fecha_Co" , header: "Fecha Comienzo" , width :80,readonly:false},
	{id : "Fecha_Ba" , header: "Fecha Baja" , width :80,readonly:false},
	{id : "Nombre_Alumno" , header: "Nombre Alumnos" , width :200,readonly:false},
	{id : "Direccion" , header: "Direccion" , width :160,readonly:false},
	{id : "Ciudad" , header: "Ciudad" , width :90,readonly:false},
	{id : "Codigo_Postal" , header: "C. Postal" , width :60,readonly:false},
	{id : "Telefono" , header: "Telefono" , width :80,readonly:false},
	{id : "Movil" , header: "Movil" , width :80,readonly:false},
	{id : "Pago" , header: "Pago" , width :60, align : 'center',readonly:false},
	{id : "Grupo" , header: "Grupo" , width :80,readonly:false}
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
	height: "300",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDListaAltas.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | nav | filter | print',
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado Altas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  
  <table width="100%" border="0" align="center">
    <tr>
      <td width="44%">
      	
       	<div align="center">
       	  <form id="form1" name="form1" method="post" action="">
              <strong>Filtrar por Fechas:</strong> De
              <input name="txtFechaOrigen" type="text" id="txtFechaOrigen" value="<?php if (isset($_GET['Fecha_Alta1'])){ echo $_GET['Fecha_Alta1']; } else{ echo date('d-m-Y', time() - 86400*30); } ?>" size="12" maxlength="10" />
              &nbsp; a &nbsp; 
            <input name="txtFechaFin" type="text" id="txtFechaFin" value="<?php if (isset($_GET['Fecha_Alta2'])){echo $_GET['Fecha_Alta2'];}else{echo date('d-m-Y');} ?>" size="12" maxlength="10" />
			&nbsp;&nbsp; 
            <input type="button" value="Filtrar" onclick="doFilter()" />
          </form>
     	  </div></td>
    </tr>
  </table>
  <br />
	<div id="bigbox" style="margin:15px;display:!none">
		<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
	</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

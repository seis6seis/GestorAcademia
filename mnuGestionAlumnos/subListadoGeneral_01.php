<?php 
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	$_SESSION['SQL']="";
	require ("../Connections/DB_mysql.class.php");
	$miconexion = new DB_mysql;
	$miconexion->conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado General - Gestor Academia</title>
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
var Total=-1;
function ActualizarTotal(){
	if(Total==-1){
		document.getElementById('txtTotalRegistros').value =mygrid.getPageInfo().totalRowNum;
	}
	else{
		document.getElementById('txtTotalRegistros').value =Total;
	}
}
function FiltrarCodigo(){
	var filterInfo=[
		{
			fieldName : "Codi",
			logic : "startWith",
			value : Sigma.Util.getValue("txtCodigo")
		}
	]
	var grid=Sigma.$grid("mygrid1");
	//grid.save();
	var rowNOs=grid.filterGrid(filterInfo);
	Total=rowNOs.length;
}

function FiltrarNombre(){
	var filterInfo=[
		{
			fieldName : "Nombre_Alumno",
			logic : "startWith",
			value : Sigma.Util.getValue("txtNombre")
		}
	]
	var grid=Sigma.$grid("mygrid1");
	//grid.save();
	var rowNOs=grid.filterGrid(filterInfo); 
	Total=rowNOs.length;
}

function FiltrarGrupo() {
	var filterInfo=[
		{
			fieldName : "Grupo",
			logic : "startWith",
			value : Sigma.Util.getValue("lstGrupo")
		}
	]
	var grid=Sigma.$grid("mygrid1");
	var rowNOs=grid.filterGrid(filterInfo); 
	Total=rowNOs.length;
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
       {name : "Materiales"},
       {name : "Descuento"},
       {name : "Motivo_Dto"},
       {name : "Procedencia"},
       {name : "Profesion_Estudios"},
       {name : "Necesidad"},
       {name : "Edad"},
       {name : "IDColegio"},
       {name : "Correo"},
       {name : "Cambios"},
       {name : "Observaciones"},
			 {name : "Centro"}
    ],
    recordType : 'object'
} 
function my_renderer(value ,record,columnObj,grid,colNo,rowNo){
	return "<input type='radio' name='Edit' value='"+rowNo+"' id='Edit' />";
}
function render_materiales(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Materiales' value='Ma"+rowNo+"' id='Materiales' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
function render_descuento(value ,record,columnObj,grid,colNo,rowNo){
	var Frase="<input type='checkbox' name='Descuento' value='Dt"+rowNo+"' id='Descuento' ";
	if(value=="YES") {
		Frase=Frase+"checked='checked'";
	}		
	Frase=Frase+ "/>";
	return Frase;
}
var colsOption = [
	{id : "Codi" , header: "Codigo" , width :70,readonly:false},
	{id : "Reserva" , header: "Reserva" , width :60, align : 'center',editor:{type:"text"}},
	{id : "Fecha_Al" , header: "Fecha Alta" , width :80,editor:{type:"text"}},
	{id : "Fecha_Co" , header: "Fecha Comienzo" , width :80,editor:{type:"text"}},
	{id : "Fecha_Ba" , header: "Fecha Baja" , width :80,editor:{type:"text"}},
	{id : "Nombre_Alumno" , header: "Nombre Alumnos" , width :200,editor:{type:"text",
                 validator : function(value,record,colObj,grid){
                     if (value.length<=40) {
                         return true;
                     }
                     return "Maximo 40 caracteres.";
                 }
			}
	},
	{id : "Direccion" , header: "Direccion" , width :160,editor:{type:"text",
                 validator : function(value,record,colObj,grid){
                     if (value.length<=40) {
                         return true;
                     }
                     return "Maximo 40 caracteres.";
                 }
			}
	},
	{id : "Ciudad" , header: "Ciudad" , width :90,editor:{type:"text",
                 validator : function(value,record,colObj,grid){
                     if (value.length<=35) {
                         return true;
                     }
                     return "Maximo 35 caracteres.";
				}
			}
	},
	{id : "Codigo_Postal" , header: "C. Postal" , width :60,editor:{type:"text",
                 validator : function(value,record,colObj,grid){
                     if (value.length<=5) {
                         return true;
                     }
                     return "Maximo 5 caracteres.";
                 }
			}
	},
	{id : "Telefono" , header: "Telefono" , width :80,editor:{type:"text"}},
	{id : "Movil" , header: "Movil" , width :80,editor:{type:"text"}},
	{id : "Pago" , header: "Pago" , width :60,editor : { type :"select" ,	options : {'AN_B': 'AN_B', 'AN_M': 'AN_M' ,'CU_B':'CU_B','CU_M':'CU_M','ME_B':'ME_B','ME_M':'ME_M','TR_B':'TR_B','TR_M':'TR_M','FIN':'FIN'} ,defaultText : 'ME_B'}},
	{id : "Grupo" , header: "Grupo" , width :80, editor:{ type :"select" ,	options : {'----': '----'
<?php 
	$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo ", '".substr($row['Grupo'],3)."': '".substr($row['Grupo'],3)."'";
	}
?>
} ,defaultText : '----'}},
	{id : "Materiales" , header: "Materiales" , width :60, align : 'center', renderer:render_materiales},
	{id : "Descuento" , header: "Descuento" , width :60, align : 'center', renderer:render_descuento},
	{id : "Motivo_Dto" , header: "Motivo Dto." , width :60,editor : { type :"select" ,	options : {'----': '----', 'MC': 'Mul Cur', 'FA': 'Familiares', 'OT': 'Otros'} ,defaultText : '----'}},
	{id : "Procedencia" , header: "Procedencia" , width :60,editor : { type :"select" ,	options : {'----': '----', 'AC': 'Alumno del Centro', 'FA': 'Fachada', 'IA': 'Paginas Amarillas', 'IG': 'Google', 'IL': 'Internet Local', 'PP': 'Papel, Carteles, Buzon', 'RF': 'Referencias', 'OT': 'Otros'} ,defaultText : '----'}},
	{id : "Profesion_Estudios" , header: "Profesion" , width :60,editor:{type:"text"}},
	{id : "Necesidad" , header: "Necesidad" , width :60, editor : { type :"select" ,	options : {'----': '----', 'MEJ': 'Mejorar', 'SUS': 'Suspende', 'TRA': 'Trabajo', 'AMP': 'Ampliar conocimiento', 'OTR': 'Otros'} ,defaultText : '----'}},
	{id : "Edad" , header: "Edad" , width :60,editor:{type:"text"}},
	{id : "IDColegio" , header: "id Colegio" , width :80, editor:{ type :"select" ,	options : {'----': '----'
<?php
	$sql="SELECT * FROM colegios WHERE Centro='".$_GET['Centro']."' ORDER BY NombreC ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo ", '".$row['idClegio']."': '".$row['NombreC']."'";
	}
?>
} ,defaultText : '----'}},
	{id : "Correo" , header: "Correo" , width :60,editor:{type:"text"}},
	{id : "Cambios" , header: "Cambios" , width :60,editor:{type:"text"}},
	{id : "Observaciones" , header: "Observaciones" , width :260,editor:{type:"text"}},
	{id : "Centro" , header : "Centro",width :100,readonly:false}
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
		}
	}
);

var gridOption={
	id : "mygrid1",
	width: "98%",
	height: "500",
	replaceContainer : true,
	resizable : true,
	pageSize : 50000,
	loadURL : "BD/BDsubListadoGeneral.php",
	saveURL : "BD/BDsubListadoGeneral.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | <?php if($_SESSION['NombrePermiso']=="Administrador"){ echo "btndel "; } ?> btnsave | filter | print',
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		//alert (grid.getColumnValue('Materiales',rowNO));
		if (colNO==13){
			if(record['Materiales']=='YES'){ grid.setColumnValue('Materiales',rowNO,''); } else { grid.setColumnValue('Materiales',rowNO,'on'); }
		}
		if (colNO==14){
			if(record['Descuento']=='YES'){ grid.setColumnValue('Descuento',rowNO,''); } else { grid.setColumnValue('Descuento',rowNO,'on'); }
		}
		//grid.save();
	}

};
/*ar context = {
	sequence:false,checkBox:false,radioBox:true,selectRowWhenClick:true,paintMode:"all"
};*/
var gridRow=-1;
var FiltroAutomatico=false;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Listado General<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<table width="100%" border="0" bgcolor="#999999">
  <tr>
    <td>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Filtrar por Codigo:</strong><input name="txtCodigo" type="text" id="f_value1" onKeyUp="FiltrarCodigo()" value="">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Filtrar por Nombre:</strong><input name="txtNombre" type="text" id="f_value1" onKeyUp="FiltrarNombre()" value="">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Filtrar por Curso:</strong>
            <select name="lstGrupo" id="lstGrupo" onchange="FiltrarGrupo()">
                <option>&nbsp;</option>
    <?php
        $sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
        $miconexion->consulta($sql);
        while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
            echo "	  	<option value='".substr($row['Grupo'],3)."' id='formulario'>".substr($row['Grupo'],3)."</option>\n";
        }
        $miconexion->desconectar();
    ?>
        </select>
    </td>
  </tr>
</table>
    <strong>&nbsp;&nbsp;Total Alumnos:</strong> 
    <input name="txtTotalRegistros" type="text" id="txtTotalRegistros" size="5" maxlength="5" readonly="readonly" />
    <br />
    <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
<script type="text/javascript">
	setInterval('ActualizarTotal()',500);
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
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

Sigma.ToolFactroy.register(
	'btnrefresh',  
	{
		cls : 'clsRefresh',  
		toolTip : 'Actualiza la lista.',
		action : function(event,grid) { 
			grid.reload();
			grid.save();
		}
	}
);
var dsOption1= {
    fields :[
			{name : 'idClase'},
			{name : 'idCodigo'},
      {name : 'Fecha'},
      {name : 'ActividadesRealizadas'},
      {name : 'TipoDeberes'},
      {name : 'DescripcionDeberes'},
      {name : 'Observaciones'},
			{name : "ControlPreDeberes"},
			{name : "ControlDeberes"},
			{name : "ComentariosProf"}	
    ],
    recordType : 'object'
} 

var colsOption1 = [
	{id : "idClase", header : " ", width :1},
	{id : "idGrupo" , header: "Grupo" , width :85},
	{id : "Fecha" , header: "Fecha" , width :80},
	{id : "ActividadesRealizadas" , header: "Actividades Realizadas" , width: 150},
	{id : "TipoDeberes" , header: "Tipo Deberes" , width :150},
	{id : "DescripcionDeberes" , header: "Descripcion Deberes" , width :200},
	{id : "Observaciones" , header: "Observaciones" , width :250},
	{id : "ControlPreDeberes" , header: "ControlPreDeberes" , width :100, editor:{type:'select', options:{'Mal': 'Mal','Bien': 'Bien','Excelente': 'Excelente'}}},
	{id : "ControlDeberes" , header: "ControlDeberes" , width :100, editor:{type:'select', options:{'Mal': 'Mal','Bien': 'Bien','Excelente': 'Excelente'}}},
	{id : "ComentariosProf" , header: "ComentariosProf" , width :100, editor:{type:"text"}}	
];

var gridOption1={
	id : "gridbox1",
	width: "99%",
	height: "200",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDControlJefeEstudios0.php",
	saveURL : 'BD/BDControlJefeEstudios0.php',
	container : 'gridbox1',
	dataset : dsOption1 ,
	columns : colsOption1,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnsave | filter | print',
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (colNO==1){
			record['idGrupo']='<?php echo $_GET['Grupo'] ?>';
			grid.save();
			/*Filtro(CodigoSelec);*/
		}
	}
};
var mygrid1=new Sigma.Grid(gridOption1);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid1));
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
		background : url(../Imagenes/Iconos/form_delete.png) no-repeat center center; 
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Control del desarrollo de Clases<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
  <hr />
  <table width="100%" border="0">
    <tr>
      <td>
				&nbsp;&nbsp;&nbsp;&nbsp;<strong>Grupo:</strong>				<select name="selGrupo" id="selGrupo" onchange="MM_jumpMenu('parent',this,0)">
					<option>&nbsp;</option>
<?php
	$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "							<option value='ControlJefeEstudios0.php?Grupo=".$row['Grupo']."' id='formulario'";
		if ($row['Grupo']==$_GET['Grupo']) echo " selected ";
		echo ">".substr($row['Grupo'],3)."</option>\n";
	}
?>
				</select>				
      </td>
    </tr>
    <tr>
      <td>
				<div id="bigbox" style="margin:15px;display:!none;">
        	<div id="gridbox1" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:100%;" ></div>
				</div>			</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <br />
  <?php
    
  ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

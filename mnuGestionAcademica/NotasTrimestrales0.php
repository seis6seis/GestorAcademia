<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	$_SESSION['SQL']=" WHERE Grupo='".$_GET['Grupo']."' AND Centro='".$_SESSION['Centro']."'";
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
<link rel="stylesheet" type="text/css" media="all" href="../grid/calendar/calendar-blue.css"  />
<script type="text/javascript" src="../grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-en.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../grid/gt_msg_sp.js"></script>
<script type="text/javascript" src="../grid/gt_const.js"></script>
<script type="text/javascript" src="../grid/gt_grid_all.js"></script>

<script type="text/javascript">
function popup(mylink, w, h){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=no,fullscreen=no,top=10,left=10,height="+h+",width="+w)
}

function Filtro(Registro){
	var filterInfo=[
		{
			fieldName : "Codi",
			logic : "startWith",
			value : Registro
		}
	]
	var grid2=Sigma.$grid("mygrid2");
	var rowNOs=grid2.filterGrid(filterInfo); 
}
var dsOption= {
    fields :[
			{name : 'Codi'},
      {name : 'Fecha_Ba' },
      {name : 'Nombre_Alumno'},
      {name : 'Profesion_Estudios'},
      {name : 'Necesidad'},
      {name : 'Grupo'}
    ],
    recordType : 'object'
} 

var colsOption = [
	{id : "Codi" , header: "Codi" , width :75},
	{id : "Fecha_Ba" , header: "Fecha Ba" , width: 100, align : 'center'},
	{id : "Nombre_Alumno" , header: "Nombre Alumno" , width :300, align : 'left'},
	{id : "Profesion_Estudios" , header: "Profesion/Estudios" , width :58, align : 'left'},
	{id : "Necesidad" , header: "Necesidad" , width :60},
	{id : "Grupo" , header: "Grupo" , width :100}
];

Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Anadir Nota.',
		action : function(event,grid) {
			if (CodigoSelec!=-1){
				grid.add();
				FiltroBool=-1;
			}
		}
	}
);

Sigma.ToolFactroy.register(
	'btndel',  
	{
		cls : 'clsDelete',  
		toolTip : 'Borrar Nota.',
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
			FiltroBool=-1;
			grid.save();
			//Filtro(CodigoSelec);
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
			Filtro(CodigoSelec);
		}
	}
);

var gridOption={
	id : "mygrid1",
	width: "99%",
	height: "150",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDAlumnosPorGrupo.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | filter | print',
	pageSize : 50000,
	onClickCell  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	 var recs = mygrid.getUpdatedRecords();
		rowSelec=rowNO;
		colSelec=colNO;
		FiltroBool=-1;
    CodigoSelec=record['Codi'];
		var grid=Sigma.$grid("mygrid2");
    grid.loadURL = "BD/BDNotasPorAlumnos.php";
    grid.reload();
	}
};

var CodigoSelec=-1;
var gridRow=-1;
var rowSelec=-1;
var colSelec=-1;
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

// Para el segundo Grid (Recibos Cobrados
var dsOption2= {
    fields :[
		{name : 'ID'},
		{name : 'Codi'},
		{name : 'Parcial'},
		{name : 'Gram_y_Voc'},
		{name : 'E_Oral'},
		{name : 'E_Escrita'},
		{name : 'Compresion'},
		{name : 'Reading'},
		{name : 'Global'},
		{name : 'N_Faltas'},
		{name : 'Observaciones'}
    ],
    recordType : 'object'
} 

var colsOption2 = [
	{id : "ID", header : "-", width :5},
	{id : "Codi" , header: "Codi" , width :75},
	{id : "Parcial" , header: "Parcial" , width :50, align : 'center', editor:{type:'select', options:{'1': '1','2': '2','3': '3'}}},
	{id : "Gram_y_Voc" , header: "Gram. y Voc." , width: 80, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "E_Oral" , header: "E. Oral" , width :80, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "E_Escrita" , header: "E. Escrita" , width :80, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "Compresion" , header: "Compresion" , width :80, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "Reading" , header: "Reading" , width :80, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "Global" , header: "Global" , width :50, align : 'center', editor:{type:'select', options:{'NP':'NP', 'INSUFICIENTE': 'INSUFICIENTE','SUFICIENTE': 'SUFICIENTE','BIEN': 'BIEN','NOTABLE': 'NOTABLE','SOBRESALIENTE': 'SOBRESALIENTE'}}},
	{id : "N_Faltas" , header: "N. Faltas" , width :70, align : 'center', editor:{type:"text"}},
	{id : "Observaciones" , header: "Observaciones" , width :80, editor:{type:"text"}}
];

var gridOption2={
	id : "mygrid2",
	width: "99%",
	height: "110",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDNotasPorAlumnos.php",
	saveURL : 'BD/BDNotasPorAlumnos.php',
	container : 'gridbox2',
	dataset : dsOption2 ,
	columns : colsOption2,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | btnadd btndel btnsave | filter | print',
	afterEdit:function(value, oldValue, record, col, grid){
		/*if (col.id=="N_Faltas"){
			grid.save();
		}*/
	},
	onComplete:function(grid){
		if(FiltroBool==-1){
			Filtro(CodigoSelec);
			FiltroBool=0;
		}
	},
	onClickCell:function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		if (CodigoSelec!=-1 && colNO==1){
			record['Codi']=CodigoSelec;
			FiltroBool==-1;
			grid.save();
			//Filtro(CodigoSelec);
		}
	}
};
var FiltroBool=-1;
var mygrid2=new Sigma.Grid(gridOption2);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid2));

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

<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Registro de Notas<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
?>
  <hr />
  <form name="form" id="form">
    <table width="100%" border="0">
      <tr>
        <td bgcolor="#999999"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Selección de Grupo:&nbsp; </strong>
          <select name="cmbGrupo" id="cmbGrupo" onchange="MM_jumpMenu('parent',this,0)">
            <option>&nbsp;</option>
<?php
	$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
		echo "            <option value='NotasTrimestrales0.php?Grupo=".$row['Grupo']."' id='formulario'";
		if($_GET['Grupo']==$row['Grupo']) echo "selected";
		echo ">".substr($row['Grupo'],3)."</option>\n";
	}
	$sql="SELECT * FROM gruposcuotas WHERE Grupo='".$_GET['Grupo']."' ORDER BY Grupo ASC";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="txtGrupo" type="text" id="txtGrupo" size="15" readonly value="<?php echo substr($row['Grupo'],3) ?>" />
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="txtProfesor" type="text" id="txtProfesor" size="15" readonly value="<?php echo $row['Profesor'] ?>" />
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="txtPrograma" type="text" id="txtPrograma" size="15" readonly value="<?php echo $row['Programa'] ?>" />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong><a href="#" onclick="popup('ImprimirNotas0.php', 450,200,'yes')">Imprimir</a></strong>
					&nbsp;&nbsp;&nbsp;
          <strong><a href="RegistrosAcademicos0.php" target="_blank">Registros</a></strong></td>
      </tr>
      <tr>
        <td align="left" valign="top">
            <table width="100%" border="0">
              <tr>
                <td>
                    <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:150px;width:100%;" ></div>
                </td>
              </tr>
              <tr>
                <td>
                    <div id="gridbox2" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:110px;width:100%;" ></div>
                </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
  </form>
  <br />

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

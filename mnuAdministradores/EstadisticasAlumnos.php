<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
	require ("../Connections/funciones.php");

	if ($_GET['FechaI']=="")
		$FechaInicio=date("Y-m-d", strtotime("-1 year"));
	else
		$FechaInicio=$_GET['FechaI'];

	if ($_GET['FechaF']=="") 
		$FechaFin=date("Y-m-d");
	else
		$FechaFin=$_GET['FechaF'];

	$_SESSION['SQL']="";
	if ($_GET['Centro']!="Todos" && $_GET['Centro']!='') $_SESSION['SQL']=" Centro='".$_GET['Centro']."'";
	if ($_GET['Grupo']!="Todos" && $_GET['Grupo']!=''){
		if ($_SESSION['SQL']!='') $_SESSION['SQL'].=" AND";
		$_SESSION['SQL'].=" Grupo='".$_GET['Grupo']."'";
	}
	if ($_GET['Filtro']!="Todos" && $_GET['Filtro']!=''){
		if ($_SESSION['SQL']!='') $_SESSION['SQL'].=" AND";

		if ($_GET['Filtro']=="Altas"){
			if ($_GET['FechaI']!="Todos" && $_GET['FechaI']!='' && $_GET['FechaF']!="Todos" && $_GET['FechaF']!=''){
				$_SESSION['SQL'].=" Fecha_Al BETWEEN '".$_GET['FechaI']."' AND '".$_GET['FechaF']."'";
			}else $_SESSION['SQL'].=" Fecha_Al<>'0000-00-00'";
		}

		if ($_GET['Filtro']=="Bajas"){
			if ($_GET['FechaI']!="Todos" && $_GET['FechaI']!='' && $_GET['FechaF']!="Todos" && $_GET['FechaF']!=''){
				$_SESSION['SQL'].=" Fecha_Ba BETWEEN '".$_GET['FechaI']."' AND '".$_GET['FechaF']."'";
			}else $_SESSION['SQL'].=" Fecha_Ba<>'0000-00-00'";
		}
	}

	if ($_SESSION['SQL']!="") $_SESSION['SQL']=" WHERE".$_SESSION['SQL']
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Estadisticas de Alumnos - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link rel="stylesheet" type="text/css" href="../grid/gt_grid.css" />  
<link rel="stylesheet" type="text/css" href="../grid/gt_grid_height.css" />
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../grid/gt_msg_sp.js"></script>
<script type="text/javascript" src="../grid/gt_const.js"></script>
<script type="text/javascript" src="../grid/gt_grid_all.js"></script>
<script type="text/javascript" src="../grid/flashchart/fusioncharts/FusionCharts.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../grid/calendar/calendar-setup.js"></script>

<!-- Quitar cuando HTML5 este al 100% -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="../lib/jquery-ui.js"></script>
<script type="text/javascript">
	$(function(){
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '<Ant',
			nextText: 'Sig>',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm',
			dateFormat: 'dd-mm-yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
		$('#FechaI').datepicker({
			showButtonPanel: true,
			onSelect: function (date) {
				var fechaI=date.split("-").reverse().join("-");
				var fechaF=$("#FechaF").val();
				fechaF=fechaF.split("-").reverse().join("-");
				window.location = "EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=<?php echo $_GET['Filtro']; ?>&FechaI="+fechaI+"&FechaF="+fechaF;
			}
		});
		$('#FechaF').datepicker({
			showButtonPanel: true,
			onSelect: function (date) {
				var fechaI=$("#FechaI").val();
				fechaI=fechaI.split("-").reverse().join("-");
				var fechaF=date.split("-").reverse().join("-");
								window.location = "EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=<?php echo $_GET['Filtro']; ?>&FechaI="+fechaI+"&FechaF="+fechaF;
			}
		});
	});

</script>
<!-- Quitar cuando HTML5 este al 100% -->
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
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
	{id : "Grupo" , header: "Grupo" , width :80,readonly:false},
	{id : "Materiales" , header: "Materiales" , width :60, align : 'center',readonly:false},
	{id : "Descuento" , header: "Descuento" , width :60, align : 'center',readonly:false},
	{id : "Motivo_Dto" , header: "Motivo Dto." , width :60, align : 'center',readonly:false},
	{id : "Procedencia" , header: "Procedencia" , width :60, align : 'center',readonly:false},
	{id : "Profesion_Estudios" , header: "Profesion" , width :60,readonly:false},
	{id : "Necesidad" , header: "Necesidad" , width :60, align : 'center',readonly:false},
	{id : "Edad" , header: "Edad" , width :60,readonly:false},
	{id : "IDColegio" , header: "id Colegio" , width :80,readonly:false},
	{id : "Correo" , header: "Correo" , width :60,readonly:false},
	{id : "Cambios" , header: "Cambios" , width :60,readonly:false},
	{id : "Observaciones" , header: "Observaciones" , width :260,readonly:false},
	{id : "Centro" , header : "Centro",width :100, readonly:false, hidden:true}
];

var gridOption={
	id : "mygrid1",
	width: "95%",
	height: "300",
	replaceContainer : true,
	resizable : true,
	loadURL : "BD/BDEstadisticasAlumnos.php",
	saveURL : "BD/BDEstadisticasAlumnos.php",
	exportURL : "BD/BDEstadisticasAlumnos.php?export=true",
	exportFileName : 'EstadisticasAlumnos',
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | nav | print xls',
	pageSize : 100
};
var mygrid=new Sigma.Grid(gridOption);
Sigma.Util.onLoad(Sigma.Grid.render(mygrid));

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
			<td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Estadisticas de Alumnos<!-- InstanceEndEditable --></div></td>
		</tr>
	</table>
	<!-- InstanceBeginEditable name="Codigo" -->
	<hr />
	<br />
	<table width="100%" border="0">
		<tr>
			<td>
<?php
	if ($_SESSION['NombrePermiso']=="Administrador"){
?>
				<strong>Centro:</strong>
				<select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
					<option value="EstadisticasAlumnos.php?Centro=Todos&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=<?php echo $_GET['Filtro']; ?>&FechaI=<?php echo $_GET['FechaI']; ?>&FechaF=<?php echo $_GET['FechaF']; ?>">-- Totos los Centros --</option>
<?php
		$miconexion = new DB_mysql ;
		$miconexion->conectar();
		$sql="SELECT Codigo, NombreCentro FROM Centros";
		$miconexion->consulta($sql);
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo '					<option value="EstadisticasAlumnos.php?Centro='.$row['Codigo'].'&Grupo='.$_GET['Grupo'].'&Filtro='.$_GET['Filtro'].'&FechaI='.$_GET['FechaI'].'&FechaF='.$_GET['FechaF'].'"';
			if ($_GET['Centro']==$row['Codigo']) echo " selected ";
			echo ">".$row['NombreCentro']."</option>\n";
		}
?>
				</select>

				<strong>Por Grupo</strong>
				<select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
					<option value="EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=Todos&Filtro=<?php echo $_GET['Filtro']; ?>&FechaI=<?php echo $_GET['FechaI']; ?>&FechaF=<?php echo $_GET['FechaF']; ?>">-- Totos los Grupos --</option>
<?php
	if ($_GET['Centro']!='Todos' && $_GET['Centro']!=''){
		$sql="SELECT Grupo FROM gruposcuotas WHERE Centro='".$_GET['Centro']."'";
		$miconexion->consulta($sql);
		while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
			echo '					<option value="EstadisticasAlumnos.php?Centro='.$_GET['Centro'].'&Grupo='.$row['Grupo'].'&Filtro='.$_GET['Filtro'].'&FechaI='.$_GET['FechaI'].'&FechaF='.$_GET['FechaF'].'"';
			if ($_GET['Grupo']==$row['Grupo']) echo " selected ";
			echo ">".substr($row['Grupo'],3)."</option>\n";
		}
	}
?>
				</select>

				<strong>Tipo de Filtro</strong>
				<select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
					<option value="EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=Todos&FechaI=<?php echo $_GET['FechaI']; ?>&FechaF=<?php echo $_GET['FechaF']; ?>"
					<?php if($_GET['Filtro']=='Todos' || $_GET['Filtro']=='') echo " selected"; ?>
					>-- Totos los Alumnos --</option>
					<option value="EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=Altas&FechaI=<?php echo $_GET['FechaI']; ?>&FechaF=<?php echo $_GET['FechaF']; ?>"
					<?php if($_GET['Filtro']=='Altas') echo " selected"; ?>
						>Altas</option>
					<option value="EstadisticasAlumnos.php?Centro=<?php echo $_GET['Centro']; ?>&Grupo=<?php echo $_GET['Grupo']; ?>&Filtro=Bajas&FechaI=<?php echo $_GET['FechaI']; ?>&FechaF=<?php echo $_GET['FechaF']; ?>"
					<?php if($_GET['Filtro']=='Bajas') echo " selected"; ?>
						>Bajas</option>
				</select>

				<strong>Entre la fecha</strong> 
				<input type="date" size="5" id="FechaI" name="FechaI" placeholder="Fecha Inicio" value="<?php echo cambiarfecha($FechaInicio); ?>">
				<strong> y</strong> 
				<input type="date" size="5" id="FechaF" name="FechaF" placeholder="Fecha Fin" value="<?php echo cambiarfecha($FechaFin); ?>">

<?php
	}
?>
			</td>
		</tr>
		<tr>
			<td>
				<div id="bigbox" style="margin:15px;display:!none">
					<div id="mygrid1" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:100%;width:100%;" ></div>
				</div>
			</td>
		</tr>
	</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

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
		$('#txtFechaFalta').datepicker({
			showButtonPanel: true,
			onSelect: function (date) {
				$("#txtFechaFalta").val(date);
			}
		});
	});

</script>
<!-- Quitar cuando HTML5 este al 100% -->
<script type="text/javascript">
$(document).ready(function(){
	$("#btnGuardarFalta").click(function() {
		if ($("#txtCodAlumnoFalta").val()!='' && $("#txtAlumnoFalta").val()!='' && $("#txtFechaFalta").val()!=''){
			var fecha=$("#txtFechaFalta").val().split("-").reverse().join("-");
			// *********** MODAL ********//
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			$('#mask').fadeIn(1000);
			$('#mask').fadeTo("slow",0.8);
			var winH = $(window).height();
			var winW = $(window).width();
			$("#dialog").css('top', winH/2-$("#dialog").height()/2);
			$("#dialog").css('left', winW/2-$("#dialog").width()/2);
			$("#dialog").fadeIn(2000);
			//*********** FIN DE MODAL *******//
			var parametros = {
				"action" : "save",
				"CodAlumno" : $("#txtCodAlumnoFalta").val(),
				"Fecha" : $("#txtFechaFalta").val(),
				"Justificada" : $("#selJustificada").val()
			};
			var puntos=0;
			$.ajax({
				data: parametros,
				url:   'BD/BDFaltas.php',
				type:  'POST',
				cache: false,
				dataType : 'json',
				success: function(msg){
					if (msg.Res=='OK'){
						$('#mask, .window').hide();
						$("#txtCodAlumnoFalta").val("");
						$("#txtAlumnoFalta").val("");
						$("#txtFechaFalta").val("");
						$('#selJustificada').val("NO");
					}else{
						$('#mask, .window').hide();
						alert(msg.Res);
					}
				},
				error: function(msg) { 
					console.log("Error: " + msg.Res); 
				}
			});
		}
	});
});
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
	width: "500px",
	height: "200px",
	replaceContainer : false,
	resizable : false,
	loadURL : "BD/BDAlumnos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | filter | print',
	pageSize : 50000,
	onClickCell  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
		$("#NumFaltas").html("<font>&nbsp;</font>");
		$.ajax({
			data: {"action": "TotalFaltas", "Codigo": record['Codi']},
			url:   'BD/BDFaltas.php',
			type:  'POST',
			cache: false,
			dataType : 'json',
			success: function(msg){
				if (msg.Res=='OK'){
					if (msg.Total>0)
						$("#NumFaltas").html("<font color='#ff0000'>Tiene `"+msg.Total+"` faltas en la ultima semana.</font>");
				}else{
					alert(msg.Res);
				}
			},
			error: function(msg) { 
				console.log("Error: " + msg.Res); 
			}
		});
		var d=new Date();
		rowSelec=rowNO;
		colSelec=colNO;
		FiltroBool=-1;
    	CodigoSelec=record['Codi'];
    	$("#txtCodAlumnoFalta").val(record['Codi']);
    	$("#txtAlumnoFalta").val(record['Nombre_Alumno']);
    	$("#txtFechaFalta").val(d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear());
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


var dsOption3= {
    fields :[
		{name : 'idGrupo'},
		{name : 'Fecha'},
		{name : 'DescripcionDeberes'}
    ],
    recordType : 'object'
} 

var colsOption3 = [
	{id : "idGrupo" , header: "idGrupo" , width :150, editor:{type:"text"}},
	{id : "Fecha" , header: "Fecha" , width :80, editor:{type:"text"}},
	{id : "DescripcionDeberes" , header: "Descripcion Deberes" , width :800, editor : {type :"textarea", width:'200px',height:'100px',
		validator : function(value,record,colObj,grid){ 
			if (value.length>500) alert("Texto muy largo, cortelo un poco");
		}
	}}
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
	<div id="modalBoxes">
		<div id="mask"></div>
		<div id="dialog" class="window">
			<p>Grabando datos espere...</p>
			<center><img src="../Imagenes/loading.gif" width="60px" height="60px"></center>
		</div>
	</div>
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
							$sql="SELECT Codigo, NombreCentro FROM centros ORDER BY NombreCentro ASC";
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
            <option value='/GestorAcademia/CambioCurso.php?Curso=1' id='formulario' <?php if ($_SESSION['CursoEscolar']==""){ echo " selected"; } ?> >Curso 1</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=2' id='formulario' <?php if ($_SESSION['CursoEscolar']=="2"){ echo " selected"; } ?> >Curso 2</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=3' id='formulario' <?php if ($_SESSION['CursoEscolar']=="3"){ echo " selected"; } ?> >Curso 3</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=4' id='formulario' <?php if ($_SESSION['CursoEscolar']=="4"){ echo " selected"; } ?> >Curso 4</option>
            <option value='/GestorAcademia/CambioCurso.php?Curso=5' id='formulario' <?php if ($_SESSION['CursoEscolar']=="5"){ echo " selected"; } ?> >Curso 5</option>
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
	<table border="0" align="left">
		<tr>
   		<td width="130" align="left" valign="top">
			<!-- InstanceBeginEditable name="SubMenu" -->
				<div id='SubMenu' style="width:130px;">
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/RegistrosAcademicos0.php', 800,430,'yes')">Registros Academicos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/Apoyo0.php', 800,620,'no')">Apoyos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/.php', 800,430,'yes')">Utilidades y documentos</a></p>
	      	<p><a href="#" onclick="popup('../mnuGestionAcademica/NotasTrimestrales0.php', 800,430,'yes')">Notas Trimestrales</a></p>

			</div>
      <!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
			<table width="1000px" border="0" bgcolor="#CCCCCC">
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
							<option value="index.php">&nbsp;</option>
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
            <input name="txtProfesor" type="text" id="txtProfesor" value="<?php echo $row['Profesor'] ?>" size="15" maxlength="10" />
            &nbsp;&nbsp;&nbsp;
            <a href="#" onclick="popup('FaltasMasivas.php?Grupo=<?php echo $_GET['Grupo'] ?>&Fecha='+document.form.txtFechaActual.value , 500,200,'yes')"><strong>Fal. Masiva</strong></a>
            &nbsp;&nbsp;&nbsp;
            <a href="TotalFaltas.php" target="_blank"><strong>Total Faltas</strong></a> 
            &nbsp;&nbsp;&nbsp;
        	</form>          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
			<td align="left" valign="top" width="500px">
				<div align="center" style="width:500px;float: left;margin:0"><strong>Alumno del Grupo:</strong></div>
				<div align="center" style="width:500px;float: right;margin:0"><strong>Faltas del Alumno:</strong></div>
			</td>
        </tr>
        <tr>
			<td align="left" valign="top" height="220px" width="500px">
       			<div id="gridbox" style="float: left;border:0px;padding:5px;height:200px;width:500px;margin: 0;" ></div>

				<div id="divFaltas" style="float: right;background-color: #ffffff;width: 500px;background-color: #ffffff;height: 180px; padding: 10px; margin-right: 15px; margin-top:5px" >
					<center><h3 id="NumFaltas"><font>&nbsp;</font></h3></center>
					<table>
						<tr>
							<td><b>Alumno:</b></td>
							<td><input type="text" id="txtAlumnoFalta" size="20" readonly></td>
							<td><b>Codigo:</b></td>
							<td><input type="text" id="txtCodAlumnoFalta" size="8" readonly></td>
						</tr>
						<tr>
							<td><b>Fecha:</b></td>
							<td><input type="text" id="txtFechaFalta" size="20" readonly></td>	
							<td><b>Justificada:</b></td>
							<td>
								<select id="selJustificada" style="width: 130px">
									<option value="NO" selected>No</option>
									<option value="YES">Sí</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<p align="center"><button id="btnGuardarFalta">Grabar Falta</button></p>
							</td>
						</tr>
					</table>
				</div>
			</td>
        </tr>
        <tr>
			<td>
				<div align="center"><strong>Deberes del Grupo:</strong></div>
			</td>
        </tr>
        <tr>
          <td>
             <div id="gridbox3" style="border:0px;padding:5px;height:200px;width:1055px;" ></div>
          </td>
        </tr>
      </table>
			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>

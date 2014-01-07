<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
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
<link href="/GestorAcademia/CSS/Estilo.css" rel="stylesheet" type="text/css" />
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
function popup(mylink, w, h,scrollbar){
	window.open(mylink, "", "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars="+scrollbar+",fullscreen=no,top=10,left=10,height="+h+",width="+w)
}
function validar(Centro,Fila){
		popup("ModificarAlumno0.php?Codigo="+Centro+mygrid.getColumnValue('Codi',Fila)+"&Centro="+Centro,800,430,"no");
}

function doFilter() {
	Filtro="<?php echo $_GET['Grupo'] ?>";
	var filterInfo=[
	{
		fieldName : "Grupo",
		logic : "startWith",
		value : Filtro
	},
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
function render_edit(value ,record,columnObj,grid,colNo,rowNo){
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
	{id: 'Edit' , header: "Edit" , width :27, filterable: false, exportable:false, renderer:render_edit},
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
	{id : "Materiales" , header: "Materiales" , width :60, align : 'center',readonly:false, renderer:render_materiales},
	{id : "Descuento" , header: "Descuento" , width :60, align : 'center',readonly:false, renderer:render_descuento},
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
Sigma.ToolFactroy.register(
	'btnadd',  
	{
		cls : 'clsAdd',  
		toolTip : 'Permite añadir un alumno.',
		action : function(event,grid) { popup('NuevoAlumno0.php?Centro=<?php echo $_SESSION['Centro'] ?>', 800, 430,"no") }
	}
);
Sigma.ToolFactroy.register(
	'btnedit',  
	{
		cls : 'clsEdit',  
		toolTip : 'Permite Editar un Alumno.',
		action : function(event,grid) {
			if (gridRow!=-1){
				popup("ModificarAlumno0.php?Codigo=<?php echo $_SESSION['Centro'] ?>"+mygrid.getColumnValue('Codi',gridRow)+"&Centro=<?php echo $_SESSION['Centro'] ?>",800,430,"no");
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
	height: "350",
	replaceContainer : false,
	resizable : true,
	loadURL : "BD/BDListaAlumnos.php",
	container : 'gridbox',
	dataset : dsOption ,
	columns : colsOption,
	toolbarPosition : 'top',
	toolbarContent : 'btnrefresh | state | nav | btnadd btnedit | filter | print',
	pageSize : 20,
	onClickCell:function(value, record , cell, row, colNO, rowNO, columnObj, grid){
		if (colNO==0) gridRow=rowNO;
	}
};
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
	<table width="100%" border="0" align="left">
		<tr>
   		<td width="130" align="left" valign="top">
			<!-- InstanceBeginEditable name="SubMenu" -->
				<div id='SubMenu' style="width:130px;">
					<p><a href="BuscarAlumno0.php" target="_blank">Buscar Alumno</a></p>
					<p><a href='subListadoGeneral_01.php' target='_blank'>Listado General</a></p>
					<p><a href="#" onclick="popup('Informacion0.php', 800,400,'no')">Informacion</a></p>
                    <p><a href="#" onclick="popup('DarBaja0.php', 500, 350,'no')">Registros de Bajas</a></p>          
                    <p><a href="#" onclick="popup('ListadoBajas0.php', 800,460,'no')">Listado de Bajas</a></p>
                    <p><a href="#" onclick="popup('ListadoAltas0.php', 800,460,'no')">Listado de Altas</a></p>
                    <p><a href='RelacionGrupos0.php' target='_blank'>Relacción de Grupos</a></p>
                    <p><a href="ListadoGrupos0.php" target="_blank">Listado de Grupos</a></p>          
                    <p><a href="#" onclick="popup('Contrato0.php?Codigo=<?php echo $_SESSION['Centro'] ?>'+mygrid.getColumnValue('Codi',gridRow),800,400,'yes')">Contratos</a></p>
                    <p><a href="#" onclick="popup('Cuadrante0.php',800,400,'yes')">Ver Cuadrante</a></p>
                    <p><a href="#" onclick="popup('../mnuDirectores/EditarGrupos0.php?Codigo=Nuevo', 800,400,'no')"><strong>Editar Grupos</strong></a></p>
                    <p><a href="#" onclick="popup('../mnuDirectores/EditarProfesores0.php?Codigo=Nuevo',500,400,'no')"><strong>Editar Profesores</strong></a></p>
                    <p><a href="#" onclick="popup('../mnuDirectores/EditarColegios0.php?Codigo=Nuevo',500,300,'no')"><strong>Editar Colegios</strong></a></p>
				</div>
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	$sql="SELECT * FROM Centros WHERE Codigo='".$_SESSION['Centro']."'";
	$miconexion->consulta($sql);
	$row =mysql_fetch_array($miconexion->Consulta_ID);
?>
			<!-- InstanceEndEditable --></td>
			<td width="5" bgcolor="#45AAFF">
				<div style="width:5px;">&nbsp;
				</div>
      </td>
      <td align="left" valign="top">
			<!-- InstanceBeginEditable name="Resultados" -->
			<table width="100%" height="180" border="1">
        <tr height="100">
          <td height="103" align="left" valign="top" bgcolor="#CCCCCC">
          	<table width="897" border="0">
            <tr>
              <td colspan="6">
                <div align="left" class="TituloPrincipal">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Alta y Modificaciones de Alumnos              	</div>              </td>
            </tr>
            <tr>
            	<td width="491">
								<strong>Grupo:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name='cmbCentros' id='cmbCentros' onchange="MM_jumpMenu('parent',this,0)"tabindex="0">
									<option>--<?php echo substr($_GET['Grupo'],3) ?>--</option>
<?php
								$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' ORDER BY Grupo ASC";
								$miconexion->consulta($sql);
								while ($row =mysql_fetch_array($miconexion->Consulta_ID)) {
									echo "									<option value='index.php?Grupo=".$row['Grupo']."' id='formulario'>".substr($row['Grupo'],3)."</option>\n";
								}
?>
                </select>
<?php
								if (isset($_GET["Grupo"])){
									$sql="SELECT * FROM gruposcuotas WHERE Centro='".$_SESSION['Centro']."' AND Grupo='".$_GET['Grupo']."' ORDER BY Grupo ASC";
									$miconexion->consulta($sql);
									$row =mysql_fetch_array($miconexion->Consulta_ID);
								}
?>&nbsp;
							</td>
              <td colspan="2" align="center" valign="middle" bgcolor="#999999">
                <strong>
				          <a href="#" onclick="popup('Confecionar1Recibo0.php?txtBuscarCodigo='+mygrid.getColumnValue('Codi',gridRow),900,700,'no')">Confeccionar 1º recibo</a>
                </strong>
              </td>
              <td width="99" align="center" valign="middle">&nbsp;</td>
              <td width="119" align="center" valign="middle">&nbsp;</td>
              <td width="6">&nbsp;</td>
            </tr>
            <tr>
              <td width="491" height="23"><strong>Horarios</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type='text' name='txtHorarios' id='formulario' value='<?php echo $row['Horarios'] ?>' size=10 readonly/> 
                <strong>Profesor:&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                <input type='text' name='txtProfesor' id='formulario' value='<?php echo $row['Profesor'] ?>' size=10 readonly/>
                <strong>Programa:&nbsp;</strong>               
								<input type='text' name='txtPrograma' id='formulario' value='<?php echo $row['Programa'] ?>' size=10 readonly/></td>
              <td colspan="2" align="center" valign="middle" bgcolor="#999999">
              	<strong>
                	<a href="#" onclick="popup('DatosBanco0.php?Alumno=<?php echo $_SESSION['Centro'] ?>'+mygrid.getColumnValue('Codi',gridRow)+'&Centro=<?php echo $_SESSION['Centro']?>', 800,270,'no')">Añadir datos de banco</a>
				</strong>
			  </td>
              <td align="center" valign="middle">&nbsp;</td>
              <td align="center" valign="middle">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
							<td width=491><strong>Matriculas: &nbsp;</strong>
                <input type='text' name='txtMatricula' id='formulario' value='<?php echo $row['Matriculas'] ?>&nbsp;&#8364;' size=10 READONLY/>
                <strong>Cuota Trim:</strong>
                <input type='text' name='txtCuotaTrim' id='formulario' value='<?php echo $row['CuotasTrim'] ?>&nbsp;&#8364;' size=10 READONLY/>
                <strong>Cuota Cuat:</strong>
                <input type='text' name='txtCuotaCuat' id='formulario' value='<?php echo $row['CuotasCuat'] ?>&nbsp;&#8364;' size=10 READONLY/>              </td>
							<td width="60" align='center' valign="middle">&nbsp;</td>
							<td width="69" align='center' valign="middle">&nbsp;</td>
							<td align="center" valign="middle">&nbsp;</td>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td>&nbsp;</td>
            </tr>
						<tr>
							<td width='491'><strong>Materiales:</strong>&nbsp;&nbsp;
								<input type='text' name='txtMateriales' id='formulario' value='<?php echo $row['Materiales'] ?>&nbsp;&#8364;' size=10 READONLY/>
								<strong>Cuota Mes:</strong>&nbsp;
								<input type='text' name='txtCuotaMes' id='formulario' value='<?php echo $row['CuotasMes'] ?>&nbsp;&#8364;' size=10 READONLY/>
								<strong>Cuota Año:</strong>&nbsp;
								<input type='text' name='txtCuotaAno' id='formulario' value='<?php echo $row['CuotasAno'] ?>&nbsp;&#8364;' size=10 READONLY/>              </td>
							<td align="center" valign="middle">&nbsp;</td>
							<td align="center" valign="middle">&nbsp;</td>
							<td align="center" valign="middle">&nbsp;</td>
              <td align="center" valign="middle">&nbsp;</td>
              <td>&nbsp;</td>
						</tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top">
              <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:300px;width:100%;" ></div>
          </td>
				</tr>
      </table>
<?php
			$miconexion->Desconectar();
?>
            			<!-- InstanceEndEditable --></td>

		</tr>
	</table>
</body>
<!-- InstanceEnd --></html>
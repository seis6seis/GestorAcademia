<?php
	session_start();
	include("../login.class.php");
	$login=new login();
	$login->inicia();
	require ("../Connections/DB_mysql.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla_Basica.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editor Contrato - Gestor Academia</title>
<!-- InstanceEndEditable -->
<link href="../CSS/Estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- TinyMCE -->
<script type="text/javascript" src="../TinyMCE/tiny_mce.js"></script>
<script type="text/javascript">
// Creates a new plugin class and a custom listbox
	tinymce.create('tinymce.plugins.ExamplePlugin', {
		createControl: function(n, cm) {
			switch (n) {
				case 'Comandos':
					var c = cm.createMenuButton('mymenubutton', {
						title : 'Campos',
						image : 'img/example.gif',
						icons : false
					});
					c.onRenderMenu.add(function(c, m) {
						var sub;
						m.add({title : 'Nombre Alumno', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~NOMBRE_ALUMNO~');
						}});
						m.add({title : 'Grupo', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~GRUPO~');
						}});
						m.add({title : 'Matricula', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~MATRICULA~');
						}});
						m.add({title : 'Materiales', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~MATERIALES~');
						}});
						m.add({title : 'Cuotas Mesual', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CUOTAS_MES~');
						}});
						m.add({title : 'Cuotas Trimestral', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CUOTAS_TRIM~');
						}});
						m.add({title : 'Cuotas Cuatrimestral', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CUOTAS_CUAT~');
						}});
						m.add({title : 'Cuotas Anual', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CUOTAS_ANO~');
						}});
						m.add({title : 'Nombre Director', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~NOMBRE_DIRECTOR~');
						}});
						m.add({title : 'Nombre Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~NOMBRE_CENTRO~');
						}});
						m.add({title : 'Poblacion Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~POBLACION_CENTRO~');
						}});
						m.add({title : 'Direccion Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~DIRECCION_CENTRO~');
						}});
						m.add({title : 'CP Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CP_CENTRO~');
						}});
						m.add({title : 'Provincia Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~PROVINCIA_CENTRO~');
						}});
						m.add({title : 'Curso Escolar', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~CURSO_ESCOLAR~');
						}});
						m.add({title : 'Telefono Centro', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~TELEFONO_CENTRO~');
						}});
						m.add({title : 'Fecha Actual Corta', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~FECHA_ACTUAL_CORTA~');
						}});
						m.add({title : 'Fecha Actual Larga', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~FECHA_ACTUAL_LARGA~');
						}});
						m.add({title : 'Hora Actual', onclick : function() {
							tinyMCE.activeEditor.execCommand('mceInsertContent', false, '~HORA_ACTUAL~');
						}});						
					});
					// Return the new menu button instance
					return c;
			}
			return null;
		}
	});
	
	// Register plugin with a short name
	tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "-example,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "Comandos,|,fullscreen,|,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,||,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,preview,print,|,charmap,emotions,iespell,advhr,|,sub,sup,|,ltr,rtl",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,pagebreak",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "../../TinyMCE/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../../TinyMCE/lists/template_list.js",
		external_link_list_url : "../../TinyMCE/lists/link_list.js",
		external_image_list_url : "image_list.php",
		media_external_list_url : "../../TinyMCE/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		},

		// Enable translation mode
		translate_mode : true,
		language : "es"
	});
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function Nuevo(){
	var Titulo = prompt("Indique el nombre del nuevo documento: Contrato_");
	parent.location.href="Editor_Documentos0.php?Doc=Contrato_"+Titulo+"&Estado=Nuevo&Titulo=Contrato_"+Titulo;
}
function Eliminar(){
	var Titulo=document.form.jumpMenu.options[document.form.jumpMenu.selectedIndex].text
	if (Titulo=='Informacion'  || Titulo=='----'){
		alert("No se puede eliminar el documento '"+Titulo+"'");
	}
	else{
		if (confirm("¿Seguro de eliminar '"+Titulo+"'?")) {
			// Respuesta afirmativa...
			parent.location.href="Editor_Documentos0.php?Estado=Eliminar&Titulo="+Titulo;
		}
	}
}
</script>
<!-- /TinyMCE -->
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
        <td width="88%"><div align="center" class="Titulo"><!-- InstanceBeginEditable name="EditRegion4" -->Editor de Documentos<!-- InstanceEndEditable --></div></td>
    </tr>
  </table>
	<!-- InstanceBeginEditable name="Codigo" -->
<?php
	$miconexion = new DB_mysql ;
	$miconexion->conectar();
	
	if ($_GET['Estado']=='Nuevo'){
		$sql="INSERT INTO documentos (Titulo) VALUES('".$_GET['Titulo']."')";
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo "Error al insertar documentos: ".$miconexion->Error."<br />";
			echo $sql;
		}
	}
	
	if ($_GET['Estado']=='Eliminar'){
		$sql="DELETE FROM documentos WHERE Titulo='".$_GET['Titulo']."'";
		$miconexion->consulta($sql);
		if (!empty($miconexion->$Error)){
			echo "Error al eliminar documento: ".$miconexion->Error."<br />";
			echo $sql;
		}
	}
?>
    <p align="center">
      <form name="form" id="form">
				<strong>Documento:</strong>
        <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        	<option>----</option>
<?php
					$sql="SELECT Titulo FROM Documentos";
					$miconexion->consulta($sql);
					while ($row =mysql_fetch_array($miconexion->Consulta_ID)){
						echo "<option value='Editor_Documentos0.php?Doc=".$row['Titulo']."'";
						if ($_GET['Doc']==$row['Titulo']) echo " selected ";
						echo ">".$row['Titulo']."</option>";
					}
?>
        </select>
        &nbsp;&nbsp;<strong>&nbsp;
        <a href="#" onclick="Nuevo();">Nuevo Documento</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <a href="#" onclick="Eliminar();">Eliminar Documento</a></strong>
			</form>
      <form id="form1" name="form1" method="post" action="Editor_Documentos1.php">
        <textarea id="html" name="html" rows="25" cols="80" style="width: 700px">
<?php
					$sql="SELECT Contenido FROM Documentos WHERE Titulo='".$_GET['Doc']."'";
					$miconexion->consulta($sql);
					$row =mysql_fetch_array($miconexion->Consulta_ID);
					echo $row['Contenido'];
					$miconexion->desconectar();
?>
        </textarea>
        <input type="hidden" name="Doc" id="Doc" value="<?php echo $_GET['Doc']?>"/>
    </form>
  </p>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

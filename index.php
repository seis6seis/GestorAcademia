<?php
session_start();
	if (isset($_GET['error'])==false && isset($_COOKIE['idusuario'])==true) {
		header( "Location: login.php?user=".$_COOKIE['idusuario']."&pass=".$_COOKIE['Password']);
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="Spain" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Fco. Javier Martinez Ramirez" />
  <meta name="description" content="Gestor Academia" />
	<NOSCRIPT>
	<META HTTP-EQUIV="refresh" content="1;URL=NoJavaScript.html">
	</NOSCRIPT>
  <title>Gestor Academia</title>
<link href="/GestorAcademia/CSS/Estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <table width="100%" border="0">
    <tr>
      <td width="140"><img src="Imagenes/logo_blanco.png" alt="Logo EnglishConnection" width="111" height="49" /></td>
      <td>
        <div align="right" id="formulario">
					<?php
						$usuario=$_COOKIE['idusuario'];
						$contraseña=$_COOKIE['Password'];
						echo "				<form name='frm_login' method='get' action='login.php'>";
						echo "				Usuario:&nbsp;<input type='text' name='user' value='' size='15' />&nbsp;";
						echo "				Clave:&nbsp;<input type='password' name='pass' value='' size='15' />&nbsp;"; 
						echo "				<input type='submit' name='submit' value='Aceptar' />";
						echo "				</form>";
					?>
        </div>
      </td>
    </tr>
  </table>

	<div id="container-navigation">
		<ul id="navigation">
			<li>
				<a href="#">Gestion de Alumnos</a>
			</li>
			<li>
				<a href="#">Gestion Academica</a>
			</li>
			<li>
				<a href="#">Gestion Administrativa</a>
			</li>
			<li>
				<a href="#">Datos Generales</a>
			</li>
		</ul>
	</div>
	<br />
	<table width="100%" border="0">
		<tr>
      <td>
      	<?php
					if (isset($_GET['error'])){
						echo "      	<br /><br /><br />";
						echo "				<div align='center'><b>Usuario o contraseña no valido.<b></div>";
					}
				?>
      </td>
			<td width="20">&nbsp;</td>
   		<td width="150">&nbsp;</td>
		</tr>
	</table>
</body>
</html>

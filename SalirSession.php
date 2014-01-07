<?php
	session_start();

	// destruyo la sesión
	session_destroy(); 
	//Destruye las cookies
	setcookie("idusuario", "", time()+3600);
	setcookie("password", "", time()+3600);
  setcookie("Centro", "", time()+$tiempo);
  setcookie("Permiso","", time()+$tiempo);
	setcookie("NombrePermiso", "", time()+$tiempo);

	//envío al usuario a la pag. de autenticación
	header("Location: index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Gestor Academia - EnglishConnection</title>
  <meta http-equiv="Content-Language" content="Spain" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Fco. Javier Martinez Ramirez" />
  <meta name="description" content="Gestor Academia" />
<META HTTP-EQUIV="Refresh" CONTENT="5;URL=index.php">. 
<title>Gestor Academia</title>
</head>
<body>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><strong><font face="Verdana, Arial, Helvetica, sans-serif">Si no se redirege sola la pagina tras unos segundos, <a href="index.php">pulse aqui
  </a></font></strong></p>
</div>
</body>
</html>

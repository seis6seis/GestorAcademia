<?php
	session_start();
	include("login.class.php");
	$login=new login();
	$login->inicia();
	require ("Connections/DB_mysql.class.php");
	$_SESSION['Centro']=$_GET['Centro'];
	$miconexion_Centro = new DB_mysql;
	$miconexion_Centro->conectar();
	$sql="SELECT Codigo, NombreCentro FROM centros WHERE Codigo='".$_GET['Centro']."' ORDER BY Codigo ASC";
	$miconexion_Centro->consulta($sql);
	$row =mysql_fetch_array($miconexion_Centro->Consulta_ID);
	$_SESSION['NombreCentro']=$row['NombreCentro'];
	$miconexion_Centro->desconectar();
  header( "Location: index.php" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Refresh" CONTENT="5;URL=index.php">. 
<title>Gestor Academia</title>
</head>
<body>
<div align="center">
<?php echo $_SESSION['Centro']."---".$_GET['Centro']."\n" ?>
<?php echo $_SESSION['NombreCentro'] ?>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><strong><font face="Verdana, Arial, Helvetica, sans-serif">Si no se redirege sola la pagina tras unos segundos, <a href="index.php">pulse aqui
  </a></font></strong></p>
</div>
</body>
</html>

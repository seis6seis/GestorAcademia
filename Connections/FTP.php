<?php
# FUNCIONES FTP
	ini_set('post_max_size','100M');
	ini_set('upload_max_filesize','100M');
	ini_set('max_execution_time','1000');
	ini_set('max_input_time','1000');

# CONSTANTES
# Cambie estos datos por los de su Servidor FTP
define("SERVER","ftp.englishconnection.es"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","ac4358"); //Nombre de Usuario
define("PASSWORD","M4rt1n3z_"); //Contraseña de acceso
define("PASV",true); //Activa modo pasivo

# FUNCIONES
function ConectarFTP(){
	//Permite conectarse al Servidor FTP
	$id_ftp=ftp_connect(SERVER,PORT); //Obtiene un manejador del Servidor FTP
	ftp_login($id_ftp,USER,PASSWORD); //Se loguea al Servidor FTP
	ftp_pasv($id_ftp,MODO); //Establece el modo de conexión
	ftp_chdir($id_ftp,"//public/www/GestorAcademia/Deberes");
	return $id_ftp; //Devuelve el manejador a la función
}

function SubirArchivo($id_ftp,$archivo_local,$archivo_remoto){
	//Sube archivo de la maquina Cliente al Servidor (Comando PUT)
	//$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
	ftp_put($id_ftp,$archivo_remoto,$archivo_local,FTP_BINARY);
	//Sube un archivo al Servidor FTP en modo Binario
	//ftp_quit($id_ftp); //Cierra la conexion FTP
}

function ObtenerRuta($id_ftp){
	//Obriene ruta del directorio del Servidor FTP (Comando PWD)
	//$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
	$Directorio=ftp_pwd($id_ftp); //Devuelve ruta actual p.e. "/home/willy"
	//ftp_quit($id_ftp); //Cierra la conexion FTP
	return $Directorio; //Devuelve la ruta a la función
}

function EliminarArchivo($id_ftp,$archivo_remoto){
	//$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
	ftp_delete($id_ftp,$archivo_remoto); //Devuelve ruta actual p.e. "/home/willy"
	//ftp_quit($id_ftp); //Cierra la conexion FTP
}
?>
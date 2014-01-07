<?php
class DB_mysql {
	/* variables de conexión */
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;

	/* identificador de conexión y consulta */
	var $Conexion_ID = 0;
	var $Consulta_ID = 0;

	/* número de error y texto error */
	var $Errno = 0;
	var $Error = "";

	function cambiarfecha($fecha){
			return implode('-', array_reverse(explode('-', $fecha)));
	}

	/* Método Constructor: Cada vez que creemos una variable de esta clase, se ejecutará esta función */
	//function DB_mysql($bd = "gestoracademia", $host = "hostingmysql56.amen.es", $user = "803689_Gestor", $pass = "Nj64sG6eDY5mUhaf") {
		
//	function DB_mysql($bd = "gestoracademia", $host = "localhost", $user = "root", $pass = "pedroman") {
	function DB_mysql($bd = "gestoracademia", $host = "localhost", $user = "root", $pass = "0707") {
		$this->BaseDatos = $bd.$_SESSION['CursoEscolar'];
		$this->Servidor = $host;
		$this->Usuario = $user;
		$this->Clave = $pass;
	}

	/*Conexión a la base de datos*/
	function conectar($bd="", $host="", $user="", $pass=""){
		if ($bd != "") $this->BaseDatos = $bd;
		if ($host != "") $this->Servidor = $host;
		if ($user != "") $this->Usuario = $user;
		if ($pass != "") $this->Clave = $pass;

		// Conectamos al servidor
		$this->Conexion_ID = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
		if (!$this->Conexion_ID) {
			$this->Error = "Ha fallado la conexión.";
			return 0;
		}

		//seleccionamos la base de datos
		if (!@mysql_select_db($this->BaseDatos, $this->Conexion_ID)) {
			$this->Error = "Imposible abrir ".$this->BaseDatos ;
			return 0;
		}
		mysql_query ("SET NAMES 'utf8'");

		/* Si hemos tenido éxito conectando devuelve el identificador de la conexión, sino devuelve 0 */
		return $this->Conexion_ID;
	}
	
	/* Vaciar consulta realizada */
	function VaciarConsulta(){
		mysql_free_result($this->Consulta_ID);
	}
	
	/* Desconecta la Base de Datos */
	function Desconectar(){
		mysql_close($this->Conexion_ID);
	}
	
	/* Ejecuta un consulta */
	function consulta($sql = ""){
		if ($sql == "") {
			$this->Error = "No ha especificado una consulta SQL";
			return 0;
		}
		//ejecutamos la consulta
		$this->Consulta_ID = @mysql_query($sql, $this->Conexion_ID);
		if (!$this->Consulta_ID) {
			$this->Error = mysql_error();
		}
		/* Si hemos tenido éxito en la consulta devuelve el identificador de la conexión, sino devuelve 0 */
		return $this->Consulta_ID;
	}

	/* Devuelve el número de campos de una consulta */
	function numcampos() {
		if ($this->Consulta_ID==0){
			return 0;
		}else{
			return mysql_num_fields($this->Consulta_ID);
		}
	}

	/* Devuelve el número de registros de una consulta */
	function numregistros(){
		if ($this->Consulta_ID==0){
			return 0;
		}else{
			return mysql_num_rows($this->Consulta_ID);
		}
	}

	/* Devuelve el nombre de un campo de una consulta */
	function nombrecampo($numcampo) {
		if ($this->Consulta_ID==0){
			return 0;
		}else{
			return mysql_field_name($this->Consulta_ID, $numcampo);
		}
	}

	function tipocampo($numcampo){
		if ($this->Consulta_ID==0){
			return 0;
		}else{
			return mysql_field_type($this->Consulta_ID, $numcampo);
		}
	}
	
	function DatoCampo($Dato){
		if ($this->Consulta_ID==0){
			return 0;
		}else{
			$row =mysql_fetch_array($this->Consulta_ID);
			return $row[$Dato];
		}
	}
	
	/* Muestra los datos de una consulta */
	function verconsulta($check='false',$radio='false',$elminarcodigo='false',$anadir='false') {
		if ($this->Consulta_ID!=0){
			echo "<div id='Resultado'><table border=1>\n";
			echo "<tr>\n";
			// mostramos los nombres de los campos
			if ($check=="true" or $radio=="true"){
				echo "<th width=10>&nbsp;</th>\n";
			}
			for ($i = 0; $i < $this->numcampos(); $i++){
				echo "<th>".$this->nombrecampo($i)."</th>\n";
			}
			echo "</tr>\n";
			// mostrarmos los registros
			while ($row = mysql_fetch_row($this->Consulta_ID)) {
				echo "<tr> \n";
				if ($check=="true"){
					echo "<td width=10><input type='checkbox' name='GrupoCheck' value='".$row[0]."' /></td>\n";
				}
				elseif ($radio=="true"){
					echo "<td width=10><input type='radio' name='GrupoRadio' value='".$row[0]."' /></td>\n";
				}
				for ($i = 0; $i < $this->numcampos(); $i++){
					if ($elminarcodigo=='true' and $i==0){
						echo "<td>".substr($row[$i],3)."&nbsp;</td>\n";
					}
					else{
						switch ($this->tipocampo($i)){
						case 'date':
							echo "<td>".$this->cambiarfecha($row[$i])."&nbsp;</td>\n";	
							break;			
						default:
							if ($row[$i]=='YES'){
								echo "<td><input type='checkbox' checked='checked' DISABLED/></td>\n";
							}elseif($row[$i]=='NO'){
								echo "<td><input type='checkbox' DISABLED/></td>\n";
							}
							else{
								echo "<td>".$row[$i]."&nbsp;</td>\n";
							}
							break;
						}
					}
				}
				echo "</tr>\n";
			}
			/*Opcion Añadir
			if ($anadir=='true'){
				echo "<tr> \n";
				echo "<td><a href='#'onClick=validar('Modificar')><img src='../Imagenes/Iconos/grabar.png' alt='Grabar' border='0' longdesc='Grabar nuevo alumno' /></a>";
				for ($i = 0; $i < $this->numcampos(); $i++){
					switch ($this->tipocampo($i)){
					case 'date':
						echo "<td><input type='text' id='formulario' tabindex='1' size='15' maxlength='7' name='".$this->nombrecampo($i)."' /></td>\n";	
						break;			
					default:
						if ($row[$i]=='YES' or $row[$i]=='NO'){
							echo "<td><input type='checkbox' name='".$this->nombrecampo($i)."'/></td>\n";
						}
						else{
							echo "<td><input type='text' id='formulario' tabindex='1' size='15' maxlength='7' name='".$this->nombrecampo($i)."'/></td>\n";	
						}
						break;
					}
				}
				echo "</tr>\n";
			}*/
			//Fin de añadir
			echo "</table></div>\n";
		}
	}
} //fin de la Clse DB_mysql

?>

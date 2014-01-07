<?php
class login {
// Inicia sesion
	public function inicia($tiempo=365, $usuario=NULL, $clave=NULL) { 
		$tiempo=$tiempo*86400;
    if ($usuario==NULL && $clave==NULL) {
        // Verifica sesion
        if (isset($_SESSION['idusuario'])) {
            //echo "Estas logeado";
        } else {
            // Verifica cookie
            if (isset($_COOKIE['idusuario'])) {
                // Restaura sesion
                $_SESSION['idusuario']=$_COOKIE['idusuario'];
                $_SESSION['Password']=$_COOKIE['Password'];
                $_SESSION['Centro']=$_COOKIE['Centro'];
				$_SESSION['Permiso']=$_COOKIE['Permiso'];
                $_SESSION['NombrePermiso']=$_COOKIE['NombrePermiso'];
                $_SESSION['NombreCentro']=$_COOKIE['NombreCentro'];
				$_SESSION['CursoEscolar']="";
            } else {
                // Si no hay sesion regresa al login
                header( "Location: index.php" );
            }
        }
    } else {
        $this->verifica_usuario($tiempo, $usuario, $clave);
    }
	}
//  Verifica login
	private function verifica_usuario($tiempo, $usuario, $clave) {
		$conexion = mysql_connect("localhost", "root", "pedroman");
		mysql_select_db("gestoracademia".$_SESSION['CursoEscolar'], $conexion);
		$queEmp = "SELECT * FROM usuarios WHERE usuario='".$usuario."' and clave='".$clave."'";
		$resEmp = mysql_query($queEmp, $conexion);
			$totEmp = mysql_num_rows($resEmp);
	    if ($totEmp!=0) {
				$row = mysql_fetch_array($resEmp);
				//echo "<br>Usuario:".$row['Usuario']."<br>Clave".$clave."<br>Centro:".$row['Centro']."<br>Permisos:".$row['Permisos'];
	    	// Si la clave es correcta
	   		//$idusuario=$this->codificar_usuario($usuario);
	      setcookie("idusuario", $row['Usuario'], time()+$tiempo);
	      $_SESSION['idusuario']=$row['Usuario'];
	      $idusuario=$clave;
	      setcookie("Password", $clave, time()+$tiempo);
	      $_SESSION['Password']=$clave;
				if (isset($_SESSION['Centro'])==false){
					setcookie("Centro", $row['Centro'], time()+$tiempo);
					$_SESSION['Centro']=$row['Centro'];
				}
				if (isset($_SESSION['Permisos'])==false){
					setcookie("Permiso", $row['Permisos'], time()+$tiempo);
					$_SESSION['Permiso']=$row['Permisos'];
					switch ($_SESSION['Permiso']){
					case 1:
						setcookie("NombrePermiso", "Administrador", time()+$tiempo);
						$_SESSION['NombrePermiso']= "Administrador";
						break;
					case 2:
						setcookie("NombrePermiso", "Director", time()+$tiempo);
						$_SESSION['NombrePermiso']= "Director";
						break;
					case 3:
						setcookie("NombrePermiso", "Profesor", time()+$tiempo);
						$_SESSION['NombrePermiso']= "Profesor";
						break;
					case 4:
						setcookie("NombrePermiso", "Contable", time()+$tiempo);
						$_SESSION['NombrePermiso']= "Contable";
						break;
					case 5:
						setcookie("NombrePermiso", "Alumno", time()+$tiempo);
						$_SESSION['NombrePermiso']= "Alumno";
						break;
					default:
						setcookie("NombrePermiso", "Error".$_SESSION['Permiso'], time()+$tiempo);
						$_SESSION['NombrePermiso']= "Error".$_SESSION['Permiso'];
						break;
					}
				}
				if (isset($_SESSION['NombreCentro'])==false){
					$queEmp = "SELECT NombreCentro FROM centros WHERE codigo='".$row['Centro']."'";
					$resEmp = mysql_query($queEmp, $conexion);
					$row = mysql_fetch_array($resEmp);				
					$_SESSION['NombreCentro']=$row['NombreCentro'];
				}
				mysql_free_result($resEmp);
				mysql_close($conexion);
				switch($_SESSION['NombrePermiso']){
				case "Administrador":
					header( "Location: mnuGestionAlumnos/index.php" );
					break;
				case "Director":
					header( "Location: mnuGestionAlumnos/index.php" );
					break;
				case "Profesor":
					header( "Location: mnuProfesores/index.php" );
					break;
				case "Contable":
					header( "Location: mnuGestionAdministrativa/index.php" );
					break;
				case "Alumno":
					header( "Location: mnuAlumnos/index.php" );
					break;
				}
	    } else {
			mysql_free_result($resEmp);
			mysql_close($conexion);
			// Si la clave es incorrecta
			header( "Location: index.php?error=1" );
	    }
	}
// Codifica idusuario
	private function codificar_usuario($usuario) {
    return md5($usuario);
	}
}
?>

<?php
session_start();
include("controles.php");

	if(!isset($_POST['dni'])){
		echo"<br/><h2 style='text-align:center'>No has seleccionado ningun usuario</h2>";	
		header("refresh:2, url=administradores.php");
	}

	else if(isset($_POST['eliminar'])){
	$dni=$_POST['dni'];
	if(empty($_POST['dni'])){
		echo "<br/><h2 style='text-align:center'>No has seleccionado ningun usuario</h2>";
		header("refresh:2, url=administradores.php");
		}
	$consulta = "delete from usuario where dni='$dni'";
	$resultado = mysqli_query($con, $consulta);
	echo "<br/><h2 style='text-align:center'>Usuario eliminado Correctamente</h2>";
	header("refresh:2, url=administradores.php");
	
	
	}else if(isset($_POST['modificar'])){
			$dni=$_POST['dni'];
		
		if(!empty($_POST['apellido_nuevo'])){
			$apellido=$_POST['apellido_nuevo'];
			$consulta = "update usuario set apellido='$apellido' where dni='$dni'";
			$resultado = mysqli_query($con, $consulta);
		}
		
		if(!empty($_POST['tipo_nuevo'])){
			$tipo_nuevo=$_POST['tipo_nuevo'];
			$consulta = "update usuario set tipo_usuario='$tipo_nuevo' where dni='$dni'";
			$resultado = mysqli_query($con, $consulta);
			}
		
		if(!empty($_POST['tipo_nuevo']) || !empty($_POST['apellido_nuevo'])){
			header("refresh:2, url=administradores.php");
			echo"<br/><h2 style='text-align:center'>Cambios introducidos</h2>";
			}	
		
			else{
			header("refresh:2, url=administradores.php");
			echo"<br/><h2 style='text-align:center'>no has introducido cambios</h2>";
			}
		
	}else if(isset($_POST['crear']) && isset($_POST['dni']) && isset($_POST['apellido']) && isset($_POST['tipo'])) {
		
		if(empty($_POST['dni']) || empty($_POST['apellido'])){
			header("refresh:2, url=administradores.php");
			echo "<br/><h2 style='text-align:center'>Faltan datos, usuario no creado</h2>";
		}else if( 9 > strlen($_POST['dni'])){
			header("refresh:3, url=administradores.php");
			echo"<br/><h2 style='text-align:center'>El dni ha de tener 9 digitos usuario no creado</h2>";
		}else{
			$dni=$_POST['dni'];
			$apellido=$_POST['apellido'];
			$tipo=$_POST['tipo'];
			$consulta = "select dni from usuario where dni='$dni'";
			$resultado = mysqli_query($con, $consulta);
			$filas=mysqli_num_rows($resultado);
			if($filas==1){
				header("refresh:2, url=administradores.php");
				echo"<br/><h2 style='text-align:center'>El dni introducido ya existe, usuario no creado</h2>";
				mysqli_close($con);
			}else{
			$consulta = "insert into usuario values('$dni', '$apellido', $tipo)";
			$resultado = mysqli_query($con, $consulta);
			header("refresh:2, url=administradores.php");
			echo "<br/><h2 style='text-align:center'>Usuario Añadido Correctamente</h2>";
			}
		}
	}else{
		header("refresh:2, url=administradores.php");
		echo "<br/><h2 style='text-align:center'>Faltan datos por introducir</h2>";
}
mysqli_close($con);
?>
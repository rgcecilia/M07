<?php
	session_start();
	$host = 'localhost';
	$user = 'root';
	$pass = '12345';
	$db_name = 'usuarios';
	$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error al conectar con la base de datos");
	
	if(empty($_POST['dni']) || empty($_POST['apellido'])){
		header("location:index.html");
	}
	
	$dni=$_POST['dni'];
	$apellido=$_POST['apellido'];
	$consulta = "select tipo_usuario from usuario where dni='$dni' and apellido='$apellido'";
	$resultado = mysqli_query($con, $consulta);
	$num_filas = mysqli_num_rows($resultado);
	$tipo= mysqli_fetch_row($resultado);
	
	if($num_filas == 0){
		echo"<h2>Usuario no existe</h2>";
		header("Refresh:2; url=index.html");		
	}else if($tipo[0]==1) {
		$_SESSION['tipo']=1;
		$_SESSION['user']=$dni;
		$_SESSION['apellido']=$_POST['apellido'];
		header("location:estudiantes.php");
	}else{
		$_SESSION['tipo']=0;
		$_SESSION['user']=$dni;
		$_SESSION['apellido']=$_POST['apellido'];
		header("location:administradores.php");
	}
	mysqli_close($con);
?>

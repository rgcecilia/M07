<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '12345';
	$db_name = 'usuarios';
	$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error al conectar con la base de datos");
	
	if($_SESSION['tipo']==1){
		header("location:estudiantes.php");
	}else if (!isset($_SESSION['tipo'])){
		header("location:index.html");
	}
?>
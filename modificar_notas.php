<?php
session_start();
include("controles.php");

if (isset($_POST["eliminar"])){
	$asignatura = $_POST["asignatura"];
	$dni = $_SESSION["dni"];
	$query = "delete from nota where asignatura=".$asignatura." and alumno='".$dni."';";
	$res = mysqli_query($con, $query);
	mysqli_close($con);
	header("location:submenu_notas.php");
	
	}else if(isset($_POST["modificada"]) && isset($_POST["modificar"])){
	$asignatura = $_POST["asignatura"];
	$dni = $_SESSION["dni"];
	$nota=$_POST["modificada"];
	if($nota<0 || $nota>10){
		echo"<br/><h2 style='text-align:center'>La nota ha de ser mayor que 0 y menor que 10</h2>";
		header("refresh:2, url=submenu_notas.php");
	}else{
	$query = "update nota set nota=".$nota." where asignatura=".$asignatura." and alumno='".$dni."';";
	$res = mysqli_query($con, $query);
	mysqli_close($con);
	header("location:submenu_notas.php");}
	
	}else if(isset($_POST["poner"]) && isset($_POST["nota"]) && isset($_POST["asignatura"])){
	$asignatura = $_POST["asignatura"];
	$dni = $_SESSION["dni"];
	$nota=$_POST['nota'];
	if($nota<0 || $nota>10){
		echo"<br/><h2 style='text-align:center'>La nota ha de ser mayor que 0 y menor que 10</h2>";
		header("refresh:2, url=submenu_notas.php");
	}else{
	$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error al conectar con la base de datos");
	$consulta = "insert into nota (alumno, asignatura, nota)values ('$dni','$asignatura','$nota')";
	$resultado = mysqli_query($con, $consulta);
	mysqli_close($con);
	header("location:submenu_notas.php");}
	
	}else{
		echo  "<br/><h2 style='text-align:center'>faltan datos</h2>";
		header("refresh:2, url=submenu_notas.php");
}
?>
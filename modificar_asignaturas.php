<?php
session_start();
include("controles.php");

if(isset($_POST['modificar']) && !empty($_POST['nuevo']) && !empty($_POST['asignatura'])){
   $asignatura=$_POST['asignatura'];
   $nombre=$_POST['nuevo'];
   $consulta="update asignatura set nombre='".$nombre."' where identificador='".$asignatura."';";
   $resultado=mysqli_query($con, $consulta);
	echo "<br/><h2 style='text-align:center'>Modificacion Correcta</h2>";
   header("refresh:2, url=administradores.php");
	
}else if(isset($_POST['eliminar']) && !empty($_POST['asignatura'])){
	$asignatura=$_POST['asignatura'];
    $consulta="delete from asignatura where identificador=".$asignatura.";";
    $resultado=mysqli_query($con, $consulta);
	header("refresh:2, url=administradores.php");
	 echo"<br/><h2 style='text-align:center'>Eliminacion Correcta</h2>";
	
}else if(isset($_POST['crear']) && !empty($_POST['nombre'])){
	$asignatura=$_POST['nombre'];
	$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error al conectar con la base de datos");
	$consulta = "insert into asignatura values('default','$asignatura')";
	$resultado = mysqli_query($con, $consulta);
	header("refresh:3, url=administradores.php");
	echo "<h2 style='text-align:center'>Asignatura  creada correctamente</h2>";
	
} else {
	header("refresh:2, url=administradores.php");
	echo "<br/><h2 style='text-align:center'>Faltan datos, cambios no realizados</h2>";
	mysqli_close($con);
}
mysqli_close($con);
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	if($_SESSION['tipo']==0){
		header("location:administradores.php");
	}else{
		$host = 'localhost';
		$user = 'root';
		$pass = '12345';
		$db_name = 'usuarios';
		$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error al conectar con la base de datos");
		$consulta = "select nombre, nota, identificador from asignatura, usuario, nota where identificador=asignatura and alumno=dni and alumno='".$_SESSION['user']."';";
		$resultado = mysqli_query($con, $consulta);
		$num_filas = mysqli_num_rows($resultado);
	}
	if( $num_filas == 0 ){
		$consulta="select dni, apellido from usuario where dni='".$_SESSION['user']."';";
		$resultado = mysqli_query($con, $consulta);
		$num_filas = mysqli_num_rows($resultado);
		echo "<br/><div class='col-md-6 col-md-offset-3'>
			<table class='table table-bordered text-center'>
			<thead>
				<tr>
					<th>Alumno</th>
					<th>Dni</th>
				</tr>
			</thead>
			<tbody>";
		while($fila = mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<tr>
				<td>$apellido</td>
				<td>$dni</td>
			<tr/>";}
 		echo "<br/><h2 style='text-align:center'>No hay notas para el alumno</h2><br/>";
		
	}else{
		$consulta="select dni, apellido from usuario where dni='".$_SESSION['user']."';";
		$resultado = mysqli_query($con, $consulta);
		$num_filas = mysqli_num_rows($resultado);
		echo "<br/><div class='col-md-6 col-md-offset-3'>
			<table class='table table-bordered text-center'>
			<thead>
				<tr>
					<th>Alumno</th>
					<th>Dni</th>
				</tr>
			</thead>
			<tbody>";
		while($fila = mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<tr>
				<td>$apellido</td>
				<td>$dni</td>
			<tr/>";
	}
	$consulta = "select nombre, nota, identificador from asignatura, usuario, nota where identificador=asignatura and alumno=dni and alumno='".$_SESSION['user']."';";
		$resultado = mysqli_query($con, $consulta);
		$num_filas = mysqli_num_rows($resultado);	
	echo "</tbody></table></div>";
		echo "<br/><div class='col-md-6 col-md-offset-3'><table class='table table-bordered text-center'>
			<thead>
				<tr>
					<th>Asignatura</th>
					<th>Nota</th>
				</tr>
			</thead>";
			
	while($fila = mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<tbody>
				<tr>
					<td>$nombre</td>
					<td>$nota</td>
				<tr/>";
	}
	echo "	</tbody>
			</table>
			</div>";
	}
	mysqli_close($con);
?>
	<div class="col-md-6 col-md-offset-3">
	<a href="logout.php" class="btn btn-primary btn-lg m-3 center-block">Salir</a><br/>
	</div>
</body>
</html>

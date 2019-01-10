<?php
session_start();
include("controles.php");
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
	<br/>
<?php

	if(isset($_POST['dni'])){
	$_SESSION['dni']=$_POST["dni"];
	}
	else if(empty($_POST['dni']) && !isset($_SESSION['dni'])){
		header("location:administradores.php");
	}
	
	$consulta="select dni, apellido from usuario where dni='".$_SESSION['dni']."';";
	$resultado = mysqli_query($con, $consulta);
	$num_filas = mysqli_num_rows($resultado);
	echo "<div class='col-md-6 col-md-offset-3'>
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
	echo "</tbody></table></div>";

	$consulta = "select nombre, nota, identificador from asignatura, usuario, nota where identificador=asignatura and alumno=dni and alumno='".$_SESSION['dni']."';";
	$resultado = mysqli_query($con, $consulta);
	$num_filas = mysqli_num_rows($resultado);
	
	if( $num_filas == 0 ){
	echo "<div class='col-md-6 col-md-offset-3 text-center'>
	  <h3>No existen calificaciones para el alumno<br/><br/></h3>
	  </div>";
	}else{
	echo "<div class='col-md-6 col-md-offset-3'>
			<table class='table table-bordered text-center'>
			<thead>
				<tr>
					<th>Asignatura</th>
					<th>Nota</th>
				</tr>
			</thead>
			<tbody>";
	while($fila = mysqli_fetch_array($resultado)){
		extract($fila);
		echo "<tr>
				<td>$nombre</td>
				<td>$nota</td>
			<tr/>";
	}
	echo "</tbody></table></div>";
	}
?>
	<div class='form-group col-md-6 col-md-offset-3'>
		<form method='post' action='modificar_notas.php'>
			Seleccione una asignatura para eliminar o modificar su nota:
			<select class='form-control' name='asignatura'>
				<option selected="true" disabled="disabled">Seleccione Asignatura</option>
				<?php
				$resultado = mysqli_query($con, $consulta);
				while($fila = mysqli_fetch_array($resultado)){
				extract($fila);
				echo "<option value='$identificador'>$nombre</option>";
				}
				?>
			</select>

			<div class="input-group">
				<span class="input-group-btn">
					<input type="submit" name="eliminar" value="Eliminar la nota" class="btn btn-danger" type="button"/>
  				</span>
					<input type="number" name="modificada" class="form-control" placeholder="Introduzca aqui la nueva nota">
				<span class="input-group-btn">
	  				<input type="submit" name="modificar" value="Cambiar la nota" class="btn btn-primary" type="button"/>
				</span>
			</div>
		</form>
	</div>
	<br/>
	<br/>
	<div class='form-group col-md-6 col-md-offset-3'>
		<form method='post' action='modificar_notas.php'>
		Seleccione una asignatura para introducir una nueva nota
		<select class='form-control' name='asignatura'>
			<option selected="true" disabled="disabled">Seleccione Asignatura</option>
			<?php
			$consulta = "select identificador, nombre from asignatura where identificador not in ( SELECT identificador
			FROM asignatura
			inner JOIN nota
			ON identificador=asignatura
			inner JOIN usuario
			ON alumno=dni
			where alumno='".$_SESSION['dni']."')";
				$resultado = mysqli_query($con, $consulta);
				while($fila = mysqli_fetch_array($resultado)){
				extract($fila);
				echo "<option value='$identificador'>$nombre</option>";
				}
				mysqli_close($con);
			?>
		</select>
		<div class="input-group">
			<input type="number" class="form-control" placeholder="Introduzca aqui la nueva nota" name="nota">
			<span class="input-group-btn">
				<input type="submit" name="poner" value="Insertar la Nueva nota" class="btn btn-primary" type="button" name="poner"/>
			</span>
		</div>
		<br/>
		<br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="input-group">
				<span class="input-group-btn center-block">
					<a href="logout.php" class="btn btn-primary btn-lg">Salir</a>
					<a href="administradores.php" class="btn btn-primary btn-lg">Volver</a>
				</span>
			</div>
		</div>
		</form>
	</div>
	
</body>
</html>
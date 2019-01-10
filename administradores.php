<?php
session_start();
include("controles.php");
?>

<!doctype html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="page-header d-flex justify-content-center">
                <h2 class="text-center">Panel de Administracion<br/></h2>
            </div>
            <div class="col-md-6 col-xl-12">
                <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tab0" data-toggle="tab">Bienvenido</a></li>
                        <li class=""><a href="#tab1" data-toggle="tab">Nuevo Usuario</a></li>
                        <li class=""><a href="#tab2" data-toggle="tab">Nueva Asignatura</a></li>
                        <li class=""><a href="#p3" data-toggle="tab">Menu de calificaciones</a></li>
                        <li class=""><a href="#p4" data-toggle="tab">Modificar Usuarios</a></li>
                        <li class=""><a href="#p5" data-toggle="tab">Modificar Asignaturas </a></li>
                        <li class=""><a href="logout.php">Salir</a></li>
                    </ul>
                </nav>
            </div>
            <div class="tab-content" id="tabContent">
                <br/>
                <div id="tab0" class="tab-pane text-style active">
                    <div class="text-center col-md-10 col-lg-10">
                        <h2>Bienvenido</h2>
                        <?php
                        echo "<h2 class='text-primary'>" . $_SESSION['apellido'] . "</h2>";
                        ?>
                    </div>
                </div>
                <div id="tab1" class="tab-pane text-style">
                    <div class="form-group col-md-10 col-lg-10">
                        <h2 class="text-center">Crear Usuarios</h2>
                        <form method='POST' action='modificar_usuarios.php'>
                            Dni:
                            <input class="form-control" type='text' name='dni' maxlength='9' minlength='9' placeholder="Documento nacional de identidad" /> Apellido:
                            <input class="form-control" type='text' name='apellido' maxlength='50' placeholder="Apellido del nuevo usuario" /> Tipo:
                            <label class="form-control">
                                Administrador
                                <input type='radio' name='tipo' value='0' checked/> Estudiante
                                <input type='radio' name='tipo' value='1' />
                            </label>
                            <br/>
                            <input class="btn btn-primary center-block" type='submit' name='crear' value='Crear Usuario' />
                        </form>
                        <div class='form-group col-md-10 col-lg-10'>
                            <h2 class="text-center">Modificar Usuarios</h2>
                            <form method='post' action='modificar_usuarios.php'>
                                Usuario:
                                <select name='dni' class='form-control'>
                                    <option selected="true" disabled="disabled">Seleccion</option>
                                    <?php
                                    $consulta = "select dni, nombre from usuario";
                                    $res = mysqli_query($con, $consulta);
                                    while ($fila = mysqli_fetch_array($res)) {
                                        extract($fila);
                                        echo "<option value='$dni'>$apellido</option>";
                                    }
                                    ?>
                                </select>
                                <br/>
                                <input class='btn btn-primary center-block' type='submit' name='eliminar' value='eliminar definitivamente' />
                                <br/>
                                <h3 class="text-center">Si desea modificarlo introduzca aqui los nuevos datos:</h3>
                                <br/> Apellido:
                                <input class='form-control' type='text' name='apellido_nuevo' maxlength='50' placeholder="Nuevo apellido" /> Tipo:
                                <br/>
                                <input class='btn btn-primary center-block' type='submit' name='modificar' value='Modificar Usuario' />
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane text-style">
                    <div class="form-group col-md-10 col-lg-10">
                        <h2 class="text-center">Nueva Asignatura</h2>
                        <form method='POST' action='modificar_asignaturas.php'>
                            Nombre de la Asignatura:
                            <input type='text' class="form-control" name='nombre' maxlength='30' placeholder='Introduzca aqui el nombre de la nueva asignatura' />
                            <br/>
                            <input class="btn btn-primary center-block" type='submit' name='crear' value="Crear Asignatura" />
                        </form>
                    </div>
                </div>
                <div id='p3' class='tab-pane text-style'>
                    <div class='form-group col-md-10 col-lg-10'>
                        <h2 class="text-center">Menu de Calificaciones</h2>
                        <form method='post' action='submenu_notas.php'>
                            Usuario:
                            <select class='form-control' name='dni'>
                                <?php
                                $query = "select dni, apellido from usuario";
                                $res = mysqli_query($con, $query);
                                while ($fila = mysqli_fetch_array($res)) {
                                    extract($fila);
                                    echo "<option value='$dni'>$apellido</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <input class='btn btn-primary center-block' type='submit' name='enviar' value='Ver notas del alumno' />
                        </form>
                    </div>
                </div>
                <div id='p4' class='tab-pane text-style'>
                    <div class='form-group col-md-10 col-lg-10'>
                        <h2 class="text-center">Modificar Usuarios</h2>
                        <form method='post' action='modificar_usuarios.php'>
                            Usuario:
                            <select name='dni' class='form-control'>
                                <option selected="true" disabled="disabled">Seleccion</option>
                                <?php
                                $consulta = "select dni, apellido from usuario";
                                $res = mysqli_query($con, $consulta);
                                while ($fila = mysqli_fetch_array($res)) {
                                    extract($fila);
                                    echo "<option value='$dni'>$apellido</option>";
                                }
                                ?>
                            </select>
                            <br/>
                            <input class='btn btn-primary center-block' type='submit' name='eliminar' value='eliminar definitivamente' />
                            <br/>
                            <h3 class="text-center">Si desea modificarlo introduzca aqui los nuevos datos:</h3>
                            <br/> Apellido:
                            <input class='form-control' type='text' name='apellido_nuevo' maxlength='50' placeholder="Nuevo apellido" /> Tipo:
                            <select name='tipo_nuevo' class='form-control'>
                                <option selected="true" disabled="disabled">Seleccion</option>
                                <option value="0">Administrador</option>
                                <option value="1">Estudiante</option>
                            </select>
                            <br/>
                            <input class='btn btn-primary center-block' type='submit' name='modificar' value='Modificar Usuario' />
                        </form>
                    </div>
                </div>
                <div id='p5' class='tab-pane text-style'>
                    <div class='form-group col-md-10 col-lg-10'>
                        <form method='post' action='modificar_asignaturas.php'>
                            Asignatura:
                            <select class='form-control' name='asignatura' maxlength='30'>
                                <option selected="true" disabled="disabled">Seleccion</option>
                                <?php
                                $consulta = "select identificador, nombre from asignatura";
                                $res = mysqli_query($con, $consulta);
                                while ($fila = mysqli_fetch_array($res)) {
                                    extract($fila);
                                    echo "<option value='$identificador'>$nombre</option>";
                                }
                                mysqli_close($con);
                                ?>
                            </select>
                            <br/>
                            <input class='btn btn-primary center-block' type='submit' name='eliminar' value='eliminar definitivamente' /> Nuevo Nombre:
                            <input class='form-control' type='text' name='nuevo' maxlength='30' minlength='3' />
                            <br/>
                            <input class='btn btn-primary center-block' type='submit' name='modificar' value='Modificar Nombre' />
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

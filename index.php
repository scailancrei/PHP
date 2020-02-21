<?php

require './gestalum.php';
session_unset();
/**
 * Objeto clase gestalum
 */
$bd = new gestalum;

//Condicional: Si el campo usuario y el campo clave contienen datos, realizamos la funcion del login
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['clave'] = $_POST['clave'];

    $bd->getUser($_SESSION['usuario'], $_SESSION['clave']);
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Online 4</title>
    <!-- Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>

    <h1><center>Tarea Online</center></h1>
    <h3><center>Login</center></h3>
    <form action="./index.php" method="POST">

    <div class="form-group">
    <label for="usuario">Usuario</label>
    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Introduce usuario" required>

    <label for="contraseña">Contraseña</label>
    <input type="password" class="form-control" name="clave" id="clave" placeholder="Introduce la contraseña" required>

    </div>
    <button type="submit" >Login</button>


    </form>

    <h3><center>PROFESOR A QUERER MOSTRAR</center></h3>
    <br>
    <form action="./index.php" method="POST">
  <div class="row">
    <div class="col">
      <input type="number" class="form-control" name="cod" required placeholder="Introduce cod de profesor">
    </div>
  </div>
  <br>
  <button type="submit">Enviar</button>
</form>

<?php

//Condicional: Si el input de cod profesor contiene datos realizamos la  llamada a la funcion de getProfesor
if (isset($_POST['cod'])) {

    $_SESSION['cod'] = $_POST['cod'];

    $profesor = $bd->getProfesor($_SESSION['cod']);
    ?>
    <div id="Izq">

        <?php

    //Si hay valores dentro de la variable profesor obtendremos una lista de dicho profesor
    if (isset($profesor)) {
        $lista = "";
        $lista .= "<table class='table table-sm'>";
        $lista .= "<thead class='thead-dark'>";
        $lista .= "<tr>";
        $lista .= "<th>cod_prof</th>";
        $lista .= "<th>Nombre</th>";
        $lista .= "<th>Apellidos</th>";
        $lista .= "<th>Activo</th>";
        $lista .= "</tr>";
        {

            $lista .= "<tr>";
            $lista .= "<td>" . $profesor['cod_prof'] . "</td>";
            $lista .= "<td>" . $profesor['nombre'] . "</td>";
            $lista .= "<td>" . $profesor['apellidos'] . "</td>";
            $lista .= "<td>" . $profesor['activo'] . "</td>";
            $lista .= "</tr>";

            $lista .= "</table>";
            echo $lista;
        }
        ?>
	</div>
<?php
}
}
?>
<br>
<br>
<?php

//Condicional: Si el input de cod profesor contiene datos realizamos la  llamada a la funcion de getProfesorALL
/**
 * Obtendremos todos los profesores con esta lista
 */
$profesor = $bd->getProfesorAll();
?>
    <div id="Izq">
		<center><h1> Lista de profesores</h1></center>
<?php

//Si hay valores dentro de la variable profesor obtendremos una lista de dicho profesor
if (isset($profesor)) {
    $lista = "";
    $lista = "<div center>";
    $lista .= "<table class='table table-sm'>";
    $lista .= "<thead class='thead-dark'>";
    $lista .= "<tr>";
    $lista .= "<th>cod_prof</th>";
    $lista .= "<th>Nombre</th>";
    $lista .= "<th>Apellidos</th>";
    $lista .= "<th>Activo</th>";
    $lista .= "</tr>";
    {
        foreach ($profesor as $row) {

            $lista .= "<tr>";
            $lista .= "<td>" . $row['cod_prof'] . "</td>";
            $lista .= "<td>" . $row['nombre'] . "</td>";
            $lista .= "<td>" . $row['apellidos'] . "</td>";
            $lista .= "<td>" . $row['activo'] . "</td>";
            $lista .= "</tr>";
        }

        $lista .= "</table>";
        $lista .= "</div>";
        echo $lista;
    }
    ?>
	</div>
<?php
}

?>

</form>
<h3><center>Alumno A QUERER MOSTRAR</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="exp" required placeholder="Introduce cod de alumno">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>
<?php

//Condicional: Si el input de cod alumno contiene datos realizamos la  llamada a la funcion de getAlumno
if (isset($_POST['exp'])) {

    $_SESSION['exp'] = $_POST['exp'];

    $alumno = $bd->getAlumno($_SESSION['exp']);
    ?>
      <div id="Izq">
    <?php

    //Si hay valores dentro de la variable profesor obtendremos una lista de dicho profesor
    if (isset($alumno)) {
        $lista = "";
        $lista .= "<table class='table table-sm'>";
        $lista .= "<thead class='thead-dark'>";
        $lista .= "<tr>";
        $lista .= "<th>nexped</th>";
        $lista .= "<th>Nombre</th>";
        $lista .= "<th>Apellidos</th>";
        $lista .= "<th>Activo</th>";
        $lista .= "</tr>";
        {
            $lista .= "<tr>";
            $lista .= "<td>" . $alumno['nexped'] . "</td>";
            $lista .= "<td>" . $alumno['nombre'] . "</td>";
            $lista .= "<td>" . $alumno['apellidos'] . "</td>";
            $lista .= "<td>" . $alumno['activo'] . "</td>";
            $lista .= "</tr>";

            $lista .= "</table>";
            echo $lista;
        }
        ?>
	</div>
<?php
}
}
?>
<br>
<br>
<?php

//Condicional: Si el input de cod profesor contiene datos realizamos la  llamada a la funcion de getProfesorALL
/**
 * Obtendremos todos los profesores con esta lista
 */
$alumnos = $bd->getAlumnoAll();
?>
    <div id="Izq">
		<center><h1> Lista de alumnos</h1></center>
<?php

//Si hay valores dentro de la variable profesor obtendremos una lista de dicho profesor
if (isset($alumnos)) {
    $lista = "";
    $lista = "<div center>";
    $lista .= "<table class='table table-sm'>";
    $lista .= "<thead class='thead-dark'>";
    $lista .= "<tr>";
    $lista .= "<th>nexped</th>";
    $lista .= "<th>Nombre</th>";
    $lista .= "<th>Apellidos</th>";
    $lista .= "<th>Activo</th>";
    $lista .= "</tr>";
    {
        foreach ($alumnos as $row) {

            $lista .= "<tr>";
            $lista .= "<td>" . $row['nexped'] . "</td>";
            $lista .= "<td>" . $row['nombre'] . "</td>";
            $lista .= "<td>" . $row['apellidos'] . "</td>";
            $lista .= "<td>" . $row['activo'] . "</td>";
            $lista .= "</tr>";
        }

        $lista .= "</table>";
        $lista .= "</div>";
        echo $lista;
    }
    ?>
	</div>
<?php
}
?>

<!---Obtener los datos de todos los modulos o solo 1--->
</form>
<h3><center>Modulo A QUERER MOSTRAR</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="cod_modulo" required placeholder="Introduce cod del modulo">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>
<?php

//Condicional: Si el input de cod modulo contiene datos realizamos la  llamada a la funcion de getModulo
if (isset($_POST['cod_modulo'])) {

    $_SESSION['cod_modulo'] = $_POST['cod_modulo'];

    $modulo = $bd->getModulo($_SESSION['cod_modulo']);
    ?>
      <div id="Izq">
    <?php

    //Si hay valores dentro de la variable modulo obtendremos una lista de dicho modulo
    if (isset($modulo)) {
        $lista = "";
        $lista .= "<table class='table table-sm'>";
        $lista .= "<thead class='thead-dark'>";
        $lista .= "<tr>";
        $lista .= "<th>cod_mod</th>";
        $lista .= "<th>modulo</th>";
        $lista .= "<th>descripcion</th>";
        $lista .= "<th>ciclo</th>";
        $lista .= "</tr>";
        {
            $lista .= "<tr>";
            $lista .= "<td>" . $modulo['cod_mod'] . "</td>";
            $lista .= "<td>" . $modulo['modulo'] . "</td>";
            $lista .= "<td>" . $modulo['descripcion'] . "</td>";
            $lista .= "<td>" . $modulo['ciclo'] . "</td>";
            $lista .= "</tr>";

            $lista .= "</table>";
            echo $lista;
        }
        ?>
	</div>
<?php
}
}
?>
<br>
<br>
<?php

/**
 * Obtendremos todos los profesores con esta lista
 */
$modulos = $bd->getModuloAll();
?>
    <div id="Izq">
		<center><h1> Lista de modulos</h1></center>
<?php

//Si hay valores dentro de la variable profesor obtendremos una lista de dicho profesor
if (isset($modulos)) {
    $lista = "";
    $lista = "<div center>";
    $lista .= "<table class='table table-sm'>";
    $lista .= "<thead class='thead-dark'>";
    $lista .= "<tr>";
    $lista .= "<th>Cod_mod</th>";
    $lista .= "<th>Modulo</th>";
    $lista .= "<th>Descripcion</th>";
    $lista .= "<th>Ciclo</th>";
    $lista .= "</tr>";
    {
        foreach ($modulos as $row) {

            $lista .= "<tr>";
            $lista .= "<td>" . $row['cod_mod'] . "</td>";
            $lista .= "<td>" . $row['modulo'] . "</td>";
            $lista .= "<td>" . $row['descripcion'] . "</td>";
            $lista .= "<td>" . $row['ciclo'] . "</td>";
            $lista .= "</tr>";
        }

        $lista .= "</table>";
        $lista .= "</div>";
        echo $lista;
    }
    ?>
	</div>
<?php
}
?>
<!---Obtener las faltas de un alumno en un modulo--->
</form>
<h3><center>Faltas a mostrar</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="codal" required placeholder="Introduce cod del alumno">
</div>
<div class="col">
  <input type="number" class="form-control" name="codmod" required placeholder="Introduce cod del modulo">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>
<?php

//Condicional: Si el input de codad y el input de codmod contiene datos realizamos la  llamada a la funcion de getAsistenciasMod
if (isset($_POST['codal']) && isset($_POST['codmod'])) {

    $_SESSION['codal'] = $_POST['codal'];
    $_SESSION['codmod'] = $_POST['codmod'];

    $asistencias = $bd->getAsistenciasMod($_SESSION['codal'], $_SESSION['codmod']);
    ?>
      <div id="Izq">
    <?php

    //Si hay valores dentro de la variable modulo obtendremos una lista de dicho modulo
    if (isset($asistencias)) {
        $lista = "";
        $lista .= "<table class='table table-sm'>";
        $lista .= "<thead class='thead-dark'>";
        $lista .= "<tr>";
        $lista .= "<th>cod</th>";
        $lista .= "<th>fecha</th>";
        $lista .= "<th>cod_mod</th>";
        $lista .= "<th>nexped</th>";
        $lista .= "<th>asistencia</th>";
        $lista .= "</tr>";
        {
            $lista .= "<tr>";
            $lista .= "<td>" . $asistencias['cod'] . "</td>";
            $lista .= "<td>" . $asistencias['fecha'] . "</td>";
            $lista .= "<td>" . $asistencias['cod_mod'] . "</td>";
            $lista .= "<td>" . $asistencias['nexped'] . "</td>";
            $lista .= "<td>" . $asistencias['asistencia'] . "</td>";
            $lista .= "</tr>";

            $lista .= "</table>";
            echo $lista;
        }
        ?>
	</div>
<?php
}
}
?>
<br>
<br>
<!---Borrar un profesor--->
</form>
<h3><center>Profesor a borrar</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="cod_prof" required placeholder="Introduce cod del profesor">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>

<?php

if (isset($_POST["cod_prof"])) {
    $prof = $bd->delProfesor($_POST['cod_prof']);

}

?>
<br>
<br>
<!---Borrar un Alumno--->
</form>
<h3><center>Alumno a borrar</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="cod_alumno" required placeholder="Introduce cod del Alumno">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>

<?php

if (isset($_POST["cod_alumno"])) {
    $alumno = $bd->delAlumno($_POST['cod_alumno']);

}

?>

<br>
<br>
<!---Insertar un profesor--->
</form>
<h3><center>Insertar profesores</center></h3>
<br>
<form action="./index.php" method="POST">
<div class="row">
<div class="col">
  <input type="number" class="form-control" name="codigoProf" required placeholder="Introduce cod del Profesor">
</div>
<div class="col">
  <input type="text" class="form-control" name="nombreProf" required placeholder="Introduce nombre del Profesor">
</div>
<div class="col">
  <input type="text" class="form-control" name="apellidoProf" required placeholder="Introduce apellidos del Profesor">
</div>
<div class="col">
  <input type="number" class="form-control" name="activoProf" required placeholder="Introduce actvididad del profesor">
</div>
</div>
<br>
<button type="submit">Enviar</button>
</form>

<?php

if (isset($_POST['codigoProf']) && isset($_POST['nombreProf']) && isset($_POST['apellidoProf']) && isset($_POST['activoProf'])) {
    $insertarProf = $bd->setProfesor($_POST['codigoProf'], $_POST['nombreProf'], $_POST['apellidoProf'], $_POST['activoProf']);
  
}

?>






</body>
</html>

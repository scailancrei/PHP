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

//Condicional: Si el input de cod profesor contiene datos realizamos la  llamada a la funcion de getProfesor
if (isset($_POST['cod'])) {

    $_SESSION['cod'] = $_POST['cod'];

    $profesor = $bd->getProfesor($_SESSION['cod']);
    ?>
    <div id="Izq">
		<center><h1> DIV Izquierdo 60% </h1></center>
        <?php
if (isset($profesor)) {
        $lista = "";
        $lista .= "<table class='table table-sm'>";
        $lista .= "<thead class='thead-dark'>";
        $lista .= "<tr>";
        $lista .= "<th>cod_prof</th>";
        $lista .= "<th>Nombre</th>";
        $lista .= "<th>Apellidos</th>";
        $lista .= "<th>Activo</th>";
        $lista .= "<th>Ciudad</th>";
        $lista .= "</tr>";
        {
            foreach ($listado as $row) {
                $lista .= "<tr>";
                $lista .= '<td id="' . $row['P_id'] . '">';
                $lista .= '<a href="#" onclick="cargar(\'#Der\', \'./derecho.php?id=' . $row['P_id'] . '\');">' . $row['P_id'] . '</a></td>';
                $lista .= "<td>" . $row['Nombre'] . "</td>";
                $lista .= "<td>" . $row['Apellidos'] . "</td>";
                $lista .= "<td>" . $row['Direccion'] . "</td>";
                $lista .= "<td>" . $row['Ciudad'] . "</td>";
                $lista .= "</tr>";
            }
            $lista .= "</table>";
            echo $lista;
        }
        ?>
	</div>
<?php
}
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

    <h3><center>Lista de profesor</center></h3>
    <br>
    <form action="./index.php" method="POST">
  <div class="row">
    <div class="col">
      <input type="number" class="form-control" name="cod" placeholder="Introduce cod de profesor">
    </div>
  </div>
  <br>
  <button type="submit">Enviar</button>
</form>


</body>
</html>

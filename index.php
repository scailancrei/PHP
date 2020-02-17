<?php

require './gestalum.php';
session_unset();
$bd = new gestalum;
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


<div>

</div>


</body>
</html>

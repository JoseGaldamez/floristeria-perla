<?php

include 'env_vars.php';

$conn = mysqli_connect($serverName, $userName, $password, $database);
if (!$conn) {
    die("Error al conectarse a la base de datos." . mysqli_connect_error());
}

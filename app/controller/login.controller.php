<?php
header('Content-type: application/json');
include_once '../model/login.model.php';

if ($_POST) {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        if (login($_POST['email'], $_POST['password'])) {
            echo json_encode(array('success' => true, 'message' => "Usuario Logueado"));
        } else {
            echo json_encode(array('success' => false, 'message' => "Algo falló al intentar loguear, verifique sus credenciales"));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

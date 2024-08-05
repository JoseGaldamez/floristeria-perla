<?php
header('Content-type: application/json');
include_once '../model/register.model.php';

if ($_POST) {
    if (
        isset($_POST['username']) && $_POST['username'] &&
        isset($_POST['email']) && $_POST['email'] &&
        isset($_POST['password']) && $_POST['password']
    ) {

        if ($_POST['password'] !== $_POST['confirm_password']) {
            echo json_encode(array('success' => false, 'message' => "Las contraseñas no coinciden."));
        } else {
            if (registerNewUser($_POST['username'], $_POST['email'], $_POST['password'])) {
                echo json_encode(array('success' => true, 'message' => "Usuario registrado correctamente"));
            } else {
                echo json_encode(array('success' => false, 'message' => "Algo falló creando el usuario"));
            }
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

<?php
header('Content-type: application/json');
include_once '../model/profile.model.php';

if ($_POST) {
    if (
        isset($_POST['name']) && $_POST['name'] &&
        isset($_POST['address']) && $_POST['address'] &&
        isset($_POST['phone']) && $_POST['phone'] &&
        isset($_POST['sex']) && $_POST['sex'] &&
        isset($_POST['birthday']) && $_POST['birthday']
    ) {

        if (updateProfile($_POST['name'], $_POST['address'], $_POST['phone'], $_POST['sex'], $_POST['birthday'])) {
            echo json_encode(array('success' => true, 'message' => "Usuario registrado correctamente"));
        } else {
            echo json_encode(array('success' => false, 'message' => "Algo salio mal"));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

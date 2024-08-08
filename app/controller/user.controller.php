<?php
header('Content-type: application/json');
include_once '../model/user.model.php';

if ($_POST) {
    if (isset($_POST['userID']) && $_POST['userID']) {
        if ($_POST['action'] == "deleteCategory") {
            if (deleteUser($_POST['userID'])) {
                echo json_encode(array('success' => true, 'message' => "usuarios creada correctamente"));
            } else {
                echo json_encode(array('success' => false, 'message' => "Algo falló creando la categoría"));
            }
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

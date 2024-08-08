<?php
header('Content-type: application/json');
include_once '../model/login.model.php';

if ($_POST) {
    if (isset($_POST['closeSesion'])) {

        if ($_POST['closeSesion']) {
            session_start();
            unset($_SESSION["userID"]);
            echo json_encode(array('success' => true, 'message' => "Se ha cerrado sesion"));
        } else {
            echo json_encode(array('success' => false, 'message' => "No se cerro sesión"));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

<?php
header('Content-type: application/json');

include_once '../conn/conn.php';
include_once '../model/order.model.php';

if ($_POST) {
    if (
        isset($_POST['card']) && $_POST['card'] &&
        isset($_POST['name']) && $_POST['name'] &&
        isset($_POST['expiration']) && $_POST['expiration'] &&
        isset($_POST['details']) && $_POST['details'] &&
        isset($_POST['orderID']) && $_POST['orderID'] &&
        isset($_POST['total']) && $_POST['total']
    ) {

        if (completeOrder($conn, $_POST['orderID'], $_POST['details'], $_POST['total'])) {
            echo json_encode(array('success' => true, 'message' => "Usuario registrado correctamente"));
        } else {
            echo json_encode(array('success' => false, 'message' => "Algo salio mal"));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

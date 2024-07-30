<?php
header('Content-type: application/json');
include_once '../model/category.model.php';

if (isset($_POST['categoryName']) && $_POST['categoryName'] && isset($_POST['description']) && $_POST['description']) {

    if (saveNewCategory($_POST['categoryName'], $_POST['description'])) {
        echo json_encode(array('success' => true, 'message' => "Categoría creada correctamente"));
    } else {
        echo json_encode(array('success' => false, 'message' => "Algo falló creando la categoría"));
    }
} else {
    echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
}

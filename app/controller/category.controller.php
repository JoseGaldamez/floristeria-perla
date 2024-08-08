<?php
header('Content-type: application/json');
include_once '../model/category.model.php';

if ($_POST) {
    if (isset($_POST['categoryName']) && $_POST['categoryName'] && isset($_POST['description']) && $_POST['description']) {

        if ($_POST['action'] == "createCategory") {
            if (saveNewCategory($_POST['categoryName'], $_POST['description'])) {
                echo json_encode(array('success' => true, 'message' => "Categoría creada correctamente"));
            } else {
                echo json_encode(array('success' => false, 'message' => "Algo falló creando la categoría"));
            }
        }

        if ($_POST['action'] == "updateCategory") {
            if (updateCategory($_POST['categoryID'], $_POST['categoryName'], $_POST['description'])) {
                echo json_encode(array('success' => true, 'message' => "Categoría creada correctamente", "id" => $_POST['categoryID']));
            } else {
                echo json_encode(array('success' => false, 'message' => "Algo falló creando la categoría"));
            }
        }

        if ($_POST['action'] == "deleteCategory") {
            if (deleteCategory($_POST['categoryID'])) {
                echo json_encode(array('success' => true, 'message' => "Categoría creada correctamente", "id" => $_POST['categoryID']));
            } else {
                echo json_encode(array('success' => false, 'message' => "Algo falló creando la categoría"));
            }
        }
    } else {
        echo json_encode(array('success' => false, 'message' => "Parámetros faltantes."));
    }
}

<?php

include_once '../conn/conn.php';
include_once '../model/product.model.php';
include_once '../model/category.model.php';

$action = $_GET['action'] ?? $_POST['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create' || $action === 'update') {
        $productName = $_POST['productName'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $inventary = $_POST['inventary'];
        $category = $_POST['category'];
        $status = $_POST['status'];

        // Manejar la subida de archivos
        $image = $_FILES['image']['name'];
        $target_dir = "../../app/assets/images/products/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Guardar la ruta relativa en la base de datos
        $image_path = '../../app/assets/images/products/' . basename($image);

        if ($action === 'create') {
            $result = saveNewProduct($conn, $productName, $description, $price, $inventary, $image_path, $category, $status);
        } else {
            $productId = $_POST['productId'];
            $result = updateProduct($conn, $productId, $productName, $description, $price, $inventary, $image_path, $category, $status);
        }

        echo json_encode(['success' => $result]);
    } elseif ($action === 'deactivate') {
        $productId = $_POST['productId'];
        $result = deactivateProduct($conn, $productId);

        echo json_encode(['success' => $result]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get') {
        $productId = $_GET['productId'];
        $product = getProduct($conn, $productId);

        echo json_encode($product);
    } elseif ($action === 'getCategories') {
        $categories = getAllCategories($conn);
        $categoriesArray = array();
        while ($row = $categories->fetch_assoc()) {
            $categoriesArray[] = $row;
        }
        echo json_encode($categoriesArray);
    }
}
?>
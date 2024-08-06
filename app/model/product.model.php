<?php

function saveNewProduct($conn, string $productName, string $description, float $price, int $inventary, string $image, int $category, int $status)
{
    $sql = 'INSERT INTO products (productName, description, price, inventary, created_at, image, category, status) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'products'" . $conn->error);
    }

    $statement->bind_param('ssdisii', $productName, $description, $price, $inventary, $image, $category, $status);

    $wasOk = $statement->execute();

    $statement->close();
    return $wasOk;
}

function updateProduct($conn, int $productId, string $productName, string $description, float $price, int $inventary, string $image, int $category, int $status)
{
    $sql = 'UPDATE products SET productName=?, description=?, price=?, inventary=?, image=?, category=?, status=? WHERE productID=?';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'products'" . $conn->error);
    }

    $statement->bind_param('ssdisiii', $productName, $description, $price, $inventary, $image, $category, $status, $productId);

    $wasOk = $statement->execute();

    $statement->close();
    return $wasOk;
}

function deactivateProduct($conn, int $productId)
{
    $sql = 'UPDATE products SET status=0 WHERE productID=?';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'products'" . $conn->error);
    }

    $statement->bind_param('i', $productId);

    $wasOk = $statement->execute();

    $statement->close();
    return $wasOk;
}

function getProduct($conn, int $productId)
{
    $sql = 'SELECT * FROM products WHERE productID=?';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'products'" . $conn->error);
    }

    $statement->bind_param('i', $productId);
    $statement->execute();
    $result = $statement->get_result();
    $product = $result->fetch_assoc();

    $statement->close();
    return $product;
}

function getAllProducts($conn)
{
    $sql = 'SELECT * FROM products';
    $result = $conn->query($sql);

    return $result;
}

function getProductsHome($conn, $limit, $offset)
{
    $sql = "SELECT P.productID, P.productName, P.description, P.price, P.inventary, P.image, C.categoryName, P.status 
            FROM products P 
            INNER JOIN categories C ON P.category = C.categoryID AND P.status = 1
            LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        return json_encode(array('num_rows' => 0));
    }

    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    return $result;
}
function getProducts($conn, $limit, $offset)
{
    $sql = "SELECT P.productID, P.productName, P.description, P.price, P.inventary, P.image, C.categoryName, P.status 
            FROM products P 
            INNER JOIN categories C ON P.category = C.categoryID 
            LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        return json_encode(array('num_rows' => 0));
    }

    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    return $result;
}

function getProductCount($conn)
{
    $sql = 'SELECT COUNT(*) as count FROM products';
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error en la consulta de conteo de productos: ' . $conn->error);
    }

    $row = $result->fetch_assoc();
    $count = $row['count'];

    $result->close();

    return $count;
}

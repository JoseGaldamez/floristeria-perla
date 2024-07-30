<?php


function saveNewCategory(string $categoryName, string $description)
{
    include_once '../conn/conn.php';

    $sql = "INSERT INTO categories (categoryName, description) VALUES (?, ?)";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'categories'" . $conn->error);
    }

    $statement->bind_param('ss', $categoryName, $description);

    $wasOk = $statement->execute();

    $statement->close();
    $conn->close();

    return $wasOk;
}


function getAllCategories($conn)
{
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

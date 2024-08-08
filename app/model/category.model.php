<?php


function updateCategory(int $categoryID, string $categoryName, string $description)
{
    include_once '../conn/conn.php';

    $sql = "UPDATE categories SET categoryName=?, description=? WHERE categoryID=?";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'categories'" . $conn->error);
    }

    $statement->bind_param('ssi', $categoryName, $description, $categoryID);

    $wasOk = $statement->execute();

    $statement->close();
    $conn->close();

    return $wasOk;
}

function deleteCategory(int $categoryID)
{
    include_once '../conn/conn.php';

    $sql = "DELETE FROM categories WHERE categoryID=?";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'categories'" . $conn->error);
    }

    $statement->bind_param('i', $categoryID);

    $wasOk = $statement->execute();

    $statement->close();
    $conn->close();

    return $wasOk;
}

function saveNewCategory(string $categoryName, string $description)
{
    include_once '../conn/conn.php';

    $sql = "INSERT INTO categories (categoryName, description, status) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'categories'" . $conn->error);
    }

    $status = 1;

    $statement->bind_param('ssi', $categoryName, $description, $status);

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

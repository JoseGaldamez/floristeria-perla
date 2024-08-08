<?php

function deleteUser(int $userID)
{
    include_once '../conn/conn.php';

    $sql = "UPDATE users SET status=0 WHERE userID=?";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'categories'" . $conn->error);
    }

    $statement->bind_param('i',  $userID);

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

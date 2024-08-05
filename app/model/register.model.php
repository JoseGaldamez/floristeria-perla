<?php

function registerNewUser(string $username, string $email, string $password)
{

    include_once '../conn/conn.php';
    $sql = "INSERT INTO users (userName, userEmail, userPassword, status) VALUES (?, ?, ?, ?)";

    $statement = $conn->prepare($sql);

    if ($statement === false) {
        die("Error en la preparación de consulta 'users': " . $conn->error);
    }

    $status = 1;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $statement->bind_param('sssi', $username, $email, $hashed_password, $status);

    $wasOk = $statement->execute();
    $statement->close();
    $conn->close();

    return $wasOk;
}

function getAllUsers($conn)
{
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

<?php

function registerNewUser($conn, string $username, string $email, string $password)
{

    include_once '../conn/conn.php';

    
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'users': " . $conn->error);
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $statement->bind_param('sss', $username, $email, $hashed_password);

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
?>
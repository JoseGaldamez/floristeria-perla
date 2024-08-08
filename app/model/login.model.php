<?php

function login(string $email, string $password)
{

    include_once '../conn/conn.php';
    $sql = 'SELECT * FROM users WHERE userEmail=?';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        return false;
    }

    $statement->bind_param('s', $email);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    $statement->close();

    $password_hashed = $user['userPassword'];
    if (password_verify($password, $password_hashed)) {
        session_start();
        $_SESSION['userID'] = $user['userID'];

        return true;
    } else {
        return false;
    }
}

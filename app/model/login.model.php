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

        $sqlRole = 'SELECT * FROM users_roles WHERE userID=?';
        $statementRole = $conn->prepare($sqlRole);
        if ($statementRole === false) {
            return false;
        }

        $statementRole->bind_param('i', $user['userID']);
        $statementRole->execute();
        $resultRole = $statementRole->get_result();
        $role = $resultRole->fetch_assoc();

        $_SESSION['roleID'] = $role['roleID'];

        $resultRole->close();

        return true;
    } else {
        return false;
    }
}

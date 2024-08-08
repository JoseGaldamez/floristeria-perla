<?php

function registerNewUser(string $username, string $email, string $password, int $userType)
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

    // get userCreated
    $sqlGetUser = 'SELECT * FROM users WHERE userEmail=?';
    $statementGetUser = $conn->prepare($sqlGetUser);
    if ($statementGetUser === false) {
        return false;
    }

    $statementGetUser->bind_param('s', $email);
    $statementGetUser->execute();
    $resultUser = $statementGetUser->get_result();
    $user = $resultUser->fetch_assoc();

    $userID = $user['userID'];

    $statementGetUser->close();

    // Add role
    $sqlRole = "INSERT INTO users_roles (userID, roleID) VALUES (?, ?)";
    $statementRole = $conn->prepare($sqlRole);
    $statementRole->bind_param('ii', $userID, $userType);

    $wasOk = $statementRole->execute();
    $statementRole->close();

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

function getUserByID($conn, $userID)
{
    $sql = "SELECT * FROM users WHERE userID = " . $userID;
    $result = $conn->query($sql);

    return $result;
}

function getOrCreateUserProfile($conn, $userID, $userName)
{
    $sql = "SELECT * FROM profiles WHERE userID = " . $userID;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    }
    echo "No hay perfil creado";

    $sql = "INSERT INTO profiles (userID, name, sex, phone, address) VALUES (?, ?, ?, ?, ?)";

    $statement = $conn->prepare($sql);
    $sex = 0;
    $phone = '';
    $address = '';

    $statement->bind_param('isiss', $userID, $userName, $sex, $phone, $address);
    $statement->execute();
    $statement->close();


    $sql = "SELECT * FROM profiles WHERE userID = " . $userID;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    }
}

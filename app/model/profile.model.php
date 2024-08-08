<?php

function updateProfile(string $name, string $address, string $phone, int $sex, string $birthday)
{
    $userID = 0;
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    }

    include_once '../conn/conn.php';
    $sql = "UPDATE profiles SET name = ?, address = ?, phone = ?, sex = ?, birthday = ? WHERE userID = ?";

    $statement = $conn->prepare($sql);

    $statement->bind_param('sssisi', $name, $address, $phone, $sex, $birthday, $userID);

    $wasOk = $statement->execute();
    $statement->close();
    $conn->close();

    return $wasOk;
}

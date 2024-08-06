<?php

function updateProfile(string $name, string $address, string $phone, int $sex, string $birthday)
{

    include_once '../conn/conn.php';
    $sql = "UPDATE profiles SET name = ?, address = ?, phone = ?, sex = ?, birthday = ? WHERE userID = 6";

    $statement = $conn->prepare($sql);

    $statement->bind_param('sssis', $name, $address, $phone, $sex, $birthday);

    $wasOk = $statement->execute();
    $statement->close();
    $conn->close();

    return $wasOk;
}

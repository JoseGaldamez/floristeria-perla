<?php

function completeOrder($conn, $orderID, $details, $total)
{
    $sql = 'UPDATE orders SET details=?, status=2, total=? WHERE orderID=?';
    $statement = $conn->prepare($sql);
    if ($statement === false) {
        die("Error en la preparación de consulta 'products'" . $conn->error);
    }

    $statement->bind_param('sdi', $details, $total, $orderID);

    $wasOk = $statement->execute();

    $statement->close();
    return $wasOk;
}

function getCompletedOrderByUser($conn, $userID)
{
    $sql = "SELECT * FROM orders WHERE userID=" . $userID . " AND status = 2";
    $result = $conn->query($sql);

    return $result;
}

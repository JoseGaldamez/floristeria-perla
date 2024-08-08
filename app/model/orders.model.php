<?php
function getCountActiveOrderByUser($conn, $userID)
{
    $sql = "SELECT * FROM orders WHERE userID=" . $userID . " AND status = 1";
    $result = $conn->query($sql);

    $orderId = 0;
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['orderID'];
    }

    $sqlCount = 'SELECT * FROM orders_products WHERE orderID = ' . $orderId;
    $resultCount = $conn->query($sqlCount);
    $count = 0;
    while ($row = $resultCount->fetch_assoc()) {
        $count += 1;
    }

    return $count;
}
function getActiveOrderByUser($conn, $userID)
{
    $sql = "SELECT * FROM orders WHERE userID=" . $userID . " AND status = 1";
    $result = $conn->query($sql);

    return $result;
}

function addProductToOrder($conn, $orderID, $productID)
{

    $sqlOfProduct = "SELECT * FROM products WHERE productID=" . $productID;
    $resultProduct = $conn->query($sqlOfProduct);
    if ($resultProduct->num_rows == 0) {
        $messageResponse = "Item no existe.";
    }

    while ($row = $resultProduct->fetch_assoc()) {
        $productPrice = $row['price'];
        $isv = $productPrice * 0.15;
    }

    // Create order to this user
    $sqlNewProductToOrder = "INSERT INTO orders_products (orderID, productID, productPrice, isv, quantity) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sqlNewProductToOrder);

    $quantity = 1;

    $statement->bind_param('iiddi', $orderID, $productID, $productPrice, $isv, $quantity);
    $productAdded = $statement->execute();

    if ($productAdded) {
        $messageResponse = "Item agregado correctamente.";
    }

    return $messageResponse;
}

function createNewOrderToUser($conn, $userID, $productID)
{

    $sqlOfProduct = "SELECT * FROM products WHERE productID=" . $productID;
    $resultProduct = $conn->query($sqlOfProduct);
    if ($resultProduct->num_rows == 0) {
        return array('success' => false, 'message' => "El producto no existe");
    }

    // Create order to this user
    $sqlNewOrder = "INSERT INTO orders (userID, status, details, total) VALUES (?,?,?,?)";
    $statement = $conn->prepare($sqlNewOrder);

    $orderStatus = 1;
    $details = "Orden activa";
    $total = 0.0;

    $statement->bind_param('iisd', $userID, $orderStatus, $details, $total);
    $orderCreated = $statement->execute();

    $messageResponse = "";

    if ($orderCreated) {

        $sqlOrder = "SELECT * FROM orders WHERE status= 1";
        $resultOrder = $conn->query($sqlOrder);

        $orderId = 0;
        $productPrice = 0;
        $isv = 0;

        if ($resultOrder->num_rows > 0) {

            while ($row = $resultOrder->fetch_assoc()) {
                $orderId = $row['orderID'];
            }

            while ($row = $resultProduct->fetch_assoc()) {
                $productPrice = $row['price'];
                $isv = $productPrice * 0.15;
            }


            // Create order to this user
            $sqlNewProductToOrder = "INSERT INTO orders_products (orderID, productID, productPrice, isv, quantity) VALUES (?,?,?,?,?)";
            $statement = $conn->prepare($sqlNewProductToOrder);

            $quantity = 1;

            $statement->bind_param('iiddi', $orderId, $productID, $productPrice, $isv, $quantity);
            $productAdded = $statement->execute();

            if ($productAdded) {
                $messageResponse = "Item agregado correctamente";
            }
        } else {
            $messageResponse = "No se encontró la orden creada.";
        }
    } else {
        $messageResponse = "No se logro crear la orden";
    }


    $conn->close();
    return $messageResponse;
}

function getProductFromOrder($conn, $userID)
{
    $result = getActiveOrderByUser($conn, $userID);

    $orderId = 0;
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['orderID'];
    }

    $sqlProductoOfOrder = "SELECT *, sum(o.productPrice) as price, sum(o.isv) as impuesto, sum(o.quantity) as many FROM floristeria_perla.orders_products as o inner join floristeria_perla.products as p ON p.productID = o.productID WHERE orderID = " . $orderId . " GROUP BY o.productID;";
    $resultProductoOfOrder = $conn->query($sqlProductoOfOrder);

    return $resultProductoOfOrder;
}

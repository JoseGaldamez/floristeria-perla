<?php
header('Content-type: application/json');
include_once '../conn/conn.php';
include_once '../model/orders.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $userID = 0;

    if (isset($_POST['productID']) && isset($_SESSION['userID'])) {

        $productID = $_POST['productID'];
        $userID = $_SESSION['userID'];


        $orderActive = getActiveOrderByUser($conn, $userID);

        if ($orderActive->num_rows > 0) {
            // add to current order
            while ($row = $orderActive->fetch_assoc()) {
                $orderId = $row['orderID'];
            }

            $messageResponse = addProductToOrder($conn, $orderId, $productID);
        } else {
            // create a new order
            $messageResponse = createNewOrderToUser($conn, $userID, $productID);
        }
        echo json_encode(array('success' => true, 'message' => $messageResponse));
    }
}

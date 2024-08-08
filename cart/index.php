<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla | Carrito de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include '../app/includes/menu.php';
    ?>

    <main class="container pt-5 mb-5">
        <h2 class="mt-5 pt-5">Carrito de compras</h2>

        <?php

        $userID = 0;
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }


        if ($_SERVER['REQUEST_URI'] == "/") {
            include_once 'app/conn/conn.php';
            include_once 'app/model/orders.model.php';
        } else {
            include_once '../app/model/orders.model.php';
            include_once '../app/conn/conn.php';
        }

        $resultCount = getCountActiveOrderByUser($conn, $userID);

        if ($resultCount == 0) {
            echo '<div class="profile-card border rounded p-5 mt-5 text-center mb-5"><p>Aún no hay items en el carrito...</p></div>';
        } else {

            echo '<div class="list-of-products border rounded p-2 mt-3">

            <div class="row p-3">
                <div class="col-6">
                    <h5>Nombre de producto</h5>
                </div>
                <div class="col-3 text-center">
                    <h5>Cantidad</h5>
                </div>
                <div class="col-3 text-end">
                    <h5>Precio</h5>
                </div>
            </div>';

            $products = getProductFromOrder($conn, $userID);
            $isv = 0;
            $subtotal = 0;
            $orderID = 0;

            while ($row = $products->fetch_assoc()) {
                echo '<hr /> <article class="row mt-3 p-3 align-middle">
                    <div class="col-6">
                        <div class="row align-middle">
                            <div class="col-2 align-self-center">
                                <figure class="cart-figure">
                                    <img class="img-thumbnail cart-image" src="' . $row['image'] . '" alt="Girasoles">
                                </figure>
                            </div>
                            <div class="col-8 align-self-center">
                                <h4>' . $row['productName'] . '</h4>
                                <p>' . $row['description'] . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <h5>' . $row['many'] . '</h5>
                    </div>
                    <div class="col-3 text-end align-self-center">
                        <h5>L. ' . $row['price'] . '</h5>
                    </div>
                </article> ';
                $isv += $row['impuesto'];
                $subtotal += $row['price'];
                $orderID = $row['orderID'];
            }


            echo '</div>

        <div class="total p-3 mt-5">

            <div class="row mt-2">

                <div class="col-6">
                    <h5>Subtotal</h5>
                </div>
                <div class="col-6 text-end">
                    <h5>L. ' . $subtotal . '</h5>
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-6">
                    <h5>Impuestos (15%)</h5>
                </div>
                <div class="col-6 text-end">
                    <h5>L. ' . $isv . '</h5>
                </div>

            </div>
            <hr>
            <div class="row mt-4">

                <div class="col-6">
                    <h4>Total a pagar</h4>
                </div>
                <div class="col-6 text-end">
                    <h4>L. ' . $subtotal + $isv . '</h4>
                </div>

            </div>

        </div>

        <div class="text-end">
            <button type="button" class="btn btn-pink-primary" data-bs-toggle="modal" data-bs-target="#PaymentForm">
                Pagar
            </button>
        </div>';
        }

        ?>



        <!-- Modal -->
        <div class="modal fade" id="PaymentForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Realizar pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="numbercard" class="form-label">Número de tarjeta</label>
                                <input type="text" maxlength="16" class="form-control" id="numbercard" placeholder="1234 12324 1234 1234" required>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-8">
                                    <label for="namecard" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="namecard" placeholder="NAME" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="expirationDate" class="form-label">Expiración</label>
                                    <input type="text" maxlength="5" class="form-control" id="expirationDate" placeholder="00/00" required>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="details" class="form-label">Detalles y preferencias del pedido</label>
                                <textarea class="form-control" id="details" rows="5" placeholder="Dirección adicional, fecha de entrega, mensaje de tarjeta, etc."></textarea>
                            </div>
                        </form>
                        <div id="alerts" class="mt-5">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="pay(<?php echo $orderID . ' , ' . ($subtotal + $isv); ?>)" type="button" class="btn btn-primary">Procesar pago</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php
    include '../app/includes/footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="cart.js"></script>
</body>

</html>
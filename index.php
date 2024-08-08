<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <link rel="stylesheet" href="styles/global.css">
</head>

<body>
    <?php
    include 'app/includes/menu.php';
    ?>

    <div class="lp-banner d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-6 text-center">
            <h1 class="font-titles font-space fs-1-1 text-light lp-banner-font-size">Floristería Perla</h1>
            <p class="font-paragraphs font-space fs-4 text-light">Flores que encantan, belleza que perdura</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">

            <?php

            include_once 'app/model/product.model.php';
            include_once 'app/conn/conn.php';

            // Variables de paginación
            $limit = 20; // numero de productos por página
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            $result = getProductsHome($conn, $limit, $offset);
            $totalProducts = getProductCount($conn);
            $totalPages = ceil($totalProducts / $limit);


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                <div class="card card-custom ">
                    <img src="' . $row["image"] . '" alt="' . $row["productName"] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["productName"] . '</h5>
                        <p class="card-text">' . $row["description"] . '</p>
                        <div class="footer-card-product">
                        <button onclick="addToCart(' . $row["productID"] . ')" class="btn text-pink"><i class="fa-solid fa-plus"></i> Agregar</button>
                        <span class="price">L. ' . $row["price"] . '</span>
                        </div>
                    </div>
                </div>
            </div>';
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>


    <?php
    include 'app/includes/footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="scripts/home.js"></script>
</body>

</html>
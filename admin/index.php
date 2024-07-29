<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla | Carrito de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
    <?php
    include '../app/includes/menu.php';
    ?>

    <main class="container mt-5 mb-5">
        <h2>Panel administrativo</h2>
        <hr>

        <div class="list-of-products p-2 mt-3">
            <div class="row p-3">
                <div class="col-8">
                    <h5>Productos</h5>
                </div>

                <div class="col-4 text-end">
                    <button type="button" class="btn btn-pink-primary" data-bs-toggle="modal" data-bs-target="#PaymentForm">
                        Agregar nuevo
                    </button>
                </div>
            </div>



            <article class="row mt-3 p-3 align-middle">
                <div class="col-9">
                    <div class="row align-middle">
                        <div class="col-2 align-self-center">
                            <figure class="cart-figure">
                                <img class="img-thumbnail cart-image" src="../app/assets/images/girasol.jpg" alt="Girasoles">
                            </figure>
                        </div>
                        <div class="col-8 align-self-center">
                            <h4>Girasoles Ramo</h4>
                            <p>Ramos de girasoles, 1 girasol con detalles estéticos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-3 text-end align-self-center">
                    <button type="button" class="btn btn-pink-primary" data-bs-toggle="modal" data-bs-target="#PaymentForm">
                        Editar
                    </button>
                </div>
            </article>


            <hr>
            <article class="row mt-3 p-3 align-middle">
                <div class="col-9">
                    <div class="row align-middle">
                        <div class="col-2 align-self-center">
                            <figure class="cart-figure">
                                <img class="img-thumbnail cart-image" src="../app/assets/images/rosas2.jpg" alt="Rosas">
                            </figure>
                        </div>
                        <div class="col-8 align-self-center">
                            <h4>Caja de Rosas</h4>
                            <p>Arreglo en forma de caja con 6 rosas rojas.</p>
                        </div>
                    </div>
                </div>

                <div class="col-3 text-end align-self-center">
                    <button type="button" class="btn btn-pink-primary" data-bs-toggle="modal" data-bs-target="#PaymentForm">
                        Editar
                    </button>
                </div>
            </article>
            <hr>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="PaymentForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar/agregar producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nameProduct" class="form-label">Nombre del producto</label>
                                <input type="text" class="form-control" id="nameProduct" placeholder="Flores rojas" required>
                            </div>
                            <div class="mb-3">
                                <label for="details" class="form-label">Detalles</label>
                                <textarea class="form-control" id="details" rows="5" placeholder="Detalles de lo que contiene el producto."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="pictureProduct" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="pictureProduct" placeholder="Seleccione una imagen" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-8">

                                </div>
                                <div class="mb-3 col-4">
                                    <label for="expirationDate" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="expirationDate" placeholder="L 0.00" required>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Procesar pago</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php
    include '../app/includes/footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
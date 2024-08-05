<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla | Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/sidebars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="h-100 row overflow-hidden">
    <?php
    include_once '../../app/includes/admin-menu.php';
    include_once '../../app/model/product.model.php';
    include_once '../../app/conn/conn.php';

    // Variables de paginación
    $limit = 6; // numero de productos por página
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $result = getProducts($conn, $limit, $offset);
    $totalProducts = getProductCount($conn);
    $totalPages = ceil($totalProducts / $limit);
    ?>

    <div class="col-8 p-5">
        <div class="row">
            <div class="col-9">
                <h2>Administrar Productos</h2>
            </div>
            <div class="col-3 text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addProduct" class="btn text-pink"> <i class="fa-solid fa-plus"></i> Agregar nuevo</button>
            </div>
        </div>
        <hr>

        <?php
        if (isset($_GET['success']) && $_GET['success'] === "true") {
            echo '<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Éxito!</strong> Producto guardado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>



        <div id="productTable">
            <?php
            if ($result->num_rows > 0) {
                echo '<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Precio</th><th scope="col">Inventario</th><th scope="col">Imagen</th><th scope="col">Categoría</th><th scope="col">Estado</th><th scope="col">Acciones</th></tr></thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    $statusClass = $row["status"] ? "text-success" : "text-danger";
                    $statusText = $row["status"] ? "Activo" : "Inactivo";
                    echo '<tr><th scope="row">'
                        . $row["productID"] . '</th><td>'
                        . $row["productName"] . '</td><td>'
                        . $row["description"] . '</td><td>'
                        . $row["price"] . '</td><td>'
                        . $row["inventary"] . '</td><td><img src="'
                        . $row["image"] . '" class="product-image" data-product-name="'
                        . $row["productName"] . '" alt="Imagen del producto" width="50"></td><td>'
                        . $row["categoryName"] . '</td><td class="' . $statusClass . '">' . $statusText . '</td><td>
                    <button class="btn" onclick="loadProductData('
                        . $row["productID"] . ')"><i class="fa-solid fa-pencil"></i></button>  
                    <button class="btn" onclick="showDeleteModal('
                        . $row["productID"] . ')"><i class="fa-solid fa-trash"></i></button></td> </tr>';
                }
                echo '</tbody></table>';
            } else {
                echo "0 results";
            }
            ?>
        </div>


        <!--parte de la paginación-->
        <nav>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- Modal de agregar/editar producto -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar/Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" enctype="multipart/form-data">
                        <input type="hidden" id="productId" name="productId">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Detalles sobre el producto." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="inventary" class="form-label">Inventario</label>
                            <input type="number" class="form-control" id="inventary" name="inventary" placeholder="Cantidad en inventario" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Categoría</label>
                            <select class="form-control" id="category" name="category" required>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="createOrUpdateProduct()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal de eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Icono de alerta -->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                    </symbol>
                    <symbol id="info-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </symbol>
                </svg>

                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            ¿Estás seguro de que deseas eliminar este producto?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sí, desactivar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para mostrar la imagen en grande cuando se hace click en ella -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Imagen del producto">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../../scripts/sidebars.js"></script>
    <script src="/admin/products/product.js"></script>
</body>

</html>
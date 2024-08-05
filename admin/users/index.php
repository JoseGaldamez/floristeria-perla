<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristería Perla | Usuarios</title>
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
    ?>

    <div class="col-8 p-5">

        <div class="row">
            <div class="col-9">
                <h2>Administrar Categorias</h2>
            </div>
            <div class="col-3 text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addUser" class="btn text-pink"> <i class="fa-solid fa-plus"></i> Agregar nueva</button>
            </div>
        </div>
        <hr>


        <?php
        if (isset($_GET['success']) && $_GET['success'] === "true") {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> Usuario guardado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div id="alerts" class="mt-5">
        </div>

        <div>
            <?php
            include_once '../../app/model/register.model.php';
            include_once '../../app/conn/conn.php';

            $result = getAllUsers($conn);

            if ($result->num_rows > 0) {
                echo '<table class="table"><thead><tr><th scope="col">#</th><th scope="col">Nombre</th><th scope="col">Correo Electrónico</th><th scope="col">Estado</th><th scope="col">Acciones</th></tr></thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><th scope="row">' . $row["userID"] . '</th><td>' . $row["userName"] . '</td><td>' . $row["userEmail"] . '</td><td>' . $row["status"] . '</td><td>
                <button class="btn"><i class="fa-solid fa-pencil"></i></button>  
                <button class="btn"><i class="fa-solid fa-trash"></i></button></td></tr>';
                }
                echo '</tbody></table>';
            } else {
                echo "0 results";
            }
            ?>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar/Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="UserName" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="UserName" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="UserEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="UserEmail" placeholder="Correo Electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="userPassword" placeholder="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword2" class="form-label">Confirma la contraseña</label>
                            <input type="password" class="form-control" id="userPassword2" placeholder="Confirmar contraseña" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="createOrUpdateUser()" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../../scripts/sidebars.js"></script>
    <script src="users.js"></script>
</body>

</html>
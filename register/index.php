<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristeríass Perla</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("assets/imagen/fondo.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        .btn-pink {
            background-color: #f752a4;
            border-color: #f752a4;
            color: white;
        }

        .btn-pink:hover {
            background-color: #ff1493;
        }
    </style>

</head>

<body>

    <div class="container mt-5">

        <div class="text-center mt-5">
            <img src="../assets/imagen/logo.webp" alt="Logotipo" width="auto" height="150px">
        </div>

        <h1 class="text-center"></h1>
        <div class="row justify-content-center">
            <div class="col-md-6 register-container">
                <h2 class="text-center mb-3">Registro de Usuario</h2>
                <form method="post" id="registerForm">
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-pink btn-block">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
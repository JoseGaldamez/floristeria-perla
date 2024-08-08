<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Floristería Perla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

        body {
            background-image: url('images/FONDOROSA.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .home {
            text-align: center;
            margin-top: 20px;
            color: rgb(236, 236, 236);
        }

        .home h1,
        .home h2 {
            margin: 10px 0;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-logo img {
            width: 100px;
            display: block;
            margin: 0 auto;
        }

        .text-block h3 {
            color: #333;
            margin: 10px 0;
        }

        .textbox {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            display: block;
            width: 70%;
            padding: 10px;
            text-align: center;
            border-radius: 15px;
            text-decoration: none;
            color: rgb(255, 249, 249);
            margin: 10px auto;
            box-sizing: border-box;
        }

        .btn-primary-pink {
            background-color: #D83466;
        }

        .text-color-pink {
            color: #D83466;
        }

        @media (max-width: 768px) {
            .card {
                padding: 15px;
                max-width: 90%;
            }

            .home h1,
            .home h2 {
                font-size: 1.2rem;
            }

            .card-logo img {
                width: 80px;
            }

            .textbox {
                width: calc(100% - 10px);
            }
        }
    </style>
</head>

<body>
    <div class="home">
        <img src="../assets/imagen/logo.webp" alt="Logotipo" width="auto" height="150px">
    </div>
    <div class="card">
        <div class="text-block">
            <h3>Correo Electrónico</h3>
            <input type="text" id="email" class="textbox" placeholder="Introduce tu correo">
            <h3>Contraseña</h3>
            <input type="password" id="password" class="textbox" placeholder="Introduce tu contraseña">
        </div>
        <button type="button" onclick="login()" class="btn btn-primary-pink" id="loginBtn">Iniciar Sesión</button>
        <a href="/register" class="btn text-color-pink">¿No tengo cuenta? Registrarse</a>

        <?php
        session_start();
        if (isset($_SESSION['userID'])) {
            header('Location: /');
        }

        ?>

        <div id="alerts" class="mt-5">
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="login.js"></script>
</body>

</html>
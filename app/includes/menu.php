<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-pink-primary menu-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="row align-middle">
                    <div class="col">
                        <img src="../assets/imagen/logo.webp" alt="Logotipo" class="logo-flor">
                    </div>
                    <div class="col align-self-center font-titles">
                        FLORISTERÍA PERLA
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">

                </div>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == "/") {
                                                echo "active fw-bold text-decoration-underline";
                                            }  ?> " aria-current="page" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == "/cart/") {
                                                echo "active fw-bold text-decoration-underline";
                                            }  ?>" href="/cart">
                            Carrito
                            <?php
                            if ($_SERVER['REQUEST_URI'] == "/") {
                                include_once 'app/conn/conn.php';
                                include_once 'app/model/orders.model.php';
                            } else {
                                include_once '../app/model/orders.model.php';
                                include_once '../app/conn/conn.php';
                            }

                            $resultCount = getCountActiveOrderByUser($conn, 6);

                            echo '<span class="badge cart-count rounded-pill text-bg-danger">' . $resultCount . '</span>';

                            ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == "/profile/") {
                                                echo "active fw-bold text-decoration-underline";
                                            }  ?>" href="/profile">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login" tabindex="-1" aria-disabled="true">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
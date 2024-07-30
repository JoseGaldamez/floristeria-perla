<div class="d-flex flex-column col-3 flex-shrink-0 p-3 text-white h-100 bg-pink-primary" style="width: 320px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="<?php if ($_SERVER['REQUEST_URI'] == "/admin/") {
                        echo "../assets/imagen/logo.webp";
                    } else {
                        echo "../../assets/imagen/logo.webp";
                    }  ?>" alt="Logo" class="logo-flor">
        <span class="fs-4">Floristería Perla</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/admin" class="nav-link text-white <?php
                                                        if ($_SERVER['REQUEST_URI'] == "/admin/") {
                                                            echo "sidebar-selected";
                                                        } ?>">
                <i class="fa-solid fa-house-chimney"></i>
                Inicio
            </a>
        </li>
        <li>
            <a href="/admin/products" class="nav-link text-white <?php
                                                                    if ($_SERVER['REQUEST_URI'] == "/admin/products/") {
                                                                        echo "sidebar-selected";
                                                                    } ?>">
                <i class="fa-solid fa-cart-shopping"></i>
                Productos
            </a>
        </li>
        <li>
            <a href="/admin/categories" class="nav-link text-white <?php
                                                                    if ($_SERVER['REQUEST_URI'] == "/admin/categories/") {
                                                                        echo "sidebar-selected";
                                                                    } ?>">
                <i class="fa-solid fa-layer-group"></i>
                Categorias
            </a>
        </li>
        <hr>
        <li>
            <a href="/admin/users" class="nav-link text-white <?php
                                                                if ($_SERVER['REQUEST_URI'] == "/admin/users/") {
                                                                    echo "sidebar-selected";
                                                                } ?>">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>
        </li>

    </ul>
    <hr>
    <div>
        <button class="btn w-100 text-center text-white">Cerrar sesión</button>
    </div>
</div>
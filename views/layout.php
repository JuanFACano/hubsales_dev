<?php
$rol = $_SESSION['user_rol'];
$nombre = $_SESSION['user_nombre'];
$admin = false;
if ($rol === 1) {
    $admin = true;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Autor: Juan Felipe Arismendi Cano,
    Category: enterprise">
    <title>Hubsales</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <div class="contenedor">
        <div class="sidebar">
            <header class="sidebar_header">
                <div class="sidebar_image">
                    <img src="/build/img/logo_1.jpg" alt="sidebar image">
                </div>
            </header>
            <ul class="menu_links">
                <?php if ($admin) : ?>
                    <li class="menu_item hover x2">
                        <a class="menu_link" href="/general">
                            <span class="menu_text">General</span>
                            <img class="menu_icon" src="/build/img/house-solid.svg" alt="home icon">
                        </a>
                    </li>
                    <li class="menu_item hover x2">
                        <a class="menu_link" href="/usuarios">
                            <span class="menu_text">Usuarios</span>
                            <img class="menu_icon" src="/build/img/user-group-solid.svg" alt="home icon">
                        </a>
                    </li>
                <?php endif ?>
                <li class="menu_item hover x2">
                    <a class="menu_link" href="/productos">
                        <span class="menu_text">Productos</span>
                        <img class="menu_icon" src="/build/img/cart-shopping-solid.svg" alt="home icon">
                    </a>
                </li>
                <li class="menu_item hover x2">
                    <a class="menu_link" href="/clientes">
                        <span class="menu_text">Clientes</span>
                        <img class="menu_icon" src="/build/img/user-solid.svg" alt="home icon">
                    </a>
                </li>
                <li class="menu_item hover x2">
                    <a class="menu_link" href="/facturas">
                        <span class="menu_text">Facturas</span>
                        <img class="menu_icon" src="/build/img/receipt-solid.svg" alt="home icon">
                    </a>
                </li>
            </ul>
            <div class="sidebar_footer">
                <div class="user">
                    <a href="/logout" aria-label="boton cerrar sesion">
                        <img class="icon rotate white" src="/build/img/right-from-bracket-solid.svg" alt="">
                    </a>
                    <p class="user_name capitalize"><?php echo $nombre ?></p>
                </div>
            </div>
        </div>
        <div class="app .transition">
            <?php echo $contenido; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/c36f3a940c.js" crossorigin="anonymous"></script>
    <script src="/build/js/app.js"></script>
</body>

</html>
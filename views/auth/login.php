<!DOCTYPE html>
<html lang="es">

<?php
include_once __DIR__ . '/../templates/alertas.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="build/css/app.css">
  <title>login</title>
</head>

<body>
  <div class="contenedor-app">
    <div class="login_image"></div>
    <section class="login_session">
      <h1 class="title_page">Login</h1>
      <form method="POST" action="/" class="formulario_login">
        <div class="campo">
          <input type="email" id="correo" name="correo" value="<?php echo s( $auth->user_correo ) ?>" placeholder="Correo">
          <i class="fa-regular fa-user"></i>
        </div>
        <div class="campo">
          <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña">
          <i class="fa-solid fa-lock"></i>
        </div>
        <input type="submit" class="boton pad1-2" value="Iniciar Sesión">
      </form>
    </section>
  </div>

  <script src="https://kit.fontawesome.com/c36f3a940c.js" crossorigin="anonymous"></script>
</body>
</html>
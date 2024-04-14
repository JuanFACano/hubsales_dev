<?php
?>

<div class="form_contenedor">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <form class="form" method="POST" action="/usuarios/editar?id=<?php echo $usuario->user_id ?>">
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="user_nombre">nombre</label>
        <input type="text" name="user_nombre" id="user_nombre" placeholder="Ejm. Jhon" value="<?php echo s($usuario->user_nombre) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="user_apellido">apellido</label>
        <input type="text" name="user_apellido" id="user_apellido" placeholder="Ejm. Cena" value="<?php echo s($usuario->user_apellido) ?>">
      </div>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="user_correo">correo</label>
      <input type="email" name="user_correo" id="user_correo" placeholder="ingrese un correo" value="<?php echo s($usuario->user_correo) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="user_rol">Rol</label>
      <select name="user_rol" id="user_rol">
        <option value="">Seleccione un Rol</option>
        <option <?php echo $usuario->rol_id === 1 ? 'selected' : '' ?> value="1">Admin</option>
        <option <?php echo $usuario->rol_id === 2 ? 'selected' : '' ?> value="2">Usuario Base</option>
      </select>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="user_contrasenia">Contraseña</label>
      <input type="password" name="user_contrasenia" id="user_contrasenia" placeholder="ingrese una contraseña">
    </div>
    <input class="boton" type="submit" value="Actualizar Usuario">
    <a class="boton" href="/usuarios">Volver</a>
  </form>
</div>
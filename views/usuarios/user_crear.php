<div class="form_contenedor">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <form class="form" method="POST" action="/usuarios/crear">
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="user_nombre">nombre</label>
        <input type="text" name="user_nombre" id="user_nombre" placeholder="Ejm. Jhon" value="<?php echo s($usuario->user_nombre) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="apellido">apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="Ejm. Cena" value="<?php echo s($usuario->user_apellido) ?>">
      </div>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="correo">correo</label>
      <input type="email" name="correo" id="correo" placeholder="ingrese un correo" value="<?php echo s($usuario->user_correo) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="rol">Rol</label>
      <select name="rol" id="rol">
        <option value="">Seleccione un Rol</option>
        <option <?php echo s($usuario->user_rol == 1 ? "selected" : '') ?> value="1">Admin</option>
        <option <?php echo s($usuario->user_rol == 2 ? "selected" : '') ?> value="2">Usuario Base</option>
      </select>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="contrasenia">Contraseña</label>
      <input type="password" name="contrasenia" id="contrasenia" placeholder="ingrese una contraseña">
    </div> <input class="boton" type="submit" value="Crear Usuario">
    <a class="boton" href="/usuarios">Volver</a>
  </form>
</div>
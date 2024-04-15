<div class="form_contenedor">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <form class="form" method="POST" action="/clientes/editar?id=<?php echo $cliente->cli_id ?>">
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="cli_nombre">nombre</label>
        <input type="text" name="cli_nombre" id="cli_nombre" placeholder="Jhon" value="<?php echo s($cliente->cli_nombre) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="cli_apellido">apellido</label>
        <input type="text" name="cli_apellido" id="cli_apellido" placeholder="Cena" value="<?php echo s($cliente->cli_apellido) ?>">
      </div>
    </div>
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="cli_cedula">ID</label>
        <input type="text" name="cli_cedula" id="cli_cedula" placeholder="1234561340" value="<?php echo s($cliente->cli_cedula) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="cli_telefono">telefono</label>
        <input type="text" name="cli_telefono" id="cli_telefono" placeholder="+57 1234567890" value="<?php echo s($cliente->cli_telefono) ?>">
      </div>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="cli_correo">correo</label>
      <input type="email" name="cli_correo" id="cli_correo" placeholder="correo@correo.com" value="<?php echo s($cliente->cli_correo) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="cli_direccion">direccion</label>
      <input type="text" name="cli_direccion" id="cli_direccion" placeholder="cr 1 #02-03 - cl 4 #05-06" value="<?php echo s($cliente->cli_direccion) ?>">
    </div>
    <input class="boton" type="submit" value="Actualizar Cliente">
    <a class="boton" href="/clientes">Volver</a>
  </form>
</div>
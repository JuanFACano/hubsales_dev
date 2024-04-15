<div class="form_contenedor mx70">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <form class="form" method="POST" action="/usuarios/crear">
    <div class="campo_simple">
      <label class="campo_label" for="cat_nombre">nombre</label>
      <input type="text" name="cat_nombre" id="cat_nombre" placeholder="Ejm. Jhon" value="<?php echo s($usuario->user_nombre) ?>">
    </div>
    <div class="campo_simple">
      <label for="cat_descripcion">Descripcion</label>
      <textarea name="cat_descripcion" id="cat_descripcion" cols="30" rows="10"></textarea>
    </div>
    <div class="botones_form">
      <input class="boton" type="submit" value="Crear Usuario">
      <a class="boton" href="/usuarios">Volver</a>
    </div>
  </form>
</div>
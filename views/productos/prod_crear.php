<div class="form_contenedor">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';

  ?>

  <!-- ---------------------------------------- -->
  <form class="form" method="POST" action="/productos/crear">
    <div class="campo_simple">
      <label class="campo_label" for="prod_nombre">Nombre</label>
      <input type="text" placeholder="café helado" name="prod_nombre" id="prod_nombre" value="<?php echo s($producto->prod_nombre) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="prod_descripcion">Descripcion</label>
      <textarea placeholder="Delicioso café helado" name="prod_descripcion" id="prod_descripcion" cols="30" rows="4"><?php echo S($producto->prod_descripcion) ?></textarea>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="prod_sku">Codigo de Producto</label>
      <input type="text" placeholder="Estructura: 15042024CE54321" name="prod_sku" id="prod_sku" value="<?php echo s($producto->prod_sku) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="rol">Categoria</label>
      <select name="prod_cat_id" id="rol">
        <option value="">Seleccione la categoria</option>
        <option <?php echo s($producto->prod_cat_id == 1 ? "selected" : '') ?> value="1">Cafe</option>
        <option <?php echo s($producto->prod_cat_id == 2 ? "selected" : '') ?> value="2">Moffins</option>
      </select>
    </div>
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="prod_precio_unitario">Precio Unitario</label>
        <span class="campo_icon">$</span>
        <input class="precio_input" placeholder="10.000" min=0 type="number" name="prod_precio_unitario" id="prod_precio_unitario" value="<?php echo s($producto->prod_precio_unitario) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="prod_existencias">Existencias</label>
        <input placeholder="1" type="number" name="prod_existencias" id="prod_existencias" value="<?php echo s($producto->prod_existencias) ?>">
      </div>
    </div>
    <div class="botones_form">
      <a class="boton" href="/productos">Volver</a>
      <input class="boton" type="submit" value="Crear Producto">
    </div>
    <!-- ---------------------------------------- -->
  </form>
</div>
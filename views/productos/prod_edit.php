<div class="form_contenedor">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <!-- ------------------------------------------>
  <form class="form" method="POST" action="/productos/editar?id=<?php echo $producto->prod_id ?>">
    <div class="campo_simple">
      <label class="campo_label" for="prod_nombre">Nombre</label>
      <input type="text" name="prod_nombre" id="prod_nombre" value="<?php echo s($producto->prod_nombre) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="prod_descripcion">Descripcion</label>
      <textarea name="prod_descripcion" id="prod_descripcion" cols="30" rows="4"><?php echo S($producto->prod_descripcion) ?></textarea>
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="prod_sku">Codigo de Producto</label>
      <input type="text" name="prod_sku" id="prod_sku" value="<?php echo strtoupper(s($producto->prod_sku)) ?>">
    </div>
    <div class="campo_simple">
      <label class="campo_label" for="prod_cat_id">Categoria</label>
      <select name="prod_cat_id" id="prod_cat_id">
        <option value="">Seleccione la categoria</option>
        <?php foreach ($categorias as $categoria) : ?>
          <option class="capitalize" <?php echo s($producto->prod_cat_id == $categoria->cat_id ? "selected" : '') ?> value="<?php echo s($categoria->cat_id) ?>"><?php echo s($categoria->cat_nombre) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="campo_doble">
      <div class="campo_simple">
        <label class="campo_label" for="prod_precio_unitario">Precio Unitario</label>
        <span class="campo_icon">$</span>
        <input class="precio_input" min=0 type="number" name="prod_precio_unitario" id="prod_precio_unitario" value="<?php echo s($producto->prod_precio_unitario) ?>">
      </div>
      <div class="campo_simple">
        <label class="campo_label" for="prod_existencias">Existencias</label>
        <input type="number" name="prod_existencias" id="prod_existencias" value="<?php echo s($producto->prod_existencias) ?>">
      </div>
    </div>
    <div class="botones_form">
      <a class="boton" href="/productos">Volver</a>
      <input class="boton" type="submit" value="Editar Producto">
    </div>
    <!-- ---------------------------------------- -->
  </form>
</div>
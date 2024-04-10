<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Productos</h1>
      <div class="button_active_form app_boton boton">
        <a href="/producto/crear">Agregar Producto</a>
      </div>
    </div>
    <div class="contenedor_header_search campo campo_search">
      <input type="text" id="search" name="search" placeholder="Buscar Producto">
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
  </header>
  <main class="contenedor_main">
    <table class="table">
      <thead class="table_head">
        <th class="table_head_item">Nombre</th>
        <th class="table_head_item">Precio</th>
        <th class="table_head_item">Existencias</th>
        <th class="table_head_item">Categoria</th>
        <th class="table_head_item">Descripción</th>
        <th class="table_head_item">Action</th>
      </thead>
      <tbody class="table_body" id="table_body">
        <?php foreach ($datos_base as $dato) : ?>
          <tr class="table_row">
            <td><?php echo $dato->prod_nombre ?></td>
            <td>$<?php echo $dato->prod_precio_unitario ?></td>
            <td><?php echo $dato->prod_existencias ?></td>
            <td><?php echo $dato->cat_nombre ?></td>
            <td><?php echo $dato->prod_descripcion ?></td>
            <td>
              <button class="table_actions edit">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button class="table_actions delete">
                <i class="fa-solid fa-trash"></i>
              </button>

            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
</div>
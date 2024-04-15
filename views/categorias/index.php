<div class="contenedor_app">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  $view = getView($categorias[0]);
  ?>
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Categoria</h1>
      <div class="button_active_form app_boton boton mt">
        <a href="/categorias/crear">Agregar Categoria</a>
      </div>
    </div>
  </header>
  <main class="contenedor_main">
    <table class="Table">
      <thead class="Table_head">
        <tr class="Table_row">
          <th class="Table_head_item">Categoria</th>
          <th class="Table_head_item">Descripcion</th>
          <th class="Table_head_item">Acciones</th>
        </tr>
      </thead>
      <tbody class="Table_body" id="table_body">
        <?php foreach ($categorias as $categoria) : ?>
          <tr class="Table_row">
            <td class="capitalize txtnw"><?php echo s($categoria->cat_nombre) ?></td>
            <td class="no_center"><?php echo s($categoria->cat_descripcion) ?>.</td>
            <td>
              <a href="/categorias/editar?id=<?php echo s($categoria->cat_id) ?>" class="table_actions edit">
                <img class="icon blue sm" src="/build/img/pen-to-square-solid.svg" alt="icon edit">
              </a>
              <button data-id="<?php echo s($categoria->cat_id) ?>" data-view="<?php echo $view ?>" id="delete" class="table_actions delete">
                <img class="icon red sm" src="/build/img/trash-solid.svg" alt="home icon">
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
</div>
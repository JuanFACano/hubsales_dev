<div class="contenedor_app">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  $view = getView($productos[0]);

  setlocale(LC_MONETARY, 'es_CO');
  function format($numero)
  {
    $double = number_format($numero, 0, '', '.');
    return '$' . $double;
  }

  ?>
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Productos</h1>
      <div class="prod_buttons">
        <div class="button_active_form app_boton boton">
          <a href="/productos/crear">Agregar Producto</a>
        </div>
        <div class="button_active_form app_boton boton">
          <a href="/categorias">Categoria</a>
        </div>
      </div>
    </div>
    <form method="POST" class="contenedor_header_search campo_simple">
      <input type="text" id="search" name="search" placeholder="Buscar Producto por nombre">
      <button class="send unset">
        <img class="icon blue sm" src="/build/img/magnifying-glass-solid.svg" alt="icon edit">
      </button>
    </form>
  </header>
  <main class="contenedor_main">
    <table class="Table">
      <thead class="Table_head">
        <th class="Table_head_item">ID</th>
        <th class="Table_head_item">Nombre</th>
        <th class="Table_head_item">Descripción</th>
        <th class="Table_head_item">Existencias</th>
        <th class="Table_head_item">Categoria</th>
        <th class="Table_head_item">Precio Unitario</th>
        <th class="Table_head_item">Acciones</th>
      </thead>
      <tbody class="Table_body" id="table_body">
        <?php foreach ($productos as $producto) : ?>
          <tr class="Table_row">
            <td><?php echo strtoupper($producto->prod_sku) ?></td>
            <td class="capitalize txtnw"><?php echo $producto->prod_nombre ?></td>
            <td class="capitalize"><?php echo $producto->prod_descripcion ?></td>
            <td><?php echo $producto->prod_existencias ?></td>
            <td class="txtnw"><?php echo $producto->cat_nombre ?></td>
            <td class="txtnw"><?php echo format($producto->prod_precio_unitario) ?></td>
            <td class="nell">
              <a href="/productos/editar?id=<?php echo s($producto->prod_id); ?>" class="table_actions edit">
                <img class="icon blue sm" src="/build/img/pen-to-square-solid.svg" alt="home icon">
              </a>
              <button data-id="<?php echo s($producto->prod_id) ?>" data-view="<?php echo $view ?>" id="delete" class="table_actions delete">
                <img class="icon red sm" src="/build/img/trash-solid.svg" alt="home icon">
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </main>
</div>
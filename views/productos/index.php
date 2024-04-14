<?php
$view = getView($productos[0]);
?>

<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Productos</h1>
      <div class="button_active_form app_boton boton">
        <a href="/producto/crear">Agregar Producto</a>
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
        <?php foreach ($productos as $producto) : ?>
          <tr class="table_row">
            <td title="<?php echo $producto->prod_nombre; ?>"><?php echo $producto->prod_nombre ?></td>
            <td title="<?php echo $producto->prod_precio_unitario; ?>">$<?php echo $producto->prod_precio_unitario ?></td>
            <td title="<?php echo $producto->prod_existencias; ?>"><?php echo $producto->prod_existencias ?></td>
            <td title="<?php echo $producto->cat_nombre; ?>"><?php echo $producto->cat_nombre ?></td>
            <td title="<?php echo $producto->prod_descripcion; ?>"><?php echo $producto->prod_descripcion ?></td>
            <td class="nell" title="">
              <a href="/productos/editar?id=<?php echo ''; ?>" class="table_actions edit">
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
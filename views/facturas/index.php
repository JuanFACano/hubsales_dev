<div class="contenedor_app">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Facturas</h1>
      <div class="button_active_form app_boton boton">
        <a href="/facturas/crear">Agregar Factura</a>
      </div>
    </div>
    <form method="POST" class="contenedor_header_search campo_simple" action="">
      <input type="text" id="search" name="search" placeholder="Buscar Factura por ID">
      <button class="send unset">
        <img class="icon blue sm" src="/build/img/magnifying-glass-solid.svg" alt="icon edit">
      </button>
    </form>
  </header>
  <main class="contenedor_main">
    <table class="table">
      <thead class="table_head">
        <th class="table_head_item">ID</th>
        <th class="table_head_item">Fecha Venta</th>
        <th class="table_head_item">Fecha Vencimiento</th>
        <th class="table_head_item">Cedula Cliente</th>
        <th class="table_head_item">Nombre Vendedor</th>
        <th class="table_head_item">Acciones</th>
      </thead>
      <tbody class="table_body" id="table_body">
        <?php foreach ($facturas as $factura) : ?>
          <tr class="table_row">
            <td class="capitalize"><?php echo $factura->fac_numero_factura ?></td>
            <td><?php echo $factura->fac_fecha ?></td>
            <td><?php echo $factura->fac_fecha_venc ?></td>
            <td><?php echo $factura->cli_cedula ?></td>
            <td class="capitalize"><?php echo $factura->user_nombre . " " . $factura->user_apellido ?></td>
            <td class="nell">
              <a href="/factura/editar?id=<?php echo $factura->fac_id; ?>" class="table_actions edit">
                <img class="icon blue sm" src="/build/img/pen-to-square-solid.svg" alt="home icon">
              </a>
              <button data-id="<?php echo s($factura->fac_id) ?>" data-view="<?php echo $view ?>" id="delete" class="table_actions delete">
                <img class="icon red sm" src="/build/img/trash-solid.svg" alt="home icon">
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </main>
</div>
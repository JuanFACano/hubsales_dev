<?php
?>

<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">Clientes</h1>
      <div class="button_active_form app_boton boton">
        <a href="/clientes/crear">Agregar Cliente</a>
      </div>
    </div>
    <form method="POST" class="contenedor_header_search campo_simple">
      <input type="text" id="search" name="search" placeholder="Buscar Cliente por cedula">
      <button class="send unset">
        <img class="icon blue sm" src="/build/img/magnifying-glass-solid.svg" alt="icon edit">
      </button>
    </form>
  </header>
  <main class="contenedor_main">
    <table class="table">
      <thead class="table_head">
        <th class="table_head_item">Nombre</th>
        <th class="table_head_item">Cedula</th>
        <th class="table_head_item">Direccion</th>
        <th class="table_head_item">Correo</th>
        <th class="table_head_item">Action</th>
      </thead>
      <tbody class="table_body" id="table_body">
        <?php foreach ($clientes as $cliente) : ?>
          <tr class="table_row">
            <td><?php echo $cliente->cli_nombre ?></td>
            <td><?php echo $cliente->cli_cedula ?></td>
            <td><?php echo $cliente->cli_direccion ?></td>
            <td><?php echo $cliente->cli_correo ?></td>
            <td class="nell">
              <a href="/clientes/editar?id=<?php echo $cliente->cli_id; ?>" class="table_actions edit">
                <img class="icon blue sm" src="/build/img/pen-to-square-solid.svg" alt="home icon">
              </a>
              <button data-id="<?php echo s($cliente->cli_id) ?>" data-view="<?php echo $view ?>" id="delete" class="table_actions delete">
                <img class="icon red sm" src="/build/img/trash-solid.svg" alt="home icon">
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

  </main>
</div>
<div class="contenedor_app">
  <?php
  include_once __DIR__ . '/../templates/alertas.php';
  ?>
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">usuarios</h1>
      <div class="button_active_form app_boton boton">
        <a href="/usuarios/crear">Agregar Usuario</a>
      </div>
    </div>
    <form method="POST" class="contenedor_header_search campo_simple" action="">
      <input type="text" id="search" name="search" placeholder="Buscar usuario por correo">
      <button class="send unset">
        <img class="icon blue sm" src="/build/img/magnifying-glass-solid.svg" alt="icon edit">
      </button>
    </form>
  </header>
  <main class="contenedor_main">
    <table class="table">
      <thead class="table_head">
        <th class="table_head_item">Nombre</th>
        <th class="table_head_item">Rol</th>
        <th class="table_head_item">Correo</th>
        <th class="table_head_item">Action</th>
      </thead>
      <tbody class="table_body">
        <?php foreach ($usuarios as $usuario) : ?>
          <tr class="table_row">
            <td class="capitalize"><?php echo s($usuario->user_nombre) . " " . s($usuario->user_apellido) ?></td>
            <td class="capitalize"><?php echo s($usuario->rol_nombre) ?></td>
            <td><?php echo s($usuario->user_correo) ?></td>
            <td>
              <a href="/usuarios/editar?id=<?php echo s($usuario->user_id) ?>" class="table_actions edit">
                <img class="icon blue sm" src="/build/img/pen-to-square-solid.svg" alt="icon edit">
              </a>
              <button data-id="<?php echo s($usuario->user_id) ?>" data-name="" id="delete" class="table_actions delete">
                <img class="icon red sm" src="/build/img/trash-solid.svg" alt="home icon">
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
</div>
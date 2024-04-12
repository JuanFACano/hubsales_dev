<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">usuarios</h1>
      <div class="button_active_form app_boton boton">
        <a href="/usuarios/crear">Agregar Usuario</a>
      </div>
    </div>
    <div class="contenedor_header_search campo campo_search">
      <form action="">
        <input type="text" id="search" name="search" placeholder="Buscar Usuario">
      </form>
      <button class="send">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
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
        <?php foreach ($datos_base as $dato) : ?>
          <tr class="table_row">
            <td><?php echo $dato->user_nombre . " " . $dato->user_apellido ?></td>
            <td><?php echo $dato->rol_nombre ?></td>
            <td class="td_correo"><?php echo $dato->user_correo ?></td>
            <td>
              <a href="/usuarios/editar?id=<?php echo $dato->user_id ?>" class="table_actions edit">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a data-id="<?php echo $dato->user_id ?>" class="table_actions delete">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </main>
</div>
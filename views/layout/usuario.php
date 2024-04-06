<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">usuarios</h1>
      <div class="app_boton boton">
        <a href="/usuarios/crear">Agregar Usuario</a>
      </div>
    </div>
    <div class="contenedor_header_search campo">
      <input type="email" id="email" name="email" placeholder="Buscar Usuario">
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
  </header>
  <main class="contenedor_main">
    <table class="table">
      <thead class="table_head">
        <th class="table_head_item">Nombre</th>
        <th class="table_head_item">Rol</th>
        <th class="table_head_item">Correo</th>
        <th class="table_head_item">Avatar</th>
        <th class="table_head_item">Action</th>
      </thead>
      <tbody class="table_body">
        <tr class="table_row">
          <td>Juan</td>
          <td>Admin</td>
          <td>correo@correo.com</td>
          <td>
            <img src="build/img/avatar_1.webp" alt="">
          </td>
          <td>
            <button class="table_actions edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button class="table_actions delete">
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>
        <tr class="table_row">
          <td>Juan</td>
          <td>Usuario</td>
          <td>correo@correo.com</td>
          <td>
            <img src="build/img/avatar_normal.webp" alt="">
          </td>
          <td>
            <button class="table_actions edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button class="table_actions delete">
              <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>


      </tbody>
    </table>
  </main>
</div>
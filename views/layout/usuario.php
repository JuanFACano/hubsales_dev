<div class="contenedor_app">
  <header class="contenedor_header">
    <div class="contenedor_header_head">
      <h1 class="app_title">usuarios</h1>
      <div class="button_active_form app_boton boton">
        <a href="">Agregar Usuario</a>
      </div>
    </div>
    <div class="contenedor_header_search campo">
      <input type="text" id="search" name="search" placeholder="Buscar Usuario">
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

  <div class="popup">
    <div class="form_contenedor">
      <form class="form">
        <i class="fa-regular fa-circle-xmark button_close_form"></i>
        <div class="campo_doble">
          <div class="campo_simple">
            <label class="campo_label" for="name">nombre</label>
            <input type="text" name="name" id="name" placeholder="Ejm. Jhon">
          </div>
          <div class="campo_simple">
            <label class="campo_label" for="lastname">apellido</label>
            <input type="text" name="lastname" id="lastname" placeholder="Ejm. Cena">
          </div>
        </div>
        <div class="campo_simple">
          <label class="campo_label" for="email">correo</label>
          <input type="text" name="email" id="email" placeholder="ingrese un correo">
        </div>
        <div class="campo_simple">
          <label class="campo_label" for="password">Contraseña</label>
          <input type="password" name="password" id="password" placeholder="ingrese un correo">
        </div>
        <div>
          <label class="campo_label" for="role">Rol</label>
          <p class="campo_desc">Escoja un rol para el usuario</p>
          <select class="campo_select" name="role" id="role">
            <span class="focus"></span>
            <option selected>Seleccione un Rol</option>
            <option value="1">Admin</option>
            <option value="2">Usuario Base</option>
          </select>
        </div>
        <input class="boton" type="submit" value="Crear Usuario">
      </form>
    </div>
  </div>
</div>
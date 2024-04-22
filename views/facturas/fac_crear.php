<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>crear Factura</title>
  <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

  <div class="fac_crear">
    <form class="form" methoPd="POST" autocomplete="off">
      <div class="buscar" style="display: flex; align-items: flex-end; gap: 2rem;">
        <div class=" campo_simple">
          <label class="campo_label" for="buscar_criterio">Producto</label>
          <div class="input_buscar" style="display: flex; gap: 2rem;">
            <div class="buscador" style="width: 100%;">
              <input class="no_border" type="text" name="buscar_criterio" id="fac_campo_buscar" value="">
              <ul id="lista" class="lista"></ul>
            </div>
            <div class="boton_buscador">
              <input id="buscar_prod" class="boton" type="submit" value="Buscar">
            </div>
          </div>
        </div>
      </div>
      <table class="Table" id="table_container">
        <thead class="Table_head">
          <th class="Table_head_item">ID</th>
          <th class="Table_head_item">Nombre</th>
          <th class="Table_head_item">Precio Unitario</th>
          <th class="Table_head_item">Existencias</th>
          <th class="Table_head_item">Add</th>
        </thead>
        <tbody class="Table_body" id="table_body">
        </tbody>
      </table>
    </form>
    <div class="detalle">
      <h2 class="app_title">Detalle de Factura</h2>
    </div>
  </div>
  <main class="contenedor_main">

  </main>

  <script src="/build/js/app.js"></script>
</body>

</html>
const body = document.querySelector("body");

document.addEventListener('DOMContentLoaded', function () {
  iniciarApp();
});


function iniciarApp() {
  tabs();
  goBack();
  consultarAPIProductos();
}

function tabs() {
  const menuItems = body.querySelectorAll(".menu_item");
  const windowsPathname = window.location.pathname;

  menuItems.forEach(menuItem => {
    const link = menuItem.children[0];
    const menuItemPathname = new URL(link.href).pathname;

    if (windowsPathname === menuItemPathname || (windowsPathname === '/index.php' && menuItemPathname === '/')) {
      menuItem.classList.add("active")
    }
  });
}


function goBack() {
  const buttonGoBack = body.querySelector(".boton_back");
  if (buttonGoBack) {
    buttonGoBack.addEventListener("click", (e) => {
      window.history.back();
    })
  }
}

async function consultarAPIProductos() {
  try {
    const url = 'http://localhost:3000/api/productos';
    const resultado = await fetch(url);
    const productos = await resultado.json();/* 
    mostrarProductos(productos)
 */
  } catch (error) {
    console.log(error);
  }
};

function mostrarProductos(productos) {
  productos.forEach(producto => {
    const { prod_id, prod_nombre, prod_precio_unitario, prod_descripcion, prod_existencias, prod_cat_id } = producto
    // ? scripting prod_nombre
    const nombreProducto = document.createElement('TD');
    nombreProducto.textContent = prod_nombre;

    // ? scripting prod_precio
    const precioUnitario = document.createElement('TD');
    precioUnitario.textContent = `$${prod_precio_unitario}`;

    // ? scripting prod_descripcion
    const descripcion = document.createElement('TD');
    descripcion.textContent = prod_descripcion;

    // ? scripting prod_existencias
    const existencias = document.createElement('TD');
    existencias.textContent = prod_existencias;

    // ? scripting prod_cat_id
    const categoria = document.createElement('TD');
    categoria.textContent = prod_cat_id;

    // ? scripting actions
    const actions = document.createElement('TD');

    // ? create button edit
    const buttonEdit = document.createElement('BUTTON')
    buttonEdit.classList.add("table_actions")
    buttonEdit.classList.add("edit")

    buttonEdit.onclick = function () {
      editarProducto(producto)
    }

    // ? insert icon in button
    const buttonEditIcon = document.createElement('I')
    buttonEditIcon.classList.add("fa-solid")
    buttonEditIcon.classList.add("fa-pen-to-square")

    buttonEdit.appendChild(buttonEditIcon)

    // ? create button delete
    const buttonDelete = document.createElement('BUTTON')
    buttonDelete.classList.add("table_actions")
    buttonDelete.classList.add("delete")

    buttonDelete.onclick = function () {
      eliminarProducto(producto)
    }

    // ? insert icon in button
    const buttonDeleteIcon = document.createElement('I')
    buttonDeleteIcon.classList.add("fa-solid")
    buttonDeleteIcon.classList.add("fa-trash")

    buttonDelete.appendChild(buttonDeleteIcon)

    actions.appendChild(buttonEdit)
    actions.appendChild(buttonDelete)

    // ? create table row
    const tableRow = document.createElement('TR');
    tableRow.classList.add('table_row')
    tableRow.dataset.idproducto = prod_id;

    // ? add child to table row
    tableRow.appendChild(nombreProducto);
    tableRow.appendChild(precioUnitario);
    tableRow.appendChild(existencias);
    tableRow.appendChild(categoria);
    tableRow.appendChild(descripcion);
    tableRow.appendChild(actions)

    // ? draw table row
    document.querySelector('#table_body').appendChild(tableRow)

  })
}

function editarProducto(producto) {
  console.log(producto);
}
function eliminarProducto(producto) {
  console.log(producto);
}
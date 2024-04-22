const body = document.querySelector("body");

document.addEventListener('DOMContentLoaded', function () {
  iniciarApp();
});


function iniciarApp() {
  tabs();
  goBack();
  setButtons();
  autocompletar();
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


const setButtons = () => {
  const buttonDelete = document.querySelectorAll('#delete');
  buttonDelete.forEach(button => {
    button.addEventListener('click', () => {
      alerta(button, 'delete');
    })
  });
}


function alerta(button, method) {

  const view = button.getAttribute("data-view")

  let inputHidden = document.createElement('INPUT');
  inputHidden.setAttribute("type", "hidden");
  inputHidden.setAttribute("name", "id")


  let inputSend = document.createElement('INPUT');
  inputSend.setAttribute("class", "boton")
  inputSend.setAttribute("type", "submit");
  inputSend.classList.add("pad1-4")

  let actionAlert = "";

  if (method === 'delete') {
    inputSend.setAttribute("value", "Eliminar")
    inputSend.classList.add("delete")


    if (view === "usuario") {
      console.log(view);
      actionAlert = eliminarUsuario(button, inputHidden);
    }

    if (view == "producto") {
      actionAlert = eliminarProducto(button, inputHidden);
    }

    if (view == "cliente") {
      actionAlert = eliminarCliente(button, inputHidden);
    }

    if (view == "categoria") {
      actionAlert = eliminarCategoria(button, inputHidden);
    }
    if (view == 'factura') {
      console.log("eliminando de factura");
    }
  }

  const popUp = createForm(inputHidden, inputSend, actionAlert);
  document.querySelector('body').appendChild(popUp)
}

function createForm(inputHidden, inputSend, actionAlert) {
  const formImage = document.createElement('IMG');
  formImage.classList.add("form_image")
  formImage.setAttribute("src", "/build/img/message-solid.svg");

  const formTitle = document.createElement('H2');
  formTitle.classList.add("form_title")
  formTitle.textContent = "¿Estas seguro?";

  const formSpan = document.createElement('SPAN');
  formSpan.classList.add("form_span")
  formSpan.classList.add("dark")
  formSpan.textContent = " deshacer"

  const formText = document.createElement('P');
  formText.classList.add("form_text")
  formText.textContent = "una vez confirmado, el cambio no se puede"

  formText.appendChild(formSpan);

  const inputCancel = document.createElement('BUTTON');
  inputCancel.textContent = "Cancelar";
  inputCancel.setAttribute("class", "boton")
  inputCancel.classList.add("pad1-4")


  const inputContainer = document.createElement('DIV');
  inputContainer.classList.add("buttons_container")
  inputContainer.appendChild(inputCancel)
  inputContainer.appendChild(inputSend)

  const form = document.createElement('FORM')
  form.setAttribute("method", "POST")
  form.setAttribute("action", actionAlert)
  form.classList.add("form")
  form.classList.add("form_poupup")
  form.classList.add("delete")


  form.appendChild(formImage)
  form.appendChild(formTitle);
  form.appendChild(formText);
  form.appendChild(inputHidden);
  form.appendChild(inputContainer);

  const popupDiv = document.createElement('DIV');
  popupDiv.setAttribute("class", "section-popup");
  popupDiv.appendChild(form);

  inputCancel.addEventListener('click', (event) => {
    event.preventDefault();
    nodo = popupDiv.parentNode.removeChild(popupDiv)
  })

  return popupDiv;
}

function eliminarUsuario(button, inputH) {

  const id = parseInt(button.getAttribute("data-id"));

  const action = "/api/eliminar/usuario";
  inputH.setAttribute("value", id)

  return action;
}

function eliminarProducto(button, inputH) {
  const id = parseInt(button.getAttribute("data-id"));

  const action = "/api/eliminar/producto"
  inputH.setAttribute("value", id)

  return action;
}

function eliminarCliente(button, inputH) {
  const id = parseInt(button.getAttribute("data-id"));

  const action = "/api/eliminar/cliente"
  inputH.setAttribute("value", id)

  return action;
}

function eliminarCategoria(button, inputH) {
  const id = parseInt(button.getAttribute("data-id"));

  const action = "/api/eliminar/categoria"
  inputH.setAttribute("value", id)

  return action;
}

const busquedas = {
  productos: []
}


function autocompletar() {
  const campo = document.getElementById('fac_campo_buscar');
  const submit = document.getElementById('buscar_prod');
  const list = document.getElementById('lista');

  campo.addEventListener('keyup', (event) => {
    event.preventDefault();


    if (campo.value != "") {
      list.style.display = "block"

      const inputCP = campo.value;

      let url = 'http://localhost:3000/api/productos/buscar';
      let formData = new FormData()
      formData.append("fac_campo_buscar", inputCP)

      fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(
        response => response.json()
      )
        .then(
          data => mostrarProductosBuscados(data)
        )
        .catch(
          err => console.log(err)
        )
    } else {
      list.style.display = "none"
    }
  })
}

function mostrarProductosBuscados(productos) {
  if (productos.length > 0) {
    let productFilter = []
    const list = document.getElementById('lista');


    productos.forEach(producto => {
      const { prod_id, prod_sku, prod_nombre, prod_precio_unitario, prod_existencias } = producto;
      productFilter = []

      if (!productFilter[prod_sku]) {
        const productoBuscado = document.createElement('li')
        productoBuscado.classList.add('lista_item')
        productoBuscado.textContent = `${prod_sku} - ${prod_nombre}`;
        productoBuscado.dataset.prod_id = prod_id;

        productoBuscado.addEventListener('click', () => {
          console.log(`Seleccionad: ${prod_id}`);
        })

        productFilter['prod_sku'] = prod_sku
      }
    });
  }
}

function seleccionarProducto(producto) {
  const list = document.getElementById('lista');
  const { prod_id } = producto
  const { productos } = busquedas
  if (!productos.some(agregado => agregado.prod_id === prod_id)) {
    busquedas.productos = [...productos, producto]
  }
}

const crearAlerta = () => {
  const popUp = createForm();
  document.querySelector('body').appendChild(popUp)
}

const createAlertForm = () => {
  const formImage = document.createElement('IMG');
  formImage.classList.add("form_image")
  formImage.setAttribute("src", "/build/img/message-solid.svg");

  const formTitle = document.createElement('H2');
  formTitle.classList.add("form_title")
  formTitle.textContent = "¿Estas seguro?";

  const formSpan = document.createElement('SPAN');
  formSpan.classList.add("form_span")
  formSpan.classList.add("dark")
  formSpan.textContent = " deshacer"

  const formText = document.createElement('P');
  formText.classList.add("form_text")
  formText.textContent = "una vez confirmado, el cambio no se puede"


  const inputOk = document.createElement('BUTTON');
  inputOk.textContent = "Regresar";
  inputOk.setAttribute("class", "boton")
  inputOk.classList.add("pad1-4")

  const form = document.createElement('DIV')
  form.classList.add("form")
  form.classList.add("form_poupup")
  form.classList.add("delete")

  form.appendChild(formImage)
  form.appendChild(formTitle);
  form.appendChild(formText);
  form.appendChild(inputOk);

  const popupDiv = document.createElement('DIV');
  popupDiv.setAttribute("class", "section-popup");
  popupDiv.appendChild(form);

  return popupDiv
}
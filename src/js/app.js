const body = document.querySelector("body");

document.addEventListener('DOMContentLoaded', function () {
  iniciarApp();
});


function iniciarApp() {
  tabs();
  goBack();
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


const buttonDelete = document.querySelectorAll('#delete');
buttonDelete.forEach(button => {
  button.addEventListener('click', () => {
    alerta(button, 'delete');
  })
});


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
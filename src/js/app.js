const body = document.querySelector("body");

document.addEventListener('DOMContentLoaded', function () {
  iniciarApp();
});


function iniciarApp() {
  darkMode();
  tabs();
  goBack();
}

function darkMode() {
  const preferDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
  const app = document.querySelector('.app')
  const buttons = document.querySelectorAll(".boton")

  if (preferDarkMode.matches) {
    body.classList.add("dark-mode")
    app.classList.add("dark-mode")
    buttons.forEach((button) => {
      button.classList.add("dark-mode")
    })
  } else {
    body.classList.remove("dark-mode")
    app.classList.remove("dark-mode")
    butons.forEach((button) => {
      button.classList.remove("dark-mode")
    })
  }
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

function editarProducto(producto) {
  console.log(producto);
}

function eliminarProducto(producto) {
  console.log(producto);
}
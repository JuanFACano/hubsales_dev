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

function editarProducto(producto) {
  console.log(producto);
}

function eliminarProducto(producto) {
  console.log(producto);
}
const body = document.querySelector("body"),
  menuItems = body.querySelectorAll(".menu_item"),
  windowsPathname = window.location.pathname;
console.log(windowsPathname);


menuItems.forEach(menuItem => {
  const link = menuItem.children[0];
  const menuItemPathname = new URL(link.href).pathname;

  if (windowsPathname === menuItemPathname || (windowsPathname === '/index.php' && menuItemPathname === '/')) {
    menuItem.classList.add("active")
  }
});
let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hAccueil, categories) {
  let html = template;
  let categoriesli = "";
  for (let category of categories) {
    categoriesli += `<li class="navbar__menu-item" onclick="C.handlerFilterByCategory(${category.id})">${category.name}</li>`;
  }
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hAccueil}}", hAccueil);
  html = html.replace("{{categories}}", categoriesli);
  return html;
};

export { NavBar };

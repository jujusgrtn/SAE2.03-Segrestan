let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hAccueil) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replaceAll("{{hAccueil}}", hAccueil);
  return html;
};

export { NavBar };
